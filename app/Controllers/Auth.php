<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        // Jika ada query ?preview=1, abaikan session agar user bisa melihat & mencoba UI Halaman Login
        if ($this->request->getGet('preview') !== '1') {
            if ($this->session->get('is_logged_in')) {
                if ($this->session->get('current_role') === 'siswa') {
                    return redirect()->to('/siswa');
                }
                return redirect()->to('/dashboard');
            }
        }

        $data = [
            'title' => 'Sistem Presensi & Jurnal Mengajar via QR Code',
            'features' => [
                [
                    'badge' => 'Scan QR',
                    'title' => 'Validasi Cepat & Anti-Titip Absen',
                    'desc' => 'Validasi presensi di kelas secara cepat & anti-titip absen dengan Dynamic QR rotating token setiap 15 detik.',
                    'icon' => 'qr-code',
                ],
                [
                    'badge' => 'Jurnal KBM Digital',
                    'title' => 'Dokumentasi Mengajar Real-Time',
                    'desc' => 'Catat materi ajar, metode interaktif, dan kejadian kelas langsung dari HP tanpa repot buku administrasi kertas.',
                    'icon' => 'book-open',
                ],
                [
                    'badge' => 'Notifikasi Real-Time',
                    'title' => 'Otomasi WhatsApp Orang Tua',
                    'desc' => 'Kirim info kehadiran dan kepulangan siswa otomatis ke nomor WhatsApp orang tua/wali begitu QR terverifikasi.',
                    'icon' => 'message-square',
                ],
                [
                    'badge' => 'Rekapitulasi Web',
                    'title' => 'Grafik Analitik & Ekspor Laporan',
                    'desc' => 'Pantau grafik kehadiran siswa & unduh laporan resmi siap cetak format PDF dan Excel (.xlsx) otomatis.',
                    'icon' => 'bar-chart-3',
                ],
            ]
        ];

        return view('auth/login', $data);
    }

    public function doLogin()
    {
        $this->state->ensureInitialized();
        $role = $this->request->getPost('role') ?? 'guru';
        $username = trim((string) $this->request->getPost('username'));
        $password = trim((string) $this->request->getPost('password'));

        if (empty($username) || empty($password)) {
            $this->session->setFlashdata('swal_error', 'Silakan masukkan NIP/NISN dan password terlebih dahulu!');
            return redirect()->to('/login');
        }

        // Cek login Siswa (jika memilih tab siswa atau input berupa digit NISN)
        if ($role === 'siswa' || (is_numeric($username) && strlen($username) === 10)) {
            $student = $this->state->loginAsStudent($username ?: '0068192001');
            $this->session->setFlashdata('swal_success', 'Selamat datang, ' . $student['name'] . ' (' . $student['class'] . ')! Anda berhasil masuk ke Portal Siswa.');
            return redirect()->to('/siswa');
        }

        // Default login Guru / Tenaga Pendidik
        $this->state->loginAsTeacher();
        $user = $this->state->getUser();
        $this->session->setFlashdata('swal_success', 'Selamat datang kembali, Ibu ' . $user['name'] . '! Anda berhasil masuk sebagai Guru Pengampu.');
        return redirect()->to('/dashboard');
    }

    public function demoLogin()
    {
        $this->state->ensureInitialized();
        $this->state->loginAsTeacher();
        $this->session->setFlashdata('swal_success', 'Masuk sebagai Demo Guru: Naila Salma Az-Zahra, S.Kom (SMK Budi Luhur). Data in-memory aktif!');
        return redirect()->to('/dashboard');
    }

    public function demoLoginStudent()
    {
        $this->state->ensureInitialized();
        $student = $this->state->loginAsStudent('0068192001');
        $this->session->setFlashdata('swal_success', 'Masuk sebagai Siswa: ' . $student['name'] . ' (' . $student['class'] . ')');
        return redirect()->to('/siswa');
    }

    public function switchRole($role = 'guru')
    {
        $this->state->ensureInitialized();
        if ($role === 'siswa') {
            $this->state->loginAsStudent();
            $this->session->setFlashdata('swal_info', 'Berpindah ke Mode Portal Siswa.');
            return redirect()->to('/siswa');
        } else {
            $this->state->loginAsTeacher();
            $this->session->setFlashdata('swal_info', 'Berpindah ke Mode Portal Guru / Admin.');
            return redirect()->to('/dashboard');
        }
    }

    public function logout()
    {
        $this->session->set('is_logged_in', false);
        $this->session->remove('logged_student');
        $this->session->setFlashdata('swal_info', 'Anda telah berhasil keluar (logout) dari sesi.');
        return redirect()->to('/login');
    }

    public function resetDemo()
    {
        $this->state->seedInitialData();
        $this->session->setFlashdata('swal_info', 'Data demo in-memory berhasil di-reset ke kondisi awal!');
        return redirect()->back();
    }
}
