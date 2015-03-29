<div class="sb-slidebar sb-right">

	<center>
		<h5>
			<img id="current-user-avatar" width="75" height="50" alt="image" src="<?php avatar_url($current_user->avatar)?>" class=" img-circle img-responsive">
			<?php echo $current_user->username ?>
		<h5>
	</center>

    <ul class="slidebar-menu">
        <li>
            <?php echo anchor('admin/profile','Profile') ?>
        </li>
        <li>
            <?php echo anchor('admin/profile/edit','Edit Profile') ?>
        </li>
        <li>
            <?php echo anchor('admin/profile/edit_password','Change Password') ?>
        </li>
        <li>
            <?php echo anchor('admin/logout','Logout') ?>
        </li>
    </ul>
</div> <!-- sb-slidebar sb-right -->