<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Evaluasi Pembelajaran FK UMS</title>
    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css"/>
    <!-- link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" / -->

    <style>
      .bg-4 { 
        background-color: #2f2f2f;
        color: #fff;
      }
      
      </style>

</head>

<body>
         <nav class="navbar navbar-inverse" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#" style="color: white;">Sistem On-Line Survey - Fakultas Kedokteran UMS</a>
                </div>
                
            </div>
        </nav>
        <!-- END HEADER -->


<?php
session_start();
// include Database connection file
 include "../system/koneksi.php";

function tanganiError () {
  echo "<div style='padding: 2rem; background: rgba(200, 0, 0, 0.5); color: white'>";
  echo    "<b>Terjadi Error</b>";
  echo "</div>";
}

set_error_handler('tanganiError');

$nim=$_SESSION['nim'];
$nama=$_SESSION['nama'];
$kode_topic=$_SESSION['kode_topic'] ;
$nama_topic=$_SESSION['nama_topic'] ;
//$kode_pengisi=$_SESSION['kode_pengisi'] ;
//$topic_pengisi=$_SESSION['topic_pengisi'] ;
$jabatan=$_SESSION['jabatan'];
$sebagai_pengisi=$_SESSION['sebagai_pengisi'];
$masukan=$_POST['masukan'];

$total=$_SESSION['total'];
for ($x = 1; $x <= $total; $x+1) {

  $nama_radio=$_SESSION['radio'.$x];

  if(($_POST[$_SESSION['radio'.$x]]=="")&&($x<=$total)){
   ///echo "maaf ada pililhan yang belum terisi.. silahkan kembali ke halaman sebelumnya";
   //button kembali
   echo "<div class='alert alert-warning' role='alert' id='warning'><h1> <p align='center'>Maaf ada pililhan yang belum terisi.. silahkan kembali ke halaman sebelumnya <br><br>
      <button class='btn btn-primary btn-sm btn-block' onclick='history.back()'>Kembali ke halaman isi survey</button></div>";

   return false;
  }else{
  $nilai_radio=$_POST[$_SESSION['radio'.$x]];
   
  //input ke database
  $input= "INSERT INTO data (id_topic_pengisi_pertanyaan,kode_topic,nama_topic,nim,nama_pengisi,jabatan_pengisi,sebagai_pengisi,angka_survey,tahun_input)

  VALUES('$nama_radio','$kode_topic','$nama_topic','$nim','$nama','$jabatan','$sebagai_pengisi','$nilai_radio',now())";
  mysqli_query($koneksi,$input);
   }
   //while berikutnya
  $x++;
}

//simpan kesan dan pesan
$input_masukan= "INSERT INTO data_kesan_pesan (kode_topic,masukan,tahun_input)

  VALUES('$kode_topic','$masukan',now())";
  mysqli_query($koneksi,$input_masukan);

//$id_topic_pengisi=$_SESSION['id_topic_pengisi'];
//$tanya8=$_SESSION['tanya8'];

   // $inpu_satu = "INSERT INTO data (id_topic_pengisi_pertanyaan,angka_survey)
      //          VALUES('$id_topic_pengisi','$tanya1')";
    //mysqli_query($koneksi,$inpu_satu);

    //echo "<b2>Data sukses disimpan</b2>";
            


?>

<!-- Success message -->
<div class="alert alert-success" role="alert" id="success_message"><h1> <p align="center">Terimakasih sudah mengisi lembar <br> <?php echo "$nama_topic"; ?></p></h1><br><br>
<a href="../index.php"><button class="btn btn-primary btn-sm btn-block" >Klik disini untuk menuju mengisi Survey lagi</button></a>

</div>

<?php
session_unset();
session_destroy();
?>

<!--cfooter class="container-fluid bg-4 text-center">
  <p><br>Fakultas Kedokteran UMS <a href="https://kedokteran.ums.ac.id">kedokteran.ums.ac.id<br><br></a></p>
</footerc-->
</body>
</html>
