          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title pt-1"><?= $title; ?> Data</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> Add
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->

              <div class="card-body">

                <?php if ($this->session->flashdata('pesan')) {
                  echo '<div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <i class="icon fas fa-check"></i>';
                  echo $this->session->flashdata('pesan');
                  echo '</div>'
                  ;} 
                ?>

                <table class="table table-bordered table-striped" id="example1">
                  <thead class="text-center">
                    <tr>
                      <th>No.</th>
                      <th>Category</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $no = 1; foreach ($category as $k) :?>
                      <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $k['name_theme']; ?></td>
                        <td class="text-center">
                          <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $k['id']; ?>"><i class="fas fa-edit"></i></button>
                          <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $k['id']; ?>"><i class="fas fa-trash"></i></button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <!-- modal add -->
          <div class="modal fade" id="add">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add <?= $title; ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">

                <?php echo form_open('virgy_admin/add_category'); ?>

                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" placeholder="Article category name..." name="name_category" required>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info">Add</button>
                </div>
                <?php echo form_close(); ?>

              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

          <!-- modal edit -->
        <?php foreach ($category as $k) :?>
          <div class="modal fade" id="edit<?= $k['id']; ?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit <?= $title; ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                <?php echo form_open('virgy_admin/edit_category/'. $k['id']); ?>
              
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" placeholder="Article category name..." name="name_category" value="<?= $k['name_theme']; ?>" required>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info">Edit</button>
                </div>
                <?php echo form_close(); ?>

              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
        <?php endforeach; ?>

          <!-- modal delete -->
        <?php foreach ($category as $k) :?>
          <div class="modal fade" id="delete<?= $k['id']; ?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Delete <?= $title ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5>Apakah Anda Yakin Menghapus <?= $k['name_theme']; ?>?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <a href="<?= base_url('virgy_admin/delete_category/'. $k['id']); ?>" class="btn btn-danger">Delete</a>
                </div>
              
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
        <?php endforeach; ?>

