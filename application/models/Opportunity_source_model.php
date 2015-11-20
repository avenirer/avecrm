<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Opportunity_source_model extends MY_Model
{
  public $table = 'opportunity_sources';
  public $primary_key = 'id';
  public $timestamps = TRUE;
  public $soft_deletes = TRUE;
  public $has_many = array(
      'opportunities' => array('foreign_model'=>'opportunity_model','foreign_table'=>'opportunities','foreign_key'=>'source',
          'local_key'=>'id')
  );

  public function __construct(){
    parent::__construct();
  }

  public $rules = array(

      'insert' => array(
          'source' => array('field'=>'source','label'=>'Source','rules'=>'trim|is_unique[opportunity_sources.source]|required'),
          'info' => array('field'=>'info','label'=>'Info','rules'=>'trim')
      ),
      'update' => array(
          'source' => array('field'=>'source','label'=>'Source','rules'=>'trim|required'),
          'info' => array('field'=>'info','label'=>'Info','rules'=>'trim'),
          'id' => array('field'=>'id','label'=>'Source ID','rules'=>'trim|is_natural_no_zero|required')

      )
  );
}