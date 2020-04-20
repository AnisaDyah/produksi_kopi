<?php $this->load->view('layouts/header_admin'); ?>

        <!-- page content -->
        <div class="right_col">
              <div class="container">
        <br/>
        <legend>Lihat Pengguna</legend>
        <div class="content">
          <div class="form-group">
            <label for="nama">Nama</label>
            <p><?php echo $data->nama_lengkap?></p>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <p><?php echo $data->alamat?></p>
          </div>
         
          <div class="form-group">
            <label for="username">Username</label>
            <p><?php echo $data->username?></p>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <p><?php echo $data->password?></p>
          </div>
          <div class="form-group">
            <label for="privilege">Privilege</label>
            <p> <?php foreach ($user_level as $k)
                          {
                            if($k->id_user_level == $data->id_user_level)
                            {
                            echo $k->user_level;
                            }
                          }
                          ?>
            </p>
          </div>
          <a class="btn btn-info" href="<?php echo base_url('pengguna/') ?>">Kembali</a>
        </div>
      </div>
        </div>        
        <!-- /page content -->

        <?php $this->load->view('layouts/footer_admin'); ?>