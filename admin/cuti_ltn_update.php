<!DOCTYPE html>
<html lang="en">
<?php
  session_start(); 
  if(!isset($_SESSION['id_admin']) and !isset($_SESSION['NIP'])){ 
  header("location:../index.php");
  exit();
  }
  include ('../head.php');
?>

  <?php
      include("koneksi.php");
      if (isset($_POST["updatedata"])){
      $id=$_GET['id_pengajuan'];
      $x=$_POST['jenis_cuti'];
      // $a=$_POST['id_pengajuan'];
      $b=$_POST['tgl_pengajuan'];
      $c=$_POST['NIP_pengaju'];
      $d=$_POST['alasan_cuti'];
      $v=$_POST['gaji_pokok'];
      $e=$_POST['lama_cuti'];
      $f=$_POST['tgl_mulai'];
      $g=$_POST['tgl_selesai'];
      $h0=$_POST['alamat'];
      $i=$_POST['no_tlp'];
      $j=$_POST['sp_dinas'];
      $k=$_POST['sp_alasan1'];
      $l=$_POST['sp_bkd'];
      $m=$_POST['sp_alasan2'];

     
      $edited=mysqli_query($con, "UPDATE cuti_ltn set jenis_cuti='$x',tgl_pengajuan='$b',NIP_pengaju='$c',alasan_cuti='$d',gaji_pokok='$v',lama_cuti='$e',tgl_mulai='$f',tgl_selesai='$g',alamat='$h0',no_tlp='$i',sp_dinas='$j',sp_alasan1='$k',sp_bkd='$l',sp_alasan2='$m' where id_pengajuan='$id'");

      if($edited){ 
              header("location:cuti_ltn.php");
              exit();
      }else
              echo "gagal";
      }
    ?>



<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
<?php
include ('nav_admin.php');
?>
<!-- end -->
  <div class="content-wrapper">
    <div class="container-fluid">

      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>Pengajuan Cuti Luar Tanggungan Negara</div>
        <div class="card-body">
          </div>

 <?php
         
          include ("koneksi.php");

          $id = $_GET['id_pengajuan'];

          $sql = mysqli_query($con, "SELECT * FROM cuti_ltn WHERE id_pengajuan = '$id'");
          while($data = mysqli_fetch_array($sql)){
  
?>

<table>
<td style="width:5%"></td>
<h3>&nbsp;&nbsp;&nbsp;Edit Pengajuan CLTN Pegawai</h3><br>
<form action="cuti_ltn_update.php?id_pengajuan=<?php echo $id;?>" name="updatedata" method="post">
<td style="width:85%">
  <input required type="hidden" name="jenis_cuti" value="KAP" class="form-control" >
  <input required type="hidden" name="id_pengajuan" value="<?php echo $data['id_pengajuan'];?>" class="form-control" > 
   <div class="form-group">
      <label >Tanggal Pengajuan :  </label>
      <input required type="date" value="<?php echo $data['tgl_pengajuan'];?>"name="tgl_pengajuan" class="form-control" >
    </div>        
    <div class="form-group">
      <label >NIP :  </label>
      <input required type="text" value="<?php echo $data['NIP_pengaju'];?>" name="NIP_pengaju" class="form-control" >
    </div>
    <div class="form-group">
      <label >Alasan Cuti :</label>
     <textarea rows="5" required type="text" name="alasan_cuti" class="form-control" ><?php echo $data['alasan_cuti'];?></textarea>
    </div> 
        <div class="form-group">
      <label >Gaji Pokok :</label>
      <input required type="text" value="<?php  echo $data['gaji_pokok'];?>" name="gaji_pokok" class="form-control" >
    </div>
    <div class="form-group">
      <label >Lama Cuti:</label>
      <input required type="text" value="<?php  echo $data['lama_cuti'];?>" name="lama_cuti" class="form-control" >
    </div>
    <div class="form-group">
    <label >Tanggal Mulai:</label>
      <input required type="date" value="<?php echo $data['tgl_mulai'];?>" name="tgl_mulai" class="form-control" >
    </div>
    <div class="form-group">
     <label >Tanggal Selesai:</label>
      <input required type="date" value="<?php echo $data['tgl_selesai'];?>" name="tgl_selesai" class="form-control" >
    </div>
    <div class="form-group">
     <label >Alamat selama menjalani cuti:</label>
      <textarea rows="5" required type="text" name="alamat" class="form-control" placeholder="Contoh Penulisan Alamat : 
Jl. Pasar Barat No.51 RT.01/RW.01 Kec.Banjaran
Kab.Bandung Prov.Jawa Barat" class="form-control" ><?php echo $data['alamat'];?></textarea>
   </div>
    <div class="form-group">
     <label >Nomor Telepon:</label>
      <input required type="text" value="<?php echo $data['no_tlp'];?>" name="no_tlp" class="form-control" >
    </div>
     <div class="form-group">
      <label>Status Persetujuan Kepala Dinas : </label>
      <select  name="sp_dinas"  class="form-control">
        <option>----Pilih Status Persetujuan----</option>
        <option class="alert alert-success" value="disetujui" <?php if($data['sp_dinas'] == 'disetujui'){ echo 'selected'; } ?>>Disetujui</option>
        <option class="alert alert-info" value="ditangguhkan" <?php if($data['sp_dinas'] == 'ditangguhkan'){ echo 'selected'; } ?>>Ditangguhkan</option>
        <option class="alert alert-warning" value="perubahan" <?php if($data['sp_dinas'] == 'perubahan'){ echo 'selected'; } ?>>Perubahan</option>
        <option class="alert alert-danger" value="tidak disetujui" <?php if($data['sp_dinas'] == 'tidak disetujui'){ echo 'selected'; } ?>>Tidak Disetujui</option>
    </select>
    </div>
    <div class="form-group">
      <label>Alasan :</label>
      <input value="<?php echo $data['sp_alasan1']; ?>" name="sp_alasan1" class="form-control"  type="text" >
    </div>
    <div class="form-group">
      <label>Status Persetujuan BKD : </label>
      <select  name="sp_bkd"  class="form-control">
        <option>----Pilih Status Persetujuan----</option>
        <option class="alert alert-success" value="disetujui" <?php if($data['sp_bkd'] == 'disetujui'){ echo 'selected'; } ?>>Disetujui</option>
        <option class="alert alert-info" value="ditangguhkan" <?php if($data['sp_bkd'] == 'ditangguhkan'){ echo 'selected'; } ?>>Ditangguhkan</option>
        <option class="alert alert-warning" value="perubahan" <?php if($data['sp_bkd'] == 'perubahan'){ echo 'selected'; } ?>>Perubahan</option>
        <option class="alert alert-danger" value="tidak disetujui" <?php if($data['sp_bkd'] == 'tidak disetujui'){ echo 'selected'; } ?>>Tidak Disetujui</option>
    </select>
    </div>
    <div class="form-group">
      <label>Alasan :</label>
      <input  value="<?php echo $data['sp_alasan2']; ?>" name="sp_alasan2" class="form-control"  type="text" >
    </div>
    <?php } ?>
    <br>
    <button style="width:150px;text-align:center;" type="submit" value="simpan" name="updatedata" class="btn btn-success"><i class="fa fa-fw fa-pencil-square-o"></i>&nbsp;Edit</button>
    <br><br>
  </td>
  <td style="width:5%"></td>
  </form>
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
    <!-- Logout Modal-->
  <?php include ('footer_table.php'); ?>
  </div>
</body>

</html>
