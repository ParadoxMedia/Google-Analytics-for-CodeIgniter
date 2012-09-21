<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $this->load->library('ga_lib');
        $data['stats'] = $this->ga_lib->getData('', '', '');
        $this->load->view('welcome_message', $data);
	}

    public function stats()
    {
        $this->load->library('ga_lib');
        $data['stats'] = $this->ga_lib->getData('', '', '');
        $data['date_info'] = $this->ga_lib->getDateInfo();
        $this->load->view('stats', $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */