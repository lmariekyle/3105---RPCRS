<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $employees = User::all();
       return view('employees.index', compact('employees'));	
    }

    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
			'status' => $request->status,
			'firstname' => $request->firstname,
			'middlename' => $request->middlename,
			'lastname' =>  $request->lastname,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

    

        return redirect(RouteServiceProvider::HOME);
    }

    public function show($id)
    {
        $employee = User::find($id);
        return view('employees.show')->with('employee',$employee);
    }

    public function update(Request $request, User $employee)
    {
        $this->validate($request, [
			'status' => 'required',
			'firstname' => 'required',
			'middlename' => 'required',
			'lastname' =>  'required',
            'email' => 'required|email',
            'date_of_birth' => 'required',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'password' =>'required'
		]);

        $employee->update($request->all());
        event(new Registered($employee));
        Auth::login($employee);

        return back()->with('success', 'Employee updated successfully');
    }
}
