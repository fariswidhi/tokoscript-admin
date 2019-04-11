<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk as Table;
use App\Vendor;
use App\Kategori;
use App\Tag;
use App\VendorPosition;

use App\ProdukTag;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = 'data/produk';
    protected $url = 'data/produk';

public function __construct()
{

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
        'name'=>'Nama Produk',
        'list'=>[
            'type'=>'text',
            'field'=>'nama',
            'showAsTable'=>true,
          ],

      ],
    [
        'name'=>'File',
        'list'=>[
            'type'=>'file',
            'field'=>'file',
            'showAsTable'=>false,
            'class'=>'file'
          ],

      ],
    [
        'name'=>'Harga',
        'list'=>[
            'type'=>'number',
            'field'=>'harga',
            'showAsTable'=>true,
          ],

      ],
    [
        'name'=>'Foto',
        'list'=>[
            'type'=>'file',
            'field'=>'foto',
            'showAsTable'=>false,
            'class'=>'imgne'
          ],

      ],
    [
        'name'=>'Deskripsi',
        'list'=>[
            'type'=>'textarea',
            'field'=>'deskripsi',
            'showAsTable'=>false,
          ],

      ],
      [
        'name'=>'kategori',
        'list'=>[
            'type'=>'select',
            'field'=>'kategori_id',
            'showAsTable'=>true,
            'data'=>Kategori::all(),
            'id'=>'id',
            'value'=>'nama',
            'related'=>true,
            'belongsTo'=>'kategory',
            'key'=>'nama'
          ],

      ], 
      [
        'name'=>'Tags',
        'list'=>[
            'type'=>'select',
            'field'=>'tags',
            'showAsTable'=>false,
            'data'=>Tag::all(),
            'id'=>'id',
            'class'=>'selectTag',
            'value'=>'tag',
            'related'=>true,
            'belongsTo'=>'kategory',
            'key'=>'nama'
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

          if (session('levelid')=='2') {
            # code...
            $dataTable = Table::where('userid',session('adminid'))->paginate(10);

          }
          else{

            $dataTable = Table::paginate(10);
          }
        }
        // print_r(session()->all());
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
        // $name = $this->dumpName($request->except(['_token','_method']),'save','Table');


$foto = $request->file('foto');


$file = $request->file('file');

$table = new Table; 
$table->nama= $request->nama;
$table->harga= $request->harga;
$table->userid = session('adminid');

if (!empty($file)) {

  $ext = $file->getClientOriginalExtension();
  $name = md5('produkfile'.time()).'.'.$ext;
  // echo $name;
  $file->move(public_path('files/'),$name);

  $table->file = 'files/'.$name;

}
if (!empty($foto)) {

  $ext = $foto->getClientOriginalExtension();
  $name = md5('produks'.time()).'.'.$ext;
  // echo $name;
  $foto->move(public_path('cache/'),$name);


  $table->foto = 'cache/'.$name;
}
$table->slug = str_slug($request->nama,'-').'-'.$this->generateRandomString(5);
$table->deskripsi= $request->deskripsi;

$table->kategori_id= $request->kategori_id;

$save = $table->save();


if (!empty($request->tags)) {
  # code...
  $tags = $request->tags;
  foreach ($tags as $t) {
    # code...

    if (is_numeric($t)) {
      $cek = Tag::where('id',$t);

      if ($cek->count()>0) {
        # code...
        $produkTag = new ProdukTag;
        $produkTag->produk_id = $table->id;
        $produkTag->tag_id = $t;
        $produkTag->save();
      }
      else{
        // if not exist
        $tag = new Tag;
        $tag->tag = $t;
        $tag->save();

        $produkTag = new ProdukTag;
        $produkTag->produk_id = $table->id;
        $produkTag->tag_id = $tag->id;
        $produkTag->save();
      }
    }
    else{
        $tag = new Tag;
        $tag->tag = $t;
        $tag->save();

        $produkTag = new ProdukTag;
        $produkTag->produk_id = $table->id;
        $produkTag->tag_id = $tag->id;
        $produkTag->save();

    }
  }
}

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
      //  $name = $this->dumpName($request->except(['_token','_method']),'update','Table');

// print_r($request);
// exit();



$foto = $request->file('foto');

        // INI ADALAH HASIL GENERATE DARI KODE DIATAS;
$table = Table::find($id); 

$table->nama= $request->nama;
$table->harga= $request->harga;
if (!empty($foto)) {

  $ext = $foto->getClientOriginalExtension();
  $name = md5('produks'.time()).'.'.$ext;
  // echo $name;
  $foto->move(public_path('cache/'),$name);


  $table->foto = 'cache/'.$name;
}
$table->slug = str_slug($request->nama,'-').'-'.$this->generateRandomString(5);
$table->deskripsi= $request->deskripsi;

$table->kategori_id= $request->kategori_id;

$save = $table->save();

// exit();

if (!empty($request->tags)) {
  # code...
  $tags = $request->tags;
  foreach ($tags as $t) {
    # code...

    if (is_numeric($t)) {
      $cek = Tag::where('id',$t);

      if ($cek->count()>0) {
        # code...

        $produkTagg = ProdukTag::where('produk_id',$id)->where('tag_id',$t);

        if ($produkTagg->count()==0) {

        $produkTag = new ProdukTag;
        $produkTag->produk_id = $id;
        $produkTag->tag_id = $t;
        $produkTag->save();
        }

      }
      else{
        // if not exist
        $tag = new Tag;
        $tag->tag = $t;
        $tag->save();

        $produkTag = new ProdukTag;
        $produkTag->produk_id = $id;
        $produkTag->tag_id = $tag->id;
        $produkTag->save();
      }
    }
    else{
        $tag = new Tag;
        $tag->tag = $t;
        $tag->save();

        $produkTag = new ProdukTag;
        $produkTag->produk_id = $id;
        $produkTag->tag_id = $tag->id;
        $produkTag->save();

    }


    $status = 1;
          return [
          'status'=>$status
        ];


    }
  }
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
