<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman <?= $data['title'] ?></title>

    <link rel="stylesheet" href="<?= BASEURL ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/css/style.css">
</head>

<body>
    <nav style="background-color: rgb(0, 0, 13); padding: 5px 50px;" class="navbar navbar-expand-lg mb-4">
        <div class="container-fluid">
            <a style="color: white;" class="navbar-brand" href="<?= BASEURL ?>">Toko Kita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span style="background-color: white; border: solid black 1px; border-radius: 3px;" class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= BASEURL ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL ?>/about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL ?>/contact">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="pencarian">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>