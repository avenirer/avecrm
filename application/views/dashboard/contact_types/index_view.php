<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
  <div class="col-lg-12">
    <a href="<?php echo site_url('dashboard/contact-types/create');?>" class="btn btn-primary">Create
              contact type</a>
    <a href="<?php echo site_url('dashboard/contact-types');?>" class="btn btn-primary">See all contact
              types</a>
  </div>
</div>
<div class="row">
  <div class="col-lg-12" style="margin-top: 10px;">
    <?php
    if($contact_types)
    {
      echo '<table class="table table-hover table-bordered table-condensed">';
      echo '<tr><td>ID</td><td>Contact type</td></td><td>Info</td><td>Operations</td></tr>';
      foreach($contact_types as $type)
      {
        echo '<tr>';
        echo '<td>'.$type->id.'</td><td>'.$type->title.'</td><td>'.$type->info.'</td>';
        echo '<td>';
        echo anchor('dashboard/contact-types/edit/'.$type->id,'<span class="fa fa-pencil"></span>').' '.anchor('dashboard/contact-types/delete/'.$type->id,'<span class="fa fa-eraser"></span>');
        echo '</td>';
        echo '</tr>';
      }
      echo '</table>';
    }
    ?>
  </div>
</div>