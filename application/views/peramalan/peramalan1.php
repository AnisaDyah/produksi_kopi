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
      <?php $error=$this->session->flashdata('message');
                  if($error) {?>
                  <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error; ?>                    
                  </div>
                  <?php }?> 
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              &nbsp;
            </h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php echo site_url('Peramalan/peramalan2') ?>" method="post">
            <div class="box-body">
              <div class="form-group">
                <label>Bulan Yang ingin diramal</label>
                <input type="text" name="tgl_ramal" class="form-control pull-right" id="datepickerbulan2" placeholder="Masukkan bulan yang ingin diramal" required>
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