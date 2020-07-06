<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper" style="height: 700px">
  <section class="content-header">
    <h1>
      Pilih Konstanta, Data awal dan Bulan yang ingin diramal
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
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php echo site_url('Produksi/export_laporan') ?>" method="post">
            <div class="box-body">
            <div class="form-group">
                <label>Data yang akan dicetak: </label>
                <select class="form-control select2" name="jenis_data">
                    <option value="permintaan">Data Permintaan</option>
                    <option value="produksi">Data Produksi</option>
                  <!-- <?php foreach ($jenis_kopi as $key): ?>
                    <option value="<?php echo $key->id_kopi; ?>"><?php echo $key->jenis_kopi; ?></option>
                  <?php endforeach ?> -->
                </select>
              </div>
            <div class="form-group">
                <label>Produksi dari Kopi Jenis : </label>
                <select class="form-control select2" name="id_kopi">
                    <option value="">semua jenis kopi</option>
                  <?php foreach ($jenis_kopi as $key): ?>
                    <option value="<?php echo $key->id_kopi; ?>"><?php echo $key->jenis_kopi; ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label>Tanggal Awal</label>
                <input type="text" name="tgl_awal" class="form-control pull-right" id="datepicker" placeholder="YYYY-MM-DD">
              </div>
              <div class="form-group">
                <label>Tanggal Akhir</label>
                <input type="text" name="tgl_akhir" class="form-control pull-right" id="datepicker2" placeholder="YYYY-MM-DD">
              </div>
            </div>
            <div class="box-footer">
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
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