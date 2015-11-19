<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
  <div class="col-lg-12">
    <h1><?php echo $search_value;?></h1>
  </div>
</div>
<?php
foreach($search_results as $result => $string) {
  $value = $search_value;
  $contacts = (isset(${$result})) ? ${$result} : FALSE;
  $link = anchor('dashboard/opportunities/create/0/'.$result.'/'.urlencode($value), '<span class="fa
      fa-plus-circle"></span>');

  $title = $string.' '.$link;
  ?>
  <div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
      <h2><?php echo $title;?></h2>
      <?php
      if ($contacts) {
        echo '<table class="table table-hover table-bordered table-condensed">';
        echo '<tr><td>UID</td><td>Contact</td><td>Type</td><td>Email</td><td>Phone</td><td>City</td><td>Operations</td></tr>';
        foreach ($contacts as $contact) {
          echo '<tr>';
          echo '<td>' . $contact->uid . '</td>';
          echo '<td>' . $contact->first_name . ' ' . $contact->last_name . '</td>';
          echo '<td>' . $contact->type->title . '</td>';
          echo '<td>' . $contact->email . '</td>';
          echo '<td>' . $contact->phone . '</td>';
          echo '<td>' . (isset($contact->city->name) ? $contact->city->name : '-') . '</td>';
          echo '<td>';
          echo anchor('dashboard/contacts/edit/' . $contact->id, '<span class="fa fa-pencil"></span>') . ' ';
          echo anchor('dashboard/contacts/delete/' . $contact->id, '<span class="fa fa-eraser"></span>').' ';
          echo anchor('dashboard/opportunities/create/'.$contact->id,'<span class="fa fa-star"></span>').' ';
          echo '</td>';
          echo '</tr>';
        }
        echo '</table>';
      }
      ?>
    </div>
  </div>
  <?php
}
?>