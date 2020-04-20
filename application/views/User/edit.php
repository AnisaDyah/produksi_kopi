<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Edit Pelanggan
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
         
            <div class="box-body">
      <?php echo form_open('User/update/'.$User->id_user); ?>
        <?php echo form_hidden('id_user', $User->id_user) ?>
     
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Alamat Email" value="<?php echo $User->email ?>">
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" value="<?php echo $User->username ?>">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan Password" value="<?php echo $User->password ?>">
        </div>
        <div class="form-group">
          <label> Privilege </label>
              <select class="form-control" name ="privilege" id="privilege"> 
                <option selected>
                <?php
                  foreach($user_level as $k) {
                    $s='';
                      if($k->id_user_level == $User->id_user_level)
                      { $s='selected'; }
                ?>
                 <option value="<?php echo $k->id_user_level ?>" <?php echo $s ?>>
                    <?php echo $k->user_level ?>
                  </option>
                  <?php } ?>
            </select>
        </div>

        <a class="btn btn-info" href="<?php echo base_url('User/index') ?>">Kembali</a>
        <button type="submit" class="btn btn-primary">OK</button>
      <?php echo form_close(); ?>
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