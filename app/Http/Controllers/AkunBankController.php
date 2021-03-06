<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AkunBank as Table;
use App\Vendor;
use App\Kategori;
use App\Tag;
use App\VendorPosition;
use App\MetodePembayaran;
use App\ProdukTag;

class AkunBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = 'data/akun-bank';
    protected $url = 'data/akun-bank';

public function __construct()
{
  $this->middleware('super');

}
    public function searchForId($id, $array) {
   foreach ($array as $key => $val) {
       if ($val['uid'] === $id) {
           return $key;
       }
   }
   return null;
}


    public function forms(){

        $forms = [
    [
        'name'=>'Nama (Atas Nama)',
        'list'=>[
            'type'=>'text',
            'field'=>'name',
            'showAsTable'=>true,
          ],

      ],
    [
        'name'=>'Nomor (No.Rekening)',
        'list'=>[
            'type'=>'number',
            'field'=>'number',
            'showAsTable'=>true,
          ],

      ],
      [
        'name'=>'Metode Pembayaran',
        'list'=>[
            'type'=>'select',
            'field'=>'metode_pembayaran',
            'showAsTable'=>true,
            'data'=>MetodePembayaran::all(),
            'id'=>'id',
            'value'=>'metode_pembayaran',
            'related'=>true,
            'belongsTo'=>'metodePembayaran',
            'key'=>'metode_pembayaran'
          ],

      ], 
  
        ];

        return $forms;

    }

  public function fields(){

        $forms = $this->forms();
        $count = count($forms);

        // print_r($forms);
        // print_r($forms);
        $array = [];
        for ($i=0; $i < $count ; $i++) { 
            # code...
            $name  = $forms[$i]['name'];
            $list = $forms[$i]['list'];
            $type = $list['type'];
            $field = $list['field'];
            $showAsTable = $list['showAsTable'];

            // print_r($list);
            $class = array_key_exists('class', $list) ? $list['class']: ' ';
            $data = array_key_exists('data', $list) ? $list['data']: ' ';
            $id = array_key_exists('id', $list) ? $list['id']: ' ';
            $value = array_key_exists('value', $list) ? $list['value']: ' ';
            $related = array_key_exists('related', $list) ? $list['related']: false;
            $belongsTo = array_key_exists('belongsTo', $list) ? $list['belongsTo']: ' ';
            $key = array_key_exists('key', $list) ? $list['key']: ' ';

            // var_dump($class);
            // var_dump($list);
            // $class

            $array[] = [
                'name'=>$name,
                'type'=>$type,
                'field'=>$field,
                'class'=>$class,
                'showAsTable'=>$showAsTable,
                'data'=>$data,
                'id'=>$id,
                'value'=>$value,
                'related'=>$related,
                'belongsTo'=>$belongsTo,
                'key'=>$key
            ];

            // echo $forms[$i];

        }

        return $array;
  }

    public function index(Request $request)
    {
        //

        $data = $this->fields();
        // print_r($forms);
            // print_r($data);
        $title = "Daftar Data";
        $subtitle = "Pegawai Vendor ";

        if (!empty($request->q)) {
        $columns = ['nama','kategori'];
        
        $query = Table::select('*');
        
        foreach($columns as $column)
        {
            $query->orWhere($column, 'LIKE', '%'.$request->q.'%');
        }
        
        $dataTable = $query->get();

        }
        else{
            $dataTable = Table::paginate(10);
        }
        return view($this->dir.'/table',compact('data','dataTable','title','subtitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = $this->fields();

        $title = "Tambah Data";
        $subtitle = "User ";
        return view($this->dir.'/create',compact('data','title','subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // UNTUK DUMP NAMA FORM

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request, $type untuk save/update,$table untuk Class nama tabel

     */

    public function dumpName($request,$type,$table){

        $text = '';
        if ($type=='save') {
            $text.= '$table = new '.$table."; <br>";
        }
        elseif ($type=='update') {
            $text .= '$table = '.$table.'::find($id); <br>';
        }
        foreach ($request as $r=>$v) {
            # code...
            // print_r($r);
            $text .= '$table->'.$r.'= $request->'.$r.";<br>";
            // echo $r."<br>";
        }

        $text .= '$save = $table->save();<br>';
        $text .= 'if ($save) {<br>';
        $text .= '//Do Your Something<br>';
        $text .= '}<br>';
        $text .= 'else {<br>';
        $text .= '//Do Your Something <br>';
        $text .= '}<br>';

        echo $text;


    }

      public function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



    public function store(Request $request)
    {
        //
        //$name = $this->dumpName($request->except(['_token','_method']),'save','Table');

$table = new Table; 
$table->name= $request->name;
$table->number= $request->number;
$table->metode_pembayaran= $request->metode_pembayaran;
$save = $table->save();

        if ($save) {
        //Do Your Something
          $status = 1;
            $request->session()->flash('success', "Data Berhasil Disimpan");
            // return redirect($request->segment(1).'/'.$request->segment(2));

        }
        else {
        //Do Your Something 
          $status =0;
            $request->session()->flash('danger', "Data Gagal Disimpan");
            // return redirect()->back();
        }



        return [
          'status'=>$status
        ];

        // $table = new Table;
        // print_r($request->all());


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $data = $this->fields();
        $table = Table::find($id);
        $title = "Detail  Data";
        $subtitle = "Pegawai Vendor";
        return view($this->dir.'/info',compact('data','table','title','subtitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $data = $this->fields();
        $table = Table::find($id);

        $title = "Edit Data";
        $subtitle = "Pegawai Vendor";



        $produkTag = ProdukTag::where('produk_id',$id);

        if ($produkTag->count()>0) {
          # code...
          $arr = [];
          foreach ($produkTag->get() as $pg) {
            # code...
            $arr[]= $pg->tag_id;
          }
        }
        else{
          $arr = null;
        }



        return view($this->dir.'/edit',compact('data','table','title','subtitle','arr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
//        $name = $this->dumpName($request->except(['_token','_method']),'update','Table');


        // INI ADALAH HASIL GENERATE DARI KODE DIATAS;
$table = Table::find($id); 
$table->name= $request->name;
$table->number= $request->number;
$table->metode_pembayaran= $request->metode_pembayaran;
$save = $table->save();



       if ($save) {
        //Do Your Something
          $status = 1;
            $request->session()->flash('success', "Data Berhasil Diubah");
            // return redirect($this->url);

        }
        else {
        //Do Your Something 
          $status =0;
            $request->session()->flash('success', "Data Gagal Diubah");
            // return redirect()->back();
        }

        return [
          'status'=>$status
        ];


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        //
       $table = Table::find($id);
        $delete = $table->delete();
        if ($delete) {
        // //Do Your Something
            $request->session()->flash('success', "Data Berhasil Dihapus");
            // return redirect($this->url);
            $st= 1;
        }
        else {
        //Do Your Something 
            $request->session()->flash('success', "Data Gagal Dihapus");
            $st = 0;
        }

        // return redirect()->back();
        return [
          'response'=>$st
        ];
    }
}
