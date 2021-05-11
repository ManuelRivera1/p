<?php

namespace App\Controllers;

use App\Libraries\Hash; #llamar funcion

class Auth extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }
    public function index()
    {
        // echo 'Hello World!';
        #retornar vistas desde una parte especifica
        return view('auth/login');
    }
    public function register()
    {
        // echo 'Hello World!';
        #retornar vistas desde una parte especifica
        return view('auth/register');
    }
    public function save()
    {
        // lets' validate requests
        // $validation = $this->validate([
        //     'name'=>'required',
        //     'email'=>'required|valid_email|is_unique[users.email]',
        //     'password'=>'required|min_length[5]|max_length[12]',
        //     'cpassword'=>'required|min_length[5]|max_length[12]|matches[password]',
        // ]);      
        // lets' validate requests with edited message
        $validation = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => ['required' => 'you full name is required']
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'mail is required',
                    'valid_email' => 'you must a valid email',
                    'is_unique' => ' email already taken',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[12]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must have atleast 5 charactes in length',
                    'max_length' => 'Password must not have characters more  than 12 in length',
                ]
            ],
            'cpassword' => [
                'rules' => 'required|min_length[5]|max_length[12]|matches[password]',
                'errors' => [
                    'required' => 'confirm Password is required',
                    'min_length' => 'confirm Password must have atleast 5 charactes in length',
                    'max_length' => 'confirm Password must not have characters more  than 12 in length',
                    'matches' => 'confirm Password not maches to password',
                ]
            ],
        ]);

        if (!$validation) {
            return view('auth/register', ['validation' => $this->validator]);
        } else {
            #date capture for $_POST
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $values = [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password), #encriptar clave 
            ];
            #models views
            $usersModel = new \App\Models\UsersModel();
            $query = $usersModel->insert($values);
            if (!$query) {
                return redirect()->back()->with('fail', 'Something went wrong');
            } else {
                // return redirect()->to('register')->with('success', 'You are now registered success');
                $last_id = $usersModel->insertID(); //this is last inserted id redirect a dashboard
                session()->set('loggedUser',$last_id);
                return redirect()->to('/dashboard');
            }
        }
    }
    #check of login
    function check()
    {
        $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_not_unique[users.email]',
                'errors' => [
                    'required' => 'mail is required',
                    'valid_email' => 'Enter a valid email adress',
                    'is_not_unique' => ' this email is not registered on our service',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[12]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must have atleast 5 charactes in length',
                    'max_length' => 'Password must not have characters more  than 12 in length',
                ]
            ],
        ]);
        if (!$validation) {
            return view('auth/login', ['validation' => $this->validator]);
        } else {
             //let's check user
             $email = $this->request->getPost('email');
             $password = $this->request->getPost('password');
             $usersModel = new \App\Models\UsersModel();
             $users_info = $usersModel->where('email',$email)->first();

             $check_password = Hash::check($password, $users_info['password']);
            if (!$check_password) {
                session()->setFlashdata('fail','incorrect password');
                return redirect()->to('/auth')->withInput();
            } else {
                $users_id = $users_info['id'];
                session()->set('loggedUser',$users_id);
                return redirect()->to('/dashboard');
            }
        }
    }
    #cerrar seccion 
    function logout(){
        if(session()->has('loggedUser')){
            session()->remove('loggedUser');
            return redirect()->to('/auth?access=out')->with('fail','you area logged out!');
        }
    }
}
