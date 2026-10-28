<?php

namespace App\Controllers;

class Presensi extends BaseController
{
    public function index()
    {
        $this->state->ensureInitialized();

        if (!$this->session->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $classes = $this->state->getClasses();
        $selectedClass = $this->request->getGet('kelas') ?? 'X RPL 1';
        $attendances = $this->state->getAttendances($selectedClass, date('Y-m-d'));
        $students = $this->state->getStudents($selectedClass);
        $schedules = $this->state->getSchedules();
        $user = $this->state->getUser();

        $data = [
            'title' => 'Scan QR Presensi Siswa - Anti-Titip Absen',
            'active_nav' => 'scan_qr',
            'user' => $user,
            'classes' => $classes,
            'selectedClass' => $selectedClass,
            'attendances' => $attendances,
            'students' => $students,
            'schedules' => $schedules,
            'totalStudents' => count($students) > 0 ? count($students) : 32,
            'presentCount' => count(array_filter($attendances, fn($a) => $a['status'] === 'Hadir')),
        ];

        return view('presensi/scan_qr', $data);
    }

    /**
     * AJAX Endpoint: Proses QR scan fisik / kamera browser / input manual
     */
    public function process()
    {
        $this->state->ensureInitialized();

        $nisn = $this->request->getPost('nisn') ?? $this->request->getVar('nisn');
        $className = $this->request->getPost('kelas') ?? $this->request->getVar('kelas') ?? 'X RPL 1';
        $status = $this->request->getPost('status') ?? 'Hadir';
        $method = $this->request->getPost('method') ?? 'Kamera Scanner Browser';

        $result = $this->state->recordAttendance($nisn, $className, $status, $method);

        // Ambil data terbaru untuk update live UI
        $todayAttendances = $this->state->getAttendances($className, date('Y-m-d'));
        $presentCount = count(array_filter($todayAttendances, fn($a) => $a['status'] === 'Hadir'));
        $students = $this->state->getStudents($className);

        return $this->response->setJSON([
            'success' => $result['success'] ?? true,
            'message' => $result['message'] ?? 'Presensi berhasil dicatat!',
            'student' => $result['student'] ?? null,
            'attendance' => $result['attendance'] ?? null,
            'notification' => $result['notification'] ?? null,
            'presentCount' => $presentCount,
            'totalStudents' => count($students) > 0 ? count($students) : 32,
            'attendances' => $todayAttendances,
        ]);
    }

    /**
     * AJAX Endpoint: Simulasi Scan Siswa untuk Demo Cepat
     */
    public function simulate()
    {
        $this->state->ensureInitialized();

        $className = $this->request->getPost('kelas') ?? 'X RPL 1';
        $result = $this->state->recordAttendance(null, $className, 'Hadir', 'Simulasi Demo Scan QR');

        $todayAttendances = $this->state->getAttendances($className, date('Y-m-d'));
        $presentCount = count(array_filter($todayAttendances, fn($a) => $a['status'] === 'Hadir'));
        $students = $this->state->getStudents($className);

        return $this->response->setJSON([
            'success' => $result['success'],
            'message' => $result['message'],
            'student' => $result['student'],
            'attendance' => $result['attendance'],
            'notification' => $result['notification'],
            'presentCount' => $presentCount,
            'totalStudents' => count($students) > 0 ? count($students) : 32,
            'attendances' => $todayAttendances,
        ]);
    }
}
