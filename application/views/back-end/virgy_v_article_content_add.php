          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><?= $title; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              	<?php 

                // // notifikasi form kosong
                // echo validation_errors('<div class="alert alert-danger alert-dismissible">
                //   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                //   <h5><i class="icon fas fa-exclamation-triangle"></i>', '</h5></div>');

              	// notifikasi gagal upload gambar
              	if (isset($error_upload)) {
              		echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="icon fas fa-exclamation-triangle"></i>'. $error_upload . '</div>';
              	}

              	echo form_open_multipart('virgy_admin/addcontent'); 
              	?>

                  <div class="form-group">
                      <label>Category</label>
                      <select name="id_category" class="form-control <?= form_error('id_category')? 'is-invalid' : null ?>">
                        <option value="">--Pilih Kategori--</option>
                        <?php foreach ($category as $key => $value) :?>
                          <option value="<?= $value['id']; ?>" <?= (set_value('id_category') == $value['id'])? 'selected': null?>><?= $value['name_theme']; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?= form_error('id_category', '<small class="text-danger pl-1">', '</small>'); ?>

                  </div>

                  <div class="form-group">
                      <label>Title</label>
                      <input type="text" class="form-control <?= form_error('title')? 'is-invalid' : null ?>" placeholder="Judul content..." name="title" value="<?= set_value('title'); ?>">
                      <?= form_error('title', '<small class="text-danger pl-1">', '</small>'); ?>
                  </div>

                  <div class="form-group">
                      <label>Content</label>
                      <textarea id="compose-textarea" name="content" class="form-control <?= form_error('content')? 'is-invalid' : null ?>" placeholder="Isi content..." style="height: 300px"><?= set_value('content'); ?></textarea>
                      <?= form_error('content', '<small class="text-danger pl-1">', '</small>'); ?>
                  </div>

                  <div class="row">
                  	<div class="col-sm-6">
                     <div class="form-group">
                        <label for="exampleInputFile">Image</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="image" id="preview_gambar" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Pilih gambar ilustrasi max 4mb... (not required)</label>
                          </div>
                        </div>
                      </div>
                     </div>
	              
                    <div class="col-sm-6">	
  	                  <div class="form-group">
  	                      <img src="<?= base_url('assets/img/no_image_content.png') ?>" id="image_load" width="200px" class="rounded mx-auto d-block my-1">
  	                  </div>
	                  </div>
	                </div>

                  <div class="form-group">  
                      <a href="<?= base_url('virgy_admin/articlecontent'); ?>" class="btn btn-info btn-sm">Back</a>
                      <button type="submit" class="btn btn-success btn-sm">Add</button>
                  </div>

                 <?php echo form_close(); ?>

              </div>
            </div>
          </div>

<script>
	function bacaGambar(input){
		if (input.files && input.files[0]) {
			let reader = new FileReader();
			reader.onload = function(e){
				$('#image_load').attr('src', e.target.result);

			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$('#preview_gambar').change(function(){
		bacaGambar(this);
	});
</script>