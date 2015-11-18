<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class City_model extends MY_Model
{
  public $table = 'cities';
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
          'name' => array('field'=>'name','label'=>'City','rules'=>'trim|is_unique[cities.name]|required')
      ),
      'update' => array(
          'name' => array('field'=>'name','label'=>'Name','rules'=>'trim|required'),
          'id' => array('field'=>'id','label'=>'City ID','rules'=>'trim|is_natural_no_zero|required')

      )
  );
}