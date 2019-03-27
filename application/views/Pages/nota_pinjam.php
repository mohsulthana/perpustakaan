<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      <!-- Card stats -->
      <div class="row" id="printable">
        <div class="col-12">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <h1 class="pb-5">PERPUSTAKAAN SMA TELADAN</h1>
              <p>Nota Peminjaman</p>
              <div class="row">
                <div class="col-3">
                  <h3>No. Peminjaman</h3>
                  <h3>Tanggal Peminjaman</h3>
                  <h3>Nama Siswa</h3>
                  <h3>Lama Pinjam</h3>
                  <h3>Keterangan</h3>
                  <h3>Status</h3>
                </div>
                <div class="col-3">
              <?php $no = 1; foreach($tabel_siswa as $tabel_siswas) {?>
                  <h3><?= $tabel_siswas->no_pinjam; ?></h3>
                  <h3><?= $tabel_siswas->tgl_pinjam; ?></h3>
                  <h3><?= $tabel_siswas->nm_siswa; ?></h3>
                  <h3><?= $tabel_siswas->lama_pinjam; ?> hari</h3>
                  <h3><?= $tabel_siswas->keterangan; ?></h3>
                  <h3><?= $tabel_siswas->status; ?></h3>
              <?php }; ?>
                </div>
              </div>
              <button class="btn btn-small btn-success" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
              <div class="row">
                <div class="table-responsive container-fluid my-5">
                  <table id="table" class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; foreach($nota as $notas) {?>
                      <tr>
                        <th scope="row">
                          <?= $no++; ?>
                        </th>
                        <th scope="row">
                          <?= $notas->kd_buku; ?>
                        </th>
                        <th scope="row">
                          <?= $notas->judul; ?>
                        </th>
                        <th scope="row">
                          <?= $notas->jumlah_bk; ?>
                        </th>
                      </tr>
                    <?php }; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td></td>
                        <td></td>
                        <td scope="row">Jumlah</td>
                        <td scope="row"></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>