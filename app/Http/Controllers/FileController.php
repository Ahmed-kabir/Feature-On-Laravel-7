<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use DB;
use Storage;
use Response;
use Maatwebsite\Excel\Excel;
// use Illuminate\Support\Facades\Crypt;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addFile()
    {
        $data['title'] = 'Add File'; 
        return view('add_file', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveFile(Request $request)
    {
         $request->validate([
            "title"=>'required',
            "image"=>'required|mimes:jpeg,png,jpg,gif,svg,pdf,xlx,csv|max:2048'
        ]);

        $image = $request->file('image');
        $name = $image->getClientOriginalName();
        $path=('public/productimage/');
        $image->move($path,$name);
        $imageurl=$path.$name;
        $data['title'] =$request->input('title');
        $data['name'] =$name;
        $data['file']= $imageurl;
        $data['created_at'] = date('Y-m-d H:i:s');

         DB::table('images')->insert($data);
         return redirect('/add-file')->with('message', 'Image Added successfully');
        // dd($request->all());
    }

    public function manageFile()
    {
        $data['images'] = DB::table('images')->get();
        $data['title'] = 'Manage File';
        // dd($data);
        return view('manage_file', $data);
    }

    public function downloadFile($id)
    {
        $file = DB::table('images')->where('id', '=', $id)->first();
        // $tst = $file->file;
        $down = public_path()."/$file->file";
        return response::download($down);
        // return Storage::download($file->file, $file->title);
         // $file1= public_path(). '\productimage'.$file->id;
        // $path = Storage::disk('public')->path($tst);
        // $pathToFile = storage_path($file->file);
        // return response()->download($pathToFile);
        // echo '<pre>';
        // print_r($path);
        // echo '</pre>';

    }

    public function addExcel()
    {
         $data['title'] = 'Add Excel'; 
        return view('add_excel', $data);
    }

    public function saveExcel(Request $request)
    {
        $request->validate([
            "excel"=>'required|mimes:xls,xlsx'
            
        ]);

         $path = $request->file('excel')->getRealPath();


     $data = Excel::load($path)->get();

     if($data->count() > 0)
     {
      foreach($data->toArray() as $key => $value)
      {
       foreach($value as $row)
       {
        $insert_data[] = array(
         'name'  => $row['Name'],
         'subject'   => $row['Subject'],
         'marks'   => $row['Marks']
        
        );
       }
      }

      if(!empty($insert_data))
      {
       DB::table('excel')->insert($insert_data);
      }
     }
     return back()->with('message', 'Excel Data Imported successfully.');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
