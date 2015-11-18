<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
  <div class="col-lg-12">
    <a href="<?php echo site_url('dashboard/customers/create');?>" class="btn btn-primary">Add customer</a>
    <a href="<?php echo site_url('dashboard/customers');?>" class="btn btn-primary">See all</a>
  </div>
</div>
<div class="row">
  <div class="col-lg-12" style="margin-top: 10px;">
    <?php
    if($customers)
    {
      echo '<table class="table table-hover table-bordered table-condensed">';
      echo '<tr><td>ID</td><td>Customer</td><td>Type</td><td>Email</td><td>Phone</td><td>City</td><td>Operations</td></tr>';
      foreach($customers as $customer)
      {
        echo '<tr>';
        echo '<td>'.$customer->id.'</td>';
        echo '<td>'.$customer->first_name.' '.$customer->last_name.'</td>';
        echo '<td>'.$customer->type->title.'</td>';
        echo '<td>'.$customer->email.'</td>';
        echo '<td>'.$customer->phone.'</td>';
        echo '<td>'.(isset($customer->city->name) ? $customer->city->name : '-').'</td>';
        echo '<td>';
        echo anchor('dashboard/customers/edit/'.$customer->id,'<span class="fa fa-pencil"></span>').' '.anchor('dashboard/customers/delete/'.$customer->id,'<span class="fa fa-eraser"></span>');
        echo '</td>';
        echo '</tr>';
      }
      echo '</table>';
    }
    ?>
  </div>
</div>