<?php if ($training->trainers()->isEmpty()) {?>
   <span class="alert alert-warning col-md-8 col-md-offset-2"><strong><i class="fa fa-warning"></i> </strong> No Trainer.</span>
<?php }else{ ?>
    <h3>Trainers</h3>
    <?php foreach ($training->trainers() as $trainer) { ?>
       <div class="content-box box-default">
            <div class="row">
                <div class="col-md-2">
                    <img src="<?php avatar_url($trainer->avatar)?>" alt="" class="img-circle img-responsive">
                </div>
                <div class="col-md-10">
                    <h4 class="content-box-title"><?= $trainer->full_name ?></h4>
                    <?= $trainer->description ?>
                </div>
            </div>
        </div>
    <?php } ?>
<?php }?>