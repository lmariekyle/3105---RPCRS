<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = User::paginate(5);
       return view('employees.index', compact('employees'));	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $employee)
    {
        return view('employees.create', compact('employee'));	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
			'status' => 'required',
			'role' => 'required',
			'firstname' => 'required',
			'middlename' => 'required',
			'lastname' =>  'required',
            'email' => 'required|email',
            'date_of_birth' => 'required',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'password' =>'required'
		]);

        $employee= User::create([
			'status' => $request->status,
			'role' => $request->role,
			'firstname' => $request->firstname,
			'middlename' => $request->middlename,
			'lastname' =>  $request->lastname,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password)
		]);
        
        event(new Registered($employee));
        // Auth::login($employee);

    	return back()->with('success', 'Employee added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = User::find($id);
        return view('employees.show')->with('employee',$employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = User::find($id);
        return view('employees.edit')->with('employee',$employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $employee)
    {
        $this->validate($request, [
			'status' => 'required',
			'role' => 'required',
			'firstname' => 'required',
			'middlename' => 'required',
			'lastname' =>  'required',
            'email' => 'required|email',
            'date_of_birth' => 'required',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'password' =>'required'
		]);

        $employee->update($request->all());

        return back()->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = User::find($id);
        $employee->delete();

        return back()->with('success', 'Employee Deleted successfully');
    }

    public function viewEmployee($id)
    {
        $employee=User::find($id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('employees.role',compact('employee','roles','permissions'));
    }

    public function assignRole(Request $request,User $employee){

        if($employee->hasRole($request->role)){
            return back()->with('message','Role Exists');
        }
        $employee->assignRole($request->role);
        return back()->with('message','Role Added');
    }

    public function removeRole(User $employee, Role $role){

        if($employee->hasRole($role)){
            $employee->removeRole($role);
            return back()->with('message','Role Removed');
        }
        return back()->with('message','Role Not Exists');
    }
    
}
