<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Opportunity_model extends MY_Model
{
  public $table = 'opportunities';
  public $primary_key = 'id';
  public $timestamps = TRUE;
  public $soft_deletes = TRUE;
  public $has_one = array(
    'contact' => array('foreign_model'=>'contact_model','foreign_table'=>'contacts','foreign_key'=>'id',
        'local_key'=>'contact_id'),
    'status' => array('foreign_model'=>'opportunity_status_model','foreign_table'=>'opportunity_status','foreign_key'=>'id',
          'local_key'=>'status'),
    'source' => array('foreign_model'=>'opportunity_source_model','foreign_table'=>'opportunity_sources','foreign_key'=>'id',
        'local_key'=>'source'),
    'user' => array('foreign_model'=>'user_model','foreign_table'=>'users','foreign_key'=>'id','local_key'=>'assigned_to')
  );

  public function __construct(){
    parent::__construct();
  }
}