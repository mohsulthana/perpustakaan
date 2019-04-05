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
                    <th scope="col">Tanggal</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Tools</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach($pengadaan->result() as $pengadaans) {?>
                  <tr>
                    <th scope="row">
                      <?= $no++; ?>
                    </th>
                    <td>
                      <?= $pengadaans->no_pengadaan; ?>
                    </td>
                    <td>
                      <?= $pengadaans->tgl_pengadaan; ?>
                    </td>
                    <td>
                      <?= $pengadaans->judul; ?>
                    </td>
                    <td>
                      <?= $pengadaans->jumlah; ?>
                    </td>
                    <td class="text-right">
                      <button data-id="<?= $pengadaans->no_pengadaan; ?>" class="btn btn-sm btn-danger btn-delete">Delete</button>
                      <a href="" data-toggle="modal" data-target="#editData/<?= $pengadaans->no_pengadaan;?>" class="btn btn-sm btn-info">Edit</a>
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
<?php echo form_open_multipart('pengadaan/add_pengadaan'); ?>
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
              <label for="no_pengadaan">Kode</label>
              <input type="text" name="no_pengadaan" class="form-control" value="<?= $kode_baru; ?>" readonly>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="tgl_pengadaan">Tanggal pengadaan</label>
              <input type="date" name="tgl_pengadaan" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="kategori">Kategori</label>
                <select class="custom-select" id="kategori" name="kategori">
                  <?php foreach($kategori as $kategoris) {
                    echo "<option value='" . $kategoris->kd_kategori . "'>" . $kategoris->nm_kategori . "</option>";
                  } ?>
                </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="judul">Judul Buku</label>
                <select class="custom-select" name="judul" id="judul">
                  <option value="">Pilih</option>
                </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="asal_buku">Asal Buku</label>
              <input type="text" name="asal_buku" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="jumlah">Jumlah</label>
              <input type="number" name="jumlah" class="form-control" min="0"  step="1">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <input type="text" name="keterangan" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary" value="submit">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>

<?php echo validation_errors(); ?>
<?php echo form_open('pengadaan/update_pengadaan'); ?>
<?php $error; ?>
<div class="modal fade" id="editData/<?= $pengadaans->no_pengadaan;?>" tabindex="-1" role="dialog" aria-labelledby="editDataLabel" aria-hidden="true">
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
              <label for="no_pengadaan">Kode</label>
<?php $no = 1; foreach($pengadaan->result() as $pengadaans) {?>
              <input type="text" name="no_pengadaan" class="form-control" value="<?= $pengadaans->no_pengadaan; ?>" readonly>
<?php }; ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="tgl_pengadaan">Tanggal pengadaan</label>
<?php $no = 1; foreach($pengadaan->result() as $pengadaans) {?>
              <input type="date" name="tgl_pengadaan" class="form-control" value="<?= $pengadaans->tgl_pengadaan; ?>">
<?php }; ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="kategori">Kategori</label>
                <select class="custom-select" id="kategori" name="kategori">
                  <option value="<?= $pengadaans->kd_kategori; ?>">Default: <?= $pengadaans->nm_kategori; ?></option>
                  <?php foreach($kodekategori = $kategori as $kategoris) {
                    echo "<option value='" . $kategoris->kd_kategori . "'>" . $kategoris->nm_kategori . "</option>";
                  } ?>
                </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="judul">Judul Buku</label>
                <select class="custom-select" name="judul" id="judul">
                  <option value="">Pilih</option>
                </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="asal_buku">Asal Buku</label>
<?php $no = 1; foreach($pengadaan->result() as $pengadaans) {?>
              <input type="text" name="asal_buku" class="form-control" value="<?= $pengadaans->asal_buku; ?>">
<?php }; ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="jumlah">Jumlah</label>
<?php $no = 1; foreach($pengadaan->result() as $pengadaans) {?>
              <input type="number" name="jumlah" class="form-control" min="0"  step="1" value="<?= $pengadaans->jumlah; ?>">
<?php }; ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
<?php $no = 1; foreach($pengadaan->result() as $pengadaans) {?>
              <input type="text" name="keterangan" class="form-control" value="<?= $pengadaans->keterangan; ?>">
<?php }; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary" value="submit">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>

<script>
  $(document).ready(function() {
    $("#kategori").change(function() {
      $("#judul").hide();

      $.ajax({
        type: "POST",
        url: "<?= base_url('peminjaman/listBuku');?>",
        data: {kd_kategori : $("#kategori").val()},
        dataType: "JSON",
        success: function(response) {
          $("#judul").html(response.list_buku).show();
          console.log(response);
        },
        error: function (xhr, ajaxOptions, thrownError) {
          console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    });
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
              url: '<?= base_url('pengadaan/delete_pengadaan');?>',
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