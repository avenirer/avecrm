<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_type_model extends MY_Model
{
  public $table = 'customer_types';
  public $primary_key = 'id';
  public $timestamps = TRUE;
  public $soft_deletes = TRUE;
  public $has_many = array(
      'customers' => array('foreign_model'=>'customer_model','foreign_table'=>'customers','foreign_key'=>'customer_type','local_key'=>'id')
  );

  public function __construct(){
    parent::__construct();
  }

  public $rules = array(

      'insert' => array(
          'title' => array('field'=>'title','label'=>'Type','rules'=>'trim|is_unique[customer_types.title]|required'),
          'info' => array('field'=>'info','label'=>'Info','rules'=>'trim')
      ),
      'update' => array(
          'title' => array('field'=>'title','label'=>'Type','rules'=>'trim|required'),
          'info' => array('field'=>'info','label'=>'Info','rules'=>'trim'),
          'id' => array('field'=>'id','label'=>'Customer type ID','rules'=>'trim|is_natural_no_zero|required')

      )
  );
}