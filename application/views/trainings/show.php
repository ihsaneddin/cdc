<div class="row">
    <div class="col-md-12">
        <section>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Training Detail</h3>
                </div>
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-ar">
                        <li class="active">
                            <a href="#training-description" data-toggle="tab">Overview</a>
                        </li>
                        <li>
                            <a href="#training-participants" data-toggle="tab">Participants</a>
                        </li>
                        <li>
                            <a href="#training-materials" data-toggle="tab">Materials</a>
                        </li>
                        <li>
                            <a href="#training-trainers" data-toggle="tab">Trainers</a>
                        </li>
                        <li class="pull-right">
                            <?php echo anchor('trainings/edit/'.$training->id, '<i class="fa fa-edit"></i>', array('title' => 'Edit training')) ?>
                        </li>
                        <li class="pull-right">
                            <?= anchor('trainings/list_of_attendances/'.$training->id, '<i class="fa fa-print"></i>', array('title' => 'Print attendance list') )?>
                        </li>
                        <li class="pull-right">
                            <a class='' title="Upload photos" href="#training-photos-upload-modal" data-toggle='modal'>
                                <i class="fa fa-file-image-o"></i>
                            </a>

                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="training-description">
                            <h3 class="post-title"><a href="javascript:void()" class="transicion"><?= $training->title ?></a></h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="<?php echo $training->banner_url ?>" class="img-responsive imageborder" alt="Image">
                                </div>
                                <div class="col-md-6">
                                    <h3>Description</h3>
                                    <p>
                                        <?php echo $training->description ?>
                                    </p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="content-box box-default">
                                        <span class="icon-ar icon-ar-lg icon-ar-inverse icon-ar-square"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <h5 class="content-box-title"><?= $training->status ?></h5>
                                        <p>
                                            <?= date("M-d-Y", strtotime($training->start_date)) ?> until <?= date("M-d-Y", strtotime($training->end_date)) ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="content-box box-default">
                                        <a href="#training-participants" data-toggle="tab"><span class="icon-ar icon-ar-lg icon-ar-inverse icon-ar-square"><i class="fa fa-group"></i></span></a>
                                        <h5 class="content-box-title"><?= total_participants($training->total_participants,10) ?></h5>
                                        <p>
                                            Participants
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="content-box box-default">
                                        <a href="#training-materials" data-toggle="tab"><span class="icon-ar icon-ar-lg icon-ar-inverse icon-ar-square"><i class="glyphicon glyphicon-file"></i></span></a>
                                        <h5 class="content-box-title"><?=  total_participants($training->training_materials()->count(), 10) ?></h5>
                                        <p>Materials</p>
                                    </div>
                                </div>
                                <div class="col-md-3    ">
                                    <div class="content-box box-default">
                                        <a href="#training-trainers" data-toggle="tab"><span class="icon-ar icon-ar-lg icon-ar-inverse icon-ar-square"><i class="glyphicon glyphicon-user"></i></span></a>
                                        <h5 class="content-box-title"><?= total_participants($training->trainers()->count(),10) ?></h5>
                                        <p>Trainers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="training-participants">
                            <?php $this->load->section('participants_list', 'admin/trainings/participants_list', array('training' => $training))?>
                            <?= $this->load->get_section('participants_list')?>
                        </div>
                        <div class="tab-pane" id="training-materials">
                            <h3>Files</h3>
                            <?php $this->load->section('materials_list', 'admin/trainings/materials_list', array('training' => $training))?>
                            <?= $this->load->get_section('materials_list')?>
                        </div>
                        <div class="tab-pane" id="training-trainers">
                            <?php $this->load->section('trainers_list', 'admin/trainings/trainers_list', array('training' => $training))?>
                            <?= $this->load->get_section('trainers_list')?>
                        </div>
                    </div>

                        <?php $this->load->section('photos_list', 'admin/trainings/photos_list', array('training' => $training))?>
                        <?=  $this->load->get_section('photos_list') ?>

                        <?php $this->load->section('comments_list', 'admin/trainings/comments_list', array('training' => $training, 'new_comment' => isset($new_comment) ? $new_comment : null))?>
                        <?=  $this->load->get_section('comments_list') ?>


                </div>
            </div>
        </section>
    </div>
</div>


<div id='modal'>
    <?php $this->load->section('upload_form_photos_modal', 'admin/trainings/upload_training_photos_form', array('training' => $training))?>
    <?=  $this->load->get_section('upload_form_photos_modal') ?>
</div>

<script src="<?php javascript_url('trainings.js')?>"></script>