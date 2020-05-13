<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper" style="height: 700px">
  <section class="content-header">
    <h1>
      Peramalan Jumlah Produksi Kopi dari Bulan <?php echo $bulan_ramalan[0] ?> s.d <?php echo $bulan_ramalan[$jangka_waktu-1] ?>
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
              <?php //echo "Peramalan produk ".$produk->nama_produk." menggunakan konstanta ".$konstanta; ?>
              <?php echo "Peramalan kategori ".$jenis_kopi->jenis_kopi." menggunakan konstanta ".$konstanta; ?>
            </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
           
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th colspan="5" style="text-align: center;">Peramalan Bulan <?php echo $bulan_ramalan[0] ?> s.d <?php echo $bulan_ramalan[$jangka_waktu-1] ?></th>
                </tr>
                <tr>
                  <th>Bulan</th>
                  <th>Hasil Ramalan</th>
                </tr>
              </thead>
              <tbody>
              <?php for($i = 0; $i < $jangka_waktu; $i++){ ?>
                <tr>
                  <td><?php echo $bulan_ramalan[$i]."-".$tahun_ramalan[$i]; ?></td>
                  <td><?php echo $ft_end[$i]; ?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            <br>
            <br>
            <br>
            <div class="box-body chart-responsive">
              <div class="chart" id="line-chart" style="height: 300px;"></div>
            </div>
            <div class="box-body chart-responsive">
              <label>Legend : </label>
              <div id="legend" style="height: auto;">
              </div>
            </div>
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