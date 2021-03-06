<!DOCTYPE html>
<html lang="en">
<?php
  session_start(); 
  if(!isset($_SESSION['id_ppk']) and !isset($_SESSION['NIP'])){ 
  header("location:../index.php");
  exit();
  }
  include ('../head.php');
?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
<?php
include ('nav_ppk.php');
?>
<!-- end -->
  <div class="content-wrapper">
    <div class="container-fluid">

      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>&nbsp;Riwayat Pengajuan Cuti Luar Tanggungan Negara</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <a  data-toggle="modal" data-target="#exampleCutiLTN"><button  name= "tambahdata" style="margin-left:20px;" class="btn btn-primary float-sm-left" type="submit"  value="ADD"><i class="fa fa-fw fa-plane"></i>&nbsp;Buat Surat</button></a>
              <br><br>
<?php
    include ('koneksi.php');

    $tes=$_SESSION['NIP'];
    $query=mysqli_query($con,"SELECT data_pns.NIP,cuti_ltn.id_pengajuan,data_pns.nama,cuti_ltn.NIP_pengaju,cuti_ltn.tgl_pengajuan,cuti_ltn.alasan_cuti,cuti_ltn.lama_cuti,cuti_ltn.tgl_mulai,cuti_ltn.tgl_selesai,cuti_ltn.sp_dinas,cuti_ltn.sp_bkd FROM cuti_ltn inner join data_pns on cuti_ltn.NIP_pengaju=data_pns.NIP where NIP_pengaju='$tes' ");

    
?>

              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Tanggal Mulai</th> 
                  <th>Tanggal Selesai</th>
                  <th>Lihat Detail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                  <th>Cetak Surat Pengajuan</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $i=0;
               while($data = mysqli_fetch_array($query)){
              // http://achmatim.net/2010/01/18/perintah-mysql-untuk-menampilkan-data-dari-beberapa-tabel/
              $i=$i+1;
              ?>
                <tr>
                  <td><?php echo $i;?> </td>
                  <td><?php echo $data['tgl_pengajuan'];?></td>
                  <td><?php echo $data['tgl_mulai'];?></td>
                  <td><?php echo $data['tgl_selesai'];?></td>
                  <td><p>&nbsp;<a href="my_cuti_ltn_view.php?id_pengajuan=<?php echo $data['id_pengajuan']; ?>" class="btn btn-primary"><i class="fa fa-fw fa-eye"></i></a>&nbsp;&nbsp;<!-- <a href="akun_delete_pns.php?id_ppk=<?php echo $data['id_ppk']; ?>" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></a> --></p></td> 
                  <td>
                      <?php  if(is_null($data['sp_dinas']) or $data['sp_dinas']==''){   ?>
                     <div class="alert alert-primary" ><i class="fa fa-clock-o"></i>&nbsp;Menunggu Konfirmasi</div>
                     <?php }else if($data['sp_dinas']=='disetujui' && $data['sp_bkd']=='disetujui'){ ?>
                     <div class="alert alert-success" >
                      <a href="../print/print_permintaan_ltn.php?id_pengajuan=<?php echo $data['id_pengajuan']; ?>" ><i class="fa fa-fw fa-print"></i>&nbsp;<b>Cetak Surat Permintaan Cuti</b></a><br>
                      <a href="../print/print_sk_ltn.php?id_pengajuan=<?php echo $data['id_pengajuan']; ?>" ><i class="fa fa-fw fa-print"></i>&nbsp;<b>Cetak Surat Keputusan Cuti</b></a>
                     </div>
                     <?php }else if($data['sp_dinas']=='tidak disetujui'){ ?>
                     <div class="alert alert-danger" ><i class="fa fa-close"></i>&nbsp;Pengajuan Tidak Diterima</div>
                    <?php }else{?>
                    <div class="alert alert-success" ><a href="../print/print_permintaan_ltn.php?id_pengajuan=<?php echo $data['id_pengajuan']; ?>" ><i class="fa fa-fw fa-print"></i>&nbsp;<b>Cetak Surat Permintaan Cuti</b></a></div>
                    <?php }?>
                  </td>
                </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Dinas Komunikasi dan Informatika Provinsi Jawa Barat</div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © 2018 Diskominfo Jabar | RHM</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <!-- Cuti ltn -->
    <?php include ('../peraturan_cuti.php'); ?>
    <!-- end tahunan -->

    <!-- Logout ltn-->
  <?php include ('footer_table.php'); ?>
  </div>
</body>

</html>
