          <div class="col-sm-12">

            <?php 
              if ($this->session->flashdata('pesan')) {
              echo '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i>';
              echo $this->session->flashdata('pesan');
              echo '</h5></div>'
              ;} 
            ?>

            <!-- Profile Image -->
            <div class="card card-info">
              <div class="card-body box-profile">
                <div class="row mb-3 d-flex align-items-center justify-content-center">
                  <div class="col-12 col-sm-6">
                    <div class="text-center">
                      <img class="img-fluid img-thumbnail"
                           src="<?php echo empty($profile['photo']) ? base_url('assets/img/no_photo_user.jpg') : base_url('assets/img/img_user/'). $profile['photo']; ?>"
                           alt="User profile picture">
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 align-self-start">
                    <p><h2 class="text-muted text-center mt-3"><?= $profile['name_user'] ?></h2></p>

                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Email </b> <a class="float-right"><?= $profile['email'] ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>NIM </b> <a class="float-right"><?= $profile['nim'] ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Username </b> <a class="float-right"><?= $profile['username'] ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Jurusan </b> <a class="float-right"><?= $profile['jurusan'] ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Fakultas </b> <a class="float-right"><?= $profile['fakultas'] ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Bergabung Sejak</b> <a class="float-right"><?= date('d F Y', $profile['date_created']) ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Password </b> <a href="<?= base_url('virgy_admin/editpassword/') ?>" class="btn btn-sm btn-warning float-right"><b>Change Password</b></a>
                      </li>
                    </ul>
                  </div>
                </div>

                <a href="<?= base_url('virgy_admin/editprofile/'.$this->session->userdata('username')) ?>" class="btn btn-info btn-block"><b>Edit Profile</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
