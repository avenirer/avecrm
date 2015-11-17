<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends MY_Model
{
  public $table = 'clients';
  public $primary_key = 'id';
  public $timestamps = TRUE;
  public $soft_deletes = TRUE;
  public $has_one = array(
    'client_type' => array('foreign_model'=>'client_type','foreign_table'=>'client_types','foreign_key'=>'id',
        'local_key'=>'client_type'),
    'company' => array('foreign_model'=>'client_company_model','foreign_table'=>'companies','foreign_key'=>'id',
        'local_key'=>'company_id'),
    'city' => array('foreign_model'=>'city_model','foreign_table'=>'cities','foreign_key'=>'id','local_key'=>'city_id')
  );

  public function __construct(){
    parent::__construct();
  }

  public $rules = array(

    'insert' => array(
      'client_type' => array('field'=>'client_type','label'=>'Client type','rules'=>'trim|is_natural|required'),
      'title' => array('field'=>'title','label'=>'Title','rules'=>'trim|in_list[m,f,-]|required'),
      'first_name' => array('field'=>'first_name','label'=>'First name','rules'=>'trim'),
      'last_name' => array('field'=>'last_name','label'=>'Last name','rules'=>'trim'),
      'email' => array('field'=>'email','label'=>'Email','rules'=>'trim|valid_email|required'),
      'phone' => array('field'=>'phone','label'=>'Phone','rules'=>'trim'),
      'birthday' => array('field'=>'birthday','label'=>'Birthday','rules'=>'trim'),
      'company' => array('field'=>'company','label'=>'Companies','rules'=>'trim|is_natural|required'),
      'address' => array('field'=>'address','label'=>'Address','rules'=>'trim'),
      'postal_code'=> array('field'=>'postal_code','label'=>'Postal code','rules'=>'trim|numeric'),
      'city' => array('field'=>'city','label'=>'City','rules'=>'trim|is_natural'),
      'info' => array('field'=>'info','label'=>'Info','rules'=>'trim')
    ),

    'update' => array(
      'title' => array('field'=>'title','label'=>'Title','rules'=>'trim|required'),
      'page_title' => array('field'=>'page_title','label'=>'Page title','rules'=>'trim'),
      'admin_email' => array('field'=>'admin_email','label'=>'Admin email','rules'=>'trim|valid_email|required'),
      'contact_email' => array('field'=>'contact_email', 'label'=>'Contact email', 'rules'=>'trim|valid_email')
    )
  );
}