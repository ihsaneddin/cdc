<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title with-panel-action">Edit Your Profile</h3>
  </div>
  <div class="panel-body">
    <div class="col-md-10 col-sm-offset-1">
      <div class="panel panel-primary">
        <div class="panel-heading">Change Password</div>
        <div class="panel-body">

          <?php echo  form_open('profiles/update_password', array('class' => 'form', 'role' => 'form', 'method' => 'post', 'id' => 'edit-profile-form'))?>

           <?php $this->load->section('edit_password_form', 'profiles/edit_password_form', array('current_user' => $current_user))?>
           <?php echo $this->load->get_section('edit_password_form')?>

          <?php echo form_close()?>

        </div>
      </div>
    </div>
  </div>
</div>
