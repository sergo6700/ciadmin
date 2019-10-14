<?php
    $user_info = $user;
    $info = $this->session->userdata('history');
?>




<div class="container">
    <div class="row m-y-2">
        <div class="col-lg-8 push-lg-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#history" data-toggle="tab" class="nav-link">History</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Edit</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#editPass" data-toggle="tab" class="nav-link">Change password</a>
                </li>
            </ul>
            <div class="tab-content p-b-3">
                <div class="tab-pane active" id="profile">
                    <h4 class="m-y-2"><?= $user_info->first_name . ' ' . $user_info->last_name ?></h4>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>About</h6>
                            <p>Email: <?= $user_info->email_addres ?></p>
                            <p>Username: <?= $user_info->user_name ?></p>

                        </div>
                        <div class="col-md-6">
                            <h6>Recent Tags</h6>
                            <a href="" class="tag tag-default tag-pill">html5</a>
                            <a href="" class="tag tag-default tag-pill">react</a>
                            <a href="" class="tag tag-default tag-pill">codeply</a>
                            <a href="" class="tag tag-default tag-pill">angularjs</a>
                            <a href="" class="tag tag-default tag-pill">css3</a>
                            <a href="" class="tag tag-default tag-pill">jquery</a>
                            <a href="" class="tag tag-default tag-pill">bootstrap</a>
                            <a href="" class="tag tag-default tag-pill">responsive-design</a>
                            <hr>
                            <span class="tag tag-primary"><i class="fa fa-user"></i> 900 Followers</span>
                            <span class="tag tag-success"><i class="fa fa-cog"></i> 43 Forks</span>
                            <span class="tag tag-danger"><i class="fa fa-eye"></i> 245 Views</span>
                        </div>
                        <div class="col-md-12">
                            <h4 class="m-t-2"><span class="fa fa-clock-o ion-clock pull-xs-right"></span> Recent Activity</h4>

                        </div>
                    </div>
                    <!--/row-->
                </div>
                <div class="tab-pane" id="history">
                    <h4 class="m-y-2">Recent History</h4>
                    <table class="table table-striped table-bordered  table-condensed">
                        <thead>
                        <tr>
                            <th class="header">#</th>
                            <th class="red header">Name</th>
                            <th class="red header">Model</th>
                            <th class="yellow header headerSortDown">Description</th>
                            <th class="green header">Stock</th>
                            <th class="red header">Sell Price</th>
                            <th class="red header">Count</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($info) && !empty($info)){
                            foreach($info as $row) {?>
                                <tr>
                                    <td class="id"><?= $row['id'] ?></td>
                                    <td><?= $row['product_name'] ?></td>
                                    <td><?= $row['product_category'] ?></td>
                                    <td><?= $row['description'] ?></td>
                                    <td><?= $row['stock'] ?></td>
                                    <td><?= $row['sell_price'] ?></td>
                                    <td><?= $row['count'] ?></td>
                                </tr>
                            <?php }//end foreach
                        }// end if
                        else{?>
                            <div class="alert alert-danger" role="alert">
                                Your history is empty!
                            </div>
                        <?php } ?>
                        </tbody>
                    </table>

                </div>
                <div class="tab-pane" id="edit">
                    <h4 class="m-y-2">Edit Profile</h4>
                    <form role="form" action="user/update" method="post">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">First name</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="first_name" type="text" value="<?= $user_info->first_name ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="last_name" value="<?= $user_info->last_name?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="email" name="email" value="<?= $user_info->email_addres ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Username</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="user_name" value="<?= $user_info->user_name?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="reset" class="btn btn-secondary" value="Cancel">
                                <input type="submit" class="btn btn-primary" value="Save Changes">
                                <a href="<?= site_url("member")?>/user/delete" class="btn btn-danger">Delete account</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="editPass">
                    <h4 class="m-y-2">Change password</h4>
                    <form role="form" action="user/updatePass" method="post">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Old password</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="old_pass" type="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">New password</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" name="new_pass"">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Confirm new password</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" name="confirm_pass">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="reset" class="btn btn-secondary" value="Cancel">
                                <input type="submit" name="change_pass" class="btn btn-primary" value="Save Changes">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 pull-lg-8 text-xs-center">
            <img src="<?= $user_info->image ?>" class="m-x-auto img-fluid img-circle" style="width: 200px;height: auto" alt="avatar">
            <h6 class="m-t-2">Upload a different photo</h6>
            <label class="custom-file">
                <?= form_open_multipart('user/updateImage') ?>
                    <input type="file" id="file" name="file" required class="custom-file-input">
                    <span class="custom-file-control">Choose file</span><br>
                    <input type="submit" id="file" class="btn btn-danger">
                <?= form_close() ?>
            </label>
        </div>
    </div>
</div>
<hr>