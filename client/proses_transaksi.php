<?php
include "Client_transaksi.php";

if ($_POST['aksi'] == 'tambah') {
    $data = array("id_transaksi" => $_POST['id_transaksi'], "id_user" => $_POST['id_user'], "nominal" => $_POST['nominal'], "harga" => $_POST['harga'], "metode" => $_POST['metode'], "aksi" => $_POST['aksi']);
    $abc->tambah_data($data);
    header('location:../menu/menu_transaksi.php');
} elseif ($_POST['aksi'] == 'ubah') {
    $data = array("id_transaksi" => $_POST['id_transaksi'], "id_user" => $_POST['id_user'], "nominal" => $_POST['nominal'], "harga" => $_POST['harga'], "metode" => $_POST['metode'],  "aksi" => $_POST['aksi']);
    $abc->ubah_data($data);
    header('location:../menu/menu_transaksi.php');
} elseif ($_GET['aksi'] == 'hapus') {
    $data = array("id_transaksi" => $_GET['id_transaksi'], "aksi" => $_GET['aksi']);
    $abc->hapus_data($data);
    header('location:../menu/menu_transaksi.php');
}
unset($abc, $data);
