<?php

	
	$url="http://limitless-earth-2748.herokuapp.com/REST/getInputAdmin/".urlencode($_POST['nama_barang']);
	$response=json_decode(file_get_contents($url),true);
    
	if($response['jumlah']>0)
	{
		$message1 = "Nama Barang telah Dipakai, Silahkan Gunakan Nama Barang Lain.";
		echo "<script type='text/javascript'>alert('$message1');</script>";
	}
	else
	{
		$client = new SoapClient(null, array(
      'location' => "http://limitless-earth-2748.herokuapp.com/server.php",
      'uri'      => "urn://limitless-earth-2748.herokuapp.com"));

   $return = $client->__soapCall("addBarang",array($_POST['nama_barang'],$_POST['kategori_barang'],$_POST['jumlah_barang'],$_POST['harga_barang'],$_POST['deskripsi_barang'],$_POST['nama_barang']));
   $mysql2=json_decode($return,true);
   $response=$mysql2['status'];
		
		if (!$response)
		{
			
		}
		else
		{
			$message = "Barang Berhasil ditambahkan,silahkan upload gambar barang !";
			echo "<script type='text/javascript'>alert('$message');
					window.location='upload.php';
			</script>";
		}
	}

	//header('Location: upload.php');
?>