<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    protected $data = array();
    public $website;
    public $language_file;
    function __construct()
    {
        parent::__construct();
        $this->load->model('website_model');
        $this->website = $this->website_model->get();
        $this->data['website'] = $this->website;

        $this->data['page_title'] = $this->website->page_title;
        $this->data['page_description'] = '';
        $this->data['before_closing_head'] = '';
        $this->data['before_closing_body'] = '';

        $this->load->model('banned_model');
        $ips = $this->banned_model->set_cache('banned_ips',3600)->get_all();
        $banned_ips = array();
        if(!empty($ips))
        {
            foreach($ips as $ip)
            {
                $banned_ips[] = $ip->ip;
            }
        }
        if(in_array($_SERVER['REMOTE_ADDR'],$banned_ips))
        {
            echo 'You are banned from this site.';
            exit;
        }

        if($this->website->status == '0')
        {
            if($this->router->class!=='user')
            {
                $this->load->library('ion_auth');
                if (!$this->ion_auth->is_admin())
                {
                    redirect('offline', 'refresh', 503);
                }
            }
        }
    }

    protected function render($the_view = NULL, $template = 'public_master')
    {
        /* load a generic language file (this language file will be used across many pages - like in the footer of pages) */
        $this->load->language('app_files/app_lang');

        /* you can load a specific language file inside the controller constructor with $this->language_file = ''.
        The file will be loaded from the app_files directory inside specific language directory */
        if(!isset($this->language_file))
        {
            $uri = explode('/', uri_string());
            $calling_class = get_class($this);
            foreach ($uri as $key => $value) {
                if (is_numeric($value)) unset($uri[$key]);
                else $uri[$key] = str_replace('-', '_', $value);
            }

            $methods = debug_backtrace();

            foreach($methods as $method)
            {
                if($method['function']!=='render' && method_exists($calling_class,$method['function']))
                {
                    $current_method = $method['function'];
                }
            }

            $method_key = array_search($current_method, $uri);
            $language_file_array = array_slice($uri, 0, ($method_key + 1));

            $calling_class = strtolower($calling_class);
            if (!in_array($calling_class, $language_file_array)) $language_file_array[] = $calling_class;
            if (!in_array($current_method, $language_file_array)) $language_file_array[] = $current_method;
            $this->language_file = implode('_', $language_file_array);
        }

        /* verify if a language file specific to the method exists. If it does, load it. If it doesn't, simply do not load anything */
        if(file_exists(APPPATH.'language/'.$this->config->item('language').'/app_files/'.strtolower($this->language_file).'_lang.php')) {
            $this->lang->load('app_files/'.strtolower($this->language_file).'_lang');
        }


      if($template == 'json' || $this->input->is_ajax_request())
      {
        header('Content-Type: application/json');
            echo json_encode($this->data);
        }
        elseif(is_null($template))
        {
            $this->load->view($the_view,$this->data);
        }
        else
        {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            $this->load->view('templates/' . $template . '_view', $this->data);
        }
    }
}

class Auth_Controller extends MY_Controller {
    public $current_user;
    function __construct() {
        parent::__construct();
        $this->load->library(array('ion_auth','form_validation','rat'));
      $this->load->helper('form');
        $this->load->library('postal');
        if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('user/login');
        }
        $this->current_user = $this->ion_auth->user()->row();
    }
    protected function render($the_view = NULL, $template = 'auth_master')
    {
        parent::render($the_view, $template);
    }
}