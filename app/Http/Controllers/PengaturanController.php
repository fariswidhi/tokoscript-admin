<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi as Table;
use App\Vendor;
use App\Kategori;
use App\Tag;
use App\VendorPosition;

use App\ProdukTag;
use App\Mutasi;
use App\SettingWeb;

class PengaturanController extends Controller
{

	public function pengaturan(Request $request){
		if ($request->isMethod("POST")) {
			$name = $request->nama_web;
			$logo = $request->file("logo");
			$komisi = $request->komisi;


			$setting = SettingWeb::find(1);
			$setting->nama_web = $name;
			if (!empty($logo)) {
				# code...
				$ext = $logo->getClientOriginalExtension();
				$namane = "brand-".time().'.'.$ext;
				$namadb = "cache/".$namane;
				$logo->move(public_path("cache"),$namane);
				$setting->logo_web = $namadb;
			}
			$setting->komisi = $komisi;
			$setting->save();

			return redirect()->back();

		}	
		else{
			$data = SettingWeb::find(1);
		return view('pengaturan/pengaturan',compact('data'));

		}
	}
}
