
<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper" style="height: 900px">
  <section class="content-header">
    <h1>
      Data Produksi Kopi
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
            <?php if($this->session->userdata('id_user_level') == '1'): ?>
            <div class="box-tools pull-right">
              <a href="<?php echo site_url('Produksi/create'); ?>" type="button" class="btn btn-success">
                <i class="fa fa-plus"> Tambah Data Produksi</i>
              </a>
            </div>
            <?php endif;?>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-striped table-bordered" id="tabeluser">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Jumlah</th>
                  <th>Jenis Kopi</th>
                  <?php if($this->session->userdata('id_user_level') == '1'): ?>
                  <th>Action</th>
                  <?php endif;?>
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
                  <?php if($this->session->userdata('id_user_level') == '1'): ?>
                  <td style="text-align: center">
                  <?php echo form_open('Produksi/destroy/'.$key->id_produksi)  ?>
                    <a href="<?php echo site_url('Produksi/edit/'.$key->id_produksi); ?>" title="Edit Nama Kategori" class="btn btn-primary">
                      <i class="fa fa-pencil"></i>
                    </a>
                   
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-close"></i></button>
                    <?php echo form_close() ?>
                  </td>
                  <?php endif;?>
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