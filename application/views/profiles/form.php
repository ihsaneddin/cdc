    <div class="row">
      <div class="col-md-4 col-sm-offset-4">
      <center>
      <div class="form-group <?php has_error(form_error('avatar'))?>">
        <?php echo form_upload(array('name' => 'avatar', 'id' => 'avatar', 'class' => 'form-control file-input', 'placeholder' => 'Username' ))?>
        <?php echo form_error('avatar') ?>
        <?php echo form_input(array('name' => '_delete_avatar', 'id' => '_delete-avatar', 'type' => 'hidden'))?>
      </div>
      </center>
      </div>
    </div>

    <div class="form-group <?php has_error(form_error('email'))?>">
      <?php echo form_label('Email Address', 'email', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'email', 'id' => 'email', 'class' => 'form-control', 'placeholder' => 'User email', 'value' => input_value($current_user->email,'email') ))?>
      <?php echo form_error('email') ?>
    </div>

    <div class="form-group <?php has_error(form_error('username'))?>">
      <?php echo form_label('Username', 'username', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'username', 'id' => 'username', 'class' => 'form-control', 'placeholder' => 'Username', 'value' => input_value($current_user->username,'username') ))?>
      <?php echo form_error('username') ?>
    </div>

    <div class="form-group">
      <?php echo form_label('First Name', 'first_name', array('class' => 'control-label'))?>
      <?php echo form_input(array('class' => 'form-control', 'name' => 'first_name', 'id' => 'first_name', 'placeholder' => 'User first name', 'value' => input_value($current_user->first_name,'first_name') ))?>
      <?php echo form_error('first_name') ?>
    </div>

    <div class="form-group">
      <?php echo form_label('Last Name', 'last_name', array('class' => 'control-label'))?>
      <?php echo form_input(array('class' => 'form-control', 'name' => 'last_name', 'id' => 'last_name', 'placeholder' => 'User last name', 'value' => input_value($current_user->last_name,'last_name') ))?>
      <?php echo form_error('last_name') ?>
    </div>

    <div class="form-group <?php has_error(form_error('phone_number'))?>">
      <?php echo form_label('Phone Number', 'phone_number', array('class' => 'control-label'))?>
      <?php echo form_input(array('class' => 'form-control', 'name' => 'phone_number', 'id' => 'phone_number', 'value' => input_value($current_user->phone_number,'phone_number') ))?>
      <?php echo form_error('phone_number') ?>
    </div>

    <div class="form-group <?php echo has_error(form_error('description'))?>">
      <?php echo form_label('About You', 'description', array('class' => 'control-label'))?>
      <?php echo form_textarea(array('name' => 'description', 'id' => 'description', 'class' => 'form-control', 'placeholder' => 'Training description', 'value' => input_value($current_user->description,'description') ))?>
      <?php echo form_error('description') ?>
    </div>

    <hr>
    <center>
      <?php echo form_button(array('name' => 'create_user', 'class' => 'btn btn-ar btn-success' , 'content' => '<i class="fa fa-save"></i>Save', 'type' => 'submit', 'value' => 'submit'))?>
      <?php echo anchor('admin/users', '<i class="fa fa-remove"></i>Cancel', array('class' => 'btn btn-ar btn-danger'))?>
    </center>

<script>
$(document).ready(function(){

  $('.input-date').datepicker({format: 'yyyy/mm/dd'}).on('changeDate', function(ev){
    $(this).datepicker('hide');
  });

  var options = {
                  showUpload: false,
                  allowedFileTypes : ['image'],
                  allowedFileExtensions: ['jpeg', 'jpg', 'png'],
                  maxFileSize: 1024,
                  initialPreview: ['<img src="'+$('#current-user-avatar').attr('src')+'" class="file-preview-image">']
                }
  initializeFileInput($('#avatar'),options);

  var form = $('#edit-profile-form');

  form.find('#avatar').change(function(e){
    if ($(this).val() != '') form.find('#_delete-avatar').val('');
  });

  form.find('.fileinput-remove').click(function(e){
      form.find('#_delete-avatar').val(1);
  });

});

</script>
