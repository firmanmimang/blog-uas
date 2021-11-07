
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('virgy_admin') ?>" class="brand-link navbar-info">
      <img src="<?= base_url() ?>assets/adminlte/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><strong>Halaman Admin</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo empty($this->session->userdata('photo')) ? base_url('assets/img/no_photo_user.jpg') : base_url('assets/img/img_user/'). $this->session->userdata('photo'); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= base_url('virgy_admin/profile') ?>" class="d-block"><strong><?= $this->session->userdata('name_user') ?></strong></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="<?= base_url('virgy_admin') ?>" class="nav-link <?php if($this->uri->segment(1)== 'virgy_admin' && $this->uri->segment(2)== '') echo 'active' ?> <?php if($this->uri->segment(1)== 'virgy_admin' && $this->uri->segment(2)== 'index') echo 'active' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('virgy_admin/category'); ?>" class="nav-link <?php if($this->uri->segment(2)== 'category') echo 'active' ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>Article Categories</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('virgy_admin/articlecontent'); ?>" class="nav-link <?php if($this->uri->segment(2)== 'articlecontent' || $this->uri->segment(2)== 'addcontent' || $this->uri->segment(2)== 'editcontent') echo 'active' ?>">
              <i class="nav-icon fas fa-receipt"></i>
              <p>Article Contents</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('virgy_auth/logout'); ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Log Out</p>
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
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('virgy_admin') ?>">Dashboard</a></li>

              <?php 
              // CATEGORIES
              if ($this->uri->segment(1)=="virgy_admin" && $this->uri->segment(2) == "category") {
                echo '<li class="breadcrumb-item active">Article Categories</li>';
              }

              // CONTENTS
              if ($this->uri->segment(1) == "virgy_admin" && $this->uri->segment(2)== "articlecontent") {
                echo '<li class="breadcrumb-item active">Article Contents</li>';
              }

              if ($this->uri->segment(1) == "virgy_admin" && $this->uri->segment(2)== "addcontent") {
                echo '<li class="breadcrumb-item active"><a href="'.base_url('virgy_admin/articlecontent').'">Article Contents</a></li>';
                echo '<li class="breadcrumb-item active">Making Content</li>';
              }

              if ($this->uri->segment(1) == "virgy_admin" && $this->uri->segment(2)== "editcontent") {
                echo '<li class="breadcrumb-item active"><a href="'.base_url('virgy_admin/articlecontent').'">Article Contents</a></li>';
                echo '<li class="breadcrumb-item active">Edit Content</li>';
              }

              // PROFILE
              if ($this->uri->segment(1)=="virgy_admin" && $this->uri->segment(2) == "profile") {
                echo '<li class="breadcrumb-item active">Profile</li>';
              }

              if ($this->uri->segment(1) == "virgy_admin" && $this->uri->segment(2)== "editpassword") {
                echo '<li class="breadcrumb-item active"><a href="'.base_url('virgy_admin/profile').'">Profile</a></li>';
                echo '<li class="breadcrumb-item active">Change Password</li>';
              }

              if ($this->uri->segment(1) == "virgy_admin" && $this->uri->segment(2)== "editprofile") {
                echo '<li class="breadcrumb-item active"><a href="'.base_url('virgy_admin/profile').'">Profile</a></li>';
                echo '<li class="breadcrumb-item active">Edit Profile</li>';
              }
              ?>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">