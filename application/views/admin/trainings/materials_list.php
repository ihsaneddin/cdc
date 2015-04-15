<?php if($training->id) { ?>
  <table class="table table-hover">
    <thead>
      <th>Training material files</th>
      <th>
          <?php echo anchor('#', '<i class="fa fa-plus"></i>', array('class' => 'btn btn-sm btn-default pull-right add-training-material-file', 'title' => 'Add training material files', 'data-target' => 'form-group-training-materials-files' ))?>
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
                <?php echo anchor('#', '<i class="fa fa-download"></i>', array('class' => 'download-training-material-file', 'title' => 'Download file')) ?>
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
  <div class="form-group form-group-training-materials-files <?php echo has_error_for($training->errors, 'training_materials')?> <?= is_null($training->id) ? '' : 'hidden' ?>">
    <?php echo form_label('Training Materials', 'training_materials', array('class' => 'control-label'))?>
    <?php echo form_upload(array('name' => 'training[training_materials][][file_name]', 'id' => 'training-materials', 'class' => 'form-control', 'multiple' => '' ))?>
    <?php echo error_message_for($training->errors, 'training_materials') ?>
  </div>
<?php } ?>

