<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->lang->load('top_menu_lang');
?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php echo anchor('dashboard', $website->title, 'class="navbar-brand"');?>
    </div>

    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><?php echo anchor('dashboard',$this->lang->line('homepage'));?></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
             aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line('opportunities');?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><?php echo anchor('dashboard/opportunities', $this->lang->line('opportunities_list'));?></li>
            <li><?php echo anchor('dashboard/opportunities/create', $this->lang->line('opportunities_add'));?></li>
            <?php
            if($this->ion_auth->is_admin()) {
              echo '<li role="separator" class="divider"></li>';
              echo '<li>'.anchor('dashboard/opportunity-sources',$this->lang->line('sources_list')).'</li>';
              echo '<li>'.anchor('dashboard/opportunity-sources/create',$this->lang->line('sources_add')).'</li>';
            }
            ?>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line('contacts');?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><?php echo anchor('dashboard/contacts', $this->lang->line('contacts_list'));?></li>
            <li><?php echo anchor('dashboard/contacts/create', $this->lang->line('contacts_add'));?></li>
            <?php
            if($this->ion_auth->is_admin()) {
              echo '<li role="separator" class="divider"></li>';
              echo '<li>'.anchor('dashboard/contact-types',$this->lang->line('contact_types_list')).'</li>';
              echo '<li>'.anchor('dashboard/contact-types/create',$this->lang->line('contact_types_add')).'</li>';
            }
            ?>
          </ul>
        </li>
        <li><?php echo anchor('dashboard/cities',$this->lang->line('cities'));?></li>
          <li><?php echo anchor('dashboard/about',$this->lang->line('about'));?></li>
      </ul>

      <?php echo form_open('dashboard/opportunities/search', 'class="navbar-form navbar-left" role="search"');?>
        <div class="form-group">
          <?php echo form_input('search',set_value('search'),'class="form-control" placeholder="'.$this->lang->line('opportunity_search_add_input').'"');?>
        </div>
        <button type="submit" class="btn btn-default"><?php echo $this->lang->line('opportunity_search_add_button');?></button>
      <?php echo form_close();?>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="//www.gravatar.com/avatar/<?php echo $_SESSION['gravatar'];?>?s=20" /> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <?php
            if($this->ion_auth->is_admin())
            {

                echo '<li role="separator" class="divider"></li>';
                echo '<li>'.anchor('dashboard/users', $this->lang->line('users_list')).'</li>';
                echo '<li>'.anchor('dashboard/users/create', $this->lang->line('users_add')).'</li>';
                echo '<li role="separator" class="divider"></li>';
                echo '<li>'.anchor('dashboard/master',$this->lang->line('website_settings')).'</li>';

            }
            ?>
            <li role="separator" class="divider"></li>
            <li><?php echo anchor('user/logout',$this->lang->line('users_logout'));?></li>
          </ul>
        </li>
      </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>