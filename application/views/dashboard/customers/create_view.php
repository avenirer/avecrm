<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-lg-4 col-lg-offset-4">
    <h1>Add customer</h1>
    <?php echo form_open();?>
    <div class="form-group">
      <?php
      echo form_label('Customer type','customer_type');
      echo form_error('customer_type');
      if($customer_types)
      {
        echo form_dropdown('customer_type',$customer_types,set_select('customer_type','1'),'class="form-control"');
      }
      else
      {
        echo '<br />';
      }
      if($this->ion_auth->is_admin()) {
        echo anchor('dashboard/customer-types/create', '<i class="fa fa-plus-circle" data-toggle="tooltip" data-placement="right" title="Add a customer type"></i>');
      }
      ?>
    </div>
    <div class="form-group">
        <?php
        echo form_label('First name','first_name');
        echo form_error('first_name');
        echo form_input('first_name',set_value('first_name'),'class="form-control"');
        ?>
    </div>
    <div class="form-group">
        <?php
        echo form_label('Last name','last_name');
        echo form_error('last_name');
        echo form_input('last_name',set_value('last_name'),'class="form-control"');
        ?>
    </div>
    <div class="form-group">
      <?php
      echo form_label('Email','email');
      echo form_error('email');
      echo form_input('email',set_value('email'),'class="form-control"');
      ?>
    </div>
    <div class="form-group">
      <?php
      echo form_label('Phone','phone');
      echo form_error('phone');
      echo form_input('phone',set_value('phone'),'class="form-control"');
      ?>
    </div>
    <div class="form-group">
      <?php
      echo form_label('Sex','sex');
      echo form_error('sex');
      echo form_dropdown('sex',$sex, set_select('sex'),'class="form-control"');
      ?>
    </div>
    <div class="form-group">
      <?php
      echo form_label('Birthday', 'birthday');
      echo form_error('birthday');
      ?>
      <div class="input-group date datetimepicker">
        <?php
        echo form_input('birthday', set_value('birthday', '0000-01-01 00:00:00'), 'class="form-control"');
        ?>
        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
      </div>
    </div>
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
        echo form_label('Address','address');
        echo form_error('address');
        echo form_textarea('address',set_value('address'),'class="form-control"');
        ?>
    </div>

    <div class="form-group">
        <?php
        echo form_label('Postal code','postal_code');
        echo form_error('postal_code');
        echo form_input('postal_code',set_value('postal_code'),'class="form-control"');
        ?>
    </div>
    <?php
    echo form_label('City','city');
    echo form_error('city');
    echo form_dropdown('city',$cities,set_select('cities','0'),'class="form-control"');
    echo anchor('dashboard/cities/create', '<i class="fa fa-plus-circle" data-toggle="tooltip" data-placement="right" title="Add a new city"></i>');
    ?>

    <div class="form-group">
      <?php
      echo form_label('Additional info','info');
      echo form_error('info');
      echo form_textarea('info',set_value('info'),'class="form-control"');
      ?>
    </div>
        <?php echo form_submit('submit', 'Add customer', 'class="btn btn-primary btn-lg btn-block"');?>
        <?php echo anchor('dashboard/customers', 'Cancel','class="btn btn-default btn-lg btn-block"');?>
        <?php echo form_close();?>
    </div>
</div>