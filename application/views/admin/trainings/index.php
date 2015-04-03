<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title with-panel-action">Trainings List</h3>

    <div class="pull-right with-panel-action">
      <?php echo form_open('' , array('method' => 'GET') )?>
      <div class="input-group">
        <?php echo form_input(array('name' => 'search', 'class' => 'form-control input-sm', 'placeholder' => 'search', 'value' => $this->input->get('search'))) ?>
        <span class="input-group-btn">
            <?php echo form_button(array('content' => '<i class="fa fa-search"></i>', 'class' => 'btn btn-search', 'type' => 'submit'))?>
        </span>
      </div>
      <?php echo form_close()?>
    </div>

    <div class="btn-group pull-right">
        <?php echo anchor('admin/trainings/create_new', '<i class="fa fa-plus"></i>', array('class' => 'btn', 'title' => 'Create a new training' ))?>
    </div>

  </div>
	<div class="panel-body">
		<table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Total Participant</th>
            <th> Action </th>
          </tr>
        </thead>
        <tbody>
          <?php echo empty_table($trainings['data'],6) ?>
          <?php foreach ($trainings['data'] as $training) {?>
            <tr>

            </tr>
          <?php }?>
        </tbody>
      </table>

     <div class="pull-right">
      <span><?php echo pagination_info($trainings) ?></span>
     </div>

  </div>

  <div class="pull-right">
    <?php echo $pagination?>
  </div>

</div>
