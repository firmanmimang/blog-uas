          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title pt-1"><?= $title; ?> Data</h3>

                <div class="card-tools">
                  <a href="<?= base_url('virgy_admin/addcontent'); ?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> making content
                  </a>
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
                      <th>Author</th>
                      <th>Created Date</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $no = 1; foreach ($contents as $c) :?>
                      <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $c['name_theme']; ?></td>
                        <td><?= $c['name_user']; ?></td>
                        <td class="text-center">
                          <?= date('d F Y', $c['date_created']) ?><br>
                          <?= date('h:i:s A', $c['date_created']); ?>
                        </td>
                        <td><?= $c['title']; ?></td>
                        <?php if (empty($c['image'])): ?>
                          <td class="text-center"><img src="<?= base_url('assets/img/no_image_content.png'); ?>" width="150px" class="img-thumbnail" ></td>
                        <?php else: ?>
                          <td class="text-center"><img src="<?= base_url('assets/img/img_content/'. $c['image']); ?>" width="150px" class="img-thumbnail" ></td>
                        <?php endif ?>
                        <td class="text-center">
                          <a href="<?= base_url('virgy_admin/editcontent/'.$c['id']); ?>" class="btn btn-warning btn-sm mt-1"><i class="fas fa-fw fa-edit"></i></a><br>
                          <button class="btn btn-danger btn-sm mt-1" data-toggle="modal" data-target="#delete<?= $c['id']; ?>"><i class="fas fa-fw fa-trash"></i></button><br>
                          <button class="btn btn-info btn-sm mt-1" data-toggle="modal" data-target="#view<?= $c['id']; ?>"><i class="far fa-fw fa-eye"></i></button><br>
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

          
        <!-- modal delete -->
        <?php foreach ($contents as $c) :?>
          <div class="modal fade" id="delete<?= $c['id']; ?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Delete <?= $title ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5>Apakah Anda Yakin Menghapus <?= $c['title']; ?>?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <a href="<?= base_url('virgy_admin/delete_content/'. $c['id']); ?>" class="btn btn-danger">Delete</a>
                </div>
              
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
        <?php endforeach; ?>

        <?php foreach ($contents as $key => $value): ?>
        <!-- Modal View -->
        <div class="modal fade" id="view<?= $value['id']; ?>">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">View Content</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="mailbox-read-info">
                  <h1><?= $value['title'] ?></h1>
                  <h6 class="mailbox-read-time">Author : <?= $value['name_user'] ?>
                    <span class="mailbox-read-time float-right"><?= date('d F Y', $c['date_created']) ?></span></h6>
                </div>

                <?php if (!empty($value['image'])): ?>
                  <!-- /.mailbox-read-info -->
                  <div class="mailbox-controls with-border text-center">
                    <img class="img-fluid pad rounded" src="<?= base_url('assets/img/img_content/'.$value['image']) ?>" alt="Photo">
                  </div>
                <?php endif ?>

                <!-- content -->
                <div class="mailbox-read-message">

                  <?= htmlspecialchars_decode($value['content']) ?>
                </div>
   
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <?php endforeach ?>

