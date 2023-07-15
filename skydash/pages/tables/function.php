<?php
session_start();
//KOneksi database
$conn = mysqli_connect("localhost","root","","surat");

//Pengirim Baru
if(isset($_POST['pengirimBaru'])){
    $nama_pengirim = $_POST['nama_pengirim'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];

    $addPengirim = mysqli_query($conn, "insert into pengirim (nama_pengirim, jabatan, alamat) values ('$nama_pengirim','$jabatan','$alamat')");
    if($addPengirim){
        header('location:pengirim.php');
    }else{
        header('location:pengirim.php');
    }
} 

//Edit Pengirim
if(isset($_POST['updatePengirim'])){
    $id_pengirim =$_POST['id_pengirim'];
    $nama_pengirim =$_POST['nama_pengirim'];
    $jabatan=$_POST['jabatan'];
    $alamat=$_POST['alamat'];

    $update = mysqli_query($conn,"update pengirim set nama_pengirim='$nama_pengirim', jabatan='$jabatan', alamat='$alamat' where id_pengirim ='$id_pengirim'");

    if($update){
        header('location:pengirim.php');

    }else{ 
        echo 'gagal';
        header('location:pengirim.php');

    };
}


//Hapus Pengirim
if (isset($_GET['hapus'])) {
    $id_pengirim = $_GET['hapus'];
    
    // Proses hapus data pelanggan dari database
    $hapus = $conn->query("DELETE FROM pengirim WHERE id_pengirim = $id_pengirim");
    
    if ($hapus) {
        // Data berhasil dihapus, lakukan redirect atau tampilkan pesan sukses
        header("Location: pengirim.php");
        exit;
    } else {
        // Terjadi kesalahan saat menghapus data, tampilkan pesan error
        $error = "Terjadi kesalahan saat menghapus data. Silakan coba lagi.";
    }
  }
  
//Penerima Baru
if(isset($_POST['penerimaBaru'])){
    $nama_penerima = $_POST['nama_penerima'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];

    $addPenerima = mysqli_query($conn, "insert into penerima (nama_penerima, jabatan, alamat) values ('$nama_penerima','$jabatan','$alamat')");
    if($addPenerima){
        header('location:penerima.php');
    }else{
        echo'gagal';
        header('location:penerima.php');
    }
}

//Edit Penerima
if(isset($_POST['updatePenerima'])){
    $id_penerima =$_POST['id_penerima'];
    $nama_penerima =$_POST['nama_penerima'];
    $jabatan=$_POST['jabatan'];
    $alamat=$_POST['alamat'];

    $update = mysqli_query($conn,"update penerima set nama_penerima='$nama_penerima', jabatan='$jabatan', alamat='$alamat' where id_penerima ='$id_penerima'");

    if($update){
        header('location:penerima.php');

    }else{ 
        echo 'gagal';
        header('location:penerima.php');

    };
}

//Hapus Penerima
if (isset($_GET['hapus'])) {
    $id_penerima = $_GET['hapus'];
    
    // Proses hapus data pelanggan dari database
    $hapus = $conn->query("DELETE FROM penerima WHERE id_penerima = $id_penerima");
    
    if ($hapus) {
        // Data berhasil dihapus, lakukan redirect atau tampilkan pesan sukses
        header("Location: penerima.php");
        exit;
    } else {
        // Terjadi kesalahan saat menghapus data, tampilkan pesan error
        $error = "Terjadi kesalahan saat menghapus data. Silakan coba lagi.";
    }
  }


//Kategori Baru
if(isset($_POST['kategoriBaru'])){
    $nama_kategori = $_POST['nama_kategori'];

    $addKategori = mysqli_query($conn, "insert into kategori (nama_kategori) values ('$nama_kategori')");
    if($addKategori){
        header('location:kategori.php');
    }else{
        echo'gagal';
        header('location:table.php');
    }
}

//Edit Kategori
if(isset($_POST['updateKategori'])){
    $id_kategori =$_POST['id_kategori'];
    $nama_kategori =$_POST['nama_kategori'];

    $update = mysqli_query($conn,"update kategori set nama_kategori='$nama_kategori' where id_kategori ='$id_kategori'");

    if($update){
        header('location:kategori.php');

    }else{ 
        echo 'gagal';
        header('location:table.php');

    };
}

//Hapus Kategori
if (isset($_GET['hapus'])) {
    $id_kategori = $_GET['hapus'];
    
    $hapus = $conn->query("DELETE FROM kategori WHERE id_kategori = $id_kategori");
    
    if ($hapus) {
        // Data berhasil dihapus, lakukan redirect atau tampilkan pesan sukses
        header("Location: kategori.php");
        exit;
    } else {
        // Terjadi kesalahan saat menghapus data, tampilkan pesan error
        $error = "Terjadi kesalahan saat menghapus data. Silakan coba lagi.";
    }
  }

//Surat Baru
if(isset($_POST['suratBaru'])){
    $nomor_surat = $_POST['nomor_surat'];
    $keterangan = $_POST['keterangan'];
    $pengirimnya = $_POST['pengirimnya'];
    $penerimanya = $_POST['penerimanya'];
    $kategorinya = $_POST['kategorinya'];

    $tanggals = date('Y-m-d H:i:s');

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['foto']['name'];
        $target_dir = "images/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir);
        }
        $target_file = $target_dir . basename($foto);

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
     
            $tambah = $conn->query("INSERT INTO surat (nomor_surat, keterangan, id_pengirim, id_penerima, id_kategori, foto, tanggal) VALUES ('$nomor_surat', '$keterangan', '$pengirimnya', '$penerimanya', '$kategorinya', '$target_file', '$tanggals')");

            if ($tambah) {
               
                header("Location: table.php");
                exit;
            } else {
                echo "Terjadi kesalahan saat menambahkan data. Silakan coba lagi.";
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Gagal meng-upload foto.";
        }
    } else {

        $tambah = $conn->query("INSERT INTO surat (nomor_surat, keterangan, id_pengirim, id_penerima, id_kategori, tanggal) VALUES ('$nomor_surat', '$keterangan', '$pengirimnya', '$penerimanya', '$kategorinya', '$tanggals')");

        if ($tambah) {
        
            header("Location: table.php");
            exit;
        } else {
            echo "Terjadi kesalahan saat menambahkan data. Silakan coba lagi.";
            echo "Error: " . $conn->error;
        }
    }
}

//Edit Surat
if(isset($_POST['editSurat'])){
    $id_surat = $_POST['id_surat'];
    $nomor_surat = $_POST['nomor_surat'];
    $keterangan = $_POST['keterangan'];
    $pengirimnya = $_POST['pengirimnya'];
    $penerimanya = $_POST['penerimanya'];
    $kategorinya = $_POST['kategorinya'];

    $tanggals = date('Y-m-d H:i:s');

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['foto']['name'];
        $target_dir = "images/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir);
        }
        $target_file = $target_dir . basename($foto);

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $edit = $conn->query("UPDATE surat SET nomor_surat='$nomor_surat', keterangan='$keterangan', id_pengirim='$pengirimnya', id_penerima='$penerimanya', id_kategori='$kategorinya', foto='$target_file', tanggal='$tanggals' WHERE id_surat='$id_surat'");

            if ($edit) {
                header("Location: table.php");
                exit;
            } else {
                echo "Terjadi kesalahan saat mengedit data. Silakan coba lagi.";
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Gagal meng-upload foto.";
        }
    } else {
        $edit = $conn->query("UPDATE surat SET nomor_surat='$nomor_surat', keterangan='$keterangan', id_pengirim='$pengirimnya', id_penerima='$penerimanya', id_kategori='$kategorinya', tanggal='$tanggals' WHERE id_surat='$id_surat'");

        if ($edit) {
            header("Location: table.php");
            exit;
        } else {
            echo "Terjadi kesalahan saat mengedit data. Silakan coba lagi.";
            echo "Error: " . $conn->error;
        }
    }
}

//Hapus Surat
if (isset($_GET['hapus'])) {
    $id_surat = $_GET['hapus'];
    
    // Proses hapus data pelanggan dari database
    $hapus = $conn->query("DELETE FROM surat WHERE id_surat = $id_surat");
    
    if ($hapus) {
        // Data berhasil dihapus, lakukan redirect atau tampilkan pesan sukses
        header("Location: table.php");
        exit;
    } else {
        // Terjadi kesalahan saat menghapus data, tampilkan pesan error
        $error = "Terjadi kesalahan saat menghapus data. Silakan coba lagi.";
    }
  }

//Detail Surat
if (isset($_GET['id_surat'])) {
    $id_surat = $_GET['id_surat'];
    $surat = getSuratDetails($id_surat);
    if ($surat) {
        // Tampilkan detail surat
        echo "Nomor Surat: " . $surat['nomor_surat'] . "<br>";
        echo "Tanggal: " . $surat['tanggal'] . "<br>";
        echo "Keterangan: " . $surat['keterangan'] . "<br>";
        echo "ID Pengirim: " . $surat['id_pengirim'] . "<br>";
        echo "ID Penerima: " . $surat['id_penerima'] . "<br>";
        echo "ID Kategori: " . $surat['id_kategori'] . "<br>";
        echo '<img src="' . $surat['gambar'] . '" alt="Gambar Surat">';
    } else {
        echo "Surat tidak ditemukan.";
    }
} else {
    echo "ID Surat tidak diberikan.";
}

//Lampiran Baru
if(isset($_POST['lampiranBaru'])){
    
    $suratnya = $_POST['suratnya'];
    $deskripsi_lampiran = $_POST['deskripsi_lampiran'];
    
    $addLampiran = mysqli_query($conn, "insert into lampiran (id_surat,deskripsi_lampiran) values ('$suratnya','$deskripsi_lampiran')");
    if($addLampiran){
        header('location:lampiran.php');
    }else{
        echo'gagal';
        header('location:table.php');
    }
}

//Edit Lampiran
if(isset($_POST['updateLampiran'])){
    $id_lampiran =$_POST['id_lampiran'];
    $id_surat =$_POST['id_surat'];
    $deskripsi_lampiran =$_POST['deskripsi_lampiran'];

    $update = mysqli_query($conn,"update lampiran set deskripsi_lampiran='$deskripsi_lampiran' where id_lampiran ='$id_lampiran'");

    if($update){
        header('location:lampiran.php');

    }else{ 
        echo 'gagal';
        header('location:table.php');

    };
}

//Arsip Baru
if(isset($_POST['arsipBaru'])){
    
    $suratnya = $_POST['suratnya'];
    $ket = $_POST['ket'];
    
    $addArsip = mysqli_query($conn, "insert into arsip (id_surat,ket) values ('$suratnya','$ket')");
    if($addArsip){
        header('location:arsip.php');
    }else{
        echo'gagal';
        header('location:arsip.php');
    }
}

//Hapus Lampiran
if (isset($_GET['hapus'])) {
    $id_lampiran = $_GET['hapus'];
    
    // Proses hapus data pelanggan dari database
    $hapus = $conn->query("DELETE FROM lampiran WHERE id_lampiran = $id_lampiran");
    
    if ($hapus) {
        // Data berhasil dihapus, lakukan redirect atau tampilkan pesan sukses
        header("Location: lampiran.php");
        exit;
    } else {
        // Terjadi kesalahan saat menghapus data, tampilkan pesan error
        $error = "Terjadi kesalahan saat menghapus data. Silakan coba lagi.";
    }
  }

//Edit Arsip
if(isset($_POST['updateArsip'])){
    $id_arsip =$_POST['id_arsip'];
    $id_surat =$_POST['id_surat'];
    $tanggal=$_POST['tanggal'];
    $ket=$_POST['ket'];

    $update = mysqli_query($conn,"update arsip set tanggal='$tanggal', ket='$ket' where id_arsip ='$id_arsip'");

    if($update){
        header('location:arsip.php');

    }else{ 
        echo 'gagal';
        header('location:table.php');

    };
}

//Hapus Arsip
if (isset($_GET['hapus'])) {
    $id_arsip = $_GET['hapus'];
    
    // Proses hapus data pelanggan dari database
    $hapus = $conn->query("DELETE FROM arsip WHERE id_arsip = $id_arsip");
    
    if ($hapus) {
        // Data berhasil dihapus, lakukan redirect atau tampilkan pesan sukses
        header("Location: arsip.php");
        exit;
    } else {
        // Terjadi kesalahan saat menghapus data, tampilkan pesan error
        $error = "Terjadi kesalahan saat menghapus data. Silakan coba lagi.";
    }
  }

//Disposisi Baru
if(isset($_POST['disposisiBaru'])){
    
    $suratnya = $_POST['suratnya'];
    $isi = $_POST['isi'];
    
    $addDisposisi = mysqli_query($conn, "insert into disposisi (id_surat,isi) values ('$suratnya','$isi')");
    if($addDisposisi){
        header('location:disposisi.php');
    }else{
        echo'gagal';
        header('location:table.php');
    }
}

//Edit Disposisi
if(isset($_POST['updateDisposisi'])){
    $id_disposisi =$_POST['id_disposisi'];
    $id_surat =$_POST['id_surat'];
    $isi =$_POST['isi'];
    $tanggal =$_POST['tanggal'];

    $update = mysqli_query($conn,"update disposisi set isi='$isi', tanggal='$tanggal' where id_disposisi ='$id_disposisi'");

    if($update){
        header('location:disposisi.php');

    }else{ 
        echo 'gagal';
        header('location:table.php');

    };
}

//Hapus Disposisi
if (isset($_GET['hapus'])) {
    $id_disposisi = $_GET['hapus'];
    
    // Proses hapus data pelanggan dari database
    $hapus = $conn->query("DELETE FROM disposisi WHERE id_disposisi = $id_disposisi");
    
    if ($hapus) {
        // Data berhasil dihapus, lakukan redirect atau tampilkan pesan sukses
        header("Location: disposisi.php");
        exit;
    } else {
        // Terjadi kesalahan saat menghapus data, tampilkan pesan error
        $error = "Terjadi kesalahan saat menghapus data. Silakan coba lagi.";
    }
  }

?>