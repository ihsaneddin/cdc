    <div class="form-group <?php echo has_error_for($article->errors, 'title')?>">
      <?php echo form_label('Title', 'title', array('class' => 'control-label'))?>
      <?php echo form_input(array('name' => 'article[title]', 'id' => 'title', 'class' => 'form-control', 'placeholder' => 'Title', 'value' => input_value($article->title,'title') ))?>
      <?php echo error_message_for($article->errors, 'title') ?>
    </div>

    <div class="form-group <?php echo has_error_for($article->errors, 'image')?>">
      <?php echo form_label('Image', 'image', array('class' => 'control-label'))?>
      <?php echo form_upload(array('name' => 'article[image]', 'id' => 'image', 'class' => 'form-control', 'placeholder' => '', 'value' => input_value($article->image,'image') ))?>
      <?php echo error_message_for($article->errors, 'image') ?>
    </div>

    <div class="form-group">
      <?php echo form_label('Status', 'status', array('class' => 'control-label'))?>
      <br>
      <?php echo form_checkbox(array('name' => 'article[status]', 'class' => 'form-control switch', 'value' => 1, 'data-on-text' => 'Active', 'data-off-text' => 'Inactive', 'checked' => $article->status ? 'potato' : '') )?>
      <?php echo error_message_for($article->errors, 'status') ?>
    </div>

    <div class="form-group <?php echo has_error_for($article->errors, 'content')?>">
      <?php echo form_label('Content', 'content', array('class' => 'control-label'))?>
      <?php echo form_textarea(array('name' => 'article[content]', 'id' => 'content', 'class' => 'form-control', 'placeholder' => 'Article content', 'value' => input_value($article->content,'content') ))?>
      <?php echo error_message_for($article->errors, 'content') ?>
    </div>

    <hr>
    <center>
      <?php echo form_button(array('name' => 'create_article', 'class' => 'btn btn-ar btn-success' , 'content' => '<i class="fa fa-save"></i>Save', 'type' => 'submit', 'value' => 'submit'))?>
      <?php echo anchor('admin/articles', '<i class="fa fa-remove"></i>Cancel', array('class' => 'btn btn-ar btn-danger'))?>
    </center>

<script>

  $(document).ready(function(e){
    var options = {
                  showUpload: false,
                  allowedFileTypes : ['image'],
                  allowedFileExtensions: ['jpeg', 'jpg', 'png'],
                  maxFileSize: 1024,
                  maxFileCount: 1
                }
    initializeFileInput($('#image'),options);

  });

</script>