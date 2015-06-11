<div class="container">
  <div class="row">
    <div class="col-md-8 main-content">
        <?php foreach ($trainings['data'] as $training) {
            render('trainings/training_item', array('training' => $training));
        }?>

        <?= $pagination ?>

    </div>

    <div class="col-md-4">
        <?= render('trainings/right_sidebar', array('articles' => array('recents' => $options['articles']['recents']))) ?>
    </div>
  </div>
</div>



<script>
    $(document).ready(function(){
        if (!$('article.post').length)
        {
            var message = $('input[name=search]').val().length ? 'No results for '+$('input[name=search]').val() : 'No data yet' ;
            $('.main-content').append("<div class='alert alert-warning'> <center>"+message+"</center> </div>");
            console.log('dsadas');
        }
    });
</script>