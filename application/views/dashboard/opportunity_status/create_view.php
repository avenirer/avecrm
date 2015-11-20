<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-lg-4 col-lg-offset-4">
    <h1>Add opportunity status</h1>
    <?php echo form_open();?>
      <div class="form-group">
          <?php
          echo form_label('Status','status');
          echo form_error('status');
          echo form_input('status',set_value('status'),'class="form-control"');
          ?>
      </div>
      <div class="form-group">
          <?php
          echo form_label('Info','info');
          echo form_error('info');
          echo form_textarea('info',set_value('info'),'class="form-control"');
          ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Order','order');
        echo form_error('order');
        echo form_input('order',set_value('order'),'class="form-control"');
        ?>
      </div>
        <?php echo form_submit('submit', 'Add opportunity status', 'class="btn btn-primary btn-lg btn-block"');?>
        <?php echo anchor('dashboard/opportunity-status', 'Cancel','class="btn btn-default btn-lg btn-block"');?>
        <?php echo form_close();?>
    </div>
</div>