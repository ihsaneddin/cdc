<div class="modal fade" id="training-photos-upload-modal" role="dialog" aria-labelledby="TrainingModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">
					Upload Training Photos
				</h4>
			</div>
			<div class="modal-body">
			<?php echo  form_open_multipart(isset($upload_url) ? $upload_url : 'admin/trainings/update/'.$training->id, array('class' => 'form', 'role' => 'form', 'id' => 'form-create-training'))?>

				<div class="form-group form-group-training-materials-files <?php echo has_error_for_nested($training->photos, 'file_name')?> ">
				    <?php echo form_label('Photos', 'photos', array('class' => 'control-label'))?>
				    <?php echo form_upload(array('name' => 'training[photos][][file_name]', 'id' => 'photos', 'class' => 'form-control', 'multiple' => 'true' ))?>
				    <?php echo error_message_for_nested($training->photos, 'file_name') ?>
				</div>

				 <hr>
			    <center>
			      <?php echo form_button(array('name' => 'create_training', 'class' => 'btn btn-ar btn-success' , 'content' => '<i class="fa fa-upload"></i>Upload', 'type' => 'submit', 'value' => 'submit'))?>
			      <?php echo form_button(array('name' => 'close', 'class' => 'btn btn-ar btn-warning', 'data-dismiss' => 'modal', 'aria-hidden' => 'true', 'content' => '<i class="fa fa-remove"></i>Cancel'))?>
			    </center>
				<?php echo form_close()?>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(e){
		var options = {
                  showUpload: false,
                  //allowedFileTypes : ['image'],
                  allowedFileExtensions: ['jpeg', 'jpg', 'png'],
                  maxFileSize: 1024*2,
                  maxFileCount: 10,
                };
  		initializeFileInput($('#photos'),options);
	});

</script>