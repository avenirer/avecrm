<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
  <div class="col-lg-12">
    <a href="<?php echo site_url('dashboard/customer-types/create');?>" class="btn btn-primary">Create
              customer type</a>
    <a href="<?php echo site_url('dashboard/customer-types');?>" class="btn btn-primary">See all customer
              types</a>
  </div>
</div>
<div class="row">
  <div class="col-lg-12" style="margin-top: 10px;">
    <?php
    if($customer_types)
    {
      echo '<table class="table table-hover table-bordered table-condensed">';
      echo '<tr><td>ID</td><td>Customer type</td></td><td>Info</td><td>Operations</td></tr>';
      foreach($customer_types as $type)
      {
        echo '<tr>';
        echo '<td>'.$type->id.'</td><td>'.$type->title.'</td><td>'.$type->info.'</td></td>';
        echo '<td>';
        echo anchor('dashboard/customer-types/edit/'.$type->id,'<span class="fa fa-pencil"></span>').' '.anchor('dashboard/customer-types/delete/'.$type->id,'<span class="fa fa-eraser"></span>');
        echo '</td>';
        echo '</tr>';
      }
      echo '</table>';
    }
    ?>
  </div>
</div>