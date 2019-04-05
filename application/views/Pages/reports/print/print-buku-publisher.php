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
              <button onclick="window.location.href='<?= base_url('reports/cetak_buku');?>'" class="btn btn-success" data-toggle="modal" data-target="#addData"><i class="fas fa-print"></i> Cetak</button>
            </div>
            <div class="row container-fluid">
                <div class="col-md-3">
                  <label for="penerbit">Pilih Penerbit</label>
                  <select name="penerbit" class="custom-select" id="penerbit">
                    <option value="">Pilih</option>
                      <?php foreach($penerbit as $penerbits) {?>
                        <option value="<?= $penerbits->kd_penerbit; ?>"><?= $penerbits->nm_penerbit; ?></option>
                      <?php };?>
                  </select>
                </div>
              </div>
            <div class="table-responsive container-fluid my-5">
              <table class="table align-items-center table-flush" id="table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Pengarang</th>
                    <th scope="col">Jumlah</th>
                  </tr>
                </thead>
                <tbody id="tbody">

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
    $('#penerbit').change(function() {
      $('#tbody').hide();

      $.ajax({
        type: "POST",
        url: "<?= base_url('reports/get_book_by_publisher');?>",
        data: {kd_penerbit : $("#penerbit").val()},
        dataType: "JSON",
        success: function(response) {
          $("#tbody").html(response.list_buku).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    })
  });
</script>