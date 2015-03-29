    <div class="form-group <?php has_error(form_error('password'))?>">
      <?php echo form_label('New Password', 'password', array('class' => 'control-label'))?>
      <?php echo form_password(array('name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'New Password', 'autocomplete' => 'off' ))?>
      <?php echo form_error('password') ?>
    </div>

    <div class="form-group <?php has_error(form_error('password_confirmation'))?>">
      <?php echo form_label('Password Confirmation', 'password_confirmation', array('class' => 'control-label'))?>
      <?php echo form_password(array('name' => 'password_confirmation', 'id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => 'Password Confirmation' ))?>
      <?php echo form_error('password_confirmation') ?>
    </div>

    <hr>
    <center>
      <?php echo form_button(array('name' => 'create_user', 'class' => 'btn btn-ar btn-success' , 'content' => '<i class="fa fa-save"></i>Save', 'type' => 'submit', 'value' => 'submit'))?>
      <?php echo anchor('admin/users', '<i class="fa fa-remove"></i>Cancel', array('class' => 'btn btn-ar btn-danger'))?>
    </center>
