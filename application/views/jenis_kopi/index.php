
<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper" style="height: 900px">
  <section class="content-header">
    <h1>
      Data Jenis Kopi
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
              <a href="<?php echo site_url('Jenis_kopi/create'); ?>" type="button" class="btn btn-success">
                <i class="fa fa-plus"> Tambah Jenis Kopi</i>
              </a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-striped table-bordered" id="tabeluser">
              <thead>
                <tr>
                  <th>ID Jenis Kopi</th>
                  <th>Jenis Kopi</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($list as $key): ?>
                <tr>
                  <td><?php echo $key->id_kopi; ?></td>
                  <td><?php echo $key->jenis_kopi; ?></td>
                  <td style="text-align: center">
                  <?php echo form_open('Jenis_kopi/destroy/'.$key->id_kopi)  ?>
                    <a href="<?php echo site_url('Jenis_kopi/edit/'.$key->id_kopi); ?>" title="Edit Nama Kategori" class="btn btn-primary">
                      <i class="fa fa-pencil"></i>
                    </a>
                   
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-close"></i></button>
                    <?php echo form_close() ?>
                  </td>
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