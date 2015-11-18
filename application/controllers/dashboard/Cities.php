<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends Auth_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('city_model');
  }

  public function index()
  {
    $this->data['page_title'] = 'Cities';
    $this->data['cities'] = $this->city_model->order_by('name','ASC')->get_all();
    $this->render('dashboard/cities/index_view');
  }
  public function create()
  {
      $this->data['page_title'] = 'Add city';

    $id = $this->city_model->from_form()->insert();
    if($id===FALSE)
    {
      $this->render('dashboard/cities/create_view');
    }
    else
    {
        $this->rat->log('Added city with id '.$id,1,$_SESSION['user_id']);
        $this->postal->add('City added successfully','success');
        redirect('dashboard/cities');
    }
  }
  public function edit($id = 0)
  {
    $id = (int) $id;
    if($id==0)
    {
      redirect('cities');
    }
    $this->data['page_title'] = 'Edit city';
    if($this->city_model->from_form(NULL,NULL,array('id'))->update() === FALSE)
    {
      $this->data['city'] = $this->city_model->get($id);
      $this->render('dashboard/cities/edit_view');
    }
    else
    {
        $this->rat->log('Edited city with id '.$id,1,$_SESSION['user_id']);
        $this->postal->add('City edited successfully','success');
        redirect('dashboard/cities');
    }
  }

  public function delete($id = NULL)
  {
    if(is_null($id))
    {
      $this->postal->add('There\'s no city to delete','error');
    }
    elseif($this->city_model->delete($id))
    {
      $this->rat->log('Deleted city with id '.$id,0,$_SESSION['user_id']);
      $this->postal->add('City deleted successfully','success');
    }
    else
    {
      $this->postal->add('Could not delete the city','error');
    }
    redirect('dashboard/cities');
  }
}