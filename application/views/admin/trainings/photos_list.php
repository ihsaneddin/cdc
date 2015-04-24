<h3 class="section-title">Training Photos</h3>

<div class="bxslider-controls">
    <span id="training-photos-prev"></span>
    <span id="training-photos-next"></span>
</div>

<ul class="bxslider" id="training-photos-slider">
  <?php foreach ($training->photos as $photo) {?>
    <li class="photo-thumbnail" data-id="<?=$photo->id?>" data>
        <a href="<?php echo soft_uploaded_file_url('photos/'.$photo->file_name) ?>" title="photos" class="thumbnail" data-gallery>
         <img src="<?php echo soft_uploaded_file_url('photos/'.$photo->file_name) ?>" class="" alt="Image" height='200px'>
        </a>
         <div class="remove-photo">
            <a href="#" class='remove-a-photo'><i class='glyphicon glyphicon-remove-circle icon-remove-photo'></i></a>
        </div>
        <div class="select-remove-photo">
            <input type="checkbox" name="checkboxes" value="id" class="inline select-photo-to-remove">
        </div>
    </li>
  <?php }?>
</ul>

<?php if (!$training->photos->isEmpty()) {?>
    <div class="row remove-image-buttons">
        <center>
            <button class="btn btn-default remove-selected-image-button" data-form = '#delete-photos-form'><i class='icon icon-check'></i> Remove Selected</button>
            <button class="btn btn-default remove-all-image-button" data-form = '#delete-photos-form'><i class='icon icon-trash'></i> Remove All</button>
        </center>
    </div>
<?php } ?>

<?php echo  form_open('admin/trainings/update/'.$training->id, array('class' => 'form hidden', 'role' => 'form', 'id' => 'delete-photos-form'))?>

    <div id='input-prototype' class="input-group">
        <input type="hidden" name="id-prototype" class="prototype-input prototype-input-id" data-index="0" data-parent='training' data-relation="photos" data-name="id">
        <input type="hidden" name="delete-prototype" class = "prototype-input prototype-input-delete" value="0" data-index='0' data-parent='training' data-relation='photos' data-name="_delete">
    </div>

<?php echo form_close()?>

<?php $this->load->section('blueimp_widget', 'shared/blueimp_widget')?>
<?=  $this->load->get_section('blueimp_widget') ?>