    <div class="form-group <?php has_error(form_error('title'))?>">
      <?php echo form_label('Name', 'title', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'title', 'id' => 'title', 'class' => 'form-control', 'placeholder' => 'Training name', 'value' => input_value($training->title,'title') ))?>
      <?php echo form_error('title') ?>
    </div>

    <div class="form-group <?php has_error(form_error('banner'))?>">
      <?php echo form_label('Banner', 'banner', array('class' => 'control-label'))?>
      <?php echo form_upload(array('name' => 'banner', 'id' => 'banner', 'class' => 'form-control', 'placeholder' => '', 'value' => input_value($training->title,'banner') ))?>
      <?php echo form_error('banner') ?>
    </div>

    <div class="form-group <?php has_error(form_error('start_date'))?>">
      <?php echo form_label('Start Date', 'start_date', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'start_date', 'id' => 'start_date', 'class' => 'form-control input-date', 'placeholder' => 'Training start date', 'value' => input_value($training->start_date,'start_date') ))?>
      <?php echo form_error('start_date') ?>
    </div>

    <div class="form-group <?php has_error(form_error('end_date'))?>">
      <?php echo form_label('End Date', 'start_date', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'end_date', 'id' => 'end_date', 'class' => 'form-control input-date', 'placeholder' => 'Training end date', 'value' => input_value($training->end_date,'end_date') ))?>
      <?php echo form_error('end_date') ?>
    </div>

    <div class="form-group <?php has_error(form_error('trainer_ids'))?>">
      <?php echo form_label('Trainers', 'trainer_ids', array('class' => 'control-label'))?>
      <?php echo form_dropdown('trainer_ids[]', $options['trainers_select_options'], '', 'id="trainer_ids" class="form-control chosen-input" data-placeholder="Select trainers" multiple=""'); ?>
      <?php echo form_error('trainer_ids') ?>
    </div>

    <div class="form-group <?php has_error(form_error('description'))?>">
      <?php echo form_label('Description', 'description', array('class' => 'control-label'))?>
      <?php echo form_textarea(array('name' => 'description', 'id' => 'description', 'class' => 'form-control', 'placeholder' => 'Training description', 'value' => input_value($training->title,'description') ))?>
      <?php echo form_error('description') ?>
    </div>
    <?php if(!$training->exists()){ ?>
    <div class="form-group <?php has_error(form_error('training_materials'))?>">
      <?php echo form_label('Training Materials', 'training_materials', array('class' => 'control-label'))?>
      <?php echo form_upload(array('name' => 'training_materials[]', 'id' => 'training-materials', 'class' => 'form-control', 'multiple' => '' ))?>
      <?php echo form_error('training_materials') ?>
    </div>
    <?php } ?>

    <hr>
    <center>
      <?php echo form_button(array('name' => 'create_training', 'class' => 'btn btn-ar btn-success' , 'content' => '<i class="fa fa-save"></i>Save', 'type' => 'submit', 'value' => 'submit'))?>
      <?php echo anchor('admin/trainings', '<i class="fa fa-remove"></i>Cancel', array('class' => 'btn btn-ar btn-danger'))?>
    </center>


<script>
$(document).ready(function(){
  var options = {
                  showUpload: false,
                  //allowedFileTypes : ['image'],
                  allowedFileExtensions: ['jpeg', 'jpg', 'png', 'vsdx'],
                  maxFileSize: 1024,
                  maxFileCount: 1
                }
  initializeFileInput($('#banner'),options);
  
  options = {
    showUpload: false,
    allowedFileExtensions : ['doc', 'docx', 'pdf', 'ppt', 'pptx', 'xls', 'xlsx', 'zip', 'rar', 'vsdx'],
    maxFileCount: 5,
    maxFileSize: 1024*5
  };

  initializeFileInput($('#training-materials'),options);
  
  $('.chosen-input').chosen();

  $('.input-date').datepicker({format: 'yyyy/mm/dd'}).on('changeDate', function(ev){
    $(this).datepicker('hide');
  });
});

</script>