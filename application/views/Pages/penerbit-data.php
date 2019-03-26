<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h1 class="mb-0">Card tables</h1>
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
                    <th scope="col">Nama Penerbit</th>
                    <th scope="col">Tools</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach($penerbit as $penerbits) {?>
                  <tr>
                    <th scope="row">
                      <?= $no++; ?>
                    </th>
                    <td>
                      <?= $penerbits->kd_penerbit; ?>
                    </td>
                    <td>
                      <?= $penerbits->nm_penerbit; ?>
                    </td>
                    <td class="text-right">
                      <a href="" data-id="<?= $penerbits->kd_penerbit; ?>" class="btn btn-sm btn-danger btn-delete">Delete</a>
                      <a href="" data-toggle="modal" data-target="#editData<?= $penerbits->kd_penerbit;?>" class="btn btn-sm btn-info">Edit</a>
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
<?php echo form_open('penerbit/add_penerbit'); ?>
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
              <label for="kd_penerbit">Kode</label>
              <input type="text" name="kd_penerbit" class="form-control" value="<?= $kode_baru; ?>" readonly>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="nm_penerbit">Nama Penerbit</label>
              <input type="text" name="nm_penerbit" class="form-control">
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

<?php foreach($penerbit as $penerbits) {?>
<div class="modal fade" id="editData<?= $penerbits->kd_penerbit;?>" tabindex="-1" role="dialog" aria-labelledby="editDataLabel" aria-hidden="true">
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
        <?php echo form_open('penerbit/update_penerbit'); ?>
        <?php $error; ?>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="kd_penerbit">Kode</label>
              <input type="text" name="kd_penerbit" class="form-control" value="<?= $penerbits->kd_penerbit; ?>" readonly>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="nm_penerbit">Nama Penerbit</label>
              <input type="text" name="nm_penerbit" class="form-control" value="<?= $penerbits->nm_penerbit; ?>">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary" value="submit">Save changes</button>
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
      const kd_penerbit = $(this).attr('data-id');
      console.log(kd_penerbit);

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
              url: '<?= base_url('penerbit/delete_penerbit');?>',
              method: "POST",
              data: {id: kd_penerbit},
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