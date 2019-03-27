<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      <!-- Card stats -->
      <div class="row" id="printable">
        <div class="col-12">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <h1 class="pb-2">PERPUSTAKAAN SMA TELADAN</h1>
              <button class="btn btn-small btn-success mb-3" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
              <p>Nota Pengembalian</p>
              <div class="row">
                <div class="card col-3">
                  <div class="card-body">
                    <h4>Peminjaman</h4>
                  </div>
                </div>
                <div class="col-3">
                  <h3>No. Peminjaman</h3>
                  <h3>Tanggal Peminjaman</h3>
                  <h3>Nama Siswa</h3>
                  <h3>Lama Pinjam</h3>
                  <h3>Keterangan</h3>
                  <h3>Status</h3>
                </div>
                
                <div class="col-3">
              <?php $no = 1; foreach($pengembalian as $pengembalians) {?>
                  <h3><?= $pengembalians->no_pinjam; ?></h3>
                  <h3><?= $pengembalians->tgl_pinjam; ?></h3>
                  <h3><?= $pengembalians->nm_siswa; ?></h3>
                  <h3><?= $pengembalians->lama_pinjam; ?> hari</h3>
                  <h3><?= $pengembalians->keterangan; ?></h3>
                  <h3><?= $pengembalians->status; ?></h3>
              <?php }; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="card col-3">
                  <div class="card-body">
                    <h4>Pengembalian</h4>
                  </div>
                </div>
                <div class="col-8">
                <?php echo validation_errors(); ?>
                <?php echo form_open('pengembalian/insert'); ?>
                <?php $error; ?>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="no_kembali">No Kembali</label>
                      <input type="text" name="no_kembali" class="form-control" value="<?= $kode_baru; ?>" readonly>
                      <?php $no = 1; foreach($pengembalian as $pengembalians) {?>
                        <input type="hidden" name="no_pinjam" value="<?= $pengembalians->no_pinjam;?>">
                        <input type="hidden" name="siswa" value="<?= $pengembalians->kd_siswa;?>">
                      <?php }; ?>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="tgl_kembali">Tanggal Kembali</label>
                      <input type="date" name="tgl_kembali" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="denda">Denda (Rp)</label>
                      <input type="number" name="denda" class="form-control" min="500" step="500" name="denda">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-success">Save</button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>