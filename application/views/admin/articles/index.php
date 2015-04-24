<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title with-panel-action">Articles List</h3>

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
        <?php echo anchor('admin/articles/create_new', '<i class="fa fa-plus"></i>', array('class' => 'btn', 'title' => 'Create a new training' ))?>
    </div>

  </div>
	<div class="panel-body">
		<table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Content</th>
            <th width="10%">Status</th>
            <th>Author</th>
            <th> Action </th>
          </tr>
        </thead>
        <tbody>
          <?php echo empty_table($articles['data'],6) ?>
          <?php $i = tr_number($articles) ?>
          <?php foreach ($articles['data'] as $article) {?>
            <tr>
              <td>
                  <?php echo $i; $i++?>
              </td>
              <td>
                <?php echo $article['title'] ?>
              </td>
              <td>
                <?php echo word_limiter($article['content'], 50)?>
              </td>
              <td>
                  <center>
                    <?php echo form_checkbox(array('name' => 'article[status]', 'class' => 'form-control switch', 'value' => 1, 'data-on-text' => 'Active', 'data-off-text' => 'Inactive', 'data-size' => 'mini' ,'checked' => $article['status'] ? 'potato' : '', 'disabled' => 'disabled') )?>
                  </center>
              </td>
              <td>
                <?= is_null($article['author']) ? '' : $article['author']['full_name'] ?>
              </td>
              <td>
                <?php echo anchor('admin/articles/show/'.$article['id'], '<i class="fa fa-folder-open" title="Detail article"></i>')?>
                <?php echo anchor('admin/articles/edit/'.$article['id'], '<i class="fa fa-edit" title="Edit article"></i>')?>
                <?php echo anchor('admin/articles/delete/'.$article['id'], '<i class="fa fa-trash" title="Delete article"></i>')?>
              </td>
            </tr>
          <?php }?>
        </tbody>
      </table>

     <div class="pull-right">
      <span><?php echo pagination_info($articles) ?></span>
     </div>

  </div>

  <div class="pull-right">
    <?php echo $pagination?>
  </div>

</div>
