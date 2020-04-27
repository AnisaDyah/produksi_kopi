<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Edit Kategori
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
            
            </h3>
          </div>
          <!-- /.box-header -->
         
            <div class="box-body">
            <?php echo form_open('Jenis_kopi/update/'.$jenis_kopi->id_kopi); ?>
             <?php echo form_hidden('id_kopi', $jenis_kopi->id_kopi) ?>
              <div class="form-group">
                <label>Jenis Kopi</label>
                <input type="text" name="jenis_kopi" value="<?php echo $jenis_kopi->jenis_kopi; ?>" class="form-control" required>
              </div>
            </div>
            <div class="box-footer">
              <div class="form-group">
              <a class="btn btn-info" href="<?php echo base_url('Jenis_kopi/index') ?>">Kembali</a>
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