<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_types extends Auth_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('contact_type_model');
      if(!$this->ion_auth->in_group('admin'))
      {
          $this->postal->add('You are not allowed to visit the contact types page','error');
          redirect('dashboard');
      }
  }

  public function index()
  {
    $this->data['page_title'] = 'Customer types';
    $this->data['contact_types'] = $this->contact_type_model->order_by('title','ASC')->get_all();
    $this->render('dashboard/contact_types/index_view');
  }
  public function create()
  {
      $this->data['page_title'] = 'Create contact type';

    $id = $this->contact_type_model->from_form()->insert();
    if($id===FALSE)
    {
      $this->render('dashboard/contact_types/create_view');
    }
    else
    {
        $this->rat->log('Added contact type with id '.$id,1,$_SESSION['user_id']);
        $this->postal->add('Contact type added successfully','success');
        redirect('dashboard');
    }
  }
  public function edit($type_id = 0)
  {
    $type_id = (int) $type_id;
    if($type_id==0)
    {
      redirect('dashboard/contact-types');
    }
    $this->data['page_title'] = 'Edit contact type';
    if($this->contact_type_model->from_form(NULL,NULL,array('id'))->update() === FALSE)
    {
      $this->data['contact_type'] = $this->contact_type_model->get($type_id);
      $this->render('dashboard/contact_types/edit_view');
    }
    else
    {
        $this->rat->log('Edited contact type with id '.$type_id,1,$_SESSION['user_id']);
        $this->postal->add('Contact type edited successfully','success');
        redirect('dashboard/contact-types');
    }
  }

  public function delete($type_id = NULL)
  {
    if(is_null($type_id))
    {
      $this->postal->add('There\'s no contact to delete','error');
    }
    elseif($this->customer_type_model->delete($type_id))
    {
      $this->rat->log('Deleted contact type with id '.$type_id,0,$_SESSION['user_id']);
      $this->postal->add('Contact type deleted successfully','success');
    }
    else
    {
      $this->postal->add('Could not delete the contact type','error');
    }
    redirect('dashboard/contact_types');
  }
}