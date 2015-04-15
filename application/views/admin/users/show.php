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

            <section>
                <h2 class="section-title">Recent Activity</h2>
                <div class="list-group">
                    <span class="list-group-item" href="#">
                        <h3> Trainings </h3>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="label label-success pull-right">Completed</span>
                                Pelatihan Kuda Jingkrak
                            </li>
                            <li class="list-group-item">
                                <span class="label label-royal pull-right">New</span>
                                Pelatihan Duduk Yang Benar
                             </li>
                            <li class="list-group-item">
                                <span class="label label-warning pull-right">Upcoming</span>
                                Pelatihan Baris Berbaris
                            </li>
                        </ul>
                    </span>
                    <span class="list-group-item">
                        <h3>Comments</h3>
                        <ul class="list-group list-group-sm">
                          <li class="list-group-item">Cras justo odio</li>
                          <li class="list-group-item">Dapibus ac facilisis in</li>
                          <li class="list-group-item">Morbi leo risus</li>
                          <li class="list-group-item">Porta ac consectetur ac</li>
                          <li class="list-group-item">Vestibulum at eros</li>
                        </ul>
                    </a>
                </div> <!--list-group -->
            </section>
        </div>
    </div>
