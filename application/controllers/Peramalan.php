<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class Peramalan extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('peramalan_model');

    
    }

    public function index()
    {
        $data = [
            'jenis_kopi'=> $this->peramalan_model->get_jenis_kopi()
            
        ];
       // echo var_dump($list);
        $this->load->view('peramalan/perhitungan1', $data);
    }

    //fungsi perhitungan metode Triple Exponential Smoothing
    public function perhitungan2()
    {
        $id_kopi = $this->input->post('jenis_kopi');
        $konstanta = $this->input->post('konstanta');
        $tanggal_awal=date_format(date_create($this->input->post('tgl_awal')), 'Y-m-d');
        $bulan_awal=substr($tanggal_awal,5,2);
        $tahun_awal=substr($tanggal_awal,0,4);

        $tanggal_ramal=date_format(date_create($this->input->post('tgl_akhir')), 'Y-m-d');
        $bulan_ramal=substr($tanggal_ramal,5,2);
        $tahun_ramal=substr($tanggal_ramal,0,4);

        $bulan_akhir = $bulan_ramal-01;
        $tanggal_akhir=$tahun_ramal."-".$bulan_akhir."-30";

       //mengambil data produksi
       if(($tahun_ramal-$tahun_awal) == 0){

        $data_produksi= $this->peramalan_model->get_produksi_bybulan($tanggal_awal,$tanggal_akhir,$id_kopi);
        
        }else if(($tahun_ramal-$tahun_awal) > 0){

                for($i=$tahun_awal;$i<=$tahun_ramal;$i++){
                    $tahuns[$i]=(string)$i;
                    $data_pertahun[$i]= $this->peramalan_model->get_produksi_bytahun($tanggal_awal,$tanggal_akhir,$id_kopi,$tahuns[$i]);
                }
                $data_produksi=array_reduce($data_pertahun, 'array_merge', array());

        }else if(($tahun_ramal-$tahun_awal)< 0){
            $this->session->set_flashdata('message', 'Invalid Input');
            redirect('peramalan/');
        }
        
        
       //$data_produksi= $this->peramalan_model->get_produksi_bybulan($tanggal_awal,$tanggal_akhir,$id_kopi);
       $jenis_kopi=$this->peramalan_model->get_jeniskopi_bybulan($id_kopi);
       
       if($data_produksi != NULL){
       

       foreach($data_produksi as $key){
           $jumlah[]=$key->jumlah;
           $bulan[]=$key->bulan;
           $bulan_angka[]=$key->bulan_angka;
           $tahun[]=$key->tahun;
       }
       

       //mencari nilai s1
        $s1=array();
       for($i= 0; $i < count($data_produksi); $i++){
           if($i == 0){
           $s1[$i]=$jumlah[$i];
           }else{
            $s1[$i]=($konstanta * $jumlah[$i]) + ((1-$konstanta)*$s1[$i-1]);
           }
       }
       $data['s1']=$s1;

       //mencari nilai s2
       $s2=array();
       for($i= 0; $i < count($data_produksi); $i++){
           if($i == 0){
           $s2[$i]=$s1[$i];
           }else{
            $s2[$i]=($konstanta * $s1[$i]) + ((1-$konstanta)*$s2[$i-1]);
           }
       }
       $data['s2']=$s2;

       //mencari nilai s3
       $s3=array();
       for($i= 0; $i < count($data_produksi); $i++){
           if($i == 0){
           $s3[$i]=$s2[$i];
           }else{
            $s3[$i]=($konstanta * $s2[$i]) + ((1-$konstanta)*$s3[$i-1]);
           }
       }
       $data['s3']=$s3;

       //mencari nilai at
       $at=array();
       for($i= 0; $i < count($data_produksi); $i++){

           $at[$i]=(3*$s1[$i])-(3*$s2[$i])+$s3[$i];
           
       }
       $data['at']=$at;

       //mencari nilai bt
       $bt=array();
       $sum_s123=array();
       for($i= 0; $i < count($data_produksi); $i++){
           if($i == 0){
               $sum_s123[$i]=0;
               $bt[$i]=0;
           }else{
            $sum_s123[$i]=((6-(5*$konstanta))*$s1[$i])-((10-(8*$konstanta))*$s2[$i])+((4-(3*$konstanta))*$s3[$i]);
            $abs[$i]=abs($sum_s123[$i]);
            $bt[$i]=($konstanta*$abs[$i])/(2*(pow((1-$konstanta),2)));
            //$tess[$i]=($konstanta."*".$abs[$i])."/".(2*(pow((1-$konstanta),2)));
           }
       }
       $data['bt']=$bt;

       //mencari nilai ct
       $ct=array();
       for($i= 0; $i < count($data_produksi); $i++){
           if($i == 0){
               $ct[$i]=0;
           }else{
            $ct[$i]=($konstanta*($s1[$i]-(2*$s2[$i])+$s3[$i]))/(pow((1-$konstanta),2));
           }
       }
       $data['ct']=$ct;

       //mencari nilai ft
       $ft=array();
       $m=1;
       for($i= 0; $i < count($data_produksi); $i++){
        if($i == 0){
            $ft[$i]=$at[$i]+($bt[$i]*$m)+(0.5*$ct[$i]*pow($m,2));
        }else{
            $ft[$i]=$at[$i-1]+($bt[$i-1]*$m)+(0.5*$ct[$i-1]*pow($m,2));
        }
            
            //$tes[$i]=$at[$i]."+".($bt[$i]*$m)."+".(0.5*$ct[$i]*pow($m,2));
       }
       $data['ft']=$ft;


       
       $data['konstanta']=$konstanta;
       $data['jenis_kopi']=$jenis_kopi;
       $data['data_produksi']=$data_produksi;
       $data['jumlah']=$jumlah;
       $data['bulan']=$bulan;
       $data['tahun']=$tahun;

       //peramalan yang akan datang--------------------------------------------------------------------
       $ft_end=array();
       $bulan_ramalan=array();
        $kumpulanBulan=['January','February','March','April','May','June','July','August','September','October','November','December'];
       $jumlah_1=$at[count($data_produksi)-1]+($bt[count($data_produksi)-1]*$m)+(0.5*$ct[count($data_produksi)-1]*pow($m,2));
       $tahun_awal1=$tahun[count($data_produksi)-1];
       if(($tahun_ramal-$tahun_awal1) == 0){
                $jangka_waktu=$bulan_ramal-$bulan_angka[count($data_produksi)-1];
                for($i= 0 ; $i < $jangka_waktu ; $i++){
                    $bulan1[$i]=$bulan_angka[count($data_produksi)-1]+$i;
                    $bulan_ramalan[]=$kumpulanBulan[$bulan1[$i]];
                    $tahun_ramalan[]=$tahun_ramal;
                }
        }else if(($tahun_ramal-$tahun_awal1) == 1){
                $jangka_waktu=($bulan_ramal+(12-($bulan_angka[count($data_produksi)-1])));
                for($i= 0 ; $i < $jangka_waktu ; $i++){
                    $bulan1[$i]=$bulan_angka[count($data_produksi)-1]+$i;
                    $x=(12-$bulan_angka[count($data_produksi)-1]);
                    if($i < $x){
                        $tahun_ramalan[]=$tahun[count($data_produksi)-1];
                        $bulan_ramalan[]=$kumpulanBulan[$bulan1[$i]];
                    }else{
                        $bulan1[$i]=$i-$x;
                        $tahun_ramalan[]=$tahun_ramal;
                        $bulan_ramalan[]=$kumpulanBulan[$bulan1[$i]];
                    }
                    
                }
        }else if(($tahun_ramal-$tahun_awal)< 0){
            $this->session->set_flashdata('message', 'Invalid Input');
            redirect('peramalan/');
        }
        //echo var_dump($bulan_ramal-1);
       $s1_end=array();
       for($i= 0; $i < $jangka_waktu ; $i++){
            if($i == 0){
                //s1
                $s1_end[$i]=($konstanta * $jumlah_1) + ((1-$konstanta)*$s1[count($data_produksi)-1]);
                //s2
                $s2_end[$i]=($konstanta * $s1_end[$i]) + ((1-$konstanta)*$s2[count($data_produksi)-1]);
                //s3
                $s3_end[$i]=($konstanta * $s2_end[$i]) + ((1-$konstanta)*$s3[count($data_produksi)-1]);
                //at
                $at_end[$i]=(3*$s1_end[$i])-(3*$s2_end[$i])+$s3_end[$i];
                //bt
                $sum_s123_end[$i]=((6-(5*$konstanta))*$s1_end[$i])-((10-(8*$konstanta))*$s2_end[$i])+((4-(3*$konstanta))*$s3_end[$i]);
                $abs_end[$i]=abs($sum_s123_end[$i]);
                $bt_end[$i]=($konstanta*$abs_end[$i])/(2*(pow((1-$konstanta),2)));
                //ct
                $ct_end[$i]=($konstanta*($s1_end[$i]-(2*$s2_end[$i])+$s3_end[$i]))/(pow((1-$konstanta),2));
                //ft
                $ft_end[$i]=$at_end[$i]+($bt_end[$i]*$m)+(0.5*$ct_end[$i]*pow($m,2));
                
            }else{
                
                //s1
                $s1_end[$i]=($konstanta * $ft_end[$i-1]) + ((1-$konstanta)*$s1_end[$i-1]);
                //s2
                $s2_end[$i]=($konstanta * $s1_end[$i]) + ((1-$konstanta)*$s2_end[$i-1]);
                //s3
                $s3_end[$i]=($konstanta * $s2_end[$i]) + ((1-$konstanta)*$s3_end[$i-1]);
                //at
                $at_end[$i]=(3*$s1_end[$i])-(3*$s2_end[$i])+$s3_end[$i];
                //bt
                $sum_s123_end[$i]=((6-(5*$konstanta))*$s1_end[$i])-((10-(8*$konstanta))*$s2_end[$i])+((4-(3*$konstanta))*$s3_end[$i]);
                $abs_end[$i]=abs($sum_s123_end[$i]);
                $bt_end[$i]=($konstanta*$abs_end[$i])/(2*(pow((1-$konstanta),2)));
                //ct
                $ct_end[$i]=($konstanta*($s1_end[$i]-(2*$s2_end[$i])+$s3_end[$i]))/(pow((1-$konstanta),2));
                //ft
                $ft_end[$i]=$at_end[$i]+($bt_end[$i]*$m)+(0.5*$ct_end[$i]*pow($m,2));
                //$bulan[$i]=$bulan[$i]."-".$tahun[$i];
                
            }
        }
        $data['ft_end']=$ft_end;
        $data['bulan_ramalan']=$bulan_ramalan;
        $data['tahun_ramalan']=$tahun_ramalan;
        $data['jangka_waktu']=$jangka_waktu;
       
        

       

       //MAPE dan MSE
       $mape=array();
       $mse=array();
       $total_mape=0;
       $total_mse=0;
       for ($i=0; $i < count($data_produksi); $i++) {
           if($ft[$i] == 0){
               $mape[$i]=0;
               $mse[$i]=0;
           }else{
           $mape[$i]=(($jumlah[$i]-$ft[$i])/$jumlah[$i])*100;
           $mse[$i]=($jumlah[$i]-$ft[$i])*($jumlah[$i]-$ft[$i]);
           }
           $total_mape=$total_mape+abs($mape[$i]);
           $total_mse=$total_mse+$mse[$i];
       }
       
           $data['mape']=$mape;
           $data['mse']=$mse;
           $data['total_mape']=abs($total_mape);
           $data['total_mse']=$total_mse;

           //grafik
           $response_databiasa = array();
           for($i=count($data_produksi) ; $i<count($data_produksi)+$jangka_waktu ; $i++){
                $ft[$i]=$ft_end[$i-count($data_produksi)];
                $bulan[$i]=$bulan_ramalan[$i-count($data_produksi)];
                $tahun[$i]=$tahun_ramalan[$i-count($data_produksi)];
            }
           for ($i=0; $i < count($ft); $i++) {
            array_push($response_databiasa, array(
				"bulan"=>$bulan[$i]."-".$tahun[$i],
				"data"=>$jumlah[$i],
				"data_peramalan"=>round($ft[$i],2),
				)
            );
        }
        $data['response_databiasa']=json_encode($response_databiasa);
        echo var_dump($total_mape);        
        //echo var_dump($tahun);
        helper_log("peramalan", "melakukan peramalan dengan perhitungan");
        $this->load->view('peramalan/perhitungan2', $data);
    }else{
        $this->session->set_flashdata('message', 'data training tidak ditemukan');
        redirect('peramalan');
    }

    }

    public function peramalan1()
    {
        $data = [
            'jenis_kopi'=> $this->peramalan_model->get_jenis_kopi()
            
        ];
       // echo var_dump($list);
        $this->load->view('peramalan/peramalan1', $data);
    }

    //fungsi perhitungan metode Triple Exponential Smoothing
    public function peramalan2()
    {
        $id_kopi = $this->input->post('jenis_kopi');
        $konstanta = 0.1;

        $tanggal_ramal=date_format(date_create($this->input->post('tgl_ramal')), 'Y-m-d');
        $bulan_ramal=substr($tanggal_ramal,5,2);
        $tahun_ramal=substr($tanggal_ramal,0,4);

       //mengambil data produksi
       for($i=2018;$i<=$tahun_ramal;$i++){
        $tahuns[$i]=(string)$i;
        $data_pertahun[$i]= $this->peramalan_model->get_produksi_for_peramalan_bytahun($id_kopi,$tahuns[$i]);
        }
        $data_produksi=array_reduce($data_pertahun, 'array_merge', array());
        foreach($data_produksi as $key){
            $jumlah[]=$key->jumlah;
            $bulan[]=$key->bulan;
            $bulan_angka[]=$key->bulan_angka;
            $tahun[]=$key->tahun;
        }
       //$data_produksi= $this->peramalan_model->get_produksi_for_peramalan($id_kopi);
       $jenis_kopi=$this->peramalan_model->get_jeniskopi_bybulan($id_kopi);
       $tahun_data=$tahun_ramal-$tahun[count($data_produksi)-1];
       if($tahun_data > 0){

       //mencari nilai s1
        $s1=array();
       for($i= 0; $i < count($data_produksi); $i++){
           if($i == 0){
           $s1[$i]=$jumlah[$i];
           }else{
            $s1[$i]=($konstanta * $jumlah[$i]) + ((1-$konstanta)*$s1[$i-1]);
           }
       }
       $data['s1']=$s1;

       //mencari nilai s2
       $s2=array();
       for($i= 0; $i < count($data_produksi); $i++){
           if($i == 0){
           $s2[$i]=$s1[$i];
           }else{
            $s2[$i]=($konstanta * $s1[$i]) + ((1-$konstanta)*$s2[$i-1]);
           }
       }
       $data['s2']=$s2;

       //mencari nilai s3
       $s3=array();
       for($i= 0; $i < count($data_produksi); $i++){
           if($i == 0){
           $s3[$i]=$s2[$i];
           }else{
            $s3[$i]=($konstanta * $s2[$i]) + ((1-$konstanta)*$s3[$i-1]);
           }
       }
       $data['s3']=$s3;

       //mencari nilai at
       $at=array();
       for($i= 0; $i < count($data_produksi); $i++){

           $at[$i]=(3*$s1[$i])-(3*$s2[$i])+$s3[$i];
           
       }
       $data['at']=$at;

       //mencari nilai bt
       $bt=array();
       $sum_s123=array();
       for($i= 0; $i < count($data_produksi); $i++){
           if($i == 0){
               $sum_s123[$i]=0;
               $bt[$i]=0;
           }else{
            $sum_s123[$i]=((6-(5*$konstanta))*$s1[$i])-((10-(8*$konstanta))*$s2[$i])+((4-(3*$konstanta))*$s3[$i]);
            $abs[$i]=abs($sum_s123[$i]);
            $bt[$i]=($konstanta*$abs[$i])/(2*(pow((1-$konstanta),2)));
            //$tess[$i]=($konstanta."*".$abs[$i])."/".(2*(pow((1-$konstanta),2)));
           }
       }
       $data['bt']=$bt;

       //mencari nilai ct
       $ct=array();
       for($i= 0; $i < count($data_produksi); $i++){
           if($i == 0){
               $ct[$i]=0;
           }else{
            $ct[$i]=($konstanta*($s1[$i]-(2*$s2[$i])+$s3[$i]))/(pow((1-$konstanta),2));
           }
       }
       $data['ct']=$ct;

       //mencari nilai ft
       $ft=array();
       $m=1;
       for($i= 0; $i < count($data_produksi); $i++){
        if($i == 0){
            $ft[$i]=$at[$i]+($bt[$i]*$m)+(0.5*$ct[$i]*pow($m,2));
        }else{
            $ft[$i]=$at[$i-1]+($bt[$i-1]*$m)+(0.5*$ct[$i-1]*pow($m,2));
        }
            
            //$tes[$i]=$at[$i]."+".($bt[$i]*$m)."+".(0.5*$ct[$i]*pow($m,2));
       }
       $data['ft']=$ft;


       
       $data['konstanta']=$konstanta;
       $data['jenis_kopi']=$jenis_kopi;
       $data['data_produksi']=$data_produksi;
       $data['jumlah']=$jumlah;
       $data['bulan']=$bulan;
       $data['tahun']=$tahun;

       //peramalan yang akan datang--------------------------------------------------------------------
       $ft_end=array();
       //$jangka_waktu=$bulan_ramal-$bulan_angka[count($data_produksi)-1];
       $jumlah_1=$at[count($data_produksi)-1]+($bt[count($data_produksi)-1]*$m)+(0.5*$ct[count($data_produksi)-1]*pow($m,2));
       
       $bulan_ramalan=array();
       $kumpulanBulan=['January','February','March','April','May','June','July','August','September','October','November','December'];
      $jumlah_1=$at[count($data_produksi)-1]+($bt[count($data_produksi)-1]*$m)+(0.5*$ct[count($data_produksi)-1]*pow($m,2));
      $tahun_awal=$tahun[count($data_produksi)-1];
      if(($tahun_ramal-$tahun_awal) == 0){
               $jangka_waktu=$bulan_ramal-$bulan_angka[count($data_produksi)-1];
               for($i= 0 ; $i < $jangka_waktu ; $i++){
                   $bulan[$i]=$bulan_angka[count($data_produksi)-1]+$i;
                   $bulan_ramalan[]=$kumpulanBulan[$bulan[$i]];
                   $tahun_ramalan[]=$tahun_ramal;
               }
       }else if(($tahun_ramal-$tahun_awal) == 1){
               $jangka_waktu=($bulan_ramal+(12-($bulan_angka[count($data_produksi)-1])));
               for($i= 0 ; $i < $jangka_waktu ; $i++){
                   $bulan1[$i]=$bulan_angka[count($data_produksi)-1]+$i;
                   $x=(12-$bulan_angka[count($data_produksi)-1]);
                   if($i < $x){
                       $tahun_ramalan[]=$tahun[count($data_produksi)-1];
                       $bulan_ramalan[]=$kumpulanBulan[$bulan1[$i]];
                   }else{
                       $bulan1[$i]=$i-$x;
                       $tahun_ramalan[]=$tahun_ramal;
                       $bulan_ramalan[]=$kumpulanBulan[$bulan1[$i]];
                   }
                   
               }
       }else if(($tahun_ramal-$tahun_awal)  == 2){
        $jangka_waktu=($bulan_ramal+(12-($bulan_angka[count($data_produksi)-1])));
        for($i= 0 ; $i < $jangka_waktu ; $i++){
            $bulan1[$i]=$bulan_angka[count($data_produksi)-1]+$i;
            $x=(12-$bulan_angka[count($data_produksi)-1]);
            if($i < $x){
                $tahun_ramalan[]=$tahun[count($data_produksi)-1];
                $bulan_ramalan[]=$kumpulanBulan[$bulan1[$i]];
            }else{
                $bulan1[$i]=$i-$x;
                $tahun_ramalan[]=$tahun_ramal;
                $bulan_ramalan[]=$kumpulanBulan[$bulan1[$i]];
            }
            
        }
       }else if(($tahun_ramal-$tahun_awal)< 0){
           $this->session->set_flashdata('message', 'Invalid Input');
           redirect('peramalan/');
       }
       
       //echo var_dump($bulan1);
       $s1_end=array();
       for($i= 0; $i < $jangka_waktu ; $i++){
            if($i == 0){
                //s1
                $s1_end[$i]=($konstanta * $jumlah_1) + ((1-$konstanta)*$s1[count($data_produksi)-1]);
                //s2
                $s2_end[$i]=($konstanta * $s1_end[$i]) + ((1-$konstanta)*$s2[count($data_produksi)-1]);
                //s3
                $s3_end[$i]=($konstanta * $s2_end[$i]) + ((1-$konstanta)*$s3[count($data_produksi)-1]);
                //at
                $at_end[$i]=(3*$s1_end[$i])-(3*$s2_end[$i])+$s3_end[$i];
                //bt
                $sum_s123_end[$i]=((6-(5*$konstanta))*$s1_end[$i])-((10-(8*$konstanta))*$s2_end[$i])+((4-(3*$konstanta))*$s3_end[$i]);
                $abs_end[$i]=abs($sum_s123_end[$i]);
                $bt_end[$i]=($konstanta*$abs_end[$i])/(2*(pow((1-$konstanta),2)));
                //ct
                $ct_end[$i]=($konstanta*($s1_end[$i]-(2*$s2_end[$i])+$s3_end[$i]))/(pow((1-$konstanta),2));
                //ft
                $ft_end[$i]=$at_end[$i]+($bt_end[$i]*$m)+(0.5*$ct_end[$i]*pow($m,2));
                
            }else{
                
                //s1
                $s1_end[$i]=($konstanta * $ft_end[$i-1]) + ((1-$konstanta)*$s1_end[$i-1]);
                //s2
                $s2_end[$i]=($konstanta * $s1_end[$i]) + ((1-$konstanta)*$s2_end[$i-1]);
                //s3
                $s3_end[$i]=($konstanta * $s2_end[$i]) + ((1-$konstanta)*$s3_end[$i-1]);
                //at
                $at_end[$i]=(3*$s1_end[$i])-(3*$s2_end[$i])+$s3_end[$i];
                //bt
                $sum_s123_end[$i]=((6-(5*$konstanta))*$s1_end[$i])-((10-(8*$konstanta))*$s2_end[$i])+((4-(3*$konstanta))*$s3_end[$i]);
                $abs_end[$i]=abs($sum_s123_end[$i]);
                $bt_end[$i]=($konstanta*$abs_end[$i])/(2*(pow((1-$konstanta),2)));
                //ct
                $ct_end[$i]=($konstanta*($s1_end[$i]-(2*$s2_end[$i])+$s3_end[$i]))/(pow((1-$konstanta),2));
                //ft
                $ft_end[$i]=$at_end[$i]+($bt_end[$i]*$m)+(0.5*$ct_end[$i]*pow($m,2));
            }
        }
        $data['ft_end']=$ft_end;
        
        
        $data['tahun_ramalan']=$tahun_ramalan;
        $data['bulan_ramalan']=$bulan_ramalan;
        $data['jangka_waktu']=$jangka_waktu;
       


       //echo var_dump($data_produksi);

      

           //grafik
           $response_databiasa = array();
           for ($i=0; $i < $jangka_waktu; $i++) {
            array_push($response_databiasa, array(
				"bulan"=>$bulan_ramalan[$i]."-".$tahun[count($data_produksi)-1],
				"data_peramalan"=>round($ft_end[$i],2),
				)
            );
        }
        //echo var_dump($ft_end);
        $data['response_databiasa']=json_encode($response_databiasa);
        //echo var_dump($response_databiasa);
        helper_log("peramalan", "melakukan peramalan tanpa perhitungan");
        $this->load->view('peramalan/peramalan2', $data);
    }else{
        $this->session->set_flashdata('message', 'data tidak ditemukan');
        redirect('peramalan/peramalan1');
        }
    }
    
   

}
?>