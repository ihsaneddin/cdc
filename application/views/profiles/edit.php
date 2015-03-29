<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title with-panel-action">Edit Your Profile</h3>
  </div>
</div>
<div class="col-md-10 col-sm-offset-1">
<div class="panel panel-primary">
  <div class="panel-heading">Update Profile</div>
  <div class="panel-body">

    <?php echo  form_open_multipart('profiles/update', array('class' => 'form', 'role' => 'form', 'method' => 'post', 'id' => 'edit-profile-form'))?>

	   <?php $this->load->section('profile_form', 'profiles/form', array('current_user' => $current_user))?>
	   <?php echo $this->load->get_section('profile_form')?>

	  <?php echo form_close()?>

  </div>
</div>
</div>