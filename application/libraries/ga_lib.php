<?php

session_start();
require_once "GoogleClientApi/apiClient.php";
require_once "GoogleClientApi/contrib/apiAnalyticsService.php";


Class Ga_lib
{
    protected $service;
    protected $projectId;
    protected $client;
    protected $redirect_uri;
    protected $token;
    protected $refresh_token;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->config->load('ga_lib');
        $this->ci->load->library('session');

        // Not sure if this can be replaced with base_url() -> Yes it can;
        $scriptUri = base_url();
        $this->projectId = $this->ci->config->item('ga_projectid');

        $this->client = new apiClient();
        $this->client->setAccessType($this->ci->config->item('ga_type'));
        $this->client->setApplicationName($this->ci->config->item('ga_name'));
        $this->client->setClientId($this->ci->config->item('ga_clientid'));
        $this->client->setClientSecret($this->ci->config->item('ga_clientsecret'));
        $this->client->setRedirectUri($scriptUri);
        $this->client->setDeveloperKey($this->ci->config->item('ga_devkey')); // API key

        // $service implements the client interface, has to be set before auth call
        $this->service = new apiAnalyticsService($this->client);

        if (isset($_GET['logout'])) { // logout: destroy token
            unset($_SESSION['token']);
            die('Logged out.');
        }

        $this->setCode();
        $this->setToken();
        $this->getToken();
        //$this->refresh_token();
    }

    public function getData($start_date, $end_date, $metrics)
    {
        // metrics
        $_params[] = 'date';
        $_params[] = 'date_year';
        $_params[] = 'date_month';
        $_params[] = 'date_day';

        // dimensions
        $_params[] = 'visits';
        $_params[] = 'pageviews';
        $_params[] = 'bounces';
        $_params[] = 'entrance_bounce_rate';
        $_params[] = 'visit_bounce_rate';
        $_params[] = 'avg_time_on_site';

        $from = date('Y-m-d', time()-2*24*60*60); // 2 days
        $to = date('Y-m-d'); // today

        $month = date('m');
        $year = date('Y');
        $first = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
        $last = date('Y-m-t', mktime(0, 0, 0, $month, 1, $year));

        $metrics = 'ga:visits,ga:pageviews,ga:bounces,ga:entranceBounceRate,ga:visitBounceRate,ga:avgTimeOnSite';
        $dimensions = 'ga:date,ga:year,ga:month,ga:day';
        $data = $this->service->data_ga->get('ga:'.$this->projectId, $first, $last, $metrics, array('dimensions' => $dimensions));

        // Catch GA Data and push them in an array -> SLACKER GOOOGEL
        $dataRow = array();
        foreach($data['rows'] as $row) {
            $rowArray = array();
            foreach($_params as $colNr => $column) {
                array_push($rowArray, $row[$colNr]);
            }
            array_push($dataRow, $rowArray);
        }

        return $dataRow;
    }

    public function logout()
    {
        if (isset($_GET['logout'])) { // logout: destroy token
            unset($_SESSION['token']);
            die('Logged out.');
        }
    }

    public function GetDateInfo()
    {
        $num_days = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        $month = date('m');
        $year = date('Y');
        $date_info = array(
            'days'  => $num_days,
            'months'=> $month,
            'year'  => $year
        );
        return $date_info;
    }

    public function destroy_token()
    {
        if (isset($_GET['logout'])) { // logout: destroy token
            unset($_SESSION['token']);
            die('Logged out.');
        }
    }

    public function getToken()
    {
        if (!$this->client->getAccessToken()) { // auth call to google
            $authUrl = $this->client->createAuthUrl();
            header("Location: " . $authUrl);
            die;
        }
    }

    public function setCode()
    {
        if (isset($_GET['code'])) { // we received the positive auth callback, get the token and store it in session
            $this->client->authenticate();
            $_SESSION['token'] = $this->client->getAccessToken();
            $this->refresh_token = $_SESSION['refresh_token'];
        }
    }

    public function setToken()
    {
        if (isset($_SESSION['token'])) { // extract token from session and configure client
            $token = $_SESSION['token'];
            $this->client->setAccessToken($token);
            $this->token = $_SESSION['token'];
        }
    }

    public function refresh_token()
    {
        // Feature that has to be created if the error still exist
        $this->client->refreshToken($this->refresh_token);
    }
}