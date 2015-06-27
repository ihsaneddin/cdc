    <div class="form-group <?php echo has_error_for($training->errors, 'title')?>">
      <?php echo form_label('Name', 'title', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'training[title]', 'id' => 'title', 'class' => 'form-control', 'placeholder' => 'Training name', 'value' => input_value($training->title,'title') ))?>
      <?php echo error_message_for($training->errors, 'title') ?>
    </div>

    <div class="form-group <?php echo has_error_for($training->errors, 'banner')?>">
      <?php echo form_label('Banner', 'banner', array('class' => 'control-label'))?>
      <?php echo form_upload(array('name' => 'training[banner]', 'id' => 'banner', 'class' => 'form-control', 'placeholder' => '', 'value' => input_value($training->title,'banner') ))?>
      <?php echo error_message_for($training->errors, 'banner') ?>
    </div>

    <div class="form-group <?php echo has_error_for($training->errors, 'start_date')?>">
      <?php echo form_label('Start Date', 'start_date', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'training[start_date]', 'id' => 'start_date', 'class' => 'form-control input-date', 'placeholder' => 'Training start date', 'value' => input_value($training->start_date,'start_date') ))?>
      <?php echo error_message_for($training->errors, 'start_date') ?>
    </div>

    <div class="form-group <?php echo has_error_for($training->errors, 'end_date')?>">
      <?php echo form_label('End Date', 'end_date', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'training[end_date]', 'id' => 'end_date', 'class' => 'form-control input-date', 'placeholder' => 'Training end date', 'value' => input_value($training->end_date,'end_date') ))?>
      <?php echo error_message_for($training->errors, 'end_date') ?>
    </div>

    <div class="form-group <?php echo has_error_for($training->errors, 'start_hour')?>">
      <?php echo form_label('Start Hour', 'start_hour', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'training[start_hour]', 'id' => 'start_hour', 'class' => 'form-control input-time', 'placeholder' => 'Start hour 00:00', 'value' => input_value($training->start_hour,'start_hour') ))?>
      <?php echo error_message_for($training->errors, 'start_hour') ?>
    </div>

    <div class="form-group <?php echo has_error_for($training->errors, 'end_hour')?>">
      <?php echo form_label('End Hour', 'end_hour', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'training[end_hour]', 'id' => 'end_hour', 'class' => 'form-control input-time', 'placeholder' => 'End hour 00:00', 'value' => input_value($training->end_hour,'end_hour') ))?>
      <?php echo error_message_for($training->errors, 'end_hour') ?>
    </div>

    <div class="form-group <?php echo has_error_for($training->errors, 'training_ids')?>">
      <?php echo form_label('Trainers', 'trainer_ids', array('class' => 'control-label'))?>
      <?php echo form_dropdown('training[trainer_ids][]', $options['trainers_select_options'], '', 'id="trainer_ids" class="form-control chosen-input" data-placeholder="Select trainers" multiple=""'); ?>
      <?php echo error_message_for($training->errors, 'training_ids') ?>
    </div>

    <div class="form-group <?php echo has_error_for($training->errors, 'quota')?>">
      <?php echo form_label('Quota', 'quota', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'training[quota]', 'id' => 'quota', 'class' => 'form-control ', 'placeholder' => '', 'value' => input_value($training->quota,'quota') ))?>
      <?php echo error_message_for($training->errors, 'quota') ?>
    </div>

    <div class="form-group <?php echo has_error_for($training->errors, 'cdc_head_officer')?>">
      <?php echo form_label('CDC Head Officer', 'cdc_head_officer', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'training[cdc_head_officer]', 'id' => 'cdc_head_officer', 'class' => 'form-control ', 'placeholder' => '', 'value' => input_value($training->cdc_head_officer,'cdc_head_officer') ))?>
      <?php echo error_message_for($training->errors, 'cdc_head_officer') ?>
    </div>

    <div class="clearfix"></div>

    <div class="form-group <?php echo has_error_for($training->errors, 'description')?>">
      <?php echo form_label('Description', 'description', array('class' => 'control-label'))?>
      <?php echo form_textarea(array('name' => 'training[description]', 'id' => 'description', 'class' => 'form-control', 'placeholder' => 'Training description', 'value' => input_value($training->description,'description') ))?>
      <?php echo error_message_for($training->errors, 'description') ?>
    </div>

    <?php $this->load->section('materials_list', 'admin/trainings/materials_list', array('training' => $training, 'form' => true))?>
    <?= $this->load->get_section('materials_list')?>

    <hr>
    <center>
      <?php echo form_button(array('name' => 'create_training', 'class' => 'btn btn-ar btn-success' , 'content' => '<i class="fa fa-save"></i>Save', 'type' => 'submit', 'value' => 'submit'))?>
      <?php echo anchor('admin/trainings', '<i class="fa fa-remove"></i>Cancel', array('class' => 'btn btn-ar btn-danger'))?>
    </center>



<script>
$(document).ready(function(){

  $(function () {
    $('.time').datetimepicker();
  });

  var initialBanner = "<?php echo is_null($training->id) ? '' : $training->banner_url ?>",
      initialPreview;
  if (initialBanner != '')
  {
    initialPreview = ['<img src="'+initialBanner+'" class="file-preview-image">'];
  }
  var options = {
                  showUpload: false,
                  //allowedFileTypes : ['image'],
                  allowedFileExtensions: ['jpeg', 'jpg', 'png', 'vsdx'],
                  maxFileSize: 1024,
                  maxFileCount: 1,
                  initialPreview: initialPreview
                }
  initializeFileInput($('#banner'),options);

  options = {
    showUpload: false,
    allowedFileExtensions : ['doc', 'docx', 'pdf', 'ppt', 'pptx', 'xls', 'xlsx', 'zip', 'rar', 'vsdx'],
    maxFileCount: 5,
    maxFileSize: 1024*5
  };

  initializeFileInput($('#training-materials'),options);

  var current_trainers = <?php echo array_key_exists('current_trainers_options', $options) ? json_encode($options['current_trainers_options']) : json_encode([]) ;?>;
  $('#trainer_ids').find('option').each(function(){
    if ( current_trainers.indexOf($(this).attr('value')) != -1 )
    {
      $(this).attr('selected', '');
    }
  });
  $('.chosen-input').chosen();
  $('.input-date').datepicker({format: 'yyyy/mm/dd'}).on('changeDate', function(ev){
    $(this).datepicker('hide');
  });

});

</script>