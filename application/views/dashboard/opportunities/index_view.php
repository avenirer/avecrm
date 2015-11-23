<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
<div class="col-lg-12">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#new" aria-controls="home" role="tab" data-toggle="tab"><?php echo $this->lang->line('new_tab_title');?> <span class="badge"><?php echo (($opportunities!==FALSE) ? sizeof($opportunities) : '0');?></span></a></li>
    <li role="presentation"><a href="#my" aria-controls="profile" role="tab" data-toggle="tab"><?php echo $this->lang->line('my_tab_title');?> <span class="badge"><?php echo (($my_opportunities!==FALSE) ? sizeof($my_opportunities) : '0');?></span></a></li>
    <li role="presentation"><a href="#unread" aria-controls="profile" role="tab" data-toggle="tab"><?php echo $this->lang->line('unread_tab_title');?> <span class="badge"<?php echo (($unread_opportunities!==FALSE) ? ' style="background:red;"' : '');?>><?php echo (($unread_opportunities!==FALSE) ? sizeof($unread_opportunities) : '0');?></span></a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="new">
      <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
          <?php
          if($opportunities)
          {
            echo '<table class="table table-hover table-bordered table-condensed">';
            echo '<tr><td>'.$this->lang->line('table_id_field').'</td><td>'.$this->lang->line('table_title_field').'</td><td>'.$this->lang->line('table_source_field').'</td><td>'.$this->lang->line('table_status_field').'</td><td>'.$this->lang->line('table_operations_field').'</td></tr>';
            foreach($opportunities as $opportunity)
            {
              echo '<tr>';
              echo '<td>'.$opportunity->id.'</td>';
              echo '<td>'.$opportunity->title.'</td>';
              echo '<td>'.$opportunity->source->source.'</td>';
              echo '<td>'.$opportunity->status->status.'</td>';
              echo '<td>';
              echo anchor('dashboard/opportunities/take/'.$opportunity->id,'<span class="fa fa-chevron-circle-right" data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('table_link_take').'"></span>');
              echo '</td>';
              echo '</tr>';
            }
            echo '</table>';
          }
          ?>
        </div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="my">
      <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
          <?php
          if($my_opportunities)
          {
            echo '<table class="table table-hover table-bordered table-condensed">';
            echo '<tr><td>'.$this->lang->line('table_id_field').'</td><td>'.$this->lang->line('table_title_field').'</td><td>'.$this->lang->line('table_source_field').'</td><td>'.$this->lang->line('table_status_field').'</td><td>'.$this->lang->line('table_operations_field').'</td></tr>';
            foreach($my_opportunities as $opportunity)
            {
              echo '<tr>';
              echo '<td>'.$opportunity->id.'</td>';
              echo '<td>'.$opportunity->title.'</td>';
              echo '<td>'.$opportunity->source->source.'</td>';
              echo '<td>'.$opportunity->status->status.'</td>';
              echo '<td>';
              echo anchor('dashboard/opportunities/details/'.$opportunity->id,'<span class="glyphicon glyphicon-cog" data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('table_link_edit').'"></span>');
              echo '</td>';
              echo '</tr>';
            }
            echo '</table>';
          }
          ?>
        </div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="unread">
      <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
          <?php
          if($unread_opportunities)
          {
            echo '<table class="table table-hover table-bordered table-condensed">';
            echo '<tr><td>'.$this->lang->line('table_id_field').'</td><td>'.$this->lang->line('table_title_field').'</td><td>'.$this->lang->line('table_source_field').'</td><td>'.$this->lang->line('table_status_field').'</td><td>'.$this->lang->line('table_operations_field').'</td></tr>';
            foreach($unread_opportunities as $opportunity)
            {
              echo '<tr>';
              echo '<td>'.$opportunity->id.'</td>';
              echo '<td>'.$opportunity->title.'</td>';
              echo '<td>'.$opportunity->source->source.'</td>';
              echo '<td>'.$opportunity->status->status.'</td>';
              echo '<td>';
              echo anchor('dashboard/opportunities/details/'.$opportunity->id,'<span class="fa fa-chevron-circle-right" data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('table_link_edit').'"></span>');
              echo '</td>';
              echo '</tr>';
            }
            echo '</table>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>

</div>