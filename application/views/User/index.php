<?php $this->load->view('includes/header'); ?>

     <div class="content-wrapper" style="height: 900px">
  <section class="content-header">
    <h1>
      Data User
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
              <a href="<?php echo site_url('User/Create'); ?>" type="button" class="btn btn-success">
                <i class="fa fa-plus"> Tambah User Baru</i>
              </a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th width="20%">ID User</th>
                          <th width="20%">email</th>
                          <th width="15%">Username</th>
                          <th width="10%">Password</th>
                          <th width="10%">Privillage</th>
                          <th width="15%">
                          
                          </th>
                          
                        </tr>
                      </thead>

                      <tbody>
                      <?php foreach ($list as $data => $value) { ?>
                        <tr>
                        <td><?php echo $value->id_user ?></td>
                        <td><?php echo $value->email ?></td>
                        <td><?php echo $value->username ?></td>
                        <td><?php echo $value->password ?></td>
                        
                        <td>
                          <?php foreach ($user_level as $k)
                          {
                            if($k->id_user_level == $value->id_user_level)
                            {?>
                           
                            <?php echo $k->user_level;
                            }
                          }
                          ?>
                        </td>
                       

                          <td>
                              <?php echo form_open('User/destroy/'.$value->id_user)  ?>
                              <a class="btn btn-info" href="<?php echo base_url('User/edit/'.$value->id_user) ?>">
                              <i class="fa fa-pencil"></i>
                              </a>
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-close"></i></button>
                              <?php echo form_close() ?>
                          </td>
                        </tr>
                      <?php } ?>
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