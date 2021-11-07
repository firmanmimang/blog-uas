          <div class="col-sm-12">

            <!-- Profile Image -->
            <div class="card card-info">
              <div class="card-body box-profile">
                <?php 

                if ($this->session->flashdata('pesan_error')) {
                echo '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fas fa-times"></i>';
                echo $this->session->flashdata('pesan_error');
                echo '</div>';
                }
                
                echo form_open('virgy_admin/editpassword/'); 
                ?>
                
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" class="form-control <?= form_error('password_sekarang')? 'is-invalid' : null ?>" placeholder="Masukan password lama..." name="password_sekarang" value="<?= set_value('password_sekarang'); ?>">
                        <?= form_error('password_sekarang', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                  </li>

                  <li class="list-group-item">
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control <?= form_error('password_baru')? 'is-invalid' : null ?>" placeholder="Masukan password baru..." name="password_baru" value="<?= set_value('password_baru'); ?>">
                        <?= form_error('password_baru', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                  </li>

                  <li class="list-group-item">
                    <div class="form-group">
                        <label>Retype Password</label>
                        <input type="password" class="form-control <?= form_error('ulangi_password')? 'is-invalid' : null ?>" placeholder="Retype password..." name="ulangi_password" value="<?= set_value('ulangi_password'); ?>">
                        <?= form_error('ulangi_password', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                  </li>

                </ul>

                <div class="row">
                  <div class="col-12 col-md-3 mt-1">
                    <a href="<?= base_url('virgy_admin/profile') ?>" class="btn btn-info btn-block"><b>Kembali</b></a>
                  </div>
                  <div class="col-12 col-md-9 mt-1">
                    <button type="submit" class="btn btn-success btn-block"><b>Change Password</b></button>
                  </div>
                </div>

                <?php echo form_close() ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
