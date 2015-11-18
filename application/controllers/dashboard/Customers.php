<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends Auth_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('customer_model');
      /*
      if(!$this->ion_auth->in_group('admin'))
      {
          $this->postal->add('You are not allowed to visit the Users page','error');
          redirect('dashboard');
      }*/
  }

  public function index()
  {
    $this->data['page_title'] = 'Customers';
    //$this->data['users'] = $this->ion_auth->users($group_id)->result();
    $this->data['customers'] = $this->customer_model->with_city('fields:name')->with_type('fields:title')->get_all();
    $this->render('dashboard/customers/index_view');
  }
  public function create()
  {
      $this->data['page_title'] = 'Create customer';

    $id = $this->customer_model->from_form()->insert();
    if($id===FALSE)
      {
        $this->load->model('customer_type_model');
        $this->data['customer_types'] = $this->customer_type_model->order_by('title','ASC')->as_dropdown('title')
            ->get_all();
        $this->data['sex'] = array('-' => '-','M' => 'M','F'=>'F');
        $this->load->model('city_model');
        $this->data['cities'] = $this->city_model->as_dropdown('name')->order_by('name','ASC')->get_all();
        if($this->data['cities']===FALSE)
        {
          $this->data['cities'] = array();
        }
        array_unshift($this->data['cities'],'Nementionat');
        //print_r($customer_types);
        $this->render('dashboard/customers/create_view');
      }
      else
      {
        $this->rat->log('Added customer with id '.$id,1,$_SESSION['user_id']);
        $this->postal->add('Customer added successfully','success');
        redirect('dashboard/customers');
      }
  }
  public function edit($id = 0)
  {
    $id = (int) $id;
    if($id==0)
    {
      redirect('customers');
    }
    $this->data['page_title'] = 'Edit customer';
    if($this->customer_model->from_form(NULL,NULL,array('id'))->update() === FALSE)
    {
      $this->data['customer'] = $this->customer_model->get($id);
      $this->load->model('customer_type_model');
      $this->data['customer_types'] = $this->customer_type_model->order_by('title','ASC')->as_dropdown('title')
          ->get_all();
      $this->data['sex'] = array('-' => '-','M' => 'M','F'=>'F');
      $this->load->model('city_model');
      $this->data['cities'] = $this->city_model->as_dropdown('name')->order_by('name','ASC')->get_all();
      if($this->data['cities']===FALSE)
      {
        $this->data['cities'] = array();
      }
      array_unshift($this->data['cities'],'Nementionat');
      $this->render('dashboard/customers/edit_view');
    }
    else
    {
      $this->rat->log('Edited customer with id '.$id,1,$_SESSION['user_id']);
      $this->postal->add('Customer edited successfully','success');
      redirect('dashboard/customers');
    }
  }

  public function delete($id = NULL)
  {
    if(is_null($id))
    {
      $this->postal->add('There\'s no customer to delete','error');
    }
    elseif($this->customer_model->delete($id))
    {
      $this->rat->log('Deleted customer with id '.$id,0,$_SESSION['user_id']);
      $this->postal->add('Customer deleted successfully','success');
    }
    else
    {
      $this->postal->add('Could not delete the customer','error');
    }
    redirect('dashboard/customers');
  }
}