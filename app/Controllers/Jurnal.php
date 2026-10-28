<?php

namespace App\Controllers;

class Jurnal extends BaseController
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
        $jurnals = $this->state->getJurnals();
        $user = $this->state->getUser();
        $attendances = $this->state->getAttendances($selectedClass, date('Y-m-d'));

        // Hitung ringkasan kehadiran hari ini untuk kelas terpilih
        $countPresent = count(array_filter($attendances, fn($a) => $a['status'] === 'Hadir'));
        $countSick = count(array_filter($attendances, fn($a) => $a['status'] === 'Sakit'));
        $countPermission = count(array_filter($attendances, fn($a) => $a['status'] === 'Izin'));
        $countAbsent = 32 - ($countPresent + $countSick + $countPermission);
        if ($countAbsent < 0) $countAbsent = 0;

        $data = [
            'title' => 'Jurnal KBM Digital - Dokumentasi Mengajar Real-Time',
            'active_nav' => 'jurnal_kbm',
            'user' => $user,
            'classes' => $classes,
            'subjects' => $subjects,
            'selectedClass' => $selectedClass,
            'jurnals' => $jurnals,
            'summaryAttendance' => [
                'hadir' => $countPresent > 0 ? $countPresent : 28,
                'sakit' => $countSick,
                'izin' => $countPermission,
                'alpa' => $countAbsent,
            ],
            'availableMethods' => [
                'Diskusi Kelompok',
                'Praktikum Lab',
                'Ceramah Interaktif',
                'Project Based Learning (PjBL)',
                'Problem Based Learning (PBL)',
                'Demonstrasi / Studi Kasus'
            ]
        ];

        return view('jurnal/index', $data);
    }

    public function store()
    {
        $this->state->ensureInitialized();

        $methodsInput = $this->request->getPost('methods');
        if (is_string($methodsInput)) {
            $methods = array_filter(array_map('trim', explode(',', $methodsInput)));
        } elseif (is_array($methodsInput)) {
            $methods = $methodsInput;
        } else {
            $methods = ['Praktikum Lab'];
        }

        $data = [
            'date' => $this->request->getPost('date') ?? date('Y-m-d'),
            'class' => $this->request->getPost('class') ?? 'X RPL 1',
            'subject' => $this->request->getPost('subject') ?? 'Pemrograman Web & Perangkat Bergerak',
            'session_hours' => $this->request->getPost('session_hours') ?? 'Jam Ke 1 - 3 (07:15 - 09:30)',
            'topic' => $this->request->getPost('topic') ?? 'Materi Pembelajaran KBM',
            'methods' => $methods,
            'notes' => $this->request->getPost('notes') ?? 'KBM berjalan lancar dan kondusif.',
            'students_present' => $this->request->getPost('students_present') ?? 30,
            'students_sick' => $this->request->getPost('students_sick') ?? 0,
            'students_permission' => $this->request->getPost('students_permission') ?? 0,
            'students_absent' => $this->request->getPost('students_absent') ?? 0,
        ];

        $newJurnal = $this->state->addJurnal($data);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Jurnal KBM Digital berhasil disimpan ke sistem!',
                'jurnal' => $newJurnal,
                'total_jurnals' => count($this->state->getJurnals())
            ]);
        }

        $this->session->setFlashdata('swal_success', 'Jurnal KBM Digital berhasil disimpan ke riwayat mengajar!');
        return redirect()->to('/jurnal-kbm');
    }
}
