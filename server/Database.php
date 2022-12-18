<?php
class Database
{
    private $host = "192.168.56.136";
    private $dbname = "store";
    private $user = "aziz";
    private $password = "1";
    private $port = "3306";
    private $conn;

    // function yang pertama kali di-load saat class dipanggil
    public function __construct()
    {
        // koneksi database
        try {
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8", $this->user, $this->password);
        } catch (PDOException $e) {
            echo "Koneksi gagal";
        }
    }

    public function tampil_semua_data_pelanggan()
    {
        $query = $this->conn->prepare("select id_user,server_id,nickname,email,nohp from pelanggan order by id_user  ");
        $query->execute();
        // mengambil banyak data dengan fetchAll
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        // mengembalikan data
        return $data;
        // hapus variable memory
        $query->closeCursor();
        unset($data);
    }

    public function tampil_semua_data_transaksi()
    {
        $query2 = $this->conn->prepare("select id_transaksi, id_user, nominal, harga, metode from transaksi order by id_transaksi");
        $query2->execute();
        // mengambil banyak data dengan fetchAll
        $data2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        // mengembalikan data
        return $data2;
        // hapus variable memory
        $query2->closeCursor();
        unset($data2);
    }

    public function tampil_data_pelanggan($id_user)
    {
        $query = $this->conn->prepare("select id_user, server_id, nickname, email, nohp  from pelanggan where id_user=?");
        $query->execute(array($id_user));
        // mengambil satu data dengan fetch
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($id_user, $data);
    }
    public function tampil_data_transaksi($id_transaksi)
    {
        $query2 = $this->conn->prepare("select id_transaksi, id_user, nominal, harga, metode from transaksi where id_transaksi=?");
        $query2->execute(array($id_transaksi));
        // mengambil satu data dengan fetch
        $data2 = $query2->fetch(PDO::FETCH_ASSOC);
        return $data2;
        $query2->closeCursor();
        unset($id_transaksi, $data2);
    }

    public function tambah_data_pelanggan($data)
    {
        $query = $this->conn->prepare("insert ignore into pelanggan (id_user, server_id, nickname, email, nohp) values (?,?,?,?,?)");
        $query->execute(array($data['id_user'], $data['server_id'], $data['nickname'], $data['email'], $data['nohp']));
        $query->closeCursor();
        unset($data);
    }
    public function tambah_data_transaksi($data2)
    {
        $query2 = $this->conn->prepare("insert ignore into transaksi (id_transaksi, id_user, nominal, harga, metode) values (?,?,?,?,?)");
        $query2->execute(array($data2['id_transaksi'], $data2['id_user'], $data2['nominal'], $data2['harga'], $data2['metode']));
        $query2->closeCursor();
        unset($data2);
    }

    public function ubah_data_pelanggan($data)
    {
        $query = $this->conn->prepare("update pelanggan set server_id=?, nickname=?, email=?, nohp=? where id_user=?");
        $query->execute(array($data['server_id'], $data['nickname'], $data['email'], $data['nohp'], $data['id_user']));
        $query->closeCursor();
        unset($data);
    }
    public function ubah_data_transaksi($data2)
    {
        $query2 = $this->conn->prepare("update transaksi set id_user=?, nominal=?, harga=?, metode=? where id_transaksi=?");
        $query2->execute(array($data2['id_user'], $data2['nominal'], $data2['harga'], $data2['metode'], $data2['id_transaksi']));
        $query2->closeCursor();
        unset($data2);
    }

    public function hapus_data_pelanggan($id_user)
    {
        $query = $this->conn->prepare("delete from pelanggan where id_user=?");
        $query->execute(array($id_user));
        $query->closeCursor();
        unset($id_user);
    }
    public function hapus_data_transaksi($id_transaksi)
    {
        $query2 = $this->conn->prepare("delete from transaksi where id_transaksi=?");
        $query2->execute(array($id_transaksi));
        $query2->closeCursor();
        unset($id_transaksi);
    }
}
