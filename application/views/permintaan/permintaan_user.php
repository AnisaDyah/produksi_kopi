
<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper" style="height: 900px">
  <section class="content-header">
    <h1>
      Data permintaan Kopi oleh User
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
              &nbsp;
            </h3>
            <?php //if($this->session->userdata('id_user_level') == '1'): ?>
          
            <?php //endif;?>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-striped table-bordered" id="tabeluser">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Jumlah</th>
                  <th>Jenis Kopi</th>
                  <th>User</th>
                  <?php //if($this->session->userdata('id_user_level') == '1'): ?>
                  <th>Action</th>
                  <?php //endif;?>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($list as $key): ?>
                <tr>
                  <td><?php echo $key->tanggal; ?></td>
                  <td><?php echo $key->jumlah; ?> Kg</td>
                  <td>
                          <?php foreach ($jenis_kopi as $k)
                          {
                            if($k->id_kopi == $key->id_kopi)
                            {?>
                           
                            <?php echo $k->jenis_kopi;
                            }
                          }
                          ?>
                        </td>
                        <td>
                          <?php foreach ($user as $k)
                          {
                            if($k->id_user == $key->id_user)
                            {?>
                           
                            <?php echo $k->username;
                            }
                          }
                          ?>
                        </td>
                  <?php //if($this->session->userdata('id_user_level') == '1'): ?>
                  <td style="text-align: center">
                
                    <!-- <a href="<?php echo site_url('permintaan_user/tambah_permintaan/'.$key->id_permintaan_user); ?>" title="Edit Nama Kategori" class="btn btn-success">
                      Terima 
                    </a> -->
                    <?php 
						    switch ($key->status) {
                                case 'Diajukan':?>
                                <a href="<?php echo site_url('permintaan_user/tambah_permintaan/'.$key->id_permintaan_user); ?>" title="Edit Nama Kategori" class="btn btn-success">
                      Terima 
                    </a>
                    <?php
                                break;
                                case 'Diterima':?>
                                <a href="<?php echo site_url('permintaan_user/tambah_permintaan/'.$key->id_permintaan_user); ?>" title="Edit Nama Kategori" class="btn btn-danger">
                      Terima 
                    </a>
                    <?php
                                break;
                              
                                
                            } ?>
                    
                   
                  </td>
                  <?php// endif;?>
                </tr>
              <?php endforeach ?>
              </tbody>
            </table>
          </div>
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