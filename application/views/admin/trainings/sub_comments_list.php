<?php foreach ($comment->branchs as $branch) { ?>
	<ul class="list-unstyled sub-comments">
		<li class="comment" id="comment-<?=$branch->id?>">
			<div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-1">
                            <img src="<?= soft_avatar_url($branch->user->avatar) ?>" style="width: 85px; height: 90px;" class="imageborder alignleft">
                        </div>
                        <div class="col-md-11">
                            <div class="pull-left">
                                <a class="#"><i> <?= $branch->user->full_name ?> says :</i></a>
                            </div>
                            <div class="pull-right">
                                <i><?= date_format($branch->created_at,'d M, Y ') ?></i>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                        <?= $branch->content ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <a href="#" class="pull-right">Reply</a>
                        </div>
                    </div>
                </div>
            </div>

            	<?php $this->load->section('sub_comments_list_'.$branch->id, 'admin/trainings/sub_comments_list', array('comment' => $branch))?>
                <?=  $this->load->get_section('sub_comments_list_'.$branch->id) ?>

		</li>
    </ul>
<?php } ?>