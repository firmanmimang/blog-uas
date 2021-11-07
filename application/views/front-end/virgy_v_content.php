          <div class="card card-info">
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5 style="font-size: 2em;"><?= $content['title'] ?></h5>
                <h6 class="mailbox-read-time pt-1">by: <?= $content['name_user'] ?>
                  <span class="mailbox-read-time float-right"><?= date('d F Y', $content['date_created']) ?></span></h6>
              </div>
              <!-- /.mailbox-read-info -->
              <?php if (!empty($content['image'])): ?>
                  <!-- /.mailbox-read-info -->
                  <div class="mailbox-controls with-border text-center">
                    <img class="img-fluid rounded" src="<?= base_url('assets/img/img_content/'.$content['image']) ?>" alt="Photo">
                  </div>
              <?php endif ?>
              <!-- content -->
              <div class="mailbox-read-message">

                <?= htmlspecialchars_decode($content['content']) ?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            
            <div class="modal-footer bg-dark justify-content-between">
              <a href="<?= base_url() ?>" class="btn btn-info">Back</a>
            </div>
            <!-- /.card-footer -->
          </div>