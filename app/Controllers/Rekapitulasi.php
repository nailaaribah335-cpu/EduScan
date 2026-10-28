<?php

namespace App\Controllers;

class Rekapitulasi extends BaseController
{
    public function index()
    {
        $this->state->ensureInitialized();

        if (!$this->session->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $classes = $this->state->getClasses();
        $subjects = $this->state->getSubjects();

        $selectedClass = $this->request->getGet('kelas') ?? 'X RPL 1';
        $selectedSubject = $this->request->getGet('mapel') ?? 'Semua Mata Pelajaran';
        $dateStart = $this->request->getGet('tgl_mulai') ?? date('Y-m-d', strtotime('-6 days'));
        $dateEnd = $this->request->getGet('tgl_selesai') ?? date('Y-m-d');

        $attendances = $this->state->getAttendances($selectedClass);
        $jurnals = $this->state->getJurnals($selectedClass);
        $user = $this->state->getUser();
        $students = $this->state->getStudents($selectedClass);

        // Siapkan data rekapitulasi harian
        $dailyRecap = [
            [
                'date' => date('Y-m-d'),
                'day' => 'Hari Ini',
                'class' => $selectedClass,
                'total_students' => 32,
                'present' => 29,
                'sick' => 1,
                'permission' => 1,
                'absent' => 1,
                'percentage' => 90.6,
                'topic' => 'Arsitektur MVC CodeIgniter 4 & Pembuatan REST Controller Presensi',
            ],
            [
                'date' => date('Y-m-d', strtotime('-1 day')),
                'day' => 'Kemarin',
                'class' => $selectedClass,
                'total_students' => 32,
                'present' => 31,
                'sick' => 1,
                'permission' => 0,
                'absent' => 0,
                'percentage' => 96.9,
                'topic' => 'Integrasi Tailwind CSS & Responsive Grid Layouting',
            ],
            [
                'date' => date('Y-m-d', strtotime('-2 days')),
                'day' => '2 Hari Lalu',
                'class' => $selectedClass,
                'total_students' => 32,
                'present' => 30,
                'sick' => 0,
                'permission' => 2,
                'absent' => 0,
                'percentage' => 93.8,
                'topic' => 'Koneksi API & Asynchronous Fetch Menggunakan JavaScript',
            ],
            [
                'date' => date('Y-m-d', strtotime('-3 days')),
                'day' => '3 Hari Lalu',
                'class' => $selectedClass,
                'total_students' => 32,
                'present' => 32,
                'sick' => 0,
                'permission' => 0,
                'absent' => 0,
                'percentage' => 100.0,
                'topic' => 'Konsep Dasar QR Code Scanning & Enkripsi Hash Token',
            ],
            [
                'date' => date('Y-m-d', strtotime('-4 days')),
                'day' => '4 Hari Lalu',
                'class' => $selectedClass,
                'total_students' => 32,
                'present' => 28,
                'sick' => 2,
                'permission' => 1,
                'absent' => 1,
                'percentage' => 87.5,
                'topic' => 'Review Proyek Akhir & Praktikum Troubleshooting Database',
            ],
        ];

        // Hitung total agregat
        $totalPresentAll = array_sum(array_column($dailyRecap, 'present'));
        $totalSickAll = array_sum(array_column($dailyRecap, 'sick'));
        $totalPermissionAll = array_sum(array_column($dailyRecap, 'permission'));
        $totalAbsentAll = array_sum(array_column($dailyRecap, 'absent'));
        $totalCapacityAll = array_sum(array_column($dailyRecap, 'total_students'));
        $overallPercentage = $totalCapacityAll > 0 ? round(($totalPresentAll / $totalCapacityAll) * 100, 1) : 0;

        $data = [
            'title' => 'Rekapitulasi Web - Analisis Kehadiran & Jurnal KBM',
            'active_nav' => 'rekapitulasi',
            'user' => $user,
            'classes' => $classes,
            'subjects' => $subjects,
            'selectedClass' => $selectedClass,
            'selectedSubject' => $selectedSubject,
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd,
            'dailyRecap' => $dailyRecap,
            'attendances' => $attendances,
            'students' => $students,
            'jurnals' => $jurnals,
            'stats' => [
                'total_present' => $totalPresentAll,
                'total_sick' => $totalSickAll,
                'total_permission' => $totalPermissionAll,
                'total_absent' => $totalAbsentAll,
                'overall_percentage' => $overallPercentage,
            ]
        ];

        return view('rekapitulasi/index', $data);
    }
}
