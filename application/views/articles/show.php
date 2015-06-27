<div class="col-md-12">
    <section>
        <h2 class="page-header no-margin-top">
            <?= $article->title ?>
        </h2>
        <?= is_null($article->image) ? null : '<img src="'.$article->image_url.'" class="img-responsive imageborder" alt="Image"> '?>

        <article>
            <p>
            <?= $article->content ?>
            </p>
        </article>

        <div class="panel-footer">
            <div class="row">
                <div class="col-lg-10 col-md-9 col-sm-8">
                    <i class="fa fa-user"> </i>  &nbsp<?= is_null($article->author) ? anchor('#', 'Anonymous') : $article->author->full_name ?> <i class="fa fa-clock-o">&nbsp</i> <?= date_format($article->created_at,'d M, Y ') ?>
                </div>
            </div>
        </div>
    </section>
    <br>
</div>