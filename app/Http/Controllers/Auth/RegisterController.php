<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    // Habis register langsung ke dashboard peserta
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    // VALIDASI INPUT REGISTER
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_id'  => ['required', 'string', 'max:255', 'unique:users,user_id'],
            'nama'     => ['required', 'string', 'max:255'],
            'alamat'   => ['nullable', 'string', 'max:255'],
            'kota'     => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    // BUAT USER BARU
    protected function create(array $data)
    {
        return User::create([
            'user_id'   => $data['user_id'],
            'nama'      => $data['nama'],
            'alamat'    => $data['alamat'] ?? null,
            'kota'      => $data['kota'] ?? null,
            'user_type' => 'Peserta',                 // default PESERTA
            'password'  => Hash::make($data['password']),
        ]);
    }
}
