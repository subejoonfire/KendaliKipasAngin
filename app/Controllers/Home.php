<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    private $SuhuModel, $KipasAnginModel;
    public function __construct()
    {
        $this->SuhuModel = new \App\Models\SuhuModel();
        $this->KipasAnginModel = new \App\Models\KipasAnginModel();
    }
    public function index()
    {
        return view('index');
    }
    public function dashboard()
    {
        if (session('logged_in') != true) {
            return redirect()->to(base_url('/'));
        }
        $KipasAnginStatus = $this->KipasAnginModel->orderBy('id', 'ASC')->first();
        $dataSuhu = $this->SuhuModel->findAll();
        $dataKipasAngin = $this->KipasAnginModel->findAll();
        return view('dashboard', [
            'dataSuhu' => $dataSuhu,
            'dataKipasAngin' => $dataKipasAngin,
            'KipasAnginStatus' => $KipasAnginStatus
        ]);
    }

    public function authenticate()
    {
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('logged_in', true);
            return redirect()->to(base_url('/dashboard'));
        }

        return redirect()->back()->with('error', 'Login gagal!');
    }

    public function toggleFan()
    {
        $KipasAnginStatus = $this->KipasAnginModel->orderBy('id', 'DESC')->first();
        if ($KipasAnginStatus['status'] == 'off') {
            $newStatus = 'on';
        } else {
            $newStatus = 'off';
        }
        $this->KipasAnginModel->insert([
            'status' => $newStatus,
            'timestamp' => date('Y-m-d H:i:s'), // Waktu sekarang
        ]);
        return redirect()->to(base_url('/dashboard'));
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
