

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>CodeInsect</b> Admin System | Version 1.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="<?php echo base_url(); ?>">CodeInsect</a>.</strong> All rights reserved.
    </footer>
    
    <!-- jQuery UI 1.11.2 -->
    <!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.2 JS -->
    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>assets/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/raphael/raphael.min.js')?>"></script>
    <script src="<?php echo base_url('assets/morris.js/morris.min.js')?>"></script>
   <!-- DataTables -->
<script src="<?php echo base_url();?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url('assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
  <script type="text/javascript">
  $(document).ready(function() {
      $('#tabeluser').DataTable();
  });
  </script>
  <script>
    $(function () {
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })

    $('#datepicker2').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })

    $('#datepicker3').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })

    //Date picker Bulan
    $('#datepickerbulan').datepicker({
      autoclose: true,
      format: 'M yyyy'
    })

    $('#datepickerbulan2').datepicker({
      autoclose: true,
      format: 'M yyyy'
    })
    $('#datepickerbulan3').datepicker({
      autoclose: true,
      format: 'M yyyy'
    })

    
  })</script>
    <script>
    $(function () {
    $('.select2').select2()
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
    </script>

    <script>
  $(function () {
    var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: <?php echo $response_databiasa; ?>,
      xkey: 'bulan',
      ykeys: ['data', 'data_peramalan'],
      labels: ['Data Real','Data Ramalan'],
      parseTime: false,
      xLabelAngle: 60,
      lineColors: ['#3c8dbc', 'red'],
      hideHover: 'auto'
    });
    
    var legendItem = $('<span></span>').text('Data Asli'+' ').css('color', '#3c8dbc');
    $('#legend').append(legendItem);
    legendItem = $('<br><span></span>').text('Data Ramalan'+' ').css('color', 'red');
    $('#legend').append(legendItem);
    
  });
</script>
  </body>
</html>