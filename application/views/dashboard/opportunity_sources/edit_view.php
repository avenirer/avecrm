<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-lg-4 col-lg-offset-4">
    <h1>Edit source</h1>
    <?php
    echo form_open();
    ?>
      <div class="form-group">
        <?php
        echo form_label('Source','source');
        echo form_error('source');
        echo form_input('source',set_value('source',$source->source),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Info','info');
        echo form_error('info');
        echo form_textarea('info',set_value('info',$source->info),'class="form-control"');
        ?>
      </div>
      <?php
      echo form_error('id');
      echo form_hidden('id',$source->id);
      echo form_submit('submit', 'Edit source', 'class="btn btn-primary btn-lg btn-block"');
      echo anchor('dashboard/opportunity-sources', 'Cancel','class="btn btn-default btn-lg btn-block"');
    echo form_close();
      ?>
  </div>
</div>