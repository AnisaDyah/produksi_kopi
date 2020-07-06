<?php 
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=LaporanPermintaanKopi.xls");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table border="1">
	  <thead>
      <tr>
          <th colspan="3"> <b>Data Permintaan Kopi</b></th>
          </tr>
	    <tr>
          <th>Jenis Kopi</th>
          <th>Tanggal</th>
          <th>Jumlah</th>
	    </tr>
	  </thead>
	  <tbody>
	  <?php foreach ($permintaan as $key): ?>
        <tr>
          <td>
                          <?php foreach ($jenis_kopi2 as $k)
                          {
                            if($k->id_kopi == $key->id_kopi)
                            {?>
                            <?php echo $k->jenis_kopi;
                            }
                          }
                          ?>
                        </td>
          <td><?php echo "'".date_format(date_create($key->tanggal), "d F Y"); ?></td>
          <td><?php echo $key->jumlah; ?></td>
          
        </tr>
      <?php endforeach ?>
	  </tbody>
	</table>
</body>
</html>