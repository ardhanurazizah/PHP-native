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
if(isset($_POST['hapusPengirim'])){
    $id_pengirim =$_POST['id_pengirim'];

    $hapusdata = mysqli_query($conn, "delete from pengirim where id_pengirim='$id_pengirim'");

    if($hapusdata){
        header('location:pengirim.php');

    }else{ 
        echo 'gagal';
        header('location:table.php');

    };
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
if(isset($_POST['hapusPenerima'])){
    $id_penerima =$_POST['id_penerima'];

    $hapusdata = mysqli_query($conn, "delete from penerima where id_penerima='$id_penerima'");

    if($hapusdata){
        header('location:penerima.php');

    }else{ 
        echo 'gagal';
        header('location:table.php');

    };
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
if(isset($_POST['hapusKategori'])){
    $id_kategori =$_POST['id_kategori'];

    $hapusdata = mysqli_query($conn, "delete from kategori where id_kategori='$id_kategori'");

    if($hapusdata){
        header('location:kategori.php');

    }else{ 
        echo 'gagal';
        header('location:table.php');

    };
}

//Surat Baru
if(isset($_POST['suratBaru'])){
    $nomor_surat = $_POST['nomor_surat'];
    $keterangan = $_POST['keterangan'];
    $pengirimnya = $_POST['pengirimnya'];
    $penerimanya = $_POST['penerimanya'];
    $kategorinya = $_POST['kategorinya'];
    
    if (isset($_FILES['foto'])) {
        $foto = $_FILES['foto']['name'];
        $target_dir = "images"; 
        $target_file = $target_dir . basename($foto);

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $tambah = $conn->query("INSERT INTO surat (nomor_surat, keterangan, id_pengirim, id_penerima, id_kategori, foto) VALUES ('$nomor_surat','$keterangan', '$pengirimnya', '$penerimanya', '$kategorinya', '$target_file')");
            var_dump($tambah);

            if ($tambah) {
                header("Location: table.php");
                exit;
            } else {
                $error = "Terjadi kesalahan saat menambahkan data. Silakan coba lagi.";
            }
        } else {
            $error = "Gagal meng-upload foto.";
        }
    } else {
        $error = "Foto is required.";
    }


    // $addSurat = mysqli_query($conn, "insert into surat (nomor_surat,keterangan,id_pengirim,id_penerima,id_kategori) values ('$nomor_surat','$keterangan','$pengirimnya','$penerimanya','$kategorinya')");
    // if($addSurat){
    //     header('location:table.php');
    // }else{
    //     header('location:table.php');
    // }
}

//Edit Surat
if(isset($_POST['updateSurat'])){
    $id_surat = $_POST['id_surat'];
    $nomor_surat = $_POST['nomor_surat'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $id_pengirim = $_POST['id_pengirim'];
    $id_penerima = $_POST['id_penerima'];
    $id_kategori = $_POST['id_kategori'];

        if (isset($_FILES['foto'])) {
            $foto = $_FILES['foto']['name'];
            $target_dir = "images"; 
            $target_file = $target_dir . basename($foto);
    
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $tambah = $conn->query("INSERT INTO surat (id_kategori_menu, nama_menu, harga, foto) VALUES ('$kategori','$nama_menu', '$harga', '$target_file')");
    
                if ($tambah) {
                    header("Location: list_menu.php");
                    exit;
                } else {
                    $error = "Terjadi kesalahan saat menambahkan data. Silakan coba lagi.";
                }
            } else {
                $error = "Gagal meng-upload foto.";
            }
        } else {
            $error = "Foto is required.";
        }
    
    // $update = mysqli_query($conn,"update surat set nomor_surat='$nomor_surat', tanggal='$tanggal', keterangan='$keterangan' where id_surat ='$id_surat'");

    // if($update){
    //     header('location:table.php');

    // }else{ 
    //     echo 'gagal';
    //     header('location:table.php');

    // };
}

//Hapus Surat
if(isset($_POST['hapusSurat'])){
    $id_surat =$_POST['id_surat'];

    $hapusdata = mysqli_query($conn, "delete from surat where id_surat='$id_surat'");

    if($hapusdata){
        header('location:table.php');

    }else{ 
        echo 'gagal';
        header('location:table.php');

    };
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
    $deskripsi_lampiran=$_POST['deskripsi_lampiran'];

    $update = mysqli_query($conn,"update lampiran set id_surat='$id_surat', deskripsi_lampiran='$deskripsi_lampiran' where id_lampiran ='$id_lampiran'");

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
if(isset($_POST['hapusLampiran'])){
    $id_lampiran =$_POST['id_lampiran'];

    $hapusdata = mysqli_query($conn, "delete from lampiran where id_lampiran='$id_lampiran'");

    if($hapusdata){
        header('location:lampiran.php');

    }else{ 
        echo 'gagal';
        header('location:table.php');

    };
}

//Edit Arsip
if(isset($_POST['updateArsip'])){
    $id_arsip =$_POST['id_arsip'];
    $id_surat =$_POST['id_surat'];
    $tanggal=$_POST['tanggal'];
    $ket=$_POST['ket'];

    $update = mysqli_query($conn,"update arsip set id_surat='$id_surat', tanggal='$tanggal', ket='$ket' where id_arsip ='$id_arsip'");

    if($update){
        header('location:arsip.php');

    }else{ 
        echo 'gagal';
        header('location:table.php');

    };
}

//Hapus Arsip
if(isset($_POST['hapusArsip'])){
    $id_arsip =$_POST['id_arsip'];

    $hapusdata = mysqli_query($conn, "delete from arsip where id_arsip='$id_arsip'");

    if($hapusdata){
        header('location:arsip.php');

    }else{ 
        echo 'gagal';
        header('location:table.php');

    };
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

    $update = mysqli_query($conn,"update disposisi set id_surat='$id_surat', isi='$isi', tanggal='$tanggal' where id_disposisi ='$id_disposisi'");

    if($update){
        header('location:disposisi.php');

    }else{ 
        echo 'gagal';
        header('location:table.php');

    };
}

//Hapus Disposisi
if(isset($_POST['hapusDisposisi'])){
    $id_disposisi =$_POST['id_disposisi'];

    $hapusdata = mysqli_query($conn, "delete from disposisi where id_disposisi='$id_disposisi'");

    if($hapusdata){
        header('location:disposisi.php');

    }else{ 
        echo 'gagal';
        header('location:table.php');

    };
}


?>