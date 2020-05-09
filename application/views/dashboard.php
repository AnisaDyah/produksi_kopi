<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper" style="height: 900px">
  <section class="content-header">
    <h1>
      Welcome <?php echo $this->session->username ?> ;)
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
    <section class="content">
        <div class="row">

        <?php if($this->session->userdata('id_user_level') == '1'): ?>
        <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                <?php $user=$this->User_model->getTotal(); ?>
                  <h3><?php echo $user ?></h3>
                  <p>Total User</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url(); ?>User" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          <?php endif; ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                <?php $jenis_kopi=$this->Login_model->getTotal_kopi(); ?>
                  <h3><?php echo $jenis_kopi ?></h3>
                  <p>Jenis Kopi</p>
                </div>
                <div class="icon">
                  <i class="ion ion-coffee"></i>
                </div>
                <a href="<?php echo base_url(); ?>Jenis_kopi" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                <?php $produksi=$this->Login_model->get_produksi(); ?>
                  <h3><?php echo $produksi['jumlah_produksi']."Kg" ?></h3>
                  <p>Jumlah Produksi Kopi</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url(); ?>Produksi" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
           
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <?php $id_user=$this->session->userdata('id_user'); ?>
                  <?php $riwayat=$this->Login_model->get_riwayat($id_user); ?>
                  <h3><?php echo count($riwayat) ?></h3>
                  <p>Riwayat</p>
                </div>
                <div class="icon">
                  <i class="fa fa-history"></i>
                </div>
                <a href="<?php echo base_url(); ?>History" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div>
    </section>
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