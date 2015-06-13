<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title with-panel-action">Create Training</h3>
  </div>
  <div class="panel-body">
    <div class="col-md-10 col-sm-offset-1">
      <div class="panel panel-primary">
        <div class="panel-heading">Please fill the form below</div>
        <div class="panel-body">

          <?php echo  form_open_multipart('trainings', array('class' => 'form', 'role' => 'form', 'id' => 'form-create-training'))?>

             <?php $this->load->section('training_form', 'admin/trainings/form', array('training' => $training))?>
             <?php echo $this->load->get_section('training_form')?>

          <?php echo form_close()?>

        </div>
      </div>
      </div>
  </div>
</div>
