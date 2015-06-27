<div class="row main-content">

    <?php foreach ($articles['data'] as $article) {?>
        <?= render('articles/article_item', array('article' => $article), 'article_item'.$article['id'] ); ?>
    <?php } ?>

</div>

<div class="row">
        <hr>
    <div class="text-center">
        <?= $pagination?>
    </div>
</div>

<script>
    $(document).ready(function(){
        if (!$('div.article-item').length)
        {
            var message = 'No articles.' ;
            $('.main-content').append("<div class='alert alert-warning'> <center>"+message+"</center> </div>");
        }
    });
</script>