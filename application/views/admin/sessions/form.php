<?php echo form_open('admin/login', array('role' => 'form'))?>

    <?php if($this->session->flashdata('error')) {?>
    <div class="alert alert-border alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $this->session->flashdata('error') ?>
    </div>
    <?php }?>

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
        <button type="submit" class="btn btn-ar btn-primary pull-right">Login</button>
        <div class="clearfix"></div>
    </div>
</form>
<?php echo form_close()?>
