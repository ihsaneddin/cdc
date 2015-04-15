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
            <th>Status</th>
            <th>Total Participant</th>
            <th> Action </th>
          </tr>
        </thead>
        <tbody>
          <?php echo empty_table($trainings['data'],6) ?>
          <?php $i = tr_number($trainings) ?>
          <?php foreach ($trainings['data'] as $training) {?>
            <tr>
              <td>
                  <?php echo $i; $i++?>
              </td>
              <td>
                <?php echo $training['title'] ?>
              </td>
              <td>
                <?php echo $training['start_date'] ?>
              </td>
              <td>
                <?php echo $training['end_date']?>
              </td>
              <td>
                <center>
                  <?php echo $training['status'] ?>
                </center>
              </td>
              <td>
                <?php echo $training['total_participants'] ?>
              </td>
              <td>
                <?php echo anchor('admin/trainings/show/'.$training['id'], '<i class="fa fa-eye" title="Detail training"></i>')?>
                <?php echo anchor('admin/trainings/edit/'.$training['id'], '<i class="fa fa-edit" title="Edit training"></i>')?>
                <?php echo anchor('admin/trainings/delete/'.$training['id'], '<i class="fa fa-trash" title="Delete training"></i>')?>
              </td>
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
