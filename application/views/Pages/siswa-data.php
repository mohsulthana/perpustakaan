<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h1 class="mb-0"><?= $title; ?></h1>
              <?php if($this->session->userdata('message')) {
                '<div class="alert alert-success">
                  '. $this->session->userdata('message'). '
                </div>';
              }?>
            </div>
            <div class="d-flex flex-row-reverse container-fluid">
              <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addData">Add data</button>
            </div>
            <div class="table-responsive container-fluid my-5">
              <table id="table" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Tools</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach($siswa as $siswas) {?>
                  <tr>
                    <th scope="row">
                      <?= $no++; ?>
                    </th>
                    <td>
                      <?= $siswas->kd_siswa; ?>
                    </td>
                    <td>
                      <a href="<?= base_url('siswa/edit_siswa/'.$siswas->kd_siswa);?>"><?= $siswas->nm_siswa; ?></a>
                    </td>
                    <td>
                      <?= $siswas->kelamin; ?>
                    </td>
                    <td class="text-right">
                      <button data-id="<?= $siswas->kd_siswa; ?>" class="btn btn-sm btn-danger btn-delete">Delete</button>
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

<?php echo validation_errors(); ?>
<?php echo form_open_multipart('siswa/add_siswa'); ?>
<?php $error; ?>
<div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="addDataLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="kd_siswa">Kode</label>
              <input type="text" name="kd_siswa" class="form-control" value="<?= $kode_baru; ?>" readonly>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="nm_siswa">Nama siswa</label>
              <input type="text" name="nm_siswa" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="nisn">NISN</label>
              <input type="text" name="nisn" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="kelamin">Jenis Kelamin</label>
                <select class="custom-select" name="kelamin">
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="agama">Agama</label>
                <select class="custom-select" name="agama">
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
                  <input type="text" name="tempat_lahir" class="form-control">
                </div>
                <div class="col-md-6">
                  <input type="date" name="tgl_lahir" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea type="text" name="alamat" class="form-control"></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="gambar">Foto</label>
              <input type="file" name="photo" id="photo">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="no_telp">No Telepon</label>
              <input type="tel" name="no_telp" class="form-control" id="datepicker">
              </div>
          </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary" value="submit">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>

<?php foreach($siswa as $siswas) {?>
<div class="modal fade" id="editData<?= $siswas->kd_siswa;?>" tabindex="-1" role="dialog" aria-labelledby="editDataLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDataLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo validation_errors(); ?>
        <?php echo form_open('siswa/update_siswa'); ?>
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


<script>
  $(document).ready(function() {
    $('.btn-delete').on('click', function(e) {
      e.preventDefault();
      const kode = $(this).attr('data-id');

      Swal.fire({
        title: 'Confirmation',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: '<?= base_url('siswa/delete_siswa');?>',
              method: "POST",
              data: {id: kode},
              beforeSend: function() {
                Swal.fire({
                  title: 'Loading',
                  html: 'Processing data',
                  onOpen: () => {
                    Swal.showLoading()
                  }
                });
              },
              success: function(data) {
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                setTimeout(function() {
                    location.reload();
                }, 700);
              }
            });
          } else if (result.dismiss === swal.DismissReason.cancel) {
            swal(
              'Batal',
              'Anda membatalkan penghapusan',
              'error'
            )
          }
        });
      });
    });
    
  </script>