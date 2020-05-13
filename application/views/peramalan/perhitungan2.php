<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper" style="height: 700px">
  <section class="content-header">
    <h1>
      Perhitungan Metode Triple Exponential Smoothing
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
                  <th colspan="5" style="text-align: center;">Perhitungan dari s't sampai s'''t</th>
                </tr>
                <tr>
                  <th>Bulan</th>
                  <th>Data</th>
                  <th>S't</th>
                  <th>S''t</th>
                  <th>S'''t</th>
                </tr>
              </thead>
              <tbody>
              <?php for($i = 0; $i < count($data_produksi); $i++){ ?>
                <tr>
                  <td><?php echo $bulan[$i]."-".$tahun[$i] ?></td>
                  <td><?php echo $jumlah[$i]; ?></td>
                  <td><?php echo $s1[$i]; ?></td>
                  <td><?php echo $s2[$i]; ?></td>
                  <td><?php echo $s3[$i]; ?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            <br>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th colspan="5" style="text-align: center;">Perhitungan at, bt, ct dan peramalan (Ft + m)</th>
                </tr>
                <tr>
                  <th>at</th>
                  <th>bt</th>
                  <th>ct</th>
                  <th>Permalan (Ft + m)</th>
                </tr>
              </thead>
              <tbody>
              <?php for($i = 0; $i < count($data_produksi); $i++){ ?>
                <tr>
                  <td><?php echo $at[$i]; ?></td>
                  <td><?php echo $bt[$i]; ?></td>
                  <td><?php echo $ct[$i]; ?></td>
                  <td><?php echo $ft[$i]; ?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            <br>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th colspan="5" style="text-align: center;">Perhitungan MSE, dan MAPE</th>
                </tr>
                <tr>
                  <th>MSE</th>
                  <th>MAPE</th>
                </tr>
              </thead>
              <tbody>
              <?php for($i = 0; $i < count($data_produksi); $i++){ ?>
                <tr>
                  <td><?php echo $mse[$i]; ?></td>
                  <td><?php echo abs($mape[$i]); ?></td>
                </tr>
              <?php } ?>
                <tr>
                  <td colspan="1">TOTAL MAPE</td>
                  <td><?php echo $total_mape; ?></td>
                </tr>
                <tr>
                  <td colspan="1">NILAI MAPE</td>
                  <td><?php echo round($total_mape/count($data_produksi),2); ?>%</td>
                </tr>
              </tbody>
            </table>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th colspan="5" style="text-align: center;">Peramalan Bulan Berikutnya</th>
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