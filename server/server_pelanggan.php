<?php
error_reporting(1); // error ditampilkan
include "Database.php";
// buat objek baru dari class Database
$abc = new Database();

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

$postdata = file_get_contents("php://input");

// function untuk menghapus selain huruf dan angka
function filter($data)
{
    $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
    return $data;
    unset($data);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode($postdata);    
    $id_user = $data->id_user;
    $server_id = $data->server_id;    
    $nickname = $data->nickname;    
    $email = $data->email;
    $nohp = $data->nohp;    
    $aksi = $data->aksi;

    if ($aksi == 'tambah') {
        $data2 = array('id_user' => $id_user, 'server_id' => $server_id, 'nickname' => $nickname, 'email' => $email, 'nohp' => $nohp);
        $abc->tambah_data_pelanggan($data2);
    } elseif ($aksi == 'ubah') {
        $data2 = array('id_user' => $id_user, 'server_id' => $server_id, 'nickname' => $nickname, 'email' => $email, 'nohp' => $nohp);
        $abc->ubah_data_pelanggan($data2);
    } elseif ($aksi == 'hapus') {
        $abc->hapus_data_pelanggan($id_user);
    }
    // hapus variable dari memory
    unset($postdata, $data, $data2, $id_user, $server_id, $aksi, $abc);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (($_GET['aksi'] == 'tampil') and (isset($_GET['id_user']))) {
        $id_user = filter($_GET['id_user']);
        $data = $abc->tampil_data_pelanggan($id_user);
        echo json_encode($data);
    } else // menampilkan semua data
    {
        $data = $abc->tampil_semua_data_pelanggan();
        echo json_encode($data);
    }
    unset($postdata, $data, $id_user, $abc);
}