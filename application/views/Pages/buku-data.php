<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h1 class="mb-0"><?= $header; ?></h1>
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
                    <th scope="col">Judul buku</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Tools</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach($buku as $bukus) {?>
                  <tr>
                    <th scope="row">
                      <?= $no++; ?>
                    </th>
                    <td>
                      <?= $bukus->kd_buku; ?>
                    </td>
                    <td>
                      <?= $bukus->judul; ?>
                    </td>
                    <td>
                      <?= $bukus->jumlah; ?>
                    </td>
                    <td class="text-right">
                      <button data-id="<?= $bukus->kd_buku; ?>" class="btn btn-sm btn-danger btn-delete">Delete</button>
                      <a href="" data-toggle="modal" data-target="#editData<?= $bukus->kd_buku;?>" class="btn btn-sm btn-info">Edit</a>
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
<?php echo form_open('buku/add_buku'); ?>
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
              <label for="kd_buku">Kode</label>
              <input type="text" name="kd_buku" class="form-control" value="<?= $kode_baru; ?>" readonly>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="judul">Judul buku</label>
              <input type="text" name="judul" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="isbn">ISBN</label>
              <input type="text" name="isbn" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="pengarang">Pengarang</label>
              <input type="text" name="pengarang" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="halaman">Halaman</label>
              <input type="text" name="halaman" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="thTerbit">Tahun terbit</label>
              <input type="text" name="thTerbit" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="jumlah">Jumlah</label>
              <input type="text" name="jumlah" class="form-control">
            </div>
          </div>
               <!-- Gambar -->
          <!-- <div class="col-md-12">
            <div class="form-group">
              <label for="halaman">Halaman</label>
              <input type="text" name="halaman" class="form-control">
            </div>
          </div>           -->
          <div class="col-md-12">
            <div class="form-group">
              <label for="sinopsis">Sinopsis</label>
              <textarea type="text" name="sinopsis" class="form-control"></textarea>
            </div>
          </div>          
          <div class="col-md-12">
            <div class="form-group">
              <label for="halaman">Penerbit</label>
                <select class="custom-select" name="kd_penerbit">
                  <?php foreach($penerbit as $penerbits) {?>
                    <option value="<?= $penerbits->kd_penerbit; ?>"><?= $penerbits->nm_penerbit;?></option>
                  <?php }; ?>
                </select>
              </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="kategori">Kategori</label>
                <select class="custom-select" name="kd_kategori">
                  <?php foreach($kategori as $kategoris) {?>
                    <option value="<?= $kategoris->kd_kategori; ?>"><?= $kategoris->nm_kategori;?></option>
                  <?php }; ?>
                </select>
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

<?php foreach($buku as $bukus) {?>
<div class="modal fade" id="editData<?= $bukus->kd_buku;?>" tabindex="-1" role="dialog" aria-labelledby="editDataLabel" aria-hidden="true">
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
        <?php echo form_open('buku/update_buku'); ?>
        <?php $error; ?>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="kd_buku">Kode</label>
              <input type="text" name="kd_buku" class="form-control" value="<?= $bukus->kd_buku; ?>" readonly>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="nm_buku">Nama buku</label>
              <input type="text" name="nm_buku" class="form-control" value="<?= $bukus->judul; ?>">
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
              url: '<?= base_url('buku/delete_buku');?>',
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