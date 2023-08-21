<?php

class Contact extends Controller{
    public function index()
    {
        $this->view('templates/header');
        $this->view('contact/index');
        $this->view('templates/footer');
    }
}