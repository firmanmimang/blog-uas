          <div class="col-sm-12">
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
                        <b>Nim </b> <a class="float-right"><?= $profile['nim'] ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Jurusan </b> <a class="float-right"><?= $profile['jurusan'] ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Fakultas </b> <a class="float-right"><?= $profile['fakultas'] ?></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
