<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Opportunity_status_model extends MY_Model
{
  public $table = 'opportunity_status';
  public $primary_key = 'id';
  public $timestamps = TRUE;
  public $soft_deletes = TRUE;
  public $has_many = array(
      'opportunities' => array('foreign_model'=>'opportunity_model','foreign_table'=>'opportunities','foreign_key'=>'status',
          'local_key'=>'id')
  );

  public function __construct(){
    parent::__construct();
  }

  public $rules = array(

      'insert' => array(
        'status' => array('field'=>'status','label'=>'Status','rules'=>'trim|is_unique[opportunity_status.status]|required'),
        'info' => array('field'=>'info','label'=>'Info','rules'=>'trim'),
        'order' => array('field'=>'order','label'=>'Order','rules'=>'trim|is_natural|required')
      ),
      'update' => array(
          'status' => array('field'=>'status','label'=>'Status','rules'=>'trim|required'),
          'info' => array('field'=>'info','label'=>'Info','rules'=>'trim'),
          'order' => array('field'=>'order','label'=>'Order','rules'=>'trim|is_natural|required'),
          'id' => array('field'=>'id','label'=>'Status ID','rules'=>'trim|is_natural_no_zero|required')

      )
  );
}