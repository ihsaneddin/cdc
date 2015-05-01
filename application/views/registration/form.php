<?php echo form_open('register', array('role' => 'form'))?>
    <div class="form-group <?php echo has_error_for($registrant->errors, 'email')?>">
      <?php echo form_label('Email Address', 'email', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'user[email]', 'id' => 'email', 'class' => 'form-control', 'placeholder' => 'User email', 'value' => input_value($registrant->email,'email') ))?>
      <?php echo error_message_for($registrant->errors, 'email') ?>
    </div>

    <div class="form-group <?php echo has_error_for($registrant->errors, 'username')?>">
      <?php echo form_label('Username', 'username', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'user[username]', 'id' => 'username', 'class' => 'form-control', 'placeholder' => 'Username', 'value' => input_value($registrant->username,'username') ))?>
      <?php echo error_message_for($registrant->errors, 'username') ?>
    </div>

    <div class="form-group <?php echo has_error_for($registrant->errors, 'password')?>">
      <?php echo form_label('Password', 'password', array('class' => 'control-label'))?>
      <?php echo form_password(array('name' => 'user[password]', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'value' => input_value($registrant->password,'password') ))?>
      <?php echo error_message_for($registrant->errors, 'password') ?>
    </div>

    <div class="form-group <?php echo has_error_for($registrant->errors, 'password_confirmation')?>">
      <?php echo form_label('Password Confirmation', 'password_confirmation', array('class' => 'control-label'))?>
      <?php echo form_password(array('name' => 'user[password_confirmation]', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm password', 'value' => input_value($registrant->password_confirmation,'password_confirmation') ))?>
      <?php echo error_message_for($registrant->errors, 'password_confirmation') ?>
    </div>

    <div class="form-group <?php echo has_error_for($registrant->errors, 'student_id')?>">
      <?php echo form_label('Student Id', 'student_id', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'user[student_id]', 'id' => 'student_id', 'class' => 'form-control', 'placeholder' => 'Student Id', 'value' => input_value($registrant->student_id,'student_id') ))?>
      <?php echo error_message_for($registrant->errors, 'student_id') ?>
    </div>

    <?php
      $majors_select = function(){
        $select = array();
        $select[''] = '';
        foreach (Major::build_select_majors()->get() as $major) {
          $select[$major->id] = $major->name;
        }
        return $select;
      };
    ?>

    <div class="form-group for-student <?= has_error_for($registrant->errors, 'major_id')?>">
      <?php echo form_label('Major', 'major_id', array('class' => 'control-label'))?>
      <?php echo form_dropdown('user[major_id]', $majors_select(), selected_dropdown($registrant->major_id, 'major_id') , 'id="major-id" class="form-control chosen-input" data-placeholder="Select major"'); ?>
      <?php echo error_message_for($registrant->errors, 'major_id') ?>
    </div>

    <div class="form-group <?php echo has_error_for($registrant->errors, 'phone_number')?>">
      <?php echo form_label('Phone', 'phone_number', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'user[phone_number]', 'id' => 'phone_number', 'class' => 'form-control', 'placeholder' => 'Phone number', 'value' => input_value($registrant->phone_number,'phone_number') ))?>
      <?php echo error_message_for($registrant->errors, 'phone_number') ?>
    </div>

    <hr>
    <center>
      <?php echo form_button(array('name' => 'register', 'class' => 'btn btn-ar btn-success' , 'content' => 'Register', 'type' => 'submit', 'value' => 'submit'))?>
      <?php echo anchor('#', '<i class="fa fa-remove"></i>Cancel', array('class' => 'btn btn-ar btn-danger session-menu', 'data-target' => 'user-login-form', 'data-parent' => '#session-menu'))?>
    </center>
<?= form_close(); ?>

