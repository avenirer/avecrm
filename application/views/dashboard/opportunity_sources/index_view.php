<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
  <div class="col-lg-12">
    <a href="<?php echo site_url('dashboard/opportunity-sources/create');?>" class="btn btn-primary">Create new source</a>
    <a href="<?php echo site_url('dashboard/opportunity-sources');?>" class="btn btn-primary">See all sources</a>
  </div>
</div>
<div class="row">
  <div class="col-lg-12" style="margin-top: 10px;">
    <?php
    if($sources)
    {
      echo '<table class="table table-hover table-bordered table-condensed">';
      echo '<tr><td>ID</td><td>Source</td></td><td>Info</td><td>Operations</td></tr>';
      foreach($sources as $source)
      {
        echo '<tr>';
        echo '<td>'.$source->id.'</td><td>'.$source->source.'</td><td>'.$source->info.'</td>';
        echo '<td>';
        echo anchor('dashboard/opportunity-sources/edit/'.$source->id,'<span class="fa fa-pencil"></span>').' '.anchor('dashboard/opportunity-sources/delete/'.$source->id,'<span class="fa fa-eraser"></span>');
        echo '</td>';
        echo '</tr>';
      }
      echo '</table>';
    }
    ?>
  </div>
</div>