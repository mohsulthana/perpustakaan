<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h1 class="mb-0"><?= $header; ?></h1>
            </div>
            <div class="table-responsive container-fluid my-5">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama User</th>
                    <th scope="col">Username</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach($user as $users) {?>
                  <tr>
                    <th scope="row">
                      <?= $no++; ?>
                    </th>
                    <td>
                      <?= $users->kd_user; ?>
                    </td>
                    <td>
                      <?= $users->nm_user; ?>
                    </td>
                    <td>
                      <?= $users->username; ?>
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