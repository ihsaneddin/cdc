<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <title><?php echo $title; ?></title>

        <link rel="shortcut icon" href="<?php image_url('favicon.png') ?>">

        <meta name="description" content="">

        <!-- CSS -->
        <link href="<?php css_url('preload.css') ?>" rel="stylesheet" media="screen">
        <link href="<?php css_url('bootstrap.min.css') ?>" rel="stylesheet" media="screen">
        <link href="<?php css_url('yamm.css') ?>" rel="stylesheet" media="screen">
        <link href="<?php css_url('bootstrap-switch.min.css') ?>" rel="stylesheet" media="screen">
        <link href="<?php css_url('font-awesome.min.css') ?>" rel="stylesheet" media="screen">
        <link href="<?php css_url('animate.min.css')?>" rel="stylesheet" media="screen">
        <link href="<?php css_url('slidebars.css') ?>" rel="stylesheet" media="screen">
        <link href="<?php css_url('lightbox.css') ?>" rel="stylesheet" media="screen">
        <link href="<?php css_url('jquery.bxslider.css') ?>" rel="stylesheet">
        <link href="<?php css_url('syntaxhighlighter/shCore.css') ?>" rel="stylesheet" media="screen">

        <link href="<?php css_url('style-blue.css') ?>" rel="stylesheet" media="screen" title="default">
        <link href="<?php css_url('width-boxed.css') ?>" rel="stylesheet" media="screen" title="default">

        <link href="<?php css_url('buttons.css') ?>" rel="stylesheet" media="screen">
        <link href="<?php css_url('custom.css') ?>" rel="stylesheet" media="screen">
        <link href="<?php asset_url('js/plugins/kartik-v-bootstrap-fileinput/css/fileinput.css') ?>" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="<?php asset_url('js/plugins/datepicker/css/bootstrap-datepicker.min.css')?>">
        <link rel="stylesheet" type="text/css" href="<?php asset_url('js/plugins/jquery.chosen/chosen.css')?>">
        <link href="<?php asset_url('js/plugins/wysiwyg/bootstrap3-wysihtml5.min.css') ?>" rel="stylesheet">
        <link href="<?php asset_url('js/plugins/bootstrap.blueimp/css/blueimp-gallery.min.css') ?>" rel="stylesheet">
        <link href="<?php asset_url('js/plugins/bootstrap.image-gallery/css/bootstrap-image-gallery.min.css') ?>" rel="stylesheet">


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="../assets/js/html5shiv.min.js"></script>
            <script src="../assets/js/respond.min.js"></script>
        <![endif]-->
        <script src="<?php javascript_url('jquery.min.js')?>"></script>
    </head>

    <body>

        <div id="sb-site">
            <div class="boxed">

            	<?php echo $this->load->get_section('header'); ?>

            	<?php echo $this->load->get_section('navigation'); ?>

                <div class="container">
                    <?php echo $this->load->get_section('breadcrumbs');?>

                    <?php echo $this->load->get_section('flash_message');?>

                        <?php echo $this->load->get_section('content'); ?>
                </div>

                <?php echo $this->load->get_section('footer'); ?>

            </div> <!-- boxed -->
        </div> <!-- sb-site -->

        <?php echo $this->load->get_section('sidebar')?>

        <div id="back-top">
            <a href="#header"><i class="fa fa-chevron-up"></i></a>
        </div>

        <!-- Scripts -->
        <script src="<?php javascript_url('jquery.cookie.js')?>"></script>
        <script src="<?php javascript_url('bootstrap.min.js')?>"></script>
        <script src="<?php javascript_url('bootstrap-switch.min.js')?>"></script>
        <script src="<?php javascript_url('wow.min.js') ?>"></script>
        <script src="<?php javascript_url('slidebars.js')?>"></script>
        <script src="<?php javascript_url('jquery.bxslider.min.js')?>"></script>
        <script src="<?php javascript_url('holder.js')?>"></script>
        <script src="<?php javascript_url('buttons.js')?>"></script>
        <script src="<?php javascript_url('carousels.js')?>"></script>
        <script src="<?php javascript_url('styleswitcher.js')?>"></script>
        <script src="<?php javascript_url('jquery.mixitup.min.js')?>"></script>
        <script src="<?php javascript_url('circles.min.js')?>"></script>
        <script src="<?php javascript_url('moment.js')?>"></script>
        <script type="text/javascript" src="<?php javascript_url('plugins/datepicker/js/bootstrap-datepicker.js')?>"></script>
        <script src="<?php javascript_url('plugins/kartik-v-bootstrap-fileinput/js/fileinput.min.js')?>"></script>
        <script src="<?php javascript_url('plugins/jquery.chosen/chosen.jquery.min.js')?>"></script>
        <script src="<?php javascript_url('plugins/wysiwyg/bootstrap3-wysihtml5.all.min.js')?>"></script>
        <script src="<?php javascript_url('plugins/bootstrap.blueimp/js/jquery.blueimp-gallery.min.js')?>"></script>
        <script src="<?php javascript_url('plugins/bootstrap.image-gallery/js/bootstrap-image-gallery.min.js')?>"></script>

        <!-- Syntaxhighlighter -->
        <script src="<?php javascript_url('syntaxhighlighter/shCore.js')?>"></script>
        <script src="<?php javascript_url('syntaxhighlighter/shBrushXml.js')?>"></script>
        <script src="<?php javascript_url('syntaxhighlighter/shBrushJScript.js')?>"></script>

        <script src="<?php javascript_url('app.js')?>"></script>
        <script src="<?php javascript_url('index.js')?>"></script>
        <script>
            $(function(){
                var currentUrl = '<?php echo $base_url ?>';
                $('nav .navbar-nav li a').each(function(idx, elm){
                    var elm = $(elm);
                    if(elm.attr('href') == currentUrl){
                        elm.parents('li').addClass('active');
                    }
                });
            });


        </script>


    </body>

</html>
