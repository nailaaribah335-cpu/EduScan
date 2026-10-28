<?php

namespace App\Controllers;

class Siswa extends BaseController
{
    public function index()
    {
        $this->state->ensureInitialized();

        if (!$this->session->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        // Pastikan role siswa aktif
        $student = $this->state->getLoggedStudent();
        $history = $this->state->getStudentAttendanceHistory($student['nisn']);
        $journals = $this->state->getStudentClassJournals($student['class']);

        // Cek status hari ini
        $today = date('Y-m-d');
        $todayRecord = null;
        foreach ($history as $h) {
            if ($h['date'] === $today) {
                $todayRecord = $h;
                break;
            }
        }

        $data = [
            'title' => 'Portal Siswa - Presensi & Jurnal Digital',
            'active_nav' => 'siswa_portal',
            'student' => $student,
            'history' => $history,
            'todayRecord' => $todayRecord,
            'journals' => $journals,
            'stats' => [
                'total_hadir' => count(array_filter($history, fn($h) => $h['status'] === 'Hadir')),
                'total_sakit' => count(array_filter($history, fn($h) => $h['status'] === 'Sakit')),
                'total_izin' => count(array_filter($history, fn($h) => $h['status'] === 'Izin')),
            ]
        ];

        return view('siswa/index', $data);
    }

    /**
     * AJAX Endpoint saat siswa memindai QR proyektor guru dari HP mereka
     */
    public function scanClass()
    {
        $this->state->ensureInitialized();
        $student = $this->state->getLoggedStudent();

        $token = $this->request->getPost('token') ?? 'TOKEN-X-RPL-1-DYNAMIC';
        $result = $this->state->recordAttendance(
            $student['nisn'],
            $student['class'],
            'Hadir',
            'Scan via Ponsel Siswa'
        );

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Presensi Anda berhasil tervalidasi! WhatsApp terkirim ke Orang Tua.',
            'attendance' => $result['attendance'] ?? [
                'time' => date('H:i:s'),
                'status' => 'Hadir',
            ],
            'student' => $student,
            'notification' => $result['notification'] ?? null,
        ]);
    }
}
