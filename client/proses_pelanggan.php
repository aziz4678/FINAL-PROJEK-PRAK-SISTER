<?php
include "Client_pelanggan.php";

if ($_POST['aksi']=='tambah')
{
    $data = array("id_user"=>$_POST['id_user'], "server_id"=>$_POST['server_id'], "nickname"=>$_POST['nickname'], "email"=>$_POST['email'], "nohp"=>$_POST['nohp'],"aksi"=>$_POST['aksi']);
    $abcd->tambah_data($data);
    header('location:../menu/menu_pelanggan.php');
}
elseif ($_POST['aksi']=='ubah')
{
    $data = array("id_user"=>$_POST['id_user'], "server_id"=>$_POST['server_id'], "nickname"=>$_POST['nickname'], "email"=>$_POST['email'], "nohp"=>$_POST['nohp'],"aksi"=>$_POST['aksi']);
    $abcd->ubah_data($data);
    header('location:../menu/menu_pelanggan.php');
}
elseif ($_GET['aksi']=='hapus')
{
    $data = array("id_user"=>$_GET['id_user'], "aksi"=>$_GET['aksi']);
    $abcd->hapus_data($data);
    header('location:../menu/menu_pelanggan.php');
}
unset($abcd,$data);
?>