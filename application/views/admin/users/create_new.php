<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title with-panel-action">Create User</h3>
  </div>
</div>
<div class="col-md-10 col-sm-offset-1">
<div class="panel panel-primary">
  <div class="panel-heading">Please fill the form below</div>
  <div class="panel-body">

    <?php echo  form_open('admin/users/create', array('class' => 'form', 'role' => 'form'))?>

	     <?php $this->load->section('user_form', 'admin/users/form', array('user' => $user))?>
	     <?php echo $this->load->get_section('user_form')?>

	  <?php echo form_close()?>

  </div>
</div>
</div>