<div class="container">
    <div class="row">
        <div class="col text-center">
            <h1>Halaman Dashboard</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-m-6" id="pemberitahuanDashboard">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <div class="row">
        <div id="loadDataToko" class="col mb-5">
            <button type="button" class="btn btn-primary mb-4 mt-4 float-end" data-bs-toggle="modal" data-bs-target="#exampleModal" id="tombolTambah">
                Tambah Data Barang
            </button>
            <table class="table table-striped" id="tableDashboard">

            </table>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASEURL; ?>/dashboard/addBarang" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="id" name="id" readonly>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Barang</label>
                            <input type="number" class="form-control" id="harga" name="harga" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Jumlah Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" required>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Barang</label>
                            <input type="file" class="form-control" id="gambar" name="gambar">
                            <input type="text" class="form-label" name="alamatGambar" id="alamatGambar" hidden readonly>
                            <img style="height: 100px; width: 100px; margin-top: 10px;" src="" alt="" id="tampilkanGambar">
                        </div>
                        <div class="mb-3">
                            <label for="ukuran" class="form-label">Ukuran Barang</label>
                            <input type="text" class="form-control" id="ukuran" name="ukuran" required>
                        </div>
                        <div class="mb-3">
                            <label for="warna" class="form-label">Warna Barang</label>
                            <input type="text" class="form-control" id="warna" name="warna" required>
                        </div>
                        <div class="mb-3">
                            <label for="diskon" class="form-label">Diskon</label>
                            <input type="number" class="form-control" id="diskon" name="diskon">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>