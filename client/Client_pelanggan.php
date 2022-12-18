<?php
error_reporting(0); // error ditampilkan
class ClientPelanggan
{
    private $url;

    // function yang pertama kali di-load saat class dipanggil
    public function __construct($url)
    {
        $this->url = $url;
        unset($url);
    }

    // function untuk menghapus selain huruf dan angka
    public function filter($data)
    {
        $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
        return $data;
        unset($data);
    }

    public function tampil_semua_data_pelanggan()
    {
        $client = curl_init($this->url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        // mengembalikan data
        return $data;
        // menghapus variabel dari memory
        unset($data, $client, $response);
    }

    public function tampil_data($id_user)
    {
        $id_user = $this->filter($id_user);
        $client = curl_init($this->url . "?aksi=tampil&id_user=" . $id_user);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;
        unset($id_user, $client, $response, $data);
    }

    public function tambah_data($data)
    {
        $data = '{  "id_user":"' . $data['id_user'] . '",
                    "server_id":"' . $data['server_id'] . '",
                    "nickname":"' . $data['nickname'] . '",
                    "email":"' . $data['email'] . '",
                    "nohp":"' . $data['nohp'] . '",
                    "aksi":"' . $data['aksi'] . '"
                }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    public function ubah_data($data)
    {
        $data = '{  "id_user":"' . $data['id_user'] . '",
                    "server_id":"' . $data['server_id'] . '",
                    "nickname":"' . $data['nickname'] . '",
                    "email":"' . $data['email'] . '",
                    "nohp":"' . $data['nohp'] . '",
                    "aksi":"' . $data['aksi'] . '"
                }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    public function hapus_data($data)
    {
        $id_user = $this->filter($data['id_user']);
        $data = '{  "id_user":"' . $id_user . '",
                    "aksi":"' . $data['aksi'] . '"
                }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_user, $data, $c, $response);
    }

    // function yang terakhir kali di-load saat class dipanggil
    public function __destruct()
    {
        // hapus variable dari memory
        unset($this->url);
    }
}


//nb ini ubah localhost pake ip sesuai dengan ip servernya
$url = 'http://localhost/diamondstore/server/server_pelanggan.php';
// buat objek baru dari class Client
$abcd = new ClientPelanggan($url);