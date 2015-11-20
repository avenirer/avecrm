<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
if(isset($contact))
{
  echo '<div class="row"><div class="col-lg-12"><a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">View contact details</a></div></div>';

}
?>
<div class="row">
  <?php
  if(isset($contact))
  {
    echo '<div class="collapse" id="collapseExample">';
  }
  ?>
  <div class="col-lg-12">
    <h2>Contact details</h2>
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
            echo form_dropdown('contact_type',$contact_types,set_select('contact_type',(isset($contact) ? $contact->contact_type : '')),'class="form-control" '.(isset($contact) ? ' readonly disabled':''));
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
          echo form_dropdown('sex',$sex, set_value('sex',(isset($contact) ? $contact->sex : '')),'class="form-control"'.(isset($contact) ? ' readonly disabled':''));
          ?>
        </div>
      </div>
    </div>
    <div class="form-group">
        <?php
        echo form_error('first_name');
        echo form_input('first_name',set_value('first_name',(isset($contact) ? $contact->first_name:'')),'class="form-control" placeholder="First name"'.(isset($contact) ? ' readonly disabled':''));
        ?>
    </div>
    <div class="form-group">
        <?php
        echo form_error('last_name');
        echo form_input('last_name',set_value('last_name',(isset($contact) ? $contact->last_name:'')),'class="form-control" placeholder="Last name"'.(isset($contact) ? ' readonly disabled':''));
        ?>
    </div>
    <div class="form-group">
      <?php
      echo form_error('email');
      echo form_input('email',set_value('email',(isset($by_email) ? $by_email : (isset($contact) ? $contact->email:''))),'class="form-control"
      placeholder="email"'.(isset($contact) ? ' readonly disabled':''));
      ?>
    </div>
    <div class="form-group">
      <?php
      echo form_error('phone');
      echo form_input('phone',set_value('phone',(isset($by_phone) ? $by_phone : (isset($contact) ? $contact->phone:''))),'class="form-control"
      placeholder="Phone"'.(isset($contact) ? ' readonly disabled':''));
      ?>
    </div>
    <div class="form-group">
      <?php
      echo form_error('uid');
      echo form_input('uid',set_value('uid',(isset($by_uid) ? $by_uid : (isset($contact) ? $contact->uid:''))),'class="form-control" placeholder="UID"'.(isset($contact) ? ' readonly disabled':''));
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
        echo form_textarea(array('name'=>'address','id'=>'address','rows'=>"8"),set_value('address',(isset($contact) ? $contact->address:'')), 'class="form-control" placeholder="Address"'.(isset($contact) ? ' readonly disabled':''));
        ?>
    </div>

    <div class="form-group">
        <?php
        echo form_error('postal_code');
        echo form_input('postal_code',set_value('postal_code',(isset($contact) ? $contact->postal_code:'')),'class="form-control" placeholder="Postal code"'.(isset($contact) ? ' readonly disabled':''));
        ?>
    </div>

    <div class="form-group">
    <?php
    echo form_error('city');
    echo form_dropdown('city',$cities,set_value('cities',(isset($contact) ? $contact->city:'')),'class="form-control"'.(isset($contact) ? ' readonly disabled':''));
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
        echo form_input('birthday', set_value('birthday',(isset($contact) ? $contact->birthday:'')), 'class="form-control" placeholder="Birthday"'.(isset($contact) ? ' readonly disabled':''));
        ?>
        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
      </div>
    </div>
    <div class="form-group">
      <?php
      echo form_error('info');
      echo form_textarea(array('name'=>'info','id'=>'info','rows'=>"5"),set_value('info',(isset($contact) ? $contact->info:'')),'class="form-control"
       placeholder="Additional info"'.(isset($contact) ? ' readonly disabled':''));
      ?>
    </div>
    <?php
    if(isset($contact))
    {
      echo form_error('contact_id');
      echo form_hidden('contact_id',$contact->id);
      echo anchor('dashboard/contacts/edit/'.$contact->id, 'Edit contact','class="btn btn-primary btn-lg btn-block"');

    }
    ?>
  </div>
  <?php
  if(isset($contact))
  {
    echo '</div>';
  }
  ?>
  <div class="col-lg-12">
    <h1>Add opportunity</h1>
  </div>
  <div class="col-lg-12">
    <div class="form-group">
      <?php
      echo form_error('title');
      echo form_input('title',set_value('title'),'class="form-control" placeholder="Title"');
      ?>
    </div>
    <?php
    echo form_error('source');
    if($sources)
    {
      echo form_dropdown('source',$sources,set_value('source'),'class="form-control"');
    }
    else
    {
      echo '<br />';
    }
    if($this->ion_auth->is_admin()) {
      echo anchor('dashboard/opportunity-sources/create', '<i class="fa fa-plus-circle" data-toggle="tooltip"
            data-placement="right" title="Add a source"></i>');
    }
    ?>

    <?php
    echo form_error('status');
    if($status)
    {
      echo form_dropdown('status',$status,set_value('status'),'class="form-control"');
    }
    else
    {
      echo '<br />';
    }
    if($this->ion_auth->is_admin()) {
      echo anchor('dashboard/opportunity-status/create', '<i class="fa fa-plus-circle" data-toggle="tooltip"
            data-placement="right" title="Add a status"></i>');
    }
    ?>
    <div class="form-group">
      <?php
      echo form_error('description');
      echo form_textarea('description',set_value('description'),'class="form-control" placeholder="Description"');
      ?>
    </div>
    <?php echo form_submit('submit', 'Add opportunity', 'class="btn btn-primary btn-lg btn-block"');?>
    <?php echo anchor('dashboard/opportunities', 'Cancel','class="btn btn-default btn-lg btn-block"');?>
    <?php echo form_close();?>
  </div>
</div>