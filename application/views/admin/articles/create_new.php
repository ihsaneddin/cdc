<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title with-panel-action">Create New Article</h3>
  </div>
  <div class="panel-body">
    <div class="col-md-10 col-sm-offset-1">
      <div class="panel panel-primary">
        <div class="panel-heading">Please fill the form below</div>
        <div class="panel-body">

          <?php echo  form_open_multipart('admin/articles/create', array('class' => 'form', 'role' => 'form', 'id' => 'form-create-article'))?>

             <?php $this->load->section('article_form', 'admin/articles/form', array('article' => $article))?>
             <?php echo $this->load->get_section('article_form')?>

          <?php echo form_close()?>

        </div>
      </div>
      </div>
  </div>
</div>
