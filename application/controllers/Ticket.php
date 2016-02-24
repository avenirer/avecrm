<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function _remap($url, $params = array())
    {
        if (!method_exists($this, $url) && strlen($url)==20)
        {
            $this->index($url);
        }
        elseif(method_exists($this,$url))
        {
            return call_user_func_array(array($this, 'index'), $params);
        }
        else
        {
            redirect();
        }
    }
	public function index($url)
	{
        if($this->form_validation->alpha_numeric($url) && strlen($url)==20)
        {
            $this->form_validation->set_rules('password', 'Password', 'trim|alpha_numeric|exact_length[8]|required');
            $this->form_validation->set_rules('url','URL','trim|alpha_numeric|exact_length[20]|required');
            if($this->form_validation->run()===TRUE)
            {
                $opportunity_url = $this->input->post('url');
                $password = $this->input->post('password');
                $this->load->model('opportunity_model');
                $opportunity = $this->opportunity_model->where(array('url'=>$opportunity_url, 'password'=>$password))->with_contact('fields:first_name,last_name')->with_user('fields:first_name,last_name')->get();
                if($opportunity===FALSE)
                {
                    $this->render('public/ticket/error_view');
                }
                else
                {
                    $this->load->model('conversation_model');
                    $conversation = $this->conversation_model->where('opportunity_id',$opportunity->id)->get_all();
                }

                print_r($opportunity);
                echo '<br /><br />';
                print_r($conversation);
                $this->render('public/ticket/index_view');

            }
            else
            {
                $this->data['url'] = $url;
                $this->render('public/ticket/login_view');
            }
        }
        else
        {
            redirect();
        }
	}


}
