<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // Pastikan state siap
        $this->state->ensureInitialized();

        if (!$this->session->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $metrics = $this->state->getDashboardMetrics();
        $user = $this->state->getUser();
        $gateway = $this->state->getGateway();

        $data = [
            'title' => 'Dashboard Utama - Sistem Presensi & Jurnal Mengajar',
            'active_nav' => 'dashboard',
            'user' => $user,
            'metrics' => $metrics,
            'gateway' => $gateway,
        ];

        return view('dashboard/index', $data);
    }
}
