<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h1 class="mb-0"><?= $title; ?></h1>
            </div>
            <div class="table-responsive container-fluid my-5">
              <table id="table" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">No. Pinjam</th>
                    <th scope="col">Tgl. Pinjam</th>
                    <th scope="col">Tgl. Kembali</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Denda</th>
                    <th scope="col">Tools</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach($pengembalian as $pengembalians) {?>
                  <tr>
                    <th scope="row">
                      <?= $no++; ?>
                    </th>
                    <td>
                      <?= $pengembalians->no_pinjam; ?>
                    </td>
                    <td>
                      <?= $pengembalians->tgl_pinjam; ?>
                    </td>
                    <td>
                      <?= $pengembalians->tgl_kembali; ?>
                    </td>
                    <td>
                      <?= $pengembalians->nisn; ?>
                    </td>
                    <td>
                      <?= $pengembalians->nm_siswa; ?>
                    </td>
                    <td>
                      <?= $pengembalians->denda; ?> Rupiah
                    </td>
                    <td class="text-right">
                      <!-- <button data-id="<?= $pengembalians->no_pinjam; ?>" class="btn btn-sm btn-danger btn-delete">Delete</button> -->
                      <a href="<?= base_url('pengembalian/pengembalian_baru/' . $pengembalians->no_pinjam);?>" class="btn btn-sm btn-success">Cetak</a>
                      <a href="<?= base_url('pengembalian/nota_kembali/' . $pengembalians->no_pinjam);?>" type="submit" class="btn btn-sm btn-primary" value="submit">Batal</a>
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