
<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper" style="height: 900px">
  <section class="content-header">
    <h1>
      Data Permintaan Kopi
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
            <div class="box-tools pull-right">
              <a href="<?php echo site_url('Produksi/export_laporan') ?>" type="button" class="btn btn-success">
                <i class="fa fa-print"> Cetak Data</i>
              </a>
            </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-striped table-bordered" id="tabeluser">
              <thead>
                <tr>
                <th>Jenis Kopi</th>
          <th>Tanggal</th>
          <th>Jumlah</th>
                 
                </tr>
              </thead>
              <?php foreach ($permintaan as $key): ?>
        <tr>
          <td>
                          <?php foreach ($jenis_kopi2 as $k)
                          {
                            if($k->id_kopi == $key->id_kopi)
                            {?>
                            <?php echo $k->jenis_kopi;
                            }
                          }
                          ?>
                        </td>
          <td><?php echo "'".date_format(date_create($key->tanggal), "d F Y"); ?></td>
          <td><?php echo $key->jumlah; ?></td>
          
        </tr>
      <?php endforeach ?>
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