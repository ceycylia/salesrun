<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Login extends Controller
{
    public function index()
    {
        return view('login');  // Menampilkan halaman login
    }

    public function authenticate()
    {
        // Logic autentikasi, jika username dan password valid, arahkan ke dashboard
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($username === 'admin' && $password === 'password') {
            return redirect()->to('/home');  // Redirect ke dashboard jika login berhasil
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');  // Kembali ke login jika gagal
        }
    }
}
