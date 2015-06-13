    <div class="row">
        <div class="col-md-2">
            <section>
                <img class="img-responsive imageborder" alt="avatar" src="<?php avatar_url($current_user->avatar) ?>">
            </section>
            <section>
                <?php echo anchor('profile/edit', '<i class="fa fa-edit"></i> Edit', array('class' => 'btn btn-ar btn-block btn-warning'))?>
            </section>
        </div>
        <div class="col-md-10">
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-user"></i> Your Profile</div>
                    <table class="table table-striped">
                        <tbody><tr>
                            <th>User Name</th>
                            <td><?php echo $current_user->username ?></td>
                        </tr>
                        <tr>
                            <th>Fullname</th>
                            <td><?php echo $current_user->full_name ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $current_user->email ?></td>
                        </tr>
                        <tr>
                            <th>Student Id</th>
                            <td><?php echo $current_user->student_id ?></td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td><?php echo $current_user->phone_number ?></td>
                        </tr>
                        <tr>
                            <th>Last Login</th>
                            <td><?php echo nice_date($current_user->updated_at, 'd/m/Y h:m') ?></td>
                        </tr>
                        <tr>
                            <th>About You</th>
                            <td><?php echo $current_user->description ?></td>
                        </tr>
                    </tbody></table>
                </div>
            </section>

            <section>
                <h2 class="section-title">Recent Activity</h2>
                <div class="list-group">
                    <span id="user-trainings-list" class="list-group-item" href="#">
                        <h3> Trainings </h3>
                        <ul class="list-group">
                        <?php if ($current_user->valid_trainings()->isEmpty()){ ?>
                            <li class="list-group-item">
                                No trainings yet.
                            </li>
                        <?php }else{ ?>
                            <?php foreach ($current_user->valid_trainings() as $training) {?>
                                <li class="list-group-item">
                                    <?= anchor('trainings/show/'.$training['slug'], $training->title )?> <?= $training->status ?>
                                    <?php if ($training->confirmable() && $sentry->hasAccess('trainings.confirm')) { ?>
                                        <span class="pull-right">
                                            <?= anchor('trainings/confirm/'.$training['slug'], 'Confirm', array('class' => 'btn btn-xs btn-warning') )?>
                                        </span>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        <?php } ?>
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
