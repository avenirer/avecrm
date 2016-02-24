<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Conversation_model extends MY_Model
{
    public $table = 'conversations';
    public $primary_key = 'id';
    public $timestamps = TRUE;
    public $soft_deletes = TRUE;
    public $has_one = array(
            'opportunity' => array('foreign_model'=>'opportunity_model','foreign_table'=>'opportunities','foreign_key'=>'id',
                    'local_key'=>'opportunity_id')
    );


    public function __construct(){
        parent::__construct();
    }
}