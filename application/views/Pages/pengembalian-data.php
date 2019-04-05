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
              <a class="btn btn-sm btn-info" href="<?= base_url('pengembalian/dikembalikan');?>">Data dikembalikan</a>
            </div>
            <div class="table-responsive container-fluid my-5">
              <table id="table" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tgl. Pinjam</th>
                    <th scope="col">No. Pinjam</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Lama Pinjam</th>
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
                      <?= $pengembalians->tgl_pinjam; ?>
                    </td>
                    <td>
                      <?= $pengembalians->no_pinjam; ?>
                    </td>
                    <td>
                      <?= $pengembalians->nisn; ?>
                    </td>
                    <td>
                      <?= $pengembalians->nm_siswa; ?>
                    </td>
                    <td>
                      <?= $pengembalians->lama_pinjam; ?> hari
                    </td>
                    <td class="text-right">
                      <!-- <button data-id="<?= $pengembalians->no_pinjam; ?>" class="btn btn-sm btn-danger btn-delete">Delete</button> -->
                      <a href="<?= base_url('pengembalian/pengembalian_baru/' . $pengembalians->no_pinjam);?>" class="btn btn-sm btn-success">Kembalikan</a>
                      <!-- <a href="<?= base_url('pengembalian/nota_kembali/' . $pengembalians->no_pinjam);?>" type="submit" class="btn btn-sm btn-primary" value="submit">Cetak</a> -->
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

<?php foreach($pengembalian as $pengembalians) {?>
<div class="modal fade" id="editData/<?= $pengembalians->no_pinjam;?>" tabindex="-1" role="dialog" aria-labelledby="editDataLabel" aria-hidden="true">
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
        <?php echo form_open('pengembalian/update_pengembalian'); ?>
        <?php $error; ?>

        <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="no_pinjam">Kode</label>
            <input type="text" name="no_pinjam" class="form-control" value="<?= $kode_baru; ?>" readonly>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="tgl_pinjam">Tanggal Pinjam</label>
            <input type="date" name="tgl_pinjam" class="form-control" value="<?= $pengembalians->tgl_pinjam; ?>">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="siswa">Nama Siswa</label>
            <select class="custom-select" name="siswa">
              <?php foreach($pengembalian as $pengembalians) {?>
                <option value="<?= $pengembalians->no_pinjam; ?>"><?= $pengembalians->nm_siswa; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" value="<?= $pengembalians->keterangan; ?>">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="lama_pinjam">Lama Pinjam (dalam hari)</label>
            <input type="number" name="lama_pinjam" class="form-control" value="<?= $pengembalians->lama_pinjam; ?>"> 
          </div>
        </div>
      </div>
      <h1 style="color: grey;">Buku</h1>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="kategori">Kategori</label>
              <select class="custom-select" name="kategori">
                <?php foreach($kategori as $kategoris) {?>
                  <option value="<?= $kategoris->kd_kategori; ?>"><?= $kategoris->nm_kategori; ?></option>
                <?php } ?>
              </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="judul_buku">Judul Buku</label>
              <select class="custom-select" name="judul">
                <?php foreach($buku as $bukus) {?>
                  <option value="<?= $bukus->kd_buku; ?>"><?= $bukus->judul; ?></option>
                <?php } ?>
              </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="<?= $bukus->jumlah; ?>">
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
              url: "<?= base_url('pengembalian/delete_pengembalian');?>",
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