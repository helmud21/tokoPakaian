$(function () {

    // Make an AJAX request when the page is loaded
    // $.ajax({
    //     url: 'http://localhost/tokopakaian/public/home/getData',
    //     method: 'GET',
    //     dataType: 'json',
    //     success: function (response) {
    //         console.log(response);
    //         addHomeCard(response);
    //     },
    //     error: function (jqXHR, textStatus, errorThrown) {
    //         console.error('Error fetching data:', errorThrown);
    //     }
    // });

    // $.ajax({
    //     url: 'http://localhost/tokopakaian/public/dashboard/getData',
    //     method: 'GET',
    //     dataType: 'json',
    //     success: function (response) {
    //         addDashboardTable(response);
    //     },
    //     error: function (jqXHR, textStatus, errorThrown) {
    //         console.error('Error fetching data:', errorThrown);
    //     }
    // });
    var batas = 0;
    tampilkanDataHome();
    tampilkanDataDashboard();

    $('#tombolTambah').on('click', function () {
        $('#exampleModalLabel').html('Tambah Data Barang');
        $('.modal-footer button[type=submit').html('Tambah Barang');

        $('#tampilkanGambar').hide();
        $('#tampilkanGambar').attr('src', '');
        $('#nama').val('');
        $('#harga').val('');
        $('#stok').val('');
        $('#gambar').val('');
        $('#ukuran').val('');
        $('#warna').val('');
        $('#diskon').val('');
    });


    // $('#pencarian').on('keyup', function(){
    //     var keyword = $(this).val();
    //     console.log(keyword);
    //     $.ajax({
    //         url: 'http://localhost/tokopakaian/public/home/getDataCari',
    //         method: 'POST',
    //         dataType: 'json',
    //         data: {keyword: keyword},
    //         success: function(response){
    //             console.log('ini adalah respons : ' + response);
    //             $('#tableDashboard').empty();
    //             addDashboardTable(response);
    //         }
    //     });
    // });

    $('#pencarian').on('keyup', function(){
        var keyword = $(this).val();
        console.log(keyword);
        if(keyword === ''){
            $('#tableDashboard').empty();
            tampilkanDataDashboard();
        } else {
            $.ajax({
                url: 'http://localhost/tokopakaian/public/home/getDataCari',
                method: 'POST',
                dataType: 'json',
                data: {keyword: keyword},
                success: function(response){
                    console.log('ini adalah respons : ' + response);
                    $('#tableDashboard').empty();
                    addDashboardTable(response);
                }
            });
        }
    });

    $('#no-kanan').on('click', function(){
        console.log('ok');
    });

    $('#no-tengah').on('click', function(){
        console.log('ok');
        batas = 10;
        $.ajax({
            url: 'http://localhost/tokopakaian/public/dashboard/getDataPagination',
            method: 'post',
            dataType: 'json',
            data: {batas: batas},
            success: function(response){
                console.log(response);
                $('#tableDashboard').empty();
                addDashboardTable(response);
            }
        });
    });

    // $('#dataTable').DataTable({
    //     ajax: 'http://localhost/tokopakaian/public/dashboard/getData',
    //     columns: [
    //         {data: 'nama'},
    //         {data: 'harga'},
    //         {data: 'stok'},
    //         {data: 'gambar'},
    //         {data: 'ukuran'},
    //         {data: 'warna'},
    //         {data: 'diskon'}
    //     ]
    // });

});

function tampilkanDataHome() {
    $.ajax({
        url: 'http://localhost/tokopakaian/public/home/getData',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log(response);
            addHomeCard(response);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error fetching data:', errorThrown);
        }
    });
}

function tampilkanDataDashboard() {
    $.ajax({
        url: 'http://localhost/tokopakaian/public/dashboard/getData',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            addDashboardTable(response);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error fetching data:', errorThrown);
        }
    });
}


function addHomeCard(response) {
    for (let item of response.barangs) {
        const hargaDiskon = hitungHargaDiskon(item.diskon, item.harga);
        // console.log(hargaDiskon);
        if (item.diskon > 0) {
            const cardHtml = `
        <div class="card m-3 p-1" style="width: 15rem;">
        <img style="height:250px; width:100%;" src="${item.gambar}" class="card-img-top" alt="...">
        <div style="position=relative; display: inline-block;" class="imgcontainer">
            <div style="position: absolute;
            top: 1%;
            left: 70%;
            z-index: 2;
            height: 70px;
            width: 70px;
            border-radius: 50%;
            background-color: #25262b;
            color: red;" class="tampilkan-diskon d-flex justify-content-center align-items-center">
                <h2>${item.diskon}%</h2>
            </div>
            <div style="position: absolute;
            top: -5%;
            left: 62%;
            transform: translate(80%, 50%);
            z-index: 2;
            height: 70px;
            font-weight: bolder;
            width: 150px;
            border-radius: 50%;
            transform: rotate(35deg);
            color: red;" class="tampilkan-diskon text-center">
                <p style="font-size: 28px">DISKON</p>
            </div>
        </div>
        <div class="card-body text-center">
            <h5 class="card-title">${item.nama}</h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">${item.ukuran}</li>
            <li class="list-group-item">${item.warna}</li>
            <li class="list-group-item">${hargaDiskon}</li>
        </ul>
        <div class="card-body">
            <a href="#" class="card-link float-end text-decoration-none link-dark">Detail</a>
        </div>
    </div>
        `;
            $('#loadDataHome').append(cardHtml);
        } else {
            const cardHtml = `
        <div class="card m-3 p-1" style="width: 15rem;">
        <img style="height:250px; width:100%;" src="${item.gambar}" class="card-img-top" alt="...">
        <div class="card-body text-center">
            <h5 class="card-title">${item.nama}</h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">${item.ukuran}</li>
            <li class="list-group-item">${item.warna}</li>
            <li class="list-group-item">${hargaDiskon}</li>
        </ul>
        <div class="card-body">
            <a href="#" class="card-link float-end text-decoration-none link-dark">Detail</a>
        </div>
    </div>
        `;
            $('#loadDataHome').append(cardHtml);
        }
    }
}

function hitungHargaDiskon(diskon, harga) {
    if (diskon > 0) {
        const hargaDiskon = (diskon / 100) * harga;
        return (harga - hargaDiskon);
    } else {
        return harga;
    }
}

function addDashboardTable(response) {
    let tab = `
    <thead>
        <tr class="table-dark text-center">
            <th scope="col">No</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Harga Barang</th>
            <th scope="col">Stok</th>
            <th scope="col">Gambar</th>
            <th scope="col">Ukuran</th>
            <th scope="col">Warna</th>
            <th scope="col">Diskon</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
    `;

    let nomor = 1;
    for (let item of response.barangs) {
        tab += `
        <tbody>
        <tr>
            <th class="text-center" scope="row">`+ nomor++ + `</th>
            <td>${item.nama}</td>
            <td class="text-center">${item.harga}</td>
            <td class="text-center">${item.stok}</td>
            <td class="text-center">${item.gambar}</td>
            <td class="text-center">${item.ukuran}</td>
            <td class="text-center">${item.warna}</td>
            <td class="text-center">${item.diskon}</td>
            <td class="text-center"><button class="fw-medium btn btn-outline-danger btn-sm float-right mr-2" data-id="${item.id}" onclick="hapusData(${item.id})">Hapus</button>
            <button class="fw-medium btn btn-outline-success btn-sm float-right mr-2" data-bs-toggle="modal" id="tombolEdit" data-bs-target="#exampleModal" onclick=editData(${item.id}) data-id="${item.id}">Edit</button></td>
        </tr>
        </tbody>
        `;
    }
    $('#tableDashboard').append(tab);
}

function hapusData(id) {
    const konfirmasi = confirm('Apakah anda yakin ingin mengjapus data ini?');
    if (konfirmasi) {
        $.ajax({
            url: 'http://localhost/tokopakaian/public/dashboard/hapus',
            method: 'POST',
            dataType: 'json',
            data: { id: id },
            success: function (response) {
                console.log(response);
                alertBerhasilHapus('berhasil', 'dihapus', 'success');
                $('#tableDashboard').empty();
                addDashboardTable(response);
            }
        });
    }
}

function editData(id) {
    $('#exampleModalLabel').html('Ubah Data Barang');
    $('.modal-footer button[type=submit]').html('Simpan Perubahan');
    $('.modal-body form').attr('action', 'http://localhost/tokopakaian/public/dashboard/ubah')

    $.ajax({
        url: 'http://localhost/tokopakaian/public/dashboard/getDataUbah',
        method: 'POST',
        dataType: 'json',
        data: { id: id },
        success: function (response) {
            console.log(response);

            $('#id').val(response.id);
            $('#nama').val(response.nama);
            $('#harga').val(response.harga);
            $('#stok').val(response.stok);
            $('#alamatGambar').val(response.gambar);
            $('#tampilkanGambar').attr('src', response.gambar);
            $('#ukuran').val(response.ukuran);
            $('#warna').val(response.warna);
            $('#diskon').val(response.diskon);

        }
    });
}


function alertBerhasilHapus(pesan, aksi, tipe){
    $('#pemberitahuanDashboard').empty();
    let alert = `<div class="alert alert-`+ tipe +` text-center" role="alert">
    Data barang <strong>`+ pesan +`</strong> `+ aksi +` 
  </div>`;
  $('#pemberitahuanDashboard').append(alert);
}

