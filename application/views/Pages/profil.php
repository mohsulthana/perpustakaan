<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      <!-- Card stats -->
      <div class="row">
          <div class="card mb-3" style="max-width: 540px;">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="<?= asset_url('img/profil/' . $this->session->userdata('gambar'));?>" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Profil</h5>
                    <div class="row">
                      <div class="col-6">
                        <p class="card-text">Nama</p>
                        <p class="card-text">Username</p>
                      </div>
                      <div class="col-6">
                      <p><?= $this->session->userdata('nm_user');?></p>
                      <p><?= $this->session->userdata('username');?></p>
                      </div>
                    </div>
                    <a data-toggle="modal" data-target="#editData<?= $this->session->userdata('kd_user');?>" class="btn btn-info btn-sm">Edit</a>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
  </div>
</div>

<div class="modal fade" id="editData<?= $this->session->userdata('kd_user');?>" tabindex="-1" role="dialog" aria-labelledby="editDataLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDataLabel">Edit Profil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo validation_errors(); ?>
        <?php echo form_open('user/edit_profil'); ?>
        <?php $error; ?>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="kd_user" value="<?= $this->session->userdata('kd_user');?>">
              <label for="nm_user">Nama</label>
              <input type="text" name="nm_user" class="form-control" value="<?= $this->session->userdata('nm_user'); ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" class="form-control" value="<?= $this->session->userdata('username'); ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="password">New Password (if any)</label><br>
              <small>Leave it if you won't to change password</small>
              <input type="password" name="password" class="form-control" value="<?= $this->session->userdata('password');?>">
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