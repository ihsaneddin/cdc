<aside class="sidebar">
    <div class="block animated fadeInDown animation-delay-12">
        <?php echo form_open('' , array('method' => 'GET') )?>
          <div class="input-group">
            <?php echo form_input(array('name' => 'search', 'class' => 'form-control', 'placeholder' => 'search', 'value' => $this->input->get('search'))) ?>
            <span class="input-group-btn">
                <?php echo form_button(array('content' => '<i class="fa fa-search no-margin-right"></i>', 'class' => 'btn btn-ar btn-search btn-primary', 'type' => 'submit'))?>
            </span>
          </div>
        <?php echo form_close()?>
    </div>

    <div class="block animated fadeInDown animation-delay-10">
        <h3 class="post-title no-margin-top">Articles</h3>
        <ul class="nav nav-tabs nav-tabs-ar" id="myTab2">
            <li class="active"><a href="#articles-recents" data-toggle="tab">Recents</a></li>
            <li><a href="#articles-popular" data-toggle="tab">Popular</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="articles-recents">

                <?php if (empty($articles['recents'])) {
                    echo '<div class="alert alert-warning">No recents articles</div>';
                }else{?>

                <ul class="media-list">

                    <?php foreach ($articles['recents'] as $article) { ?>
                        <li class="media">
                            <?php if (!is_null($article['image'])){
                                echo anchor('articles/'.$article['slug'], '<img class="media-object" src="'.$article['image_url'].'" width="80" height="80" alt="image">', array('class' => 'pull-left'));
                            }?>
                            <div class="media-body">
                                <p class="media-heading">
                                    <?= anchor('articles/'.$article['slug'], $article['title']) ?>
                                </p>
                                <small><?= date("M d, Y", strtotime($article['created_at'])) ?></small>
                            </div>
                        </li>
                    <?php } ?>

                </ul>

                <?php } ?>
            </div>
            <div class="tab-pane" id="articles-popular">
                 <?php if (empty($articles['popular'])) {
                    echo '<div class="alert alert-warning">No Popular articles</div>';
                }else{?>

                <ul class="media-list">

                    <?php foreach ($articles['popular'] as $article) { ?>
                        <li class="media">
                            <?php if (!is_null($article['image'])){
                                echo anchor('articles/'.$article['slug'], '<img class="media-object" src="'.$article['image_url'].'" width="80" height="80" alt="image">', array('class' => 'pull-left'));
                            }?>
                            <div class="media-body">
                                <p class="media-heading">
                                    <?= anchor('articles/'.$article['slug'], $article['title']) ?>
                                </p>
                                <small><?= date("M d, Y", strtotime($article['created_at'])) ?></small>
                            </div>
                        </li>
                    <?php } ?>

                </ul>

                <?php } ?>
            </div>
        </div> <!-- tab-content -->
    </div>

</aside> <!-- Sidebar -->