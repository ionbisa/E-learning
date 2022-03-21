<?php
include "config.php";
$kr = mysqli_fetch_array(mysqli_query($mysqli, 'SELECT id,nama,alamat,kode,(SELECT SHA2(concat(nama,";",alamat),512)) as kode2 FROM identitas WHERE id=1'));
$data = array();
$data['kode'] = $kr['kode'];
$data['kode2'] = $kr['kode2'];
$data['home'] = $url_website . '/failed.php';
echo json_encode($data);
?>