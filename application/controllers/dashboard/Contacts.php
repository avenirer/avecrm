<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends Auth_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('contact_model');
      /*
      if(!$this->ion_auth->in_group('admin'))
      {
          $this->postal->add('You are not allowed to visit the Users page','error');
          redirect('dashboard');
      }*/
  }

  public function index()
  {
    $this->data['page_title'] = 'Contacts';
    //$this->data['users'] = $this->ion_auth->users($group_id)->result();
    $this->data['contacts'] = $this->contact_model->with_city('fields:name')->with_type('fields:title')->get_all();
    $this->render('dashboard/contacts/index_view');
  }
  public function create($autoinsert = NULL, $value = NULL)
  {
    if(isset($autoinsert) && isset($value) && (in_array($autoinsert,array('by_uid','by_phone','by_email'))))
    {
      $this->data[$autoinsert] = urldecode($value);
    }
    $this->data['page_title'] = 'Create contact';

    $id = $this->contact_model->from_form()->insert();
    if($id===FALSE)
    {
      $this->load->model('contact_type_model');
      $this->data['contact_types'] = $this->contact_type_model->order_by('title','ASC')->as_dropdown('title')
          ->get_all();
      $this->data['sex'] = array('-' => 'Sex','M' => 'M','F'=>'F');
      $this->load->model('city_model');
      $this->data['cities'] = $this->city_model->as_dropdown('name')->order_by('name','ASC')->get_all();
      if($this->data['cities']===FALSE)
      {
        $this->data['cities'] = array();
      }
      array_unshift($this->data['cities'],'Localitate');
      //print_r($customer_types);
      $this->render('dashboard/contacts/create_view');
    }
    else
    {
      $this->rat->log('Added contact with id '.$id,1,$_SESSION['user_id']);
      $this->postal->add('Contact added successfully','success');
      redirect('dashboard/contacts');
    }
  }
  public function edit($id = 0)
  {
    $id = (int) $id;
    if($id==0)
    {
      redirect('contacts');
    }
    $this->data['page_title'] = 'Edit contact';
    if($this->contact_model->from_form(NULL,NULL,array('id'))->update() === FALSE)
    {
      $this->data['contact'] = $this->contact_model->get($id);
      $this->load->model('contact_type_model');
      $this->data['contact_types'] = $this->contact_type_model->order_by('title','ASC')->as_dropdown('title')
          ->get_all();
      $this->data['sex'] = array('-' => 'Sex','M' => 'M','F'=>'F');
      $this->load->model('city_model');
      $this->data['cities'] = $this->city_model->as_dropdown('name')->order_by('name','ASC')->get_all();
      if($this->data['cities']===FALSE)
      {
        $this->data['cities'] = array();
      }
      array_unshift($this->data['cities'],'Localitate');
      $this->render('dashboard/contacts/edit_view');
    }
    else
    {
      $this->rat->log('Edited contact with id '.$id,1,$_SESSION['user_id']);
      $this->postal->add('Contact edited successfully','success');
      redirect('dashboard/contacts');
    }
  }

  public function search()
  {
    $this->data['search_results'] = array(
        'by_phone'=>'Contacts by phone',
        'by_uid'=>'Contacts by unique ID',
        'by_email'=>'Contacts by email');

    $this->form_validation->set_rules('search','Search','trim|required');
    if($this->form_validation->run()===FALSE)
    {
      redirect('dashboard/contacts');
    }
    if($this->form_validation->numeric($this->input->post('search')))
    {
      $number = trim($this->input->post('search'));
      $this->data['by_phone'] = $this->contact_model->where('phone',$number)->with_type('fields:title')
          ->with_city('fields:name')->get_all();

    }
    elseif($this->form_validation->valid_email($this->input->post('search')))
    {
      $email = trim($this->input->post('search'));
      $this->data['by_email'] = $this->contact_model->where('email',$email)->with_type('fields:title')
          ->with_city('fields:name')->get_all();
    }
    elseif($this->form_validation->alpha_dash($this->input-post('search')))
    {
      $uid = trim($this->input->post('search'));
      $this->data['by_uid'] = $this->contact_model->where('uid',$uid)->with_type('fields:title')
          ->with_city('fields:name')->get_all();
    }
    $this->data['search_value'] = trim($this->input->post('search'));
    $this->render('dashboard/contacts/index_search_view');
  }

  public function delete($id = NULL)
  {
    if(is_null($id))
    {
      $this->postal->add('There\'s no contact to delete','error');
    }
    elseif($this->customer_model->delete($id))
    {
      $this->rat->log('Deleted contact with id '.$id,0,$_SESSION['user_id']);
      $this->postal->add('Contact deleted successfully','success');
    }
    else
    {
      $this->postal->add('Could not delete the contact','error');
    }
    redirect('dashboard/contacts');
  }
}