<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h1 class="mb-0"><?= $title; ?></h1>
            </div>
            <div class="d-flex flex-row-reverse container-fluid">
              <button onclick="window.location.href='<?= base_url('reports/cetak_peminjaman');?>'" class="btn btn-success" data-toggle="modal" data-target="#addData"><i class="fas fa-print"></i> Cetak</button>
            </div>
            <div class="table-responsive container-fluid my-5">
              <table class="table align-items-center table-flush" id="table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">No Pinjam</th>
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Lama Pinjam</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Denda</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach($peminjaman as $peminjamans) {?>
                  <tr>
                    <th scope="row">
                      <?= $no++; ?>
                    </th>
                    <td>
                      <?= $peminjamans->no_pinjam; ?>
                    </td>
                    <td>
                      <?= $peminjamans->tgl_pinjam; ?>
                    </td>
                    <td>
                      <?= $peminjamans->nisn; ?>
                    </td>
                    <td>
                      <?= $peminjamans->nm_siswa; ?>
                    </td>
                    <td>
                      <?= $peminjamans->lama_pinjam; ?>
                    </td>
                    <td>
                      <?= $peminjamans->keterangan; ?>
                    </td>
                    <td>
                      Rp.<?= $peminjamans->denda; ?>
                    </td>
                    <td>
                      <?= $peminjamans->status; ?>
                    </td>
                  </tr>
                <?php }; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>