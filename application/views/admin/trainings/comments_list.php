<section>
    <h3 class="section-title">Comments</h3>

    <?php if ($training->comments->isEmpty()) {?>
        <div class="alert alert-warning"><center>No comment yet</center></div>
    <?php } ?>

    <ul class="list-unstyled">
    <?php foreach ($training->comments as $comment) {?>
        <li class="comment" id="comment-<?=$comment->id?>">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-1">
                            <img src="<?= soft_avatar_url($comment->user->avatar) ?>" style="width: 85px; height: 90px;" class="imageborder alignleft">
                        </div>
                        <div class="col-md-11">
                            <div class="pull-left">
                                <a class="#"><i> <?= $comment->user->full_name ?> says :</i></a>
                            </div>
                            <div class="pull-right">
                                <i><?= date_format($comment->created_at,'d M, Y ') ?></i>
                                &nbsp<a href="#"><i class="glyphicon glyphicon-remove-circle"></i></a>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                        <?= $comment->content ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <a href="#" class="pull-right" data-parent="<?= $comment->id ?>">Reply</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->load->section('sub_comments_list_'.$comment->id, 'admin/trainings/sub_comments_list', array('comment' => $comment))?>
            <?= $this->load->get_section('sub_comments_list_'.$comment->id) ?>

        </li>
    <?php }?>

    </ul>
</section>

<section class="comment-form">
    <h4 class="section-title">Leave a Comment</h4>
    <?= form_open('admin/trainings/'.$training->id.'/comments/create', array('class' => 'form', 'role' => 'form', 'id' => 'form-create-training-comment'))?>
        <div class="form-group <?= has_error_for( isset($new_comment) ? $new_comment->errors : [], 'content')  ?>">
            <?php echo form_label('Message', 'content', array('for' => 'message'))?>
            <?php echo form_textarea(array('name' => 'comment[content]', 'id' => 'message', 'class' => 'form-control', 'placeholder' => 'Your comment', 'value' => set_value('content') ))?>
            <?php echo error_message_for(isset($new_comment) ? $new_comment->errors : [], 'content') ?>
        </div>
        <?php echo form_button(array('name' => 'create_comment', 'class' => 'btn btn-ar btn-success pull-right' , 'content' => 'Submit', 'type' => 'submit', 'value' => 'submit'))?>
    <?= form_close() ?>

    <?php if (isset($new_comment)) { ?>
        <div id="new-comment" class="hidden">
            <?= $new_comment->toJson() ?>
        </div>
    <?php } ?>
</section>