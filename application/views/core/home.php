<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>STA DJPB SUMUT | Helpdesk</title>
  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>asset/picture/faviicon.ico">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo base_url(); ?>asset/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>core/home" class="brand-link">
      <img src="<?php echo base_url(); ?>asset/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Helpdesk</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?=@$_SESSION['name'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <?php 
          $level = $this->session->userdata('level');
          if($level == '1')
          {
            $this->load->view('core/menu'); 
          }else
          {
            $this->load->view('core/menu2'); 
          }
      ?>  
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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Helpdesk</li>
              <li class="breadcrumb-item active">Home</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php

                $start = date('Y-m');
                $end = date('Y-m-d');
                $start_date = $start."-01";
                $id_div = $this->session->userdata('id_div');
                $id_loc = $this->session->userdata('id_loc');
                $akses = $this->session->userdata('level');
                if($akses=='1'){
                $this->db->select('tic_no');
                $this->db->from('ticket');
                $this->db->where('start_date >=', $start_date);
                $this->db->where('start_date <=', $end);
                echo $this->db->count_all_results();
                }else{
                  $this->db->select('tic_no');
                  $this->db->from('ticket');
                  $this->db->where('id_div', $id_div);
                  $this->db->where('id_loc', $id_loc);
                  $this->db->where('start_date >=', $start_date);
                  $this->db->where('start_date <=', $end);
                  echo $this->db->count_all_results();
                }
                ?>
                </h3>

                <p>Total Ticket This Month</p>
              </div>
              <div class="icon">
              <ion-icon size="large" name="ticket-sharp"></ion-icon> 
              </div>
              <a href="<?php echo base_url('core/ticket')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php
                    $start = date('Y-m');
                    $end = date('Y-m-d');
                    $start_date = $start."-01";
                    $id_div = $this->session->userdata('id_div');
                    $id_loc = $this->session->userdata('id_loc');
                    $akses = $this->session->userdata('level');
                    if($akses=='1'){
                    $this->db->select('tic_no');
                    $this->db->from('ticket');
                    $this->db->where('status', '3');
                    $this->db->where('start_date >=', $start_date);
                    $this->db->where('start_date <=', $end);
                    echo $this->db->count_all_results();
                    }else{
                      $this->db->select('tic_no');
                      $this->db->from('ticket');
                      $this->db->where('id_div', $id_div);
                      $this->db->where('id_loc', $id_loc);
                      $this->db->where('status', '3');
                      $this->db->where('start_date >=', $start_date);
                      $this->db->where('start_date <=', $end);
                      echo $this->db->count_all_results();
                    }
                    ?>
                </h3>

                <p>Ticket Closed</p>
              </div>
              <div class="icon">
              <ion-icon size="large" name="checkmark-done-circle-sharp"></ion-icon> 
              </div>
              <a href="<?php echo base_url('core/ticket')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php
                    $start = date('Y-m');
                    $end = date('Y-m-d');
                    $start_date = $start."-01";
                    $id_div = $this->session->userdata('id_div');
                    $id_loc = $this->session->userdata('id_loc');
                    $akses = $this->session->userdata('level');
                    if($akses=='1'){
                    $this->db->select('tic_no');
                    $this->db->from('ticket');
                    $this->db->where('status', '2');
                    $this->db->where('start_date >=', $start_date);
                    $this->db->where('start_date <=', $end);
                    echo $this->db->count_all_results();
                    }else{
                      $this->db->select('tic_no');
                      $this->db->from('ticket');
                      $this->db->where('id_div', $id_div);
                      $this->db->where('id_loc', $id_loc);
                      $this->db->where('status', '2');
                      $this->db->where('start_date >=', $start_date);
                      $this->db->where('start_date <=', $end);
                      echo $this->db->count_all_results();
                    }
                    ?>
                </h3>

                <p>Ticket Handled</p>
              </div>
              <div class="icon">
              <ion-icon size="large" name="hammer-sharp"></ion-icon>
              </div>
              <a href="<?php echo base_url('core/ticket')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php
                    $start = date('Y-m');
                    $end = date('Y-m-d');
                    $start_date = $start."-01";
                    $id_div = $this->session->userdata('id_div');
                    $id_loc = $this->session->userdata('id_loc');
                    $akses = $this->session->userdata('level');
                    if($akses=='1'){
                    $this->db->select('tic_no');
                    $this->db->from('ticket');
                    $this->db->where('status', '1');
                    $this->db->where('start_date >=', $start_date);
                    $this->db->where('start_date <=', $end);
                    echo $this->db->count_all_results();
                    }else{
                      $this->db->select('tic_no');
                      $this->db->from('ticket');
                      $this->db->where('id_div', $id_div);
                      $this->db->where('id_loc', $id_loc);
                      $this->db->where('status', '1');
                      $this->db->where('start_date >=', $start_date);
                      $this->db->where('start_date <=', $end);
                      echo $this->db->count_all_results();
                    }
                    ?>
                </h3>

                <p>Ticket Opened</p>
              </div>
              <div class="icon">
              <ion-icon size="large" name="help-circle-sharp"></ion-icon>
              </div>
              <a href="<?php echo base_url('core/ticket')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('core/footer'); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>asset/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>asset/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>asset/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>asset/adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>asset/adminlte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url(); ?>asset/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url(); ?>asset/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>asset/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>asset/adminlte/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>asset/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url(); ?>asset/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>asset/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url(); ?>asset/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>asset/adminlte/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url(); ?>asset/adminlte/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo base_url(); ?>asset/adminlte/dist/js/pages/dashboard.js"></script> -->
<!-- Ionic -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
