<?php $this->load->view('includes/header'); ?>

        <!-- page content -->
        <div class="content-wrapper" style="height: 900px">
  <section class="content-header">
    <h1>
      Riwayat Admin
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
          <div class="box-body">
                    <table  class="table table-striped table-bordered" id="tabeluser">
                      <thead>
                        <tr>
                          <th width="20%">Waktu</th>
                          <th width="20%">User</th>
                          <th width="20%">User Level</th>
                          <th width="15%">Activity</th>
                          <th width="1%"></th>
                         
                          
                          
                        </tr>
                      </thead>

                      <tbody>
                      <?php foreach ($riwayat as $value) { ?>
                        <tr>
                      
                        <td><?php echo $value->log_time ?></td>
                        <td>
                          <?php foreach ($user as $k)
                          {
                            if($k->id_user == $value->log_user)
                            {?>
                            
                            <?php echo $k->username;
                            }
                        }
                          ?>
                          </td>
                        
                        <td>
                        <?php foreach ($user as $k)
                          {
                          foreach ($user_level as $l)
                          {
                            if(($value->log_user == $k->id_user) && ($k->id_user_level == $l->id_user_level))
                            {?>
                            
                            <?php echo $l->user_level;
                            }
                          }
                        }
                          ?>
                        </td>
                        <td><?php echo $value->log_desc ?></td>
                        <?php } ?>
                        </tr>
                      
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