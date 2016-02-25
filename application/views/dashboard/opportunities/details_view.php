<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
if(isset($opportunity))
{
  echo '<div class="row"><div class="col-lg-12"><p><a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">'.$this->lang->line('edit_opportunity_title').'</a></p></div></div>';

}
?>
<div class="row">
    <div class="collapse" id="collapseExample">
        <?php echo form_open(site_url('dashboard/opportunities/edit'));?>
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
            echo '<div class="form-group">';
            echo form_submit('submit', 'Edit opportunity', 'class="btn btn-primary btn-lg btn-block"');
            echo '</div>';
            echo form_close();?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-12">
                <?php
                if(isset($source_links))
                {
                    echo '<ul class="nav nav-tabs" role="tablist">';
                    foreach($source_links as $source)
                    {
                        //print_r($source);
                        echo '<li role="presentation"'.(($source->source=='Email') ? 'class="active"' : '').'><a href="#tab'.$source->id.'" aria-controls="tab'.$source->id.'" role="tab" data-toggle="tab">'.$source->source.'</a></li>';
                    }
                    echo '</ul>';
                    echo '<div class="tab-content">';
                    foreach($source_links as $source) {
                        echo '<div role="tabpanel" class="tab-pane' . (($source->source == 'Email') ? ' active' : '') . '" id="tab' . $source->id . '">';
                        echo '<h2>'.$source->source.'</h2>';
                        echo form_open('dashboard/conversations/add/');
                        echo '<div class="form-group">';
                        echo form_error('body');
                        echo form_textarea('body',set_value('body'),'class="form-control" placeholder="Message"');
                        echo '</div>';
                        echo form_hidden('source_id',$source->id);
                        echo form_hidden('opportunity_id',$opportunity->id);
                        echo '<div class="form-group">';
                        echo form_submit('submit','Save/Send '.$source->source,'class="btn btn-primary btn-lg btn-block"');
                        echo '</div>';
                        echo form_close();
                        echo '</div>';
                    }
                    echo '</div>';
                }
                ?>
            </div>

            <?php

            if(isset($conversations))
            {
                echo '<div class="col-lg-12"><h1>'.$this->lang->line('conversation_history_title').'</h1></div>';
                foreach($conversations as $message)
                {
                    echo '<div class="col-lg-12">';
                    echo '<div class="panel '.(($message->initiated_by=='contact') ? 'panel-success' : 'panel-primary').'">';
                    echo '<div class="panel-heading">'.$message->created_at.'</div>';
                    echo '<div class="panel-body">';
                    echo $message->body;
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>

        </div>
    </div>
    <div class="col-lg-4">
        <?php
        if(isset($contact)) {
            ?>
            <h2>Contact info</h2>
            <table class="table table-hover table-bordered table-condensed">
                <tbody>
                <tr>
                    <th>Contact name:</th>
                    <td><?php echo $contact->first_name . ' ' . $contact->last_name;
                        echo anchor('dashboard/contacts/edit/' . $contact->id, '<span class="glyphicon glyphicon-pencil"></span>', 'class="pull-right" target="_blank"'); ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo $contact->email; ?></td>
                </tr>
                <tr>
                    <th>Phone:</th>
                    <td><?php echo $contact->phone; ?></td>
                </tr>
                <tr>
                    <th>Postal address:</th>
                    <td><?php echo $contact->address; ?></td>
                </tr>
                <tr>
                    <th>City:</th>
                    <td><?php echo $contact->city->name; ?></td>
                </tr>
                <tr>
                    <th>Postal code:</th>
                    <td><?php echo $contact->postal_code; ?></td>
                </tr>
                <tr>
                    <th>Contact type:</th>
                    <td><?php echo $contact->type->title; ?></td>
                </tr>
                </tbody>
            </table>
            <?php
        }
        ?>
    </div>
</div>


</div>