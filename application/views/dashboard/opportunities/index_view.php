<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
<div class="col-lg-12">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#new" aria-controls="home" role="tab" data-toggle="tab">New opportunities</a></li>
    <li role="presentation"><a href="#my" aria-controls="profile" role="tab" data-toggle="tab">My opportunities</a></li>
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
            echo '<tr><td>ID</td><td>Title</td><td>Source</td><td>Status</td><td>Operations</td></tr>';
            foreach($opportunities as $opportunity)
            {
              echo '<tr>';
              echo '<td>'.$opportunity->id.'</td>';
              echo '<td>'.$opportunity->title.'</td>';
              echo '<td>'.$opportunity->source->source.'</td>';
              echo '<td>'.$opportunity->status->status.'</td>';
              echo '<td>';
              echo anchor('dashboard/opportunities/take/'.$opportunity->id,'<span class="fa fa-chevron-circle-right" data-toggle="tooltip" data-placement="top" title="Take over opportunity"></span>');
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
            echo '<tr><td>ID</td><td>Title</td><td>Source</td><td>Status</td><td>Operations</td></tr>';
            foreach($my_opportunities as $opportunity)
            {
              echo '<tr>';
              echo '<td>'.$opportunity->id.'</td>';
              echo '<td>'.$opportunity->title.'</td>';
              echo '<td>'.$opportunity->source->source.'</td>';
              echo '<td>'.$opportunity->status->status.'</td>';
              echo '<td>';
              echo anchor('dashboard/opportunities/take/'.$opportunity->id,'<span class="fa fa-chevron-circle-right" data-toggle="tooltip" data-placement="top" title="Take over opportunity"></span>');
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