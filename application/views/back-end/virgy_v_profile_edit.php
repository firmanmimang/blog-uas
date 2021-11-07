          <div class="col-sm-12">

            <!-- Profile Image -->
            <div class="card card-info">
              <div class="card-body box-profile">
                <div class="row mb-3 d-flex align-items-center justify-content-center">
                  <div class="col-12 col-md-6">
                    <div class="text-center">
                      <img class="img-fluid img-thumbnail"
                           src="<?php echo empty($profile['photo']) ? base_url('assets/img/no_photo_user.jpg') : base_url('assets/img/img_user/'). $profile['photo']; ?>"
                           alt="User profile picture" id="gambar_load">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <?php 

                      // notifikasi gagal upload gambar
                      if (isset($error_upload)) {
                        echo '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fas fa-exclamation-triangle"></i>'. $error_upload . '</div>';
                      }

                      echo form_open_multipart('virgy_admin/editprofile/'. $profile['username']); 
                    ?>

                      <ul class="list-group list-group-unbordered">

                        <li class="list-group-item">
                          <div class="form-group">
                              <label>Email</label>
                              <input type="text" class="form-control" placeholder="Email" name="email" value="<?= $profile['email'] ?>">
                              <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                          </div>
                        </li>

                        <li class="list-group-item">
                          <div class="form-group">
                              <label>Name</label>
                              <input type="text" class="form-control <?= form_error('name_user')? 'is-invalid' : null ?>" placeholder="Name" name="name_user" value="<?= $profile['name_user'] ?>">
                              <?= form_error('name_user', '<small class="text-danger pl-1">', '</small>'); ?>
                          </div>
                        </li>

                         <li class="list-group-item">
                          <div class="form-group">
                              <label>NIM</label>
                              <input type="text" class="form-control <?= form_error('nim')? 'is-invalid' : null ?>" placeholder="NIM" name="nim" value="<?= $profile['nim'] ?>">
                              <?= form_error('nim', '<small class="text-danger pl-1">', '</small>'); ?>
                          </div>
                        </li>

                        <li class="list-group-item">
                          <div class="form-group">
                              <label>Username</label>
                              <input type="text" class="form-control <?= form_error('username')? 'is-invalid' : null ?>" placeholder="Username" name="username" value="<?= $profile['username'] ?>">
                              <?= form_error('username', '<small class="text-danger pl-1">', '</small>'); ?>
                          </div>
                        </li>

                        <li class="list-group-item">
                          <div class="form-group">
                              <label>Jurusan</label>
                              <input type="text" class="form-control <?= form_error('jurusan')? 'is-invalid' : null ?>" placeholder="Jurusan" name="jurusan" value="<?= $profile['jurusan'] ?>">
                              <?= form_error('jurusan', '<small class="text-danger pl-1">', '</small>'); ?>
                          </div>
                        </li>

                        <li class="list-group-item">
                          <div class="form-group">
                              <label>Fakultas</label>
                              <input type="text" class="form-control <?= form_error('fakultas')? 'is-invalid' : null ?>" placeholder="Fakultas" name="fakultas" value="<?= $profile['fakultas'] ?>">
                              <?= form_error('fakultas', '<small class="text-danger pl-1">', '</small>'); ?>
                          </div>
                        </li>

                        <li class="list-group-item">
                          <div class="form-group">
                            <label for="preview_gambar">Change Photo</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" name="photo" id="preview_gambar" class="custom-file-input">
                                <label class="custom-file-label" for="preview_gambar">Choose file max 4mb...</label>
                              </div>
                            </div>
                        </li>

                      </ul>
                  </div>
                </div>

                
                <div class="row">
                  <div class="col-12 col-md-3 mt-1">
                    <a href="<?= base_url('virgy_admin/profile') ?>" class="btn btn-info btn-block"><b>Kembali</b></a>
                  </div>
                  <div class="col-12 col-md-9 mt-1">
                    <button type="submit" class="btn btn-success btn-block"><b>Edit Profile</b></button>
                  </div>
                </div>

                <?php echo form_close() ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

<script>
  function bacaGambar(input){
    if (input.files && input.files[0]) {
      let reader = new FileReader();
      reader.onload = function(e){
        $('#gambar_load').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $('#preview_gambar').change(function(){
    bacaGambar(this);
  });
</script>