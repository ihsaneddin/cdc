<div>
    <?php if($this->session->flashdata('error')) {?>
        <div class="alert alert-border alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('error') ?>
        </div>
    <?php }?>
    <?php echo form_open('login', array('role' => 'form'))?>
        <div class="form-group">
            <div class="input-group login-input">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Username', 'name' => 'username')) ?>
            </div>
            <br>
            <div class="input-group login-input">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <?php echo form_password(['name' => 'password', 'placeholder' => 'Password', 'class' => 'form-control'])?>
            </div>
            <div class="checkbox">
                <label>
                    <?php echo form_checkbox(array('name' => 'remember', 'checked' => false)) ?>
                    Remember me
                </label>
            </div>
            <button type="submit" class="btn btn-ar btn-primary">Login</button>
            <hr>
            <div class="pull-right">
                <a href="#" class="session-menu" data-target="user-registration-form" data-parent="#session-menu">Create Account</a>
                &nbspor&nbsp
                <a href="#" class="session-menu" data-target="user-recover-password" data-parent="#session-menu">Recover Password</a>
            </div>
            <div class="clearfix"></div>
        </div>
    <?= form_close() ?>
</div>