<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
if(isset($opportunity))
{
  echo '<div class="row"><div class="col-lg-12"><a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">'.$this->lang->line('edit_opportunity_title').'</a></div></div>';

}
?>
<div class="row">
    <div class="collapse" id="collapseExample">
        <div class="col-lg-12">
            <h2><?php echo $this->lang->line('edit_opportunity_title');?></h2>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <?php
                echo form_error('title');
                echo form_input('title',set_value('title',$opportunity->title),'class="form-control" placeholder="Title"');
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_error('source');
                if($sources)
                {
                    echo form_dropdown('source',$sources,set_value('source',$opportunity->source),'class="form-control"');
                }
                else
                {
                    echo '<br />';
                }
                if($this->ion_auth->is_admin()) {
                    echo anchor('dashboard/opportunity-sources/create', '<i class="fa fa-plus-circle" data-toggle="tooltip"
                data-placement="right" title="Add a source"></i>');
                }
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_error('status');
                if($status)
                {
                    echo form_dropdown('status',$status,set_value('status',$opportunity->status),'class="form-control"');
                }
                else
                {
                    echo '<br />';
                }
                if($this->ion_auth->is_admin()) {
                    echo anchor('dashboard/opportunity-status/create', '<i class="fa fa-plus-circle" data-toggle="tooltip"
                data-placement="right" title="Add a status"></i>');
                }
                ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <?php
                echo form_error('description');
                echo form_textarea('description',set_value('description',$opportunity->description),'class="form-control" placeholder="Description"');
                ?>
            </div>
        </div>
        <div class="col-lg-12">
            <?php
            echo form_error('opportunity_id');
            echo form_hidden('opportunity_id',$opportunity->id);
            echo form_submit('submit', 'Edit opportunity', 'class="btn btn-primary btn-lg btn-block"');
            echo anchor('dashboard/opportunities', 'Cancel','class="btn btn-default btn-lg btn-block"');
            echo form_close();?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <h1><?php echo $this->lang->line('conversation_history_title');?></h1>
        <?php


        echo anchor('dashboard/opportunity/edit/'.$opportunity->id, 'Edit opportunity','class="btn btn-primary btn-lg btn-block"');
        ?>
    </div>



</div>