<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Toastr;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class MyAccountController extends Controller
{

    public function index()
    {
        return view('layouts.my_account');
    }


    protected function rules()
    {
        return [
            '_token' => 'required',
            'password' => 'required|confirmed|min:6',
        ];
    }



    public function password_change(Request $request)
    {


       if(Auth::Check())
       {

        $messages = [
            'current_password.required' => 'La contraseña actual es requerida',

            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.required' => 'La contraseña es requerida',
            'current_password.required' => 'La contraseña actual es requerida',
            'password_confirmation.required' => 'La confirmación de la contraseña es requerida',
        ];

        $current_password=Auth::user()->password;



        $rules = [
            '_token' => 'required',
            'current_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];


//dd($request->all());

        $validator = Validator::make($request->all(), $rules, $messages);




       // if($validator->passes() ){
        if ($validator->fails()) {

            Toastr::error('Las contraseñas no coinciden', 'Error', 
             [
                "timeOut" => "20000",
                "closeButton" => true,
            ]
        );
            return Redirect()->back()->withErrors($validator)->withInput();


        }else {

            if (Hash::check($request->current_password, $current_password)) {
                $user = Auth::user();
            //$user->password = Hash::make($request->get('password'));
                $user->password =bcrypt($request->get('password') );
                $user->save();

                Toastr::success('Su contraseña ha sido cambiada exitosamente', 'Éxito', 
                 [
                    "timeOut" => "20000",
                    "closeButton" => true,
                ]
            );

                return Redirect()->back();
            }else{
                Toastr::error('Las contraseña actual es incorrecta', 'Error', 
                 [
                    "timeOut" => "20000",
                    "closeButton" => true,
                ]
            );
                return Redirect()->back()->withErrors($validator)->withInput();
            }




        }
    }else{

        Toastr::info('Su sesión ha expirado', 'Error', 
         [
            "timeOut" => "20000",
            "closeButton" => true,
        ]
    );

        return Redirect()->back();


    }




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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
