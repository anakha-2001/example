<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    Session::put("message","logged in successfully");
   
    $request->session()->flash("hello","hello world");
    Cookie::queue("hello","testing",1);
    // $request->session()->forget('message');
    // dd($request->session()->all());
    
    return view('welcome');
});


Route::get('/about', function (Request $request) {
    // Session::put("message","logged in successfully");
   
    // $request->session()->flash("hello","hello world");
    // $request->session()->forget('message');
    dd($request->session()->all());
    
    return view('welcome');
});

Route::get('/form', function () {
    return view("form");
})->name("form");

Route::post("post",function(Request $request){
        $validated = $request->validate([
            'name'=>'required',
            'age'=>['required','gte:18'],
            'date'=>['required','date','before_or_equal:2023-09-23']
        ]);

        if($request->file("image")){
            foreach($request->file('image')as $file){
                $filename=date("YmdHi").$file->getClientOrginalName();
            }
        }

})->name("submit.form");
