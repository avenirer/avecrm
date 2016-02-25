<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <div class="row">
        <h1>Ticket view</h1>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    echo '<h2>Write us a message</h2>';
                    echo form_open();
                    echo '<div class="form-group">';
                    echo form_error('body');
                    echo form_textarea('body',set_value('body'),'class="form-control" placeholder="Message"');
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo form_submit('submit', 'Send message','class="btn btn-primary btn-lg btn-block"');
                    echo '</div>';
                    echo form_close();
                    ?>
                </div>

                <?php

                if(isset($conversation))
                {
                    echo '<div class="col-lg-12"><h1>Conversation history</h1></div>';
                    foreach($conversation as $message)
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
            <h2>Attached files</h2>
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
