<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model
{
  public $table = 'users';
  public $primary_key = 'id';

  public $has_many = array(
    'opportunities' => array('foreign_model'=>'opportunity_model','foreign_table'=>'opportunities','foreign_key'=>'assigned_to', 'local_key'=>'id')
  );

  public function __construct()
  {
    parent::__construct();
  }


}