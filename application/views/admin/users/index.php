<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title with-panel-action">Users List</h3>

      <div class="pull-right with-panel-action">
        <div class="input-group">
          <input type="text" placeholder="search" id="search-users" class="form-control input-sm" name="search">
          <span class="input-group-btn">
              <button type="button" class="btn btn-search"><i class="fa fa-search"></i></button>
          </span>
        </div>
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
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Student Id</th>
              <th> Action </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users['data'] as $user) {?>
              <tr>
                <td></td>
                <td>
                  <?php echo $user['first_name'].' '.$user['last_name']?>
                </td>
                <td>
                  <?php echo $user['username'] ?>
                </td>
                <td>
                  <?php echo $user['email']?>
                </td>
                <td>
                  <?php echo $user['student_id']?>
                </td>
                <td>
                  <?php echo anchor('users/edit/'.$user['id'], '<i class="fa fa-edit" title="Edit user"></i>')?>
                  <?php echo anchor('users/delete/'.$user['id'], '<i class="fa fa-trash" title="Delete user"></i>')?>
                </td>
              </tr>
            <?php }?>
          </tbody>
        </table>
		</div>
	</div>
</div>