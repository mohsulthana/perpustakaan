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
              <button onclick="window.location.href='<?= base_url('reports/cetak_penerbit');?>'" class="btn btn-success" data-toggle="modal" data-target="#addData"><i class="fas fa-print"></i> Cetak</button>
            </div>
            <div class="table-responsive container-fluid my-5">
              <table class="table align-items-center table-flush" id="table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama Penerbit</th
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