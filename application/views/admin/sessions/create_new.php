<div class="paper-back-full">
    <div class="login-form-full">
        <div class="fix-box">
            <div class="text-center title-logo animated fadeInDown animation-delay-5">CDC<span> Training Information System</span></div>
            <div class="transparent-div no-padding animated fadeInUp animation-delay-8">
                <ul class="nav nav-tabs nav-tabs-transparent">
                  <li class="active"><a href="#home" data-toggle="tab">Login</a></li>
                  <li><a href="#recovery" data-toggle="tab">Recovery Pass</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane active" id="home">

                 <?php $this->load->section('form', 'admin/sessions/form')?>
                 <?php echo $this->load->get_section('form') ?>

                  </div>
                  <div class="tab-pane" id="recovery">
                    <form role="form">
                        <div class="form-group">
                            <label for="InputUserName">User Name<sup>*</sup></label>
                            <input type="text" class="form-control" id="InputUserName">
                        </div>
                        <div class="form-group">
                            <label for="InputEmail">Email<sup>*</sup></label>
                            <input type="email" class="form-control" id="InputEmail">
                        </div>
                        <button type="submit" class="btn btn-ar btn-primary pull-right">Send Password</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>