<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * --- Google Analytics for CodeIgniter---
 *
 * ga_type		    is the app type for application, offline is the default
 * ga_appname	    is the name of your app, used for authenticaion
 * ga_clientid 	    is the id of the client
 * ga_clientsecret	is the secret key of your app auth
 * ga_redirect_uri  is the redirect_uri of the app auth || blank for default
 * ga_devkey		is the developer key used for the API
 * ga_projectid		is the project ID of the current GA Acc
 */
$config['ga_type']	        = 'offline';
$config['ga_appname']	    = '';
$config['ga_clientid']	    = '';
$config['ga_clientsecret']	= '';
$config['ga_redirect_uri']  = '';
$config['ga_devkey']	    = '';
$config['ga_projectid']	    = '';
