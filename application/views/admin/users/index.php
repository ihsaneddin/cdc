<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title with-panel-action">Users List</h3>

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
        <?php echo anchor('admin/users/create_new', '<i class="fa fa-plus"></i>', array('class' => 'btn', 'title' => 'Create a new user' ))?>
    </div>

  </div>
	<div class="panel-body">
		<table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
            <th>Student Id</th>
            <th>Student Name</th>
            <th> Action </th>
          </tr>
        </thead>
        <tbody>
          <?php echo empty_table($users['data'],6) ?>
          <?php $i = tr_number($users) ?>
          <?php foreach ($users['data'] as $user) {?>
            <tr>
              <td>
                <?php echo $i; $i++?>
              </td>
              <td>
                <?php echo $user['username'] ?>
              </td>
              <td>
                <?php echo $user['email'] ?>
              </td>
              <td>
                <?php echo $user['student_id'] ?>
              </td>
              <td>
                <?php echo $user['full_name'] ?>
              </td>
              <td>
                <?php echo anchor('admin/users/show/'.$user['id'], '<i class="fa fa-folder-open" title="Detail user"></i>')?>
                <?php echo anchor('admin/users/edit/'.$user['id'], '<i class="fa fa-edit" title="Edit user"></i>')?>
                <?php echo anchor('admin/users/delete/'.$user['id'], '<i class="fa fa-trash" title="Delete user"></i>')?>
              </td>
            </tr>
          <?php }?>
        </tbody>
      </table>

     <div class="pull-right">
      <span><?php echo pagination_info($users) ?></span>
     </div>

  </div>

  <div class="pull-right">
    <?php echo $pagination?>
  </div>

</div>
