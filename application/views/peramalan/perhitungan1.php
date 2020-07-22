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
      <?php $error=$this->session->flashdata('message');
                  if($error) {?>
                  <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error; ?>                    
                  </div>
                  <?php }?> 
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
          <form role="form" action="<?php echo site_url('Peramalan/perhitungan2') ?>" method="post">
            <div class="box-body">
              <div class="form-group">
                <label>Bulan Awal</label>
                <input type="text" name="tgl_awal" class="form-control pull-right" id="datepickerbulan" placeholder="Masukkan bulan awal pengambilan data training">
              </div>
              <div class="form-group">
                <label>Bulan Yang ingin diramal</label>
                <input type="text" name="tgl_akhir" class="form-control pull-right" id="datepickerbulan2" placeholder="Masukkan bulan yang ingin diramal">
              </div>
              <!-- <div class="form-group">
                <label>Produk</label>
                <select class="form-control select2" name="produk">
                  <?php //foreach ($produk as $key): ?>
                    <option value="<?php //echo $key->id_produk; ?>"><?php //echo $key->nama_produk; ?></option>
                  <?php //endforeach ?>
                </select>
              </div> -->
              <div class="form-group">
                <label>Jenis Kopi</label>
                <select class="form-control select2" name="jenis_kopi">
                  <?php foreach ($jenis_kopi as $key): ?>
                    <option value="<?php echo $key->id_kopi; ?>"><?php echo $key->jenis_kopi; ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label>Konstanta</label>
                <select class="form-control select2" name="konstanta">
                  <option value="0.1">0.1</option>
                  <option value="0.2">0.2</option>
                  <option value="0.3">0.3</option>
                  <option value="0.4">0.4</option>
                  <option value="0.5">0.5</option>
                  <option value="0.6">0.6</option>
                  <option value="0.7">0.7</option>
                  <option value="0.8">0.8</option>
                  <option value="0.9">0.9</option>
                </select>
                <text>Nilai konstanta dapat ditentukan dengan cara melakukan percobaan berulang kali, dari hasil percobaan yang dilakukan  didapatkan  kesimpulan bahwa nilai konstanta yang optimal adalah = 0.1</text>
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