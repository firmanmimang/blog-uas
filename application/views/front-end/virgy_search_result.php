    <div class="card-body">
      <div class="row tm-gallery">
      <?php foreach ($content_search as $key => $value): ?>
        <div class="col-lg-3 col-sm-6 col-12 d-flex align-items-stretch justify-content-center">
          <div class="card" style="width: 100%;">
            <?php if (!empty($value['image'])): ?>
              <img class="card-img-top" src="<?= (empty($value['image']))? base_url('assets/img/no_image_content.png') : base_url('assets/img/img_content/'. $value['image']) ?>" alt="Card image cap">
            <?php endif ?>
            <div class="card-body">
              <h3 class="card-text text-dark pb-0 mb-0"><strong><?= $value['title'] ?></strong></h3>
              <p class="card-text text-dark mt-0 mb-1"><?= $value['name_theme'] ?></p>
              <p class="card-text text-dark"><?= date('d F Y', $value['date_created']) ?></p>
              <?php if (empty($value['image'])): ?>
                <p class="card-text text-dark"><?= substr(htmlspecialchars_decode($value['content']), 0, 100).'<a href="'. base_url('virgy_content/detail/'.$value['id']) .'"> read more...</a>'  ?></p>
              <?php endif ?>
            </div>
            <div class="card-footer">
              <a href="<?= base_url('virgy_content/detail/'.$value['id']) ?>" class="btn btn-info">Read more...</a>
            </div>
          </div>
        </div>
      <?php endforeach ?>

      </div>
    </div>





