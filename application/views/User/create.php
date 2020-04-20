<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Tambah User
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <?php echo $this->session->flashdata('alert'); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
             
            </h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php echo site_url('User/store') ?>" method="post">
            <div class="box-body">
             
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Alamat E-mail">
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
              </div>
              <div class="form-group">
            <label> Privilege </label>
                  <select class="form-control" name ="privilege" id="privilege"> 
                  <option selected> --Pilih Privilege-- </option>
                  <?php foreach ($user_level as $k) { ?>
                  <option value="<?php echo $k->id_user_level?>"><?php echo $k->user_level?></option>
                <?php } ?>
                </select>
            </div>

              <a class="btn btn-info" href="<?php echo base_url() ?>User">Kembali</a>
              <button type="submit" class="btn btn-primary">OK</button>
            <?php echo form_close() ?>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
</div>

        <?php $this->load->view('includes/footer'); ?>