<?php

class Dashboard extends Controller
{
    public function index()
    {
        // session_start();

        $data['title'] = 'Dashboard';

        // if (!isset($_SESSION['password'])) {
        //     $this->view('templates/header', $data);
        //     $this->view('login/index');
        //     $this->view('templates/footer');
        //     exit;
        // }

        // session_destroy();

        $this->view('templates/header', $data);
        $this->view('dashboard/index');
        $this->view('templates/footer');
    }

    public function authentication()
    {
        // session_start();


        //     $email = $_POST['email'];
        //     $password = $_POST['password'];

        //     if ($email === 'admin@gmail.com' && $password === 'admin') {
        //         $_SESSION['password'] = $password;
        //         $data['logedin'] = isset($_SESSION['password']);

        //         $this->view('templates/header', $data);
        //         $this->view('dashboard/index');
        //         $this->view('templates/footer');
        //         exit;
        //     } else {
        //         $error = 'Invalid email or password!';
        //     }

        if ($_POST['email'] === 'admin@gmail.com' && $_POST['password'] === 'admin') {
            header('Location:' . BASEURL . '/dashboard');
        } else {
            header('Location:' . BASEURL . '/login');
        }

        // session_destroy();
    }


    public function getData()
    {
        $data['barangs'] = $this->model('Toko_model')->getAllData();
        // header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function addBarang()
    {
        $gambar = "img/desain-baju-polos-png-17.jpg";
        $_POST['gambar'] = $gambar;
        // var_dump($_POST);

        if ($this->model('Toko_model')->tambahDataBarang($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location:' . BASEURL . '/dashboard');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location:' . BASEURL . '/dashboard');
            exit;
        }
    }

    public function getDataUbah()
    {
        echo json_encode($this->model('Toko_model')->getData($_POST['id']));
    }

    public function ubah()
    {
        // var_dump($_FILES);
        // var_dump($_POST);
        // cek jika $_FILES tidak berisi string apapun maka tambahkan $_POST['gambar] untuk mengisi value kolom gambar pada database
        if ($_FILES['gambar']['name'] == "") {

            $_POST['gambar'] = $_POST['alamatGambar'];

            if ($this->model('Toko_model')->ubahDataBarang($_POST) > 0) {
                Flasher::setFlash('berhasil', 'diubah', 'success');
                header('Location:' . BASEURL . '/dashboard');
                exit;
                header('Location:' . BASEURL . '/dashboard');
            } else {
                Flasher::setFlash('gagal', 'diubah', 'danger');
                header('Location:' . BASEURL . '/dashboard');
                exit;
            }
        } else {
            $namaFile = $_FILES['gambar']['name'];
            $namaSementara = $_FILES['gambar']['tmp_name'];

            // tentukan lokasi file akan dipindahkan
            $dirUpload = "img/";
            move_uploaded_file($namaSementara, $dirUpload . $namaFile);
            $lokasiUpload = $dirUpload . $namaFile;

            $_POST['gambar'] = $lokasiUpload;

            if ($this->model('Toko_model')->ubahDataBarang($_POST) > 0) {
                Flasher::setFlash('berhasil', 'diubah', 'success');
                header('Location:' . BASEURL . '/dashboard');
                exit;
            } else {
                Flasher::setFlash('gagal', 'diubah', 'danger');
                header('Location:' . BASEURL . '/dashboard');
                exit;
            };
        }

        // var_dump($_POST);
        // $namaFile = $_FILES['gambar']['name'];
        // $namaSementara = $_FILES['gambar']['tmp_name'];

        // // tentukan lokasi file akan dipindahkan
        // $dirUpload = "img/";
        // move_uploaded_file($namaSementara, $dirUpload . $namaFile);
        // $lokasiUpload = $dirUpload . $namaFile;

        // $_POST['gambar'] = $lokasiUpload;
        // var_dump($_POST);
        // $this->model('Toko_model')->ubahDataBarang($_POST);

        // header('Location:' . BASEURL . '/dashboard');
    }

    public function pemberitahuanUbah()
    {
    }

    public function hapus()
    {
        $id = $_POST['id'];
        // var_dump($id);
        // if ($this->model('Toko_model')->hapusDataBarang($id) > 0) {
        //     header('Location:' . BASEURL . '/dashboard');
        //     exit;
        // }
        if ($this->model('Toko_model')->hapusDataBarang($id) > 0) {
            $data['barangs'] = $this->model('Toko_model')->getAllData();
            // header('Content-Type: application/json');
            echo json_encode($data);
        }else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location:' . BASEURL . '/dashboard');
            exit;
        }
    }
}
