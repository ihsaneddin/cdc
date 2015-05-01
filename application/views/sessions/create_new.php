<div class="container">
    <div class="row" id="session-menu">
        <div class="col-md-5 pull-right" id='user-login-form'>
            <center>
                <h3 class="">CDC Training Information System</h3>
            </center>
            <div class="clearfix"></div>
            <div class="panel panel-primary animated fadeInDown animation-delay-2">
                <div class="panel-heading">Sign In</div>
                <div class="panel-body">
                 <?php $this->load->section('form', 'sessions/form')?>
                 <?php echo $this->load->get_section('form') ?>
                </div>
            </div>
        </div>
        <div class="col-md-7 pull-right" id="user-registration-form">
            <center>
                <h3 class="">CDC Training Information System</h3>
            </center>
            <div class="panel panel-primary animated fadeInDown animation-delay-2">
                <div class="panel-heading">Registration</div>
                <div class="panel-body">
                 <?php $this->load->section('register_form', 'registration/form', array('registrant' => isset($registrant) ? $registrant : new User )) ?>
                 <?= $this->load->get_section('register_form') ?>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container  -->
