<article class="post animated fadeInLeft animation-delay-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <h3 class="post-title"><?= anchor('trainings/'.$training['slug'], $training['title']) ?></h3>
            <div class="row">
                <div class="col-lg-6">
                    <img alt="Image" class="img-post img-responsive" src="<?= $training['banner_url'] ?>">
                </div>
                <div class="col-lg-6 post-content">
                        <p>
                            <?= word_limiter($training['description'], 50) ?>
                        </p>
                </div>
            </div>
        </div>
        <div class="panel-footer post-info-b">
            <div class="row">
                <div class="col-lg-10 col-md-9 col-sm-8">
                    <i class="glyphicon glyphicon-calendar"></i> <?= date("M d, Y", strtotime($training['start_date'])) ?> - <?= date("M d, Y", strtotime($training['end_date'])) ?>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <?= anchor('trainings/'.$training['slug'], 'View »', array('class' => 'pull-right')) ?>
                </div>
            </div>
        </div>
    </div>
</article>