<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = DB::table('employees')
        ->select ('employees.*','companies.name AS names')
        ->join ('companies','companies.id','=','employees.companyId')
        ->get();


        // $employee = Employees::all();
        return view('admin.pages.employee', [
            'employees' => $employee
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Companies::all();
        return View('admin.pages.employee-create', [
            'companies' => $companies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Employees::validate([
            'name' => 'required',
            'companyId' => 'required',
            'email' => 'required|email' 
        ]);

        Employees::create([
            'name' => $request->name,
            'companyId' => $request->companyId,
            'email' => $request->email
        ]);

        return redirect()->route('employee.index');
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
        $employee = Employees::findOrFail($id);
        $companies = Companies::all();

        return view('admin.pages.employee-edit',[
            'employee' => $employee,
            'companies' => $companies
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
        Employees::validate([
            'name' => 'required',
            'companyId' => 'required',
            'email' => 'required|email' 
        ]);

        $employee = Employees::findOrFail($id);

        $employee->name = $request->name;
        $employee->companyId = $request->companyId;
        $employee->email = $request->email;

        $employee->save();

        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employees::findOrFail($id)->delete();

        return redirect()->route('employee.index');
    }
}
