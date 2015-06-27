<div class="sb-slidebar sb-right">

	<center>
		<h5>
			<img id="current-user-avatar" width="75" height="50" alt="image" src="<?php avatar_url($current_user->avatar)?>" class=" img-circle img-responsive">
			<?php echo $current_user->username ?>
		<h5>
	</center>

    <ul class="slidebar-menu">
        <?php if ($sentry->hasAccess('trainings.create_new')) { ?>
            <li>
                <?php echo anchor('trainings/new','Create Training') ?>
            </li>
        <?php } ?>
            <li>
            <?php if ($sentry->hasAccess('articles.create_new')) { ?>
            <li>
            <?php echo anchor('articles/new','Create Article') ?>
        </li>
        <?php } ?>
        <li>
            <?php echo anchor('profile','Profile') ?>
        </li>
        <li>
            <?php echo anchor('profile/edit','Edit Profile') ?>
        </li>
        <li>
            <?php echo anchor('profile/edit_password','Change Password') ?>
        </li>
        <?php if (!$current_user->trainings_to_confirm()->isEmpty()){?>
            <li>
                <?php echo anchor('profile#user-trainings-list','Confirm Training <span class="label label-danger">'.$current_user->trainings_to_confirm()->count().'</span>') ?>
            </li>
        <?php } ?>
        <li>
            <?php echo anchor('logout','Logout') ?>
        </li>
    </ul>
</div> <!-- sb-slidebar sb-right -->