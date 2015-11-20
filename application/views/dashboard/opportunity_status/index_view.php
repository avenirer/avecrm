<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
  <div class="col-lg-12">
    <a href="<?php echo site_url('dashboard/opportunity-status/create');?>" class="btn btn-primary">Create new status</a>
    <a href="<?php echo site_url('dashboard/opportunity-status');?>" class="btn btn-primary">See all status</a>
  </div>
</div>
<div class="row">
  <div class="col-lg-12" style="margin-top: 10px;">
    <?php
    if($status)
    {
      echo '<table class="table table-hover table-bordered table-condensed">';
      echo '<tr><td>ID</td><td>Status</td></td><td>Info</td><td>Order</td><td>Operations</td></tr>';
      foreach($status as $status)
      {
        echo '<tr>';
        echo '<td>'.$status->id.'</td><td>'.$status->status.'</td><td>'.$status->info.'</td><td>'.$status->order.'</td>';
        echo '<td>';
        echo anchor('dashboard/opportunity-status/edit/'.$status->id,'<span class="fa fa-pencil"></span>').' '.anchor('dashboard/opportunity-status/delete/'.$status->id,'<span class="fa fa-eraser"></span>');
        echo '</td>';
        echo '</tr>';
      }
      echo '</table>';
    }
    ?>
  </div>
</div>