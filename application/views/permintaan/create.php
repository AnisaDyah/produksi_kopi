<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper" style="height: 610px">
  <section class="content-header">
    <h1>
      Tambah Data permintaan
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
            <div class="box-tools pull-right">
            
            </div>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php echo site_url('permintaan/store') ?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
              <div class="form-group">
                <label>tanggal</label>
                <input type="text" name="tanggal" class="form-control" id="datepicker" >
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input type="text" name="jumlah" class="form-control" >
              </div>
            
            <div class="form-group">
            <label> Jenis Kopi </label>
                  <select class="form-control" name ="id_kopi" id="privilege"> 
                  <option selected> --Pilih Jenis Kopi-- </option>
                  <?php foreach ($jenis_kopi as $k) { ?>
                  <option value="<?php echo $k->id_kopi?>"><?php echo $k->jenis_kopi?></option>
                <?php } ?>
                </select>
            </div>
            </div>
            <div class="box-footer">
              <div class="form-group">
              <a class="btn btn-info" href="<?php echo base_url() ?>permintaan">Kembali</a>
                <button type="submit" class="btn btn-primary">Ok</button>
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