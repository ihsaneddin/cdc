    <div class="form-group <?php has_error(form_error('email'))?>">
      <?php echo form_label('Email Address', 'email', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'email', 'id' => 'email', 'class' => 'form-control', 'placeholder' => 'User email', 'value' => input_value($user->email,'email') ))?>
      <?php echo form_error('email') ?>
    </div>

    <div class="form-group <?php has_error(form_error('username'))?>">
      <?php echo form_label('Username', 'username', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'username', 'id' => 'username', 'class' => 'form-control', 'placeholder' => 'Username', 'value' => input_value($user->username,'username') ))?>
      <?php echo form_error('username') ?>
    </div>

    <div class="form-group <?php has_error(form_error('password'))?>">
      <?php echo form_label('Password', 'password', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'User password'))?>
      <?php echo form_error('password') ?>
    </div>

    <div class="form-group">
      <?php echo form_label('First Name', 'first_name', array('class' => 'control-label'))?>
      <?php echo form_input(array('class' => 'form-control', 'name' => 'first_name', 'id' => 'first_name', 'placeholder' => 'User first name', 'value' => input_value($user->first_name,'first_name') ))?>
      <?php echo form_error('first_name') ?>
    </div>

    <div class="form-group">
      <?php echo form_label('Last Name', 'last_name', array('class' => 'control-label'))?>
      <?php echo form_input(array('class' => 'form-control', 'name' => 'last_name', 'id' => 'last_name', 'placeholder' => 'User last name', 'value' => input_value($user->last_name,'last_name') ))?>
      <?php echo form_error('last_name') ?>
    </div>

    <div class="form-group">
      <?php echo form_label('Date Of Birth', 'date_of_birth', array('class' => 'control-label'))?>
      <?php echo form_input(array('class' => 'form-control input-sm input-date', 'name' => 'date_of_birth', 'id' => 'date_of_birth', 'value' => input_value(is_null($user->date_of_birth) ? '' : nice_date($user->date_of_birth, 'Y/m/d'), 'date_of_birth')  ))?>
      <?php echo form_error('date_of_birth') ?>
    </div>

    <div class="form-group">
      <?php echo form_label('Type', 'group', array('class' => 'control-label'))?>
      <br>
      <?php echo form_checkbox(array('name' => 'group', 'class' => 'form-control switch', 'value' => 'trainer', 'data-on-text' => 'Trainer', 'data-off-text' => 'Student', 'checked' => ''.set_value('group') != '' ? 'potato' : student_or_trainer($user) .'' ) )?>
      <?php echo form_error('group') ?>
    </div>

    <div class="form-group <?php has_error(form_error('student_id'))?>">
      <?php echo form_label('Student Id', 'student_id', array('class' => 'control-label'))?>
      <?php echo form_input(array('class' => 'form-control', 'name' => 'student_id', 'id' => 'student_id', 'value' => input_value($user->student_id,'student_id') ))?>
      <?php echo form_error('student_id') ?>
    </div>

    <div class="form-group <?php has_error(form_error('phone_number'))?>">
      <?php echo form_label('Phone Number', 'phone_number', array('class' => 'control-label'))?>
      <?php echo form_input(array('class' => 'form-control', 'name' => 'phone_number', 'id' => 'phone_number', 'value' => input_value($user->phone_number,'phone_number') ))?>
      <?php echo form_error('phone_number') ?>
    </div>

    <hr>
    <center>
      <?php echo form_button(array('name' => 'create_user', 'class' => 'btn btn-ar btn-success' , 'content' => '<i class="fa fa-save"></i>Save', 'type' => 'submit', 'value' => 'submit'))?>
      <?php echo anchor('admin/users', '<i class="fa fa-remove"></i>Cancel', array('class' => 'btn btn-ar btn-danger'))?>
    </center>

<script>
$(document).ready(function(){

  if ($('input[name=group]')[0].checked)
    $('input[name=student_id]').parents('div.form-group').hide();
  else
    $('input[name=student_id]').parents('div.form-group').show();

  $(".switch").bootstrapSwitch({
    onSwitchChange : function()
    {
      $('input[name=student_id]').parents('div.form-group').toggle();
    }
  });

  $('.input-date').datepicker({format: 'yyyy/mm/dd'}).on('changeDate', function(ev){
    $(this).datepicker('hide');
  });
});

</script>