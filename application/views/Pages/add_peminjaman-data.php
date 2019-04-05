<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h1 class="mb-0"><?= $title; ?></h1>
            </div>
            <div class="card-body">
              <h1 style="color: grey;">Transaksi</h1>
              <small style="color: red">Isi daftar buku terlebih dahulu</small>
              <?php echo validation_errors(); ?>
              <?php echo form_open('peminjaman/insert'); ?>
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
                    <input type="date" name="tgl_pinjam" class="form-control">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="siswa">Nama Siswa</label>
                    <select class="custom-select" name="siswa" id="siswa">
                      <?php foreach($siswa as $siswas) {?>
                        <option value="<?= $siswas->kd_siswa; ?>"><?= $siswas->nm_siswa; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="lama_pinjam">Lama Pinjam (dalam hari)</label>
                    <input type="number" name="lama_pinjam" class="form-control" min="1" max="6"  step="1">
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary">Save transaction</button>
                </div>
              </form>
              </div>
            </div>
              <div class="col-md-12">
              <h1 style="color: grey;">Buku</h1>
                <div class="form-group">
                  <label for="kategori">Kategori</label>
                    <select class="custom-select" id="kategori" name="kategori">
                        <option value="">Pilih</option>
                      <?php foreach($kategori as $kategoris) {
                        echo "<option value='" . $kategoris->kd_kategori . "'>" . $kategoris->nm_kategori . "</option>";
                      } ?>
                    </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="judul_buku">Judul Buku</label>
                    <select class="custom-select" name="judul" id="judul">
                      <option value="">Pilih</option>
                    </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="jumlah">Jumlah</label>
                  <input type="number" name="jumlah_buku" id="jumlah_buku" class="form-control" min="0"  step="1">
                </div>
                <button type="submit" name="tambahbuku" value="tambahbukuNew" class="btn btn-sm btn-success btn-book-queue">Add book queue</button>
                <hr>
            </div>
            <div class="table-responsive container-fluid my-5">
              <h1 style="color: grey;">Barang pinjaman sejauh ini...</h1>
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Buku</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach($tmp_pinjam->result() as $tmp_pinjams) {?>
                  <tr>
                    <th scope="row">
                      <?= $no++; ?>
                    </th>
                    <td>
                      <?= $tmp_pinjams->kd_buku; ?>
                    </td>
                    <td>
                      <?= $tmp_pinjams->judul; ?>
                    </td>
                    <td>
                      <?= $tmp_pinjams->jumlah; ?>
                    </td>
                    <td class="text-right">
                    <button type="submit" name="hapusBuku" value="hapusBukuNew" data-id="<?= $tmp_pinjams->id; ?>" class="btn btn-sm btn-danger btn-remove-book-queue">Remove</button>
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
        },
        error: function (xhr, ajaxOptions, thrownError) {
          console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    });
    $('.btn-remove-book-queue').on('click', function(e) {
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
              url: "<?= base_url('peminjaman/delete_book_queue');?>",
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
    $('.btn-book-queue').on('click', function(e) {
      e.preventDefault();
      var kategori = $("#kategori").val();
      var judul = $("#judul").val();
      var jumlah_buku = $("#jumlah_buku").val();
      var siswa = $("#siswa").val();

      const value = $(this).attr('name');
      var data = {
        'judul': judul,
        'jumlah': jumlah_buku,
        'siswa': siswa
      }

      Swal.fire({
        title: 'Confirmation',
        text: "Add this book to your queue?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#007F00',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, add it!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: "<?= base_url('peminjaman/add_book_queue');?>",
              method: "POST",
              data: data,
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
                  'Added!',
                  'Your data has been added.',
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
              url: "<?= base_url('peminjaman/delete_peminjaman');?>",
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
  </script>