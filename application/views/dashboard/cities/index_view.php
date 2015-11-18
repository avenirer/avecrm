<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
  <div class="col-lg-12">
    <a href="<?php echo site_url('dashboard/cities/create');?>" class="btn btn-primary">Add city</a>
    <a href="<?php echo site_url('dashboard/cities');?>" class="btn btn-primary">See all cities</a>
  </div>
</div>
<div class="row">
  <div class="col-lg-12" style="margin-top: 10px;">
    <?php
    if($cities)
    {
      echo '<table class="table table-hover table-bordered table-condensed">';
      echo '<tr><td>ID</td><td>Cities</td></td><td>Operations</td></tr>';
      foreach($cities as $city)
      {
        echo '<tr>';
        echo '<td>'.$city->id.'</td><td>'.$city->name.'</td></td>';
        echo '<td>';
        echo anchor('dashboard/cities/edit/'.$city->id,'<span class="fa fa-pencil"></span>').' '.anchor('dashboard/cities/delete/'.$city->id,'<span class="fa fa-eraser"></span>');
        echo '</td>';
        echo '</tr>';
      }
      echo '</table>';
    }
    ?>
  </div>
</div>