<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_types extends Auth_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('customer_type_model');
      if(!$this->ion_auth->in_group('admin'))
      {
          $this->postal->add('You are not allowed to visit the customer types page','error');
          redirect('dashboard');
      }
  }

  public function index()
  {
    $this->data['page_title'] = 'Customer types';
    $this->data['customer_types'] = $this->customer_type_model->order_by('title','ASC')->get_all();
    $this->render('dashboard/customer_types/index_view');
  }
  public function create()
  {
      $this->data['page_title'] = 'Create customer type';

    $id = $this->customer_type_model->from_form()->insert();
    if($id===FALSE)
    {
      $this->render('dashboard/customer_types/create_view');
    }
    else
    {
        $this->rat->log('Added customer type with id '.$id,1,$_SESSION['user_id']);
        $this->postal->add('Customer type added successfully','success');
        redirect('dashboard');
    }
  }
  public function edit($type_id = 0)
  {
    $type_id = (int) $type_id;
    if($type_id==0)
    {
      redirect('customer-types');
    }
    $this->data['page_title'] = 'Edit customer type';
    if($this->customer_type_model->from_form(NULL,NULL,array('id'))->update() === FALSE)
    {
      $this->data['customer_type'] = $this->customer_type_model->get($type_id);
      $this->render('dashboard/customer_types/edit_view');
    }
    else
    {
        $this->rat->log('Edited customer type with id '.$type_id,1,$_SESSION['user_id']);
        $this->postal->add('Customer type edited successfully','success');
        redirect('dashboard/customer-types');
    }
  }

  public function delete($type_id = NULL)
  {
    if(is_null($type_id))
    {
      $this->postal->add('There\'s no user to delete','error');
    }
    elseif($this->customer_type_model->delete($type_id))
    {
      $this->rat->log('Deleted customer type with id '.$type_id,0,$_SESSION['user_id']);
      $this->postal->add('Customer type deleted successfully','success');
    }
    else
    {
      $this->postal->add('Could not delete the customer type','error');
    }
    redirect('dashboard/customer_types');
  }
}