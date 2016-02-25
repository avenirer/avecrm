<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <div class="row">
        <h1>Ticket view</h1>
        <p>You reached this page because are trying to view a ticket that is protected by a password. In order to access the ticket conversation history and files, we need you to insert the password you received with this particular ticket.</p>
        <div class="col-lg-4 col-lg-offset-4">
            <?php echo $this->session->flashdata('message');?>
            <?php echo form_open('',array('class'=>'form-horizontal'));?>
            <div class="form-group">
                <?php echo form_label('Password','password');?>
                <?php echo form_error('password');?>
                <?php echo form_password('password','','class="form-control"');?>
                <?php echo form_hidden('url',$url);?>
            </div>
            <div class="form_group">
                <?php echo form_submit('submit', 'Enter', 'class="btn btn-primary btn-lg btn-block"');?>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
