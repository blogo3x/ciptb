<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        
        <li>
          <a href='<?php echo site_url('listcatar') ?>'>
            <i class="fa fa-list"></i> <span>List Calon Taruna</span>
          </a>
        </li>
        
        <li>
          <a href='<?php echo site_url('addeditdelete/add') ?>'>
            <i class="fa fa-user-plus"></i> <span>Tambah Baru</span>
          </a>
        </li>
        
        <li>
          <a href='<?php echo site_url('keuangan') ?>'>
            <i class="fa fa-file"></i> <span>Keuangan</span>
          </a>
        </li>
        
        <li>
          <a href='<?php echo site_url('configurations/tahun_aktif') ?>'>
            <i class="fa fa-gear"></i> <span>Konfigurasi Sistem</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
