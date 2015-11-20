<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opportunity_sources extends Auth_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('opportunity_source_model');
      if(!$this->ion_auth->in_group('admin'))
      {
          $this->postal->add('You are not allowed to visit the opportunity sources page','error');
          redirect('dashboard');
      }
  }

  public function index()
  {
    $this->data['page_title'] = 'Opportunity sources';
    $this->data['sources'] = $this->opportunity_source_model->order_by('source','ASC')->get_all();
    $this->render('dashboard/opportunity_sources/index_view');
  }

  public function create()
  {
      $this->data['page_title'] = 'Create opportunity source';

    $id = $this->opportunity_source_model->from_form()->insert();
    if($id===FALSE)
    {
      $this->render('dashboard/opportunity_sources/create_view');
    }
    else
    {
        $this->rat->log('Added opportunity source with id '.$id,1);
        $this->postal->add('Opportunity source added successfully','success');
        redirect('dashboard/opportunity-sources');
    }
  }

  public function edit($id = 0)
  {
    $id = (int) $id;
    if($id==0)
    {
      redirect('dashboard/opportunity-sources');
    }
    $this->data['page_title'] = 'Edit opportunity';
    if($this->opportunity_source_model->from_form(NULL,NULL,array('id'))->update() === FALSE)
    {
      $this->data['source'] = $this->opportunity_source_model->get($id);
      $this->render('dashboard/opportunity_sources/edit_view');
    }
    else
    {
        $this->rat->log('Edited source with id '.$id,1);
        $this->postal->add('Source edited successfully','success');
        redirect('dashboard/opportunity-sources');
    }
  }

  public function delete($id = NULL)
  {
    if(is_null($id))
    {
      $this->postal->add('There\'s no source to delete','error');
    }
    elseif($this->opportunity_sources_model->delete($id))
    {
      $this->rat->log('Deleted source with id '.$id,0);
      $this->postal->add('Source deleted successfully','success');
    }
    else
    {
      $this->postal->add('Could not delete the source','error');
    }
    redirect('dashboard/opportunity-sources');
  }
}