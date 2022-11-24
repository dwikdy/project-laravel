<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use illuminate\Pagination\Paginator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        $companies = Companies::paginate(5);
        return view('admin.pages.companies', [
            'companies' => $companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.companies-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'logo' => 'image|mimes:png|max:2000',
            'website' => 'required'

        ])->validate();

        if($files = $request->file('image')){
            foreach($files as $file){
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'img/logo_company/';
                $image_path = $upload_path.$image_full_name;
                $file->move($upload_path, $image_full_name);

        Companies::create([
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $image_path,
            'website' => $request->website
        ]);

        // return Redirect::back()->with('msg-success', 'success');
        



        // if($files = $request->file('image')){
        //     foreach($files as $file){
        //         $image_name = md5(rand(1000, 10000));
        //         $ext = strtolower($file->getClientOriginalExtension());
        //         $image_full_name = $image_name.'.'.$ext;
        //         $upload_path = 'img/logo_company/';
        //         $image_path = $upload_path.$image_full_name;
        //         $file->move($upload_path, $image_full_name);

        // Companies::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'logo' => $image_path,
        //     'website' => $request->website
        // ]);
        
        // $validate = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'logo' => 'required|image|max:2000|mimes:png',
        //     'website' => 'required'
        // ]);
        
        // return redirect()->route('companies.index');
            }
        }
        return redirect()->route('companies.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Companies::findOrFail($id);
        return view('admin.pages.companies-edit',[
            'company' => $company
        ]);
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
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'logo' => 'required|file|size:2000|mimes:png',
            'website' => 'required'
        ]);

        $companies = Companies::findOrFail($id);
        $companies->name = $request->name;
        $companies->email = $request->email;
        $companies->website = $request->website;

        if($files = $request->file('image')){
            if(File::exists($companies->logo)){
                File::delete($companies->logo);
            }
            foreach($files as $file){
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'img/logo_company/';
                $image_path = $upload_path.$image_full_name;
                $file->move($upload_path, $image_full_name);

                $companies->logo = $image_path;
        
        
            }
        }
        $companies->save();
    return redirect()->route('companies.index');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companies = Companies::findOrFail($id)->delete();

        return redirect()->route('companies.index');
    }
}
