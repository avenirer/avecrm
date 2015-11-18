<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-lg-4 col-lg-offset-4">
    <h1>Edit customer type</h1>
    <?php
    echo form_open();
    ?>
      <div class="form-group">
        <?php
        echo form_label('Type','title');
        echo form_error('title');
        echo form_input('title',set_value('title',$customer_type->title),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Info','info');
        echo form_error('info');
        echo form_textarea('info',set_value('info',$customer_type->info),'class="form-control"');
        ?>
      </div>
      <?php
      echo form_error('id');
      echo form_hidden('id',$customer_type->id);
      echo form_submit('submit', 'Edit customer type', 'class="btn btn-primary btn-lg btn-block"');
      echo anchor('dashboard/customer-types', 'Cancel','class="btn btn-default btn-lg btn-block"');
    echo form_close();
      ?>
  </div>
</div>