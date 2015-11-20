<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opportunity_status extends Auth_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('opportunity_status_model');
      if(!$this->ion_auth->in_group('admin'))
      {
          $this->postal->add('You are not allowed to visit the opportunity status page','error');
          redirect('dashboard');
      }
  }

  public function index()
  {
    $this->data['page_title'] = 'Opportunity status';
    $this->data['status'] = $this->opportunity_status_model->order_by('order','ASC')->get_all();
    $this->render('dashboard/opportunity_status/index_view');
  }

  public function create()
  {
      $this->data['page_title'] = 'Create opportunity status';

    $id = $this->opportunity_status_model->from_form()->insert();
    if($id===FALSE)
    {
      $this->render('dashboard/opportunity_status/create_view');
    }
    else
    {
        $this->rat->log('Added opportunity status with id '.$id,1);
        $this->postal->add('Opportunity status added successfully','success');
        redirect('dashboard/opportunity-status');
    }
  }

  public function edit($id = 0)
  {
    $id = (int) $id;
    if($id==0)
    {
      redirect('dashboard/opportunity-status');
    }
    $this->data['page_title'] = 'Edit opportunity status';
    if($this->opportunity_status_model->from_form(NULL,NULL,array('id'))->update() === FALSE)
    {
      $this->data['status'] = $this->opportunity_status_model->get($id);
      $this->render('dashboard/opportunity_status/edit_view');
    }
    else
    {
        $this->rat->log('Edited status with id '.$id,1);
        $this->postal->add('status edited successfully','success');
        redirect('dashboard/opportunity-status');
    }
  }

  public function delete($id = NULL)
  {
    if(is_null($id))
    {
      $this->postal->add('There\'s no status to delete','error');
    }
    elseif($this->opportunity_status_model->delete($id))
    {
      $this->rat->log('Deleted status with id '.$id,0);
      $this->postal->add('Status deleted successfully','success');
    }
    else
    {
      $this->postal->add('Could not delete the status','error');
    }
    redirect('dashboard/opportunity-status');
  }
}