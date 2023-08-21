<?php

class Toko_model {
    private $table = 'barang';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllData()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getAllDataByDiskon()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY DISKON DESC');
        return $this->db->resultSet();
    }

    public function getDataCari($keyword)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nama LIKE %'. $keyword .'%');
        return $this->db->resultSet();
    }

    public function getData($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataBarang($data)
    {
        $query = "INSERT INTO barang VALUES ('', :nama, :harga, :stok, :gambar, :ukuran, :warna, :diskon)";

        $this->db->query($query);

        $this->db->bind('nama', $data['nama']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('gambar', $data['gambar']);
        $this->db->bind('ukuran', $data['ukuran']);
        $this->db->bind('warna', $data['warna']);
        $this->db->bind('diskon', $data['diskon']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahDataBarang($data)
    {
        

        $query = "UPDATE barang SET nama=:nama, harga=:harga, stok=:stok, gambar=:gambar, ukuran=:ukuran, warna=:warna, diskon=:diskon WHERE id=:id";

        $this->db->query($query);

        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('gambar', $data['gambar']);
        $this->db->bind('ukuran', $data['ukuran']);
        $this->db->bind('warna', $data['warna']);
        $this->db->bind('diskon', $data['diskon']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataBarang($id)
    {
        $query = "DELETE FROM barang WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}