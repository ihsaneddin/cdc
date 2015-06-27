<div class="col-md-6 article-item">
    <section>
        <div class="panel panel-default  animated fadeInDown animation-delay-8">
            <div class="panel-body">
                <h3 class="section-title no-margin-top"><?= anchor('articles/'.$article['slug'], $article['title']) ?> <small class="pull-right"><?= carbon_format($article['updated_at'], 'Y-m-d H:i:s')->diffForHumans() ?></small><div class="clearfix"></div></h3>
                <div class="clearfix"></div>
                <img src="../assets/img/demo/t1.jpg" alt="" class="alignleft imageborder">
                <p class="no-margin-top">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis, explicabo, impedit, voluptatibus fugiat saepe mollitia modi ab itaque cumque perferendis aut ducimus voluptas enim. Aspernatur, nobis id molestias! Quas, beatae commodi voluptates qui sed sint eos magni perferendis! Ea, necessitatibus.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae, illum dolor alias provident officiis. Neque at accusamus quis provident delectus commodi voluptates.</p>
                <div class="clearfix"></div>
                <a href="#" class="social-icon-ar sm twitter animated fadeInDown"><i class="fa fa-twitter"></i></a>
                <a href="#" class="social-icon-ar sm google-plus animated fadeInDown"><i class="fa fa-google-plus"></i></a>
                <a href="#" class="social-icon-ar sm facebook animated fadeInDown"><i class="fa fa-facebook"></i></a>
                <a href="#" class="social-icon-ar sm instagram animated fadeInDown"><i class="fa fa-instagram"></i></a>
                <a href="#" class="social-icon-ar sm pinterest animated fadeInDown"><i class="fa fa-pinterest"></i></a>
                <a href="#" class="social-icon-ar sm linkedin animated fadeInDown"><i class="fa fa-linkedin"></i></a>
                <a href="#" class="social-icon-ar sm git animated fadeInDown"><i class="fa fa-github"></i></a>
            </div>
        </div>
    </section>
</div>