<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}">
  <title>Halaman Beranda Aplikasi Pembayaran SPP</title>
  <link rel="icon" href="{{asset('./assetslog/images/logo2.png')}}" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('./assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('./assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('./assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('./assets/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('./assets/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('./assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('./assets/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('./assets/plugins/summernote/summernote-bs4.min.css')}}">
  <link rel="stylesheet" href="{{asset('./assets/plugins/toastr/toastr.min.css')}}">
  <!-- DataTable -->
  <link rel="stylesheet" href="{{asset('./assets/plugins/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{asset('./assets/plugins/select2/css/select2.min.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('./assets/dist/img/logo2.png')}}" alt="Logo Aplikasi SPP" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block" style="font-weight: 500;">
        <a href="javascript:void(0);" class="nav-link">Selamat Datang di Aplikasi Pembayaran SPP</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary bg-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./index" class="brand-link" style="border-color:#bbd0e3;">
      <img src="{{asset('./assets/dist/img/logo2.png')}}" alt="Logo Aplikasi SPP" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">{{Session::get('nama')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item mt-3 pb-2">
            <a href="./index" class="nav-link text-white">
              <i class="nav-icon fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
      @php
			if(Session::get('jenis') == "Admin"){
		  @endphp
          <li class="nav-item pb-2">
            <a href="javascript:void(0);" data-id="siswa" class="nav-link text-white">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Data Siswa
              </p>
            </a>
          </li>
          <li class="nav-item pb-2">
            <a href="javascript:void(0);" data-id="kelas" class="nav-link text-white">
              <i class="nav-icon fa fa-university"></i>
              <p>Data Kelas</p>
            </a>
          </li>
          <li class="nav-item pb-2">
            <a href="javascript:void(0);" data-id="spp" class="nav-link text-white">
              <i class="nav-icon fas fa-list"></i>
              <p>Data SPP</p>
            </a>
          </li>
          <li class="nav-item pb-2">
            <a href="javascript:void(0);" data-id="petugas" class="nav-link text-white">
              <i class="nav-icon fas fa-user"></i>
              <p>Petugas</p>
            </a>
          </li>
          <li class="nav-item pb-2">
          <a href="javascript:void(0);" data-id="transaksi" class="nav-link text-white">
              <i class="nav-icon fas fa-edit"></i>
              <p>Transaksi Pembayaran</p>
            </a>
         <!-- </li>
          <li class="nav-item pb-2">
          <a href="javascript:void(0);"data-id="pembayaran" class="nav-link text-white">
              <i class="nav-icon fas fa-book"></i>
              <p>Riwayat Pembayaran</p>
            </a>
          </li> -->
        @php
			  }
		    @endphp
          <li class="nav-item pb-2">
            <a href="javascript:void(0);" data-id="laporan" class="nav-link text-white">
              <i class="nav-icon fas fa-columns"></i>
              <p>Laporan</p>
            </a>
          </li>
          <li class="nav-item pb-2">
            <a href="javascript:void(0);" data-id="pengaturan" class="nav-link text-white">
              <i class="nav-icon fas fa-cog"></i>
              <p>Pengaturan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./keluar" class="nav-link text-white">
              <i class="nav-icon fas fa-lock"></i>
              <p>Logout</p>
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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row" style="padding-top:20px;">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$tsiswa}}</h3>
                <p>Data Siswa</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$tkelas}}</h3>
                <p>Data Kelas</p>
              </div>
              <div class="icon">
                <i class="fa fa-university"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$tpetugas}}</h3>
                <p>Data Petugas</p>
              </div>
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$tbayar}}</h3>
                <p>Transaksi Pembayaran</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header bg-primary">
                <h3 class="card-title">
                  <i class="fas fa-book mr-1"></i>
                  Daftar Riwayat Transaksi Pembayaran SPP
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
          @php 
					$i=1;
					$dataBg = Array("","info","warning","success","primary","danger","info","warning","success","primary","danger");
					@endphp
					@foreach($datapembayaran as $value)
					@php 
							$value->jumlah = number_format($value->jumlah,0,",",".");
							$value->petugas = ucwords(strtolower($value->petugas));
							$value->nama = ucwords(strtolower($value->nama));
					@endphp
          <li>
							<span class="text"><b>{{ $value->nama }}</b> telah Membayar SPP Sebesar Rp. {{ $value->jumlah }}</span>
							<small class="badge badge-<?php echo $dataBg[$i]; ?>"><i class="far fa-check-circle"></i> Diterima oleh {{ $value->petugas }}</small>
						</li>
					@php
					$i++;
					@endphp
					@endforeach
                </ul>
              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only Ing the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">
                <h3 class="card-title pt-2">
                  <i class="far fa-calendar-alt"></i>
                  Tanggal Hari Ini
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer mt-2">
    Copyright &copy; <?php echo date("Y"); ?> MI Al-Istiqomah.
    <div class="float-right d-none d-sm-inline-block">
      <b>Aplikasi Pembayaran SPP</b>
    </div>
  </footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script type="text/javascript" src="{{asset('./assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script type="text/javascript" src="{{asset('./assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script type="text/javascript" src="{{asset('./assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script type="text/javascript" src="{{asset('./assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script type="text/javascript" src="{{asset('./assets/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script type="text/javascript" src="{{asset('./assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('./assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script type="text/javascript" src="{{asset('./assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="{{asset('./assets/plugins/moment/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('./assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script type="text/javascript" src="{{asset('./assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script type="text/javascript" src="{{asset('./assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script type="text/javascript" src="{{asset('./assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- DataTable -->
<script type="text/javascript" src="{{asset('./assets/plugins/toastr/toastr.min.js')}}"></script>
<script type="text/javascript" src="{{asset('./assets/plugins/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('./assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="{{asset('./assets/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script type="text/javascript" src="{{asset('./assets/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script type="text/javascript" src="{{asset('./assets/dist/js/pages/dashboard.js')}}"></script>
</body>
</html>
