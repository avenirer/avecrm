<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-lg-4 col-lg-offset-4">
    <h1>Add city</h1>
    <?php echo form_open();?>
        <div class="form-group">
            <?php
            echo form_label('City name','name');
            echo form_error('name');
            echo form_input('name',set_value('name'),'class="form-control"');
            ?>
        </div>
        <?php echo form_submit('submit', 'Add city', 'class="btn btn-primary btn-lg btn-block"');?>
        <?php echo anchor('dashboard/cities', 'Cancel','class="btn btn-default btn-lg btn-block"');?>
        <?php echo form_close();?>
    </div>
</div>