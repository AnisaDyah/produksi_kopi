<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper" style="height: 610px">
  <section class="content-header">
    <h1>
      Edit Data Permintaan
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
            
            </div>
          </div>
          <!-- /.box-header -->
         
            <div class="box-body">
            <?php echo form_open('permintaan/update/'.$permintaan->id_permintaan); ?>
             <?php echo form_hidden('id_permintaan', $permintaan->id_permintaan) ?>
              <div class="form-group">
                <label>Tanggal</label>
                <input type="text" name="tanggal" value="<?php echo $permintaan->tanggal; ?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input type="text" name="jumlah" value="<?php echo $permintaan->jumlah; ?>" class="form-control" required>
              </div>
              <div class="form-group">
          <label> Jenis Kopi </label>
              <select class="form-control" name ="id_kopi" id="id_kopi"> 
                <option selected>
                <?php
                  foreach($jenis_kopi as $k) {
                    $s='';
                      if($k->id_kopi == $permintaan->id_kopi)
                      { $s='selected'; }
                ?>
                 <option value="<?php echo $k->id_kopi ?>" <?php echo $s ?>>
                    <?php echo $k->jenis_kopi ?>
                  </option>
                  <?php } ?>
            </select>
        </div>
            </div>
            <div class="box-footer">
              <div class="form-group">
              <a class="btn btn-info" href="<?php echo base_url('permintaan/index') ?>">Kembali</a>
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