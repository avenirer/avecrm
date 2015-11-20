<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-lg-12"><h1>Edit contact</h1></div>
  <?php echo form_open();?>
  <div class="col-lg-4">
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <?php
          echo form_label('Contact type','contact_type');
          echo form_error('contact_type');
          if($contact_types)
          {
            echo form_dropdown('contact_type',$contact_types,set_value('contact_type',$contact->contact_type),
                'class="form-control"');
          }
          else
          {
            echo '<br />';
          }
          if($this->ion_auth->is_admin()) {
            echo anchor('dashboard/contact-types/create', '<i class="fa fa-plus-circle" data-toggle="tooltip" data-placement="right" title="Add a contact type"></i>');
          }
          ?>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <?php
          echo form_label('Sex','sex');
          echo form_error('sex');
          echo form_dropdown('sex',$sex, set_value('sex',$contact->sex),'class="form-control"');
          ?>
        </div>
      </div>
    </div>
    <div class="form-group">
        <?php
        echo form_label('First name','first_name');
        echo form_error('first_name');
        echo form_input('first_name',set_value('first_name', $contact->first_name),'class="form-control"');
        ?>
    </div>
    <div class="form-group">
        <?php
        echo form_label('Last name','last_name');
        echo form_error('last_name');
        echo form_input('last_name',set_value('last_name',$contact->last_name),'class="form-control"');
        ?>
    </div>
    <div class="form-group">
      <?php
      echo form_label('Email','email');
      echo form_error('email');
      echo form_input('email',set_value('email',$contact->email),'class="form-control"');
      ?>
    </div>
    <div class="form-group">
      <?php
      echo form_label('Phone','phone');
      echo form_error('phone');
      echo form_input('phone',set_value('phone',$contact->phone),'class="form-control"');
      ?>
    </div>
    <div class="form-group">
      <?php
      echo form_label('UID','uid');
      echo form_error('uid');
      echo form_input('uid',set_value('uid',$contact->uid),'class="form-control"');
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
        echo form_label('Address','address');
        echo form_error('address');
        echo form_textarea('address',set_value('address', $contact->address),'class="form-control"');
        ?>
    </div>

    <div class="form-group">
        <?php
        echo form_label('Postal code','postal_code');
        echo form_error('postal_code');
        echo form_input('postal_code',set_value('postal_code',$contact->postal_code),'class="form-control"');
        ?>
    </div>
    <div class="form-group">
      <?php
      echo form_label('City','city');
      echo form_error('city');
      echo form_dropdown('city',$cities,set_value('cities',$contact->city),'class="form-control"');
      echo anchor('dashboard/cities/create', '<i class="fa fa-plus-circle" data-toggle="tooltip" data-placement="right" title="Add a new city"></i>');
      ?>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="form-group">
      <?php
      echo form_label('Birthday', 'birthday');
      echo form_error('birthday');
      ?>
      <div class="input-group date datepicker">
        <?php
        echo form_input('birthday', set_value('birthday', $contact->birthday), 'class="form-control"');
        ?>
        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
      </div>
    </div>
    <div class="form-group">
      <?php
      echo form_label('Additional info','info');
      echo form_error('info');
      echo form_textarea('info',set_value('info',$contact->info),'class="form-control"');
      ?>
    </div>
  </div>
  <div class="col-lg-12">
    <?php
    echo form_error('id');
    echo form_hidden('id',$contact->id);
    echo form_submit('submit', 'Edit contact', 'class="btn btn-primary btn-lg btn-block"');
    echo anchor('dashboard/contacts', 'Cancel','class="btn btn-default btn-lg btn-block"');
    echo form_close();
    ?>
    </div>
</div>