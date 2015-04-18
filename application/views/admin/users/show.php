    <div class="row">
        <div class="col-md-2">
            <section>
                <img class="img-responsive imageborder" alt="avatar" src="<?php echo avatar_url($user->avatar) ?>">
            </section>
            <section>
                <?php echo anchor('admin/users/edit/'.$user->id, '<i class="fa fa-edit"></i> Edit', array('class' => 'btn btn-ar btn-block btn-warning'))?>
            </section>
        </div>
        <div class="col-md-10">
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-user"></i> User Information</div>
                    <table class="table table-striped">
                        <tbody><tr>
                            <th>User Name</th>
                            <td><?php echo $user->username ?></td>
                        </tr>
                        <tr>
                            <th>Fullname</th>
                            <td><?php echo $user->full_name ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $user->email ?></td>
                        </tr>
                        <?php if ($user->is_student) {?>
                            <tr>
                                <th>Student Id</th>
                                <td><?php echo $user->student_id ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th>Phone Number</th>
                            <td><?php echo $user->phone_number ?></td>
                        </tr>
                        <tr>
                            <th>Last Login</th>
                            <td><?php echo nice_date($user->updated_at, 'd/m/Y h:m') ?></td>
                        </tr>
                    </tbody></table>
                </div>
            </section>


            <ul class="nav nav-tabs nav-tabs-ar nav-tabs-ar-white">
            <li class="active"><a href="#user-trainings" data-toggle="tab">Trainings</a></li>
            <li><a href="#profile2" data-toggle="tab">Messages</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
            <div class="tab-pane active" id="user-trainings">
                <?php $this->load->section('trainings_list', 'admin/users/trainings_list', array('user_trainings' => $user->user_trainings()))?>
                <?= $this->load->get_section('trainings_list')?>
            </div>
            <div class="tab-pane" id="profile2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, at, laboriosam, possimus, nam rem quia reiciendis sit vel totam id eum quasi aperiam officiis omnis ipsum quo praesentium quaerat unde mollitia maiores. Dignissimos, deleniti, eos, quibusdam quae voluptatibus obcaecati voluptatum iure quas voluptates cupiditate incidunt voluptate dolorem delectus exercitationem earum?</div>
            </div>

            <br>
        </div>
    </div>
