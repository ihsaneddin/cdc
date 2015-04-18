
<?php if(!is_null($training->id)) { ?>
  <table class="table table-hover">
    <thead>
      <th>Training material files</th>
      <th>
          <?php if(isset($form)) {
            echo anchor('#', '<i class="fa fa-plus"></i>', array('class' => 'btn btn-sm btn-default pull-right add-training-material-file', 'title' => 'Add training material files', 'data-target' => 'form-group-training-materials-files' ));
            echo anchor('#', '<i class="fa fa-minus"></i>', array('class' => 'btn btn-sm btn-default pull-right remove-training-material-file-input hidden', 'title' => 'Remove training material file input'));
          }?>
      </th>
    </thead>
    <tbody>
      <?php if ($training->training_materials()->get()->isEmpty()){?>
        <tr>
          <td class= 'danger' colspan="2">
            No file.
          </td>
        </tr>
      <?php }else{?>
        <?php foreach ($training->training_materials()->get() as $index => $training_material) {?>
          <tr>
            <td>
              <?php echo $training_material->file_name?>
            </td>
            <td>
              <div class="pull-right">
                <?php echo anchor("trainings/".$training->id."/download_material/".$training_material->id, '<i class="fa fa-download"></i>', array('class' => 'download-training-material-file', 'title' => 'Download file')) ?>
                <?php echo form_hidden('training[training_materials]['.$index.'][id]', $training_material->id) ?>

                <?php if (isset($form)){?>
                  <?php echo anchor('#', '<i class="fa fa-remove"></i>', array('class' => 'delete-child',  'title' => 'Remove file', 'data-target' => 'training[training_materials]['.$index.'][_delete]')) ?>
                  <?php echo form_hidden('training[training_materials]['.$index.'][_delete]', 0) ?>
                <?php }?>
              </div>
            </td>
          </tr>
        <?php }?>
      <?php }?>
    </tbody>
  </table>
<?php } ?>

<?php if(isset($form)) {?>
  <div class="form-group form-group-training-materials-files <?php echo has_error_for_nested($training->training_materials, 'file_name')?> <?= is_null($training->id) ? '' : 'hidden' ?> <?= is_null($training->id) ? 'fuck-you' : 'training-materials-prototype' ?>">
    <?php echo form_label('Training Materials', 'training_materials', array('class' => 'control-label'))?>
    <?php echo form_upload(array('name' => 'training[training_materials][][file_name]', 'id' => 'training-materials', 'class' => 'form-control', 'multiple' => '' ))?>
    <?php echo error_message_for_nested($training->training_materials, 'file_name') ?>
  </div>
<?php } ?>

<script>

$(document).ready(function(){
  jQuery.fn.outerHTML = function(s) {
      return s
          ? this.before(s).remove()
          : jQuery("<p>").append(this.eq(0).clone()).html();
  };

  options = {
    showUpload: false,
    allowedFileExtensions : ['doc', 'docx', 'pdf', 'ppt', 'pptx', 'xls', 'xlsx', 'zip', 'rar', 'vsdx'],
    maxFileCount: 5,
    maxFileSize: 1024*5
  };

  var add_button =  $('.add-training-material-file'),
      remove_button = $('.remove-training-material-file-input');

  var actual_training_materials_input = $('div.training-materials-prototype');
  if (actual_training_materials_input.length)
  {
    var training_materials_input_proto = $('div.training-materials-prototype').clone();
    training_materials_input_proto.removeClass('hidden');
    if (!actual_training_materials_input.hasClass('has-error')){
      actual_training_materials_input.remove();
    }
    else{
      add_button.addClass('hidden');
      remove_button.removeClass('hidden');
      actual_training_materials_input.removeClass('hidden');
    }
    proto = training_materials_input_proto.outerHTML();
  }

  //display input training materials files input
  add_button.on('click', function(e){
      var input = $(this).attr('data-target');
      var table = $(this).parents('table');
      if (training_materials_input_proto != undefined)
      {
        $(proto).insertAfter(table);
        initializeFileInput($('#training-materials'),options);
        $(this).addClass('hidden');
        $('.remove-training-material-file-input').removeClass('hidden');
      }
      e.preventDefault();
  });

  remove_button.on('click', function(e){
    $('.remove-training-material-file-input').addClass('hidden');
    $('.add-training-material-file').removeClass('hidden');
    $('.form-group-training-materials-files').remove();
    e.preventDefault();
  });


});

</script>