<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
  <div class="col-lg-12">
    <?php
    echo anchor('dashboard/cities/create',$this->lang->line('link_add'),'class="btn btn-primary"').' ';
    echo anchor('dashboard/cities',$this->lang->line('link_list'),'class="btn btn-primary"');
    ?>
  </div>
</div>
<div class="row">
  <div class="col-lg-12" style="margin-top: 10px;">
    <?php
    if($cities)
    {
      echo '<table class="table table-hover table-bordered table-condensed">';
      echo '<tr><td>'.$this->lang->line('table_id_field').'</td><td>'.$this->lang->line('table_city_field').'</td><td>'.$this->lang->line('table_operations_field').'</td></tr>';
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