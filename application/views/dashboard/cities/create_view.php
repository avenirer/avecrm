<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-lg-4 col-lg-offset-4">
    <h1><?php echo $this->lang->line('title');?></h1>
    <?php echo form_open();?>
        <div class="form-group">
            <?php
            echo lang('form_city_name','name');
            echo form_error('name');
            echo form_input('name',set_value('name'),'class="form-control"');
            ?>
        </div>
        <?php echo form_submit('submit', $this->lang->line('form_submit_button'), 'class="btn btn-primary btn-lg btn-block"');?>
        <?php echo anchor('dashboard/cities', $this->lang->line('form_cancel_button'),'class="btn btn-default btn-lg btn-block"');?>
        <?php echo form_close();?>
    </div>
</div>