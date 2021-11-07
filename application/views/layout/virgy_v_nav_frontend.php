<?php 
  $profile = $this->virgy_m_front_end->get_profile();
  $cat = $this->virgy_m_front_end->get_all_category();
?>
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-info">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url() ?>" class="nav-link <?php if($this->uri->segment(1) == '' || $this->uri->segment(1) == 'virgy_home' ) {echo 'active';} ?>">Home</a>
      </li>
      <li class="nav-item dropdown d-none d-sm-inline-block">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link <?= ($this->uri->segment(1) == 'virgy_content')? 'active':null ?>">Categories</a>
        <?php if (count($cat)>0) :?>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
          <?php foreach ($cat as $key => $value): ?>
          <?php 
            $cont = $this->virgy_m_front_end->get_all_contents_by_category($value['id']);
          ?>
          <?php if (!empty($cont)): ?>
            <li class="dropdown-submenu dropdown-hover">
            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle <?= ($this->uri->segment(1) == 'virgy_content' && $value['name_theme'] == $content['name_theme'])? 'active':null ?>"><?= $value['name_theme'] ?></a>
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <?php foreach ($cont as $c): ?>
                <li>
                  <a tabindex="-1" href="<?= base_url('virgy_content/detail/'.$c['id']) ?>" class="dropdown-item <?= ($this->uri->segment(1) == 'virgy_content' && $c['title'] == $content['title'])? 'active':null ?>"><?= $c['title'] ?></a>
                </li>
                <?php endforeach ?>  
              </ul>
            </li>
          <?php endif ?>
          <?php endforeach ?>
          </ul>
        <?php else: ?>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li class="dropdown-submenu dropdown-hover">
              <a class="dropdown-item">No Category</a>
            </li>
          </ul>
        <?php endif ?>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('virgy_about') ?>" class="nav-link <?php if($this->uri->segment(1) == 'virgy_about') {echo 'active';} ?>">About</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->
      <!-- SEARCH FORM -->
      <form class="form-inline ml-3" action="" method="post">
        <div class="input-group input-group-sm">
          <input name="keyword" class="form-control form-control-navbar search" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      <!-- buat sweetalert toast -->
      <?php if (count($content_search)<1): ?>
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>  
      <?php endif ?>
      

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link navbar-info">
      <img src="<?= base_url() ?>assets/adminlte/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><strong>Front End</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <!-- Home -->
            <a href="<?= base_url() ?>" class="nav-link <?php if($this->uri->segment(1) == '' || $this->uri->segment(1) == 'virgy_home' ) {echo 'active';} ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
            
          </li>
          <!-- Kategori -->
          <li class="nav-item has-treeview <?= ($this->uri->segment(1) == 'virgy_content')? 'menu-open': null ?>">
            <a href="#" class="nav-link <?= ($this->uri->segment(1) == 'virgy_content')? 'active': null ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Categories
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php foreach ($cat as $key => $value): ?>
              <?php 
                $cont = $this->virgy_m_front_end->get_all_contents_by_category($value['id']);
              ?>
              <?php if (!empty($cont)): ?>
              <li class="nav-item <?= ($this->uri->segment(1) == 'virgy_content' && $value['name_theme'] == $content['name_theme'])? 'menu-open':null ?>">
                <a href="#" class="nav-link <?= ($this->uri->segment(1) == 'virgy_content' && $value['name_theme'] == $content['name_theme'])? 'active':null ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    <?= $value['name_theme'] ?>
                    <i class="fas fa-angle-left right"></i>
                  </p>   
                </a>
                  <ul class="nav nav-treeview">
                    <?php foreach ($cont as $c): ?>
                    <li class="nav-item">
                      <a href="<?= base_url('virgy_content/detail/'.$c['id']) ?>" class="nav-link <?= ($this->uri->segment(1) == 'virgy_content' && $c['title'] == $content['title'])? 'active':null ?>">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p><?= $c['title'] ?></p>
                      </a>
                    </li>
                    <?php endforeach ?>
                  </ul>
                
              </li>
              <?php endif ?>
            <?php endforeach ?>
              
            </ul>
          </li>

          <!-- <li class="nav-header">EXAMPLES</li> -->
          <li class="nav-item">
            <a href="<?= base_url('virgy_about') ?>" class="nav-link <?php if($this->uri->segment(1) == 'virgy_about') {echo 'active';} ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                About
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $title; ?></h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- content-main -->
    <div class="content">
      <div class="container-fluid" id="result">