<form method="post" enctype="multipart/form-data">
<input type="file" name="nama_file">
<input type="submit" name="submit" value="Proses">
</form>
<?php
if(!empty($_POST['submit'])){
	$ambilnama = explode(".",$_FILES['nama_file']['name']);
	//CEK DAHULU EKSTENSI YANG DIPERBOLEHKAN ISIKAN UNTUK FILE2 YANG DIPERBOLEHKAN DIBAWAH INI
		$allowed = array(
							"jpg",
							"gif",
							"png",
							"pjpg",
							"x-png",
							"jpeg"
						);
						
		$cekext = end($ambilnama);
		if(in_array($cekext, $allowed)){
			$ext = $cekext;
		}else{
			die("File dengan ekstensi $cekext tidak diizinkan... :(");
		}
	
	$nama = $_FILES['nama_file']['name'];
	//CEK JIKA FILE SUDAH ADA MAKA KITA BERI NOMOR PADA NAMA FILE AGAR TIDAK TERJADI DUPLIKASI
	$cek = file_exists("" . $_FILES["nama_file"]["name"]);
	$index = 1;
	while($cek){
		$ambilnamanya = $ambilnama[0];
		$nama = $ambilnamanya."_".$index.".jpg"; 
		$ceklagi = file_exists("" . $nama);
		if(!$ceklagi){ 
			$cek = false;
		}
		$index++;
	} 
	//echo json_encode($_FILES);
	 move_uploaded_file($_FILES["nama_file"]["tmp_name"],"" .$nama);
	//echo $_SERVER['DOCUMENT_ROOT'];
	echo "file Berhasil diupload... dengan nama : {$nama}";
	
	/** 
	NOTE UNTUK MEMASUKAN DATABASE MAKA GUNAKAN VARIABLE $nama 
	Author : Rendy Harimayco
	*/
}
?>
