<?php

class Home extends Controller
{
    public function index()
    {
        $data['title'] = 'Home';
        $data['barangs'] = $this->model('Toko_model')->getAllData();

        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    public function getData()
    {
        $data['barangs'] = $this->model('Toko_model')->getAllDataByDiskon();
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getDataCari()
    {
        $keyword = $_POST;
        echo $keyword;
        // $data['barangs'] = $this->model('Toko_model')->getDataCari($keyword);
        // echo json_encode($data);
    }
}
