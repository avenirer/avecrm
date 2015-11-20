<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-lg-4 col-lg-offset-4">
    <h1>Edit status</h1>
    <?php
    echo form_open();
    ?>
      <div class="form-group">
        <?php
        echo form_label('Status','status');
        echo form_error('status');
        echo form_input('status',set_value('status',$status->status),'class="form-control"');
        ?>
      </div>
    <div class="form-group">
      <?php
      echo form_label('Info','info');
      echo form_error('info');
      echo form_textarea('info',set_value('info',$status->info),'class="form-control"');
      ?>
    </div>
    <div class="form-group">
      <?php
      echo form_label('Order','order');
      echo form_error('order');
      echo form_input('order',set_value('order',$status->order),'class="form-control"');
      ?>
    </div>
      <?php
      echo form_error('id');
      echo form_hidden('id',$status->id);
      echo form_submit('submit', 'Edit status', 'class="btn btn-primary btn-lg btn-block"');
      echo anchor('dashboard/opportunity-status', 'Cancel','class="btn btn-default btn-lg btn-block"');
    echo form_close();
      ?>
  </div>
</div>