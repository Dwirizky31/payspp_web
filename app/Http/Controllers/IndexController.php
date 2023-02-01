<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller{
    public function getIndex(){
		if(empty(Session::get('nama'))){
			return view('beranda');
		}else{
			$totalSiswa = DB::select("SELECT COUNT(id) AS total FROM siswa");
			$totalKelas = DB::select("SELECT COUNT(id) AS total FROM kelas");
			$totalPetugas = DB::select("SELECT COUNT(id) AS total FROM users");
			$totalPembayaran = DB::select("SELECT COUNT(id) AS total FROM pembayaran");
			$semuaPembayaran = DB::select("SELECT * FROM pembayaran ORDER BY id DESC LIMIT 6");
			$getDataView = json_decode(json_encode($semuaPembayaran), true);
			return view('index')->with("datapembayaran", $semuaPembayaran)->withTsiswa($totalSiswa[0]->total)->withTkelas($totalKelas[0]->total)->withTpetugas($totalPetugas[0]->total)->withTbayar($totalPembayaran[0]->total);
		}
    }
    public function getDataMaster(){
		if(empty(Session::get('nama'))){
			return view('beranda');
		}else{
			$tMaster = $_POST['tMaster'];
			$limit = $_POST['length'];
			$start = $_POST['start'];
			$dir = $_POST['order']['0']['dir'];
			$order = $_POST['order']['0']['column'];
			$search = $_POST['search']['value'];
			$where = "";
			$kolom = "nama";
			
			$getDataQueryTotal = DB::select("SELECT COUNT(id) AS total FROM {$tMaster}");
			
			$totalFiltered = $getDataQueryTotal[0]->total; 
			$totalData = $getDataQueryTotal[0]->total; 
			if($getDataQueryTotal[0]->total == 0){
				$data[] = array(
					"nama" => "Tidak Ada Data"
				);
			}else{
				if($tMaster == "pembayaran"){
					$aksi = "<a href = 'javascript:void(0);' data-id='{\$getDataView['id']}' data-menu='{\$tMaster}' data-index='{\$no}' data-aksi='hapus' class='hapus btn btn-danger btn-sm ml-2'><i class='fa fa-trash'></i></a>";
				}else{
					$aksi = "<a href = 'javascript:void(0);' class='btn btn-primary btn-sm ml-2 tambah' data-menu='{\$tMaster}' data-index='{\$no}' data-aksi='Ubah' data-id='{\$getDataView['id']}'><i class='fa fa-edit'></i></a> <a href = 'javascript:void(0);' data-menu='{\$tMaster}' data-id='{\$getDataView['id']}' data-index='{\$no}' data-aksi='hapus' class='hapus btn btn-danger btn-sm ml-2'><i class='fa fa-trash'></i></a>";
				}
				
				$dataKolom = "";
				$getDataViewColumn = DB::select("SHOW COLUMNS FROM {$tMaster}");
				$getDataKolom = json_decode(json_encode($getDataViewColumn), true);
				foreach($getDataKolom AS $namaKolom){
					$dataKolom .= "\"{$namaKolom['Field']}\" => \$getDataView['".$namaKolom['Field']."'],";
				}
				$genData = "\$data[] = array(\"no\" => \$no, {$dataKolom} \"aksi\" => \"{$aksi}\");";				
				if(!empty($search)){
					$where = "WHERE {$kolom} LIKE '%{$search}%' ";
				}
				$getDataNow = DB::select("SELECT * FROM {$tMaster} {$where} ORDER BY {$order} {$dir} LIMIT {$start},{$limit}");
				$getDataNowArray = json_decode(json_encode($getDataNow), true);
				
				$data = [];
				$no = 1;
				foreach($getDataNowArray AS $getDataView){
					eval($genData);
					$no++;
				}
			}
			
			return json_encode(array("draw" => intval($_POST['draw']),"recordsTotal" => intval($totalData),"recordsFiltered" => intval($totalFiltered),"data" => $data));
		}
    }
    public function getDataUbah(){
		if(empty(Session::get('nama'))){
			return view('beranda');
		}else{
			$tMaster = addslashes($_POST['tMaster']);
			$id = addslashes(@$_POST['id']);
			
			$dataKolom = "";
			$getDataViewColumn = DB::select("SHOW COLUMNS FROM {$tMaster}");
			$getDataKolom = json_decode(json_encode($getDataViewColumn), true);
			foreach($getDataKolom AS $namaKolom){
				$dataKolom .= "\"{$namaKolom['Field']}\" => \$getDataView['".$namaKolom['Field']."'],";
			}
			$aksi = "";
			$genData = "\$data[] = array({$dataKolom} \"aksi\" => \"{$aksi}\");";
			$getDataNow = DB::select("SELECT * FROM {$tMaster} WHERE id = '{$id}' ");
			$getDataNowArray = json_decode(json_encode($getDataNow), true);
			
			$data = [];
			$no = 1;
			foreach($getDataNowArray AS $getDataView){
				eval($genData);
				$no++;
			}
			return json_encode($data);
		}
    }
    public function getDataSiswa(){
		if(empty(Session::get('nama'))){
			return view('beranda');
		}else{
			$getDataNow = DB::select("SELECT nama FROM siswa");
			$getDataNowPetugas = DB::select("SELECT nama FROM users");
			$getDataNowArray = json_decode(json_encode($getDataNow), true);
			$getDataNowArrayPetugas = json_decode(json_encode($getDataNowPetugas), true);
			$siswa = "<option value=\"kosong\">Pilih Nama Siswa Disini</option>";
			$petugas = "<option value=\"kosong\">Pilih Nama Petugas Disini</option>";
			foreach($getDataNowArray AS $getDataView){
				$siswa .= "<option>{$getDataView['nama']}</option>";
			}
			foreach($getDataNowArrayPetugas AS $getDataViewPetugas){
				$petugas .= "<option>{$getDataViewPetugas['nama']}</option>";
			}
			return json_encode(array("siswa" => $siswa, "petugas" => $petugas));
		}
    }
    public function getDataKelas(){
		if(empty(Session::get('nama'))){
			return view('beranda');
		}else{
			$kelas = "<option value=\"-\">Pilih Data Kelas Disini</option>";
			$spp = "<option value=\"-\">Pilih Data Kelas Disini</option>";
			
			$getDataNowKelas = DB::select("SELECT nama FROM kelas");
			$getDataK = json_decode(json_encode($getDataNowKelas), true);
			foreach($getDataK AS $getKelas){
				$kelas .= "<option>{$getKelas['nama']}</option>";
			}
			
			$getDataNowSpp = DB::select("SELECT nominal FROM spp");
			$getDataS = json_decode(json_encode($getDataNowSpp), true);
			foreach($getDataS AS $getSpp){
				$spp .= "<option>{$getSpp['nominal']}</option>";
			}
			return json_encode(array("kelas" => $kelas,"spp" => $spp));
		}
    }
    public function getDataUsers(){
		if(empty(Session::get('nama'))){
			return view('beranda');
		}else{
			$user = Session::get('username');
			$getDataNowPetugas = DB::select("SELECT * FROM users WHERE username = '{$user}' ");
			$getData = json_decode(json_encode($getDataNowPetugas), true);
			return $getData;
		}
    }
    public function getDataHapus(){
		if(empty(Session::get('nama'))){
			return view('beranda');
		}else{
			$tMaster = addslashes($_POST['tMaster']);
			$id = addslashes(@$_POST['id']);
			
			$getDataNowPetugas = DB::table($tMaster)->where("id",$id)->delete();
			
			return json_encode(array("success" => true, "msg" => "Data berhasil dihapus"));
		}
    }
    public function getDataSimpan(){
		if(empty(Session::get('nama'))){
			return view('beranda');
		}else{
			$tMaster = addslashes($_POST['tMaster']);
			$id = addslashes(@$_POST['id']);
			
			$queryNameKey = "";
			$queryNameKeyVal = "";
			$updateNow = "";
			
			foreach($_POST as $key => $value){
				if($key == "tMaster"){
					continue;
				}
				if($key == "dibuat"){
					$value = date("Y-m-d h:i:s");
				}
				$queryNameKey .= "".addslashes($key).", ";
				$queryNameKeyVal .= "'".addslashes($value)."', ";
				$updateNow .=  $key." = '".addslashes($value)."', ";
			}
			$updateNow = rtrim($updateNow,", ");
			$queryNameKey = "INSERT INTO {$tMaster}(".rtrim($queryNameKey,", ").") VALUES(".rtrim($queryNameKeyVal,", ").") ON DUPLICATE KEY UPDATE {$updateNow}";
			$insNow = DB::insert($queryNameKey);
			Session::put('nama', $_POST['nama']);
			return json_encode(array("success" => true, "msg" => "Data berhasil disimpan"));
		}
    }
    public function getDataLaporan(){
		if(empty(Session::get('nama'))){
			return view('beranda');
		}else{
			$laporanHtml = "
				<div class=\"laporan\">
					<div class=\"print ml-3\" style=\"position:absolute;\">
						<button type=\"button\" class=\"btn btn-primary\"  onClick=\"window.print();\"><i class=\"fa fa-print\"></i> Print</button>
					</div>
					<table width=\"100%\">
						<tr style=\"border-bottom:1px solid #000;\">
							<td colspan=\"2\" align=\"center\">
								<div class=\"hed d-flex justify-content-center align-items-center mb-3\">
									<div class=\"hed1 mr-3\">
										<img src=\"./assetslog/images/logo2.png\" height=\"90px\" width=\"90px\" />
									</div>
									<div class=\"hed2\" style=\"line-height:10px;\">
										<h4 class=\"p-0 m-0\">Madrasah Ibtidaiyah Al-Istiqomah</h4>
										<h6 class=\"p-0 m-0\">Jl. Setia Budi 2 Kp. Bulak Rt/Rw 005/004 Desa Karangasih</h6>
										<h6 class=\"p-0 m-0\">Kecamatan Cikarang Utara Kabupaten Bekasi Jawa Barat 17530</h6>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan=\"2\">&nbsp;</td>
						</tr>
						<tr>
							<td colspan=\"2\" align=\"center\"><u><b>Laporan Transaksi Pembayaran SPP</b></u></td>
						</tr>
						<tr>
							<td colspan=\"2\">&nbsp;</td>
						</tr>
						<tr>
							<td colspan=\"2\">
								<table width=\"97%\" border=\"1\" class=\"ml-3 mr-3\">
									<thead>
										<tr>
											<th style=\"text-align:center;background:#f1ffa3;height:35px;\">No</th>
											<th style=\"text-align:center;background:#f1ffa3;\">Nama Siswa</th>
											<th style=\"text-align:center;background:#f1ffa3;\">Bulan</th>
											<th style=\"text-align:center;background:#f1ffa3;\">Tanggal Pembayaran</th>
											<th style=\"text-align:center;background:#f1ffa3;\">Nominal</th>
											<th style=\"text-align:center;background:#f1ffa3;\">Petugas</th>
										</tr>
									</thead>
									<tbody>";
			
			$getDataPembayaran = DB::select("SELECT * FROM pembayaran");
			$getDataPembayaranNow = json_decode(json_encode($getDataPembayaran), true);
			$no=1;
			foreach($getDataPembayaranNow AS $dataPembayaran){
				$laporanHtml .= "
					<tr>
						<td align=\"center\">{$no}</td>
						<td>{$dataPembayaran['nama']}</td>
						<td align=\"center\">{$dataPembayaran['bulan']}</td>
						<td>{$dataPembayaran['dibuat']}</td>
						<td align=\"center\">{$dataPembayaran['jumlah']}</td>
						<td>{$dataPembayaran['petugas']}</td>
					</tr>
				";
				$no++;
			}
			$laporanHtml .= "
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan=\"2\">&nbsp;</td>
						</tr>
					</table>
				</div>
			";
			return json_encode(array("success" => true, "laporan" => $laporanHtml));
		}
    }
}