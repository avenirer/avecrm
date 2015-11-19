<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-lg-12">
    <h1>Add contact</h1>
  </div>
  <div class="col-lg-4">
    <?php echo form_open();?>
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <?php
          echo form_error('contact_type');
          if($contact_types)
          {
            echo form_dropdown('contact_type',$contact_types,set_value('contact_type','1'),'class="form-control"');
          }
          else
          {
            echo '<br />';
          }
          if($this->ion_auth->is_admin()) {
            echo anchor('dashboard/contact-types/create', '<i class="fa fa-plus-circle" data-toggle="tooltip"
            data-placement="right" title="Add a contact type"></i>');
          }
          ?>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <?php
          echo form_error('sex');
          echo form_dropdown('sex',$sex, set_value('sex'),'class="form-control"');
          ?>
        </div>
      </div>
    </div>
    <div class="form-group">
        <?php
        echo form_error('first_name');
        echo form_input('first_name',set_value('first_name'),'class="form-control" placeholder="First name"');
        ?>
    </div>
    <div class="form-group">
        <?php
        echo form_error('last_name');
        echo form_input('last_name',set_value('last_name'),'class="form-control" placeholder="Last name"');
        ?>
    </div>
    <div class="form-group">
      <?php
      echo form_error('email');
      echo form_input('email',set_value('email',(isset($by_email) ? $by_email : '')),'class="form-control"
      placeholder="email"');
      ?>
    </div>
    <div class="form-group">
      <?php
      echo form_error('phone');
      echo form_input('phone',set_value('phone',(isset($by_phone) ? $by_phone : '')),'class="form-control"
      placeholder="Phone"');
      ?>
    </div>
    <div class="form-group">
      <?php
      echo form_error('uid');
      echo form_input('uid',set_value('uid',(isset($by_uid) ? $by_uid : '')),'class="form-control" placeholder="UID"');
      ?>
    </div>
  </div>
  <div class="col-lg-4">
    <?php /*
    <div class="form-group">
      <?php
      echo form_label('Company','company');
      echo form_error('company');
      echo form_input('company',set_value('company'),'class="form-control"');
      ?>
    </div>
    */
    ?>

    <div class="form-group">
        <?php
        echo form_error('address');
        echo form_textarea(array('name'=>'address','id'=>'address','rows'=>"8"),set_value('address'),
            'class="form-control"
        placeholder="Address"');
        ?>
    </div>

    <div class="form-group">
        <?php
        echo form_error('postal_code');
        echo form_input('postal_code',set_value('postal_code'),'class="form-control" placeholder="Postal code"');
        ?>
    </div>

    <div class="form-group">
    <?php
    echo form_error('city');
    echo form_dropdown('city',$cities,set_value('cities','0'),'class="form-control"');
    echo anchor('dashboard/cities/create', '<i class="fa fa-plus-circle" data-toggle="tooltip" data-placement="right" title="Add a new city"></i>');
    ?>
    </div>

  </div>
  <div class="col-lg-4">

    <div class="form-group">
      <?php
      echo form_error('birthday');
      ?>
      <div class="input-group date datepicker">
        <?php
        echo form_input('birthday', set_value('birthday'), 'class="form-control" placeholder="Birthday"');
        ?>
        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
      </div>
    </div>
    <div class="form-group">
      <?php
      echo form_error('info');
      echo form_textarea(array('name'=>'info','id'=>'info','rows'=>"5"),set_value('info'),'class="form-control"
       placeholder="Additional info"');
      ?>
    </div>
        <?php echo form_submit('submit', 'Add contact', 'class="btn btn-primary btn-lg btn-block"');?>
        <?php echo anchor('dashboard/contacts', 'Cancel','class="btn btn-default btn-lg btn-block"');?>
        <?php echo form_close();?>
    </div>
</div>