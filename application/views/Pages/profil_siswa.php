<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      <!-- Card stats -->
      <div class="row">
          <div class="card mb-3">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <?php foreach($siswa->result() as $siswas) {?>
                    <img src="<?= asset_url('photo/siswa/' . $siswas->foto )?>" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Edit Profil Siswa</h5>
                    <div class="row">
                      <div class="col-6">
                        <p class="card-text">Kode Siswa</p>
                        <p class="card-text">Nama</p>
                        <p class="card-text">NISN</p>
                        <p class="card-text">Agama</p>
                        <p class="card-text">Jenis Kelamin</p>
                        <p class="card-text">Tempat Lahir</p>
                        <p class="card-text">Tanggal Lahir</p>
                        <p class="card-text">Alamat</p>
                        <p class="card-text">No Telepon</p>
                      </div>
                      <div class="col-6">
                        <p><?= $siswas->kd_siswa?></p>
                        <p><?= $siswas->nm_siswa?></p>
                        <p><?= $siswas->agama?></p>
                        <p><?= $siswas->kelamin?></p>
                        <p><?= $siswas->tempat_lahir?></p>
                        <p><?= $siswas->tanggal_lahir?></p>
                        <p><?= $siswas->alamat?></p>
                        <p><?= $siswas->no_telepon?></p>
                      </div>
                    </div>
                    <div class="form-group">
                      <a data-toggle="modal" data-target="#editData<?= $siswas->kd_siswa;?>" class="btn btn-info btn-lg">Edit</a>
                    </div>
                    <?php };?>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
  </div>
</div>

<?php foreach($siswa->result() as $siswas) {?>
<div class="modal fade" id="editData<?= $siswas->kd_siswa;?>" tabindex="-1" role="dialog" aria-labelledby="editDataLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDataLabel">Edit Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('siswa/update_siswa'); ?>
        <?php $error; ?>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="kd_siswa">Kode</label>
              <input type="text" name="kd_siswa" class="form-control" value="<?= $siswas->kd_siswa; ?>" readonly>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="nm_siswa">Nama siswa</label>
              <input type="text" name="nm_siswa" class="form-control" value="<?= $siswas->nm_siswa; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="nisn">NISN</label>
              <input type="text" name="nisn" class="form-control" value="<?= $siswas->nisn; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="gambar">Ganti foto</label>
              <input type="file" name="photo" id="photo"><br>
              <label for="sekarang">Foto sekarang</label>
              <img height="40" src="<?= asset_url('photo/siswa/' . $siswas->foto )?>" alt="">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="kelamin">Jenis Kelamin</label>
                <select class="custom-select" name="kelamin">
                    <option value="<?= $siswas->kelamin; ?>"><?= $kelamin = $siswas->kelamin == 'L' ? 'Laki-Laki' : 'Perempuan'?></option>
                    <?= $kelamin == 'Perempuan' ? '<option value="L">Laki-Laki</option>' : '<option value="P">Perempuan</option>';?>
                </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="agama">Agama</label>
                <select class="custom-select" name="agama">                  
                  <option value="<?= $siswas->agama; ?>">Default: <?= $siswas->agama; ?></option>
                  <option value="Islam">Islam</option>
                  <option value="Kristen Protestan">Kristen Protestan</option>
                  <option value="Katolik">Katolik</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Buddha">Buddha</option>
                  <option value="Kong Hu Cu">Kong Hu Cu</option>
                </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="ttl">Tempat & Tgl Lahir</label>
              <div class="row">
                <div class="col-md-6">
                  <input type="text" name="tempat_lahir" class="form-control" value="<?= $siswas->tempat_lahir; ?>">
                </div>
                <div class="col-md-6">
                  <input type="date" name="tgl_lahir" class="form-control" value="<?= $siswas->tanggal_lahir; ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea type="text" name="alamat" class="form-control"><?= $siswas->alamat; ?></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="no_telp">No Telepon</label>
              <input type="tel" name="no_telp" class="form-control" value="<?= $siswas->no_telepon; ?>">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="subtmit" class="btn btn-sm btn-primary" value="submit">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php }; ?>