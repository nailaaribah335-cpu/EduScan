<?php

namespace App\Libraries;

class DemoStateManager
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->ensureInitialized();
    }

    /**
     * Pastikan session state memiliki data dummy awal yang lengkap dan realistis
     */
    public function ensureInitialized($force = false)
    {
        $user = $this->session->get('user');
        if ($force || !$this->session->get('app_initialized') || ($user['school'] ?? '') !== 'SMK Budi Luhur') {
            $this->seedInitialData();
        }
    }

    /**
     * Inisialisasi seluruh data dummy in-memory
     */
    public function seedInitialData()
    {
        $now = date('H:i');
        $today = date('Y-m-d');

        // Data Guru / User Pengampu Aktif SMK Budi Luhur
        $user = [
            'id' => 1,
            'name' => 'Naila Salma Az-Zahra, S.Kom',
            'nip' => '19920815 201802 2 003',
            'role' => 'Guru Produktif RPL & Pemrograman Web',
            'school' => 'SMK Budi Luhur',
            'email' => 'naila.salma@smkbudiluhur.sch.id',
            'phone' => '0812-7788-5522',
            'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=250&q=80'
        ];

        // Data Kepala Sekolah SMK Budi Luhur
        $headmaster = [
            'name' => 'Drs. H. Bambang Sudarsono, M.Pd',
            'nip' => '19680512 199303 1 004',
            'school' => 'SMK Budi Luhur',
        ];

        // Daftar Kelas & Mapel
        $classes = ['X RPL 1', 'X RPL 2', 'XI TKJ 1', 'XI TKJ 2', 'XII RPL 1'];
        $subjects = [
            'Pemrograman Web & Perangkat Bergerak',
            'Basis Data & Cloud Computing',
            'Pemodelan Perangkat Lunak',
            'Administrasi Sistem Jaringan',
            'Produk Kreatif & Kewirausahaan'
        ];

        // Jadwal Mengajar Hari Ini
        $schedules = [
            [
                'id' => 1,
                'class' => 'X RPL 1',
                'subject' => 'Pemrograman Web & Perangkat Bergerak',
                'room' => 'Lab Komputer RPL 1',
                'time_start' => '07:15',
                'time_end' => '09:30',
                'session_hours' => 'Jam Ke 1 - 3',
                'status' => 'Berlangsung', // Berlangsung, Akan Datang, Selesai
                'total_students' => 32,
                'present_count' => 28,
            ],
            [
                'id' => 2,
                'class' => 'XI TKJ 2',
                'subject' => 'Administrasi Sistem Jaringan',
                'room' => 'Lab Cisco & Jaringan',
                'time_start' => '09:45',
                'time_end' => '11:45',
                'session_hours' => 'Jam Ke 4 - 6',
                'status' => 'Akan Datang',
                'total_students' => 30,
                'present_count' => 0,
            ],
            [
                'id' => 3,
                'class' => 'XII RPL 1',
                'subject' => 'Basis Data & Cloud Computing',
                'room' => 'Ruang Teori 12',
                'time_start' => '12:45',
                'time_end' => '14:45',
                'session_hours' => 'Jam Ke 7 - 9',
                'status' => 'Akan Datang',
                'total_students' => 29,
                'present_count' => 0,
            ],
        ];

        // Daftar Siswa Terdaftar (Realistis Indonesia)
        $students = [
            // X RPL 1
            [
                'nisn' => '0068192001',
                'name' => 'Ahmad Fauzi Budiarto',
                'class' => 'X RPL 1',
                'gender' => 'L',
                'parent_name' => 'Hendra Budiarto',
                'parent_phone' => '0812-8921-7711',
                'avatar' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0068192002',
                'name' => 'Siti Nurhaliza Putri',
                'class' => 'X RPL 1',
                'gender' => 'P',
                'parent_name' => 'Ratna Dewi Kusuma',
                'parent_phone' => '0813-4455-8822',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0068192003',
                'name' => 'Dimas Aditya Pratama',
                'class' => 'X RPL 1',
                'gender' => 'L',
                'parent_name' => 'Joko Widodo Susanto',
                'parent_phone' => '0821-3344-9900',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0068192004',
                'name' => 'Annisa Rahmawati',
                'class' => 'X RPL 1',
                'gender' => 'P',
                'parent_name' => 'Sri Wahyuni, S.Pd',
                'parent_phone' => '0857-1122-3344',
                'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0068192005',
                'name' => 'Muhammad Rizky Ramadhan',
                'class' => 'X RPL 1',
                'gender' => 'L',
                'parent_name' => 'Bambang Irawan',
                'parent_phone' => '0819-7788-2211',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0068192006',
                'name' => 'Nabila Putri Zahra',
                'class' => 'X RPL 1',
                'gender' => 'P',
                'parent_name' => 'Diana Lestari',
                'parent_phone' => '0812-9900-1122',
                'avatar' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0068192007',
                'name' => 'Fajar Hidayatullah',
                'class' => 'X RPL 1',
                'gender' => 'L',
                'parent_name' => 'Agus Santoso',
                'parent_phone' => '0878-5566-7788',
                'avatar' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0068192008',
                'name' => 'Cantika Maharani Dewi',
                'class' => 'X RPL 1',
                'gender' => 'P',
                'parent_name' => 'Rini Maryani',
                'parent_phone' => '0813-7722-1133',
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0068192009',
                'name' => 'Kevin Pratama Wijaya',
                'class' => 'X RPL 1',
                'gender' => 'L',
                'parent_name' => 'Budi Kusuma',
                'parent_phone' => '0822-4411-9988',
                'avatar' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0068192010',
                'name' => 'Zahra Aulia Permata',
                'class' => 'X RPL 1',
                'gender' => 'P',
                'parent_name' => 'Yuliana Permata',
                'parent_phone' => '0856-9933-2211',
                'avatar' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0068192011',
                'name' => 'Rizky Febrian Syahputra',
                'class' => 'X RPL 1',
                'gender' => 'L',
                'parent_name' => 'Dedi Mulyadi',
                'parent_phone' => '0812-3311-6677',
                'avatar' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0068192012',
                'name' => 'Tiara Andini Salsabila',
                'class' => 'X RPL 1',
                'gender' => 'P',
                'parent_name' => 'Maya Sari',
                'parent_phone' => '0813-8899-0011',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0068192013',
                'name' => 'Bagas Wicaksono',
                'class' => 'X RPL 1',
                'gender' => 'L',
                'parent_name' => 'Suryadi Wicaksono',
                'parent_phone' => '0877-2244-6688',
                'avatar' => 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0068192014',
                'name' => 'Dhea Amanda Safitri',
                'class' => 'X RPL 1',
                'gender' => 'P',
                'parent_name' => 'Endang Susanti',
                'parent_phone' => '0812-5544-3322',
                'avatar' => 'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0068192015',
                'name' => 'Gilang Ramadhan',
                'class' => 'X RPL 1',
                'gender' => 'L',
                'parent_name' => 'Rudi Hartono',
                'parent_phone' => '0819-1133-5577',
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=150&q=80',
            ],
            // XI TKJ 2
            [
                'nisn' => '0057193001',
                'name' => 'Bayu Nugroho',
                'class' => 'XI TKJ 2',
                'gender' => 'L',
                'parent_name' => 'Teguh Nugroho',
                'parent_phone' => '0812-4433-2211',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0057193002',
                'name' => 'Clara Novita Sari',
                'class' => 'XI TKJ 2',
                'gender' => 'P',
                'parent_name' => 'Hj. Mardiah',
                'parent_phone' => '0813-9988-7766',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0057193003',
                'name' => 'Doni Darmawan',
                'class' => 'XI TKJ 2',
                'gender' => 'L',
                'parent_name' => 'Darmawan Prasetyo',
                'parent_phone' => '0821-6677-8899',
                'avatar' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=150&q=80',
            ],
            // XII RPL 1
            [
                'nisn' => '0046194001',
                'name' => 'Alif Firmansyah',
                'class' => 'XII RPL 1',
                'gender' => 'L',
                'parent_name' => 'Drs. Firmansyah',
                'parent_phone' => '0812-7788-9900',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80',
            ],
            [
                'nisn' => '0046194002',
                'name' => 'Bella Citra Kirana',
                'class' => 'XII RPL 1',
                'gender' => 'P',
                'parent_name' => 'Kurnia Dewi',
                'parent_phone' => '0813-1122-4455',
                'avatar' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=150&q=80',
            ],
        ];

        // Presensi Hari Ini (Awalnya beberapa siswa sudah hadir)
        $attendances = [
            [
                'id' => 1,
                'nisn' => '0068192001',
                'name' => 'Ahmad Fauzi Budiarto',
                'class' => 'X RPL 1',
                'date' => $today,
                'time' => '07:05:22',
                'status' => 'Hadir',
                'method' => 'Dynamic QR Sesi 1',
                'device' => 'HP Siswa (Android 14)',
                'wa_sent' => true,
            ],
            [
                'id' => 2,
                'nisn' => '0068192002',
                'name' => 'Siti Nurhaliza Putri',
                'class' => 'X RPL 1',
                'date' => $today,
                'time' => '07:08:14',
                'status' => 'Hadir',
                'method' => 'Dynamic QR Sesi 1',
                'device' => 'HP Siswa (iOS 17)',
                'wa_sent' => true,
            ],
            [
                'id' => 3,
                'nisn' => '0068192003',
                'name' => 'Dimas Aditya Pratama',
                'class' => 'X RPL 1',
                'date' => $today,
                'time' => '07:11:45',
                'status' => 'Hadir',
                'method' => 'Dynamic QR Sesi 1',
                'device' => 'HP Siswa (Android 13)',
                'wa_sent' => true,
            ],
            [
                'id' => 4,
                'nisn' => '0068192004',
                'name' => 'Annisa Rahmawati',
                'class' => 'X RPL 1',
                'date' => $today,
                'time' => '07:14:02',
                'status' => 'Hadir',
                'method' => 'Scanner Kamera Guru',
                'device' => 'Kamera Web Guru',
                'wa_sent' => true,
            ],
            [
                'id' => 5,
                'nisn' => '0068192005',
                'name' => 'Muhammad Rizky Ramadhan',
                'class' => 'X RPL 1',
                'date' => $today,
                'time' => '07:16:30',
                'status' => 'Hadir',
                'method' => 'Dynamic QR Sesi 1',
                'device' => 'HP Siswa (Android 14)',
                'wa_sent' => true,
            ],
            [
                'id' => 6,
                'nisn' => '0068192006',
                'name' => 'Nabila Putri Zahra',
                'class' => 'X RPL 1',
                'date' => $today,
                'time' => '07:18:50',
                'status' => 'Izin',
                'method' => 'Surat Orang Tua',
                'device' => 'Manual Verifikasi Guru',
                'wa_sent' => true,
            ],
            [
                'id' => 7,
                'nisn' => '0068192007',
                'name' => 'Fajar Hidayatullah',
                'class' => 'X RPL 1',
                'date' => $today,
                'time' => '07:20:11',
                'status' => 'Hadir',
                'method' => 'Dynamic QR Sesi 1',
                'device' => 'HP Siswa (Android 12)',
                'wa_sent' => true,
            ],
            [
                'id' => 8,
                'nisn' => '0068192008',
                'name' => 'Cantika Maharani Dewi',
                'class' => 'X RPL 1',
                'date' => $today,
                'time' => '07:22:40',
                'status' => 'Hadir',
                'method' => 'Scanner Kamera Guru',
                'device' => 'Kamera Web Guru',
                'wa_sent' => true,
            ],
            [
                'id' => 9,
                'nisn' => '0068192009',
                'name' => 'Kevin Pratama Wijaya',
                'class' => 'X RPL 1',
                'date' => $today,
                'time' => '07:25:05',
                'status' => 'Hadir',
                'method' => 'Dynamic QR Sesi 1',
                'device' => 'HP Siswa (iOS 16)',
                'wa_sent' => true,
            ],
            [
                'id' => 10,
                'nisn' => '0068192010',
                'name' => 'Zahra Aulia Permata',
                'class' => 'X RPL 1',
                'date' => $today,
                'time' => '07:27:18',
                'status' => 'Sakit',
                'method' => 'Surat Dokter / WA Ortu',
                'device' => 'Manual Verifikasi Guru',
                'wa_sent' => true,
            ],
        ];

        // Log Notifikasi WhatsApp ke Orang Tua
        $notifications = [
            [
                'id' => 1,
                'student_name' => 'Ahmad Fauzi Budiarto',
                'class' => 'X RPL 1',
                'parent_name' => 'Hendra Budiarto',
                'parent_phone' => '0812-8921-7711',
                'message' => 'Yth. Bapak Hendra Budiarto, kami informasikan bahwa putra/putri Anda: Ahmad Fauzi Budiarto (X RPL 1) telah tercatat HADIR di kelas pada pukul 07:05 WIB via Scan QR Code SMK Budi Luhur. Terima kasih atas kerja samanya.',
                'sent_at' => $today . ' 07:05:24',
                'status' => 'Terkirim',
                'read_status' => 'Dibaca',
            ],
            [
                'id' => 2,
                'student_name' => 'Siti Nurhaliza Putri',
                'class' => 'X RPL 1',
                'parent_name' => 'Ratna Dewi Kusuma',
                'parent_phone' => '0813-4455-8822',
                'message' => 'Yth. Ibu Ratna Dewi Kusuma, kami informasikan bahwa putra/putri Anda: Siti Nurhaliza Putri (X RPL 1) telah tercatat HADIR di kelas pada pukul 07:08 WIB via Scan QR Code. Terima kasih atas kerja samanya.',
                'sent_at' => $today . ' 07:08:16',
                'status' => 'Terkirim',
                'read_status' => 'Dibaca',
            ],
            [
                'id' => 3,
                'student_name' => 'Dimas Aditya Pratama',
                'class' => 'X RPL 1',
                'parent_name' => 'Joko Widodo Susanto',
                'parent_phone' => '0821-3344-9900',
                'message' => 'Yth. Bapak Joko Widodo Susanto, kami informasikan bahwa putra/putri Anda: Dimas Aditya Pratama (X RPL 1) telah tercatat HADIR di kelas pada pukul 07:11 WIB via Scan QR Code. Terima kasih atas kerja samanya.',
                'sent_at' => $today . ' 07:11:47',
                'status' => 'Terkirim',
                'read_status' => 'Dibaca',
            ],
            [
                'id' => 4,
                'student_name' => 'Annisa Rahmawati',
                'class' => 'X RPL 1',
                'parent_name' => 'Sri Wahyuni, S.Pd',
                'parent_phone' => '0857-1122-3344',
                'message' => 'Yth. Ibu Sri Wahyuni, S.Pd, kami informasikan bahwa putra/putri Anda: Annisa Rahmawati (X RPL 1) telah tercatat HADIR di kelas pada pukul 07:14 WIB via Scan QR Code. Terima kasih atas kerja samanya.',
                'sent_at' => $today . ' 07:14:04',
                'status' => 'Terkirim',
                'read_status' => 'Terkirim',
            ],
            [
                'id' => 5,
                'student_name' => 'Nabila Putri Zahra',
                'class' => 'X RPL 1',
                'parent_name' => 'Diana Lestari',
                'parent_phone' => '0812-9900-1122',
                'message' => 'Yth. Ibu Diana Lestari, kami mengonfirmasi bahwa status kehadiran putra/putri Anda: Nabila Putri Zahra (X RPL 1) hari ini tercatat IZIN sesuai pemberitahuan orang tua. Semoga ananda selalu dalam lindungan-Nya.',
                'sent_at' => $today . ' 07:18:52',
                'status' => 'Terkirim',
                'read_status' => 'Dibaca',
            ],
            [
                'id' => 6,
                'student_name' => 'Fajar Hidayatullah',
                'class' => 'X RPL 1',
                'parent_name' => 'Agus Santoso',
                'parent_phone' => '0878-5566-7788',
                'message' => 'Yth. Bapak Agus Santoso, kami informasikan bahwa putra/putri Anda: Fajar Hidayatullah (X RPL 1) telah tercatat HADIR di kelas pada pukul 07:20 WIB via Scan QR Code. Terima kasih atas kerja samanya.',
                'sent_at' => $today . ' 07:20:13',
                'status' => 'Terkirim',
                'read_status' => 'Dibaca',
            ],
            [
                'id' => 7,
                'student_name' => 'Zahra Aulia Permata',
                'class' => 'X RPL 1',
                'parent_name' => 'Yuliana Permata',
                'parent_phone' => '0856-9933-2211',
                'message' => 'Yth. Ibu Yuliana Permata, kami mencatat ananda Zahra Aulia Permata (X RPL 1) berstatus SAKIT hari ini. Doa kami semoga ananda lekas sembuh dan dapat beraktivitas kembali.',
                'sent_at' => $today . ' 07:27:20',
                'status' => 'Terkirim',
                'read_status' => 'Dibaca',
            ],
        ];

        // Riwayat Jurnal KBM Guru
        $jurnals = [
            [
                'id' => 1,
                'date' => $today,
                'class' => 'X RPL 1',
                'subject' => 'Pemrograman Web & Perangkat Bergerak',
                'session_hours' => 'Jam Ke 1 - 3 (07:15 - 09:30)',
                'topic' => 'Arsitektur MVC CodeIgniter 4 & Pembuatan REST Controller Presensi',
                'methods' => ['Praktikum Lab', 'Project Based Learning (PjBL)'],
                'notes' => 'Siswa antusias mempraktikkan routing dan controller. Seluruh workstation di Lab RPL 1 berfungsi optimal.',
                'students_present' => 28,
                'students_sick' => 1,
                'students_permission' => 1,
                'students_absent' => 2,
                'teacher_name' => 'Naila Salma Az-Zahra, S.Kom',
                'created_at' => $today . ' 09:30:00',
            ],
            [
                'id' => 2,
                'date' => date('Y-m-d', strtotime('-1 day')),
                'class' => 'XI TKJ 2',
                'subject' => 'Administrasi Sistem Jaringan',
                'session_hours' => 'Jam Ke 4 - 6 (09:45 - 11:45)',
                'topic' => 'Konfigurasi Web Server Apache & Dynamic DNS Debian 12',
                'methods' => ['Praktikum Lab', 'Diskusi Kelompok'],
                'notes' => '3 siswa sempat terkendala IP address conflict, berhasil diselesaikan dengan konfigurasi static lease DHCP.',
                'students_present' => 29,
                'students_sick' => 1,
                'students_permission' => 0,
                'students_absent' => 0,
                'teacher_name' => 'Naila Salma Az-Zahra, S.Kom',
                'created_at' => date('Y-m-d', strtotime('-1 day')) . ' 11:50:00',
            ],
            [
                'id' => 3,
                'date' => date('Y-m-d', strtotime('-2 days')),
                'class' => 'XII RPL 1',
                'subject' => 'Basis Data & Cloud Computing',
                'session_hours' => 'Jam Ke 7 - 9 (12:45 - 14:45)',
                'topic' => 'Optimasi Indexing MySQL & Integrasi Storage Cloud AWS S3',
                'methods' => ['Ceramah Interaktif', 'Praktikum Lab'],
                'notes' => 'Evaluasi hasil tugas mandiri database tuning menunjukkan peningkatan query execution time hingga 60%.',
                'students_present' => 28,
                'students_sick' => 0,
                'students_permission' => 1,
                'students_absent' => 0,
                'teacher_name' => 'Naila Salma Az-Zahra, S.Kom',
                'created_at' => date('Y-m-d', strtotime('-2 days')) . ' 14:55:00',
            ],
            [
                'id' => 4,
                'date' => date('Y-m-d', strtotime('-3 days')),
                'class' => 'X RPL 2',
                'subject' => 'Pemodelan Perangkat Lunak',
                'session_hours' => 'Jam Ke 1 - 3 (07:15 - 09:30)',
                'topic' => 'Use Case Diagram & Activity Diagram Sistem Presensi Sekolah',
                'methods' => ['Diskusi Kelompok', 'Presentasi Siswa'],
                'notes' => 'Tiap kelompok berhasil mempresentasikan diagram use case sistem presensi QR code dengan pembagian aktor yang jelas.',
                'students_present' => 31,
                'students_sick' => 1,
                'students_permission' => 0,
                'students_absent' => 0,
                'teacher_name' => 'Naila Salma Az-Zahra, S.Kom',
                'created_at' => date('Y-m-d', strtotime('-3 days')) . ' 09:35:00',
            ],
        ];

        // Status WhatsApp Gateway
        $gateway = [
            'status' => 'CONNECTED',
            'device_name' => 'WA-GATEWAY-BUDILUHUR',
            'server_ip' => '192.168.1.100',
            'sender_number' => '+62 821-5544-7788',
            'ping_ms' => 310,
            'quota_used' => 142,
            'quota_max' => 1000,
            'auto_send_enabled' => true,
            'last_sync' => date('Y-m-d H:i:s'),
        ];

        // Simpan ke session
        $this->session->set([
            'app_initialized' => true,
            'is_logged_in' => false, // Memerlukan login terlebih dahulu saat pertama kali buka
            'current_role' => 'guru',
            'user' => $user,
            'classes' => $classes,
            'subjects' => $subjects,
            'schedules' => $schedules,
            'students' => $students,
            'attendances' => $attendances,
            'notifications' => $notifications,
            'jurnals' => $jurnals,
            'gateway' => $gateway,
        ]);
    }

    public function getUser()
    {
        return $this->session->get('user') ?? [];
    }

    public function getClasses()
    {
        return $this->session->get('classes') ?? [];
    }

    public function getSubjects()
    {
        return $this->session->get('subjects') ?? [];
    }

    public function getSchedules()
    {
        return $this->session->get('schedules') ?? [];
    }

    public function getStudents($class = null)
    {
        $students = $this->session->get('students') ?? [];
        if ($class) {
            return array_values(array_filter($students, function ($s) use ($class) {
                return $s['class'] === $class;
            }));
        }
        return $students;
    }

    public function getAttendances($class = null, $date = null)
    {
        $attendances = $this->session->get('attendances') ?? [];
        if ($class || $date) {
            return array_values(array_filter($attendances, function ($a) use ($class, $date) {
                $matchClass = $class ? ($a['class'] === $class) : true;
                $matchDate = $date ? ($a['date'] === $date) : true;
                return $matchClass && $matchDate;
            }));
        }
        return $attendances;
    }

    public function getJurnals($class = null)
    {
        $jurnals = $this->session->get('jurnals') ?? [];
        if ($class) {
            return array_values(array_filter($jurnals, function ($j) use ($class) {
                return $j['class'] === $class;
            }));
        }
        return $jurnals;
    }

    public function getNotifications($search = null)
    {
        $notifications = $this->session->get('notifications') ?? [];
        if ($search) {
            $search = strtolower($search);
            return array_values(array_filter($notifications, function ($n) use ($search) {
                return str_contains(strtolower($n['student_name']), $search) ||
                       str_contains(strtolower($n['parent_name']), $search) ||
                       str_contains(strtolower($n['class']), $search) ||
                       str_contains(strtolower($n['parent_phone']), $search);
            }));
        }
        return $notifications;
    }

    public function getGateway()
    {
        return $this->session->get('gateway') ?? [];
    }

    /**
     * Catat Presensi Siswa via Scan QR atau Simulasi
     */
    public function recordAttendance($nisn, $className = null, $status = 'Hadir', $method = 'Dynamic QR Sesi')
    {
        $students = $this->session->get('students') ?? [];
        $attendances = $this->session->get('attendances') ?? [];
        $today = date('Y-m-d');
        $time = date('H:i:s');

        // Cari data siswa
        $targetStudent = null;
        foreach ($students as $s) {
            if ($s['nisn'] === $nisn) {
                $targetStudent = $s;
                break;
            }
        }

        // Jika tidak ditemukan berdasarkan NISN spesifik, cari yang belum hadir di kelas tersebut
        if (!$targetStudent && $className) {
            $alreadyPresentNisns = array_column(
                array_filter($attendances, fn($a) => $a['class'] === $className && $a['date'] === $today),
                'nisn'
            );
            foreach ($students as $s) {
                if ($s['class'] === $className && !in_array($s['nisn'], $alreadyPresentNisns)) {
                    $targetStudent = $s;
                    break;
                }
            }
        }

        // Jika masih belum ada, gunakan siswa pertama yang belum hadir
        if (!$targetStudent) {
            $alreadyPresentNisns = array_column(
                array_filter($attendances, fn($a) => $a['date'] === $today),
                'nisn'
            );
            foreach ($students as $s) {
                if (!in_array($s['nisn'], $alreadyPresentNisns)) {
                    $targetStudent = $s;
                    break;
                }
            }
        }

        // Jika semua sudah hadir, ambil salah satu siswa untuk demo
        if (!$targetStudent && !empty($students)) {
            $targetStudent = $students[array_rand($students)];
        }

        if (!$targetStudent) {
            return [
                'success' => false,
                'message' => 'Data siswa tidak ditemukan.'
            ];
        }

        // Cek apakah sudah absen hari ini
        $alreadyAttended = false;
        foreach ($attendances as $idx => $att) {
            if ($att['nisn'] === $targetStudent['nisn'] && $att['date'] === $today) {
                $alreadyAttended = true;
                // Update status jika berbeda
                $attendances[$idx]['time'] = $time;
                $attendances[$idx]['status'] = $status;
                $attendances[$idx]['method'] = $method;
                break;
            }
        }

        $newAttendanceRecord = null;
        if (!$alreadyAttended) {
            $newAttendanceRecord = [
                'id' => count($attendances) + 1,
                'nisn' => $targetStudent['nisn'],
                'name' => $targetStudent['name'],
                'class' => $targetStudent['class'],
                'date' => $today,
                'time' => $time,
                'status' => $status,
                'method' => $method,
                'device' => 'Webcam Scanner / Dynamic QR',
                'wa_sent' => true,
            ];
            // Sisipkan di posisi teratas
            array_unshift($attendances, $newAttendanceRecord);
        }

        $this->session->set('attendances', $attendances);

        // Otomatis kirim notifikasi WhatsApp ke Orang Tua
        $notifResult = $this->triggerParentNotification(
            $targetStudent['name'],
            $targetStudent['class'],
            $targetStudent['parent_name'],
            $targetStudent['parent_phone'],
            $status,
            $time
        );

        return [
            'success' => true,
            'is_new' => !$alreadyAttended,
            'student' => $targetStudent,
            'attendance' => $newAttendanceRecord ?? [
                'nisn' => $targetStudent['nisn'],
                'name' => $targetStudent['name'],
                'class' => $targetStudent['class'],
                'time' => $time,
                'status' => $status
            ],
            'notification' => $notifResult,
            'message' => 'Presensi berhasil diverifikasi!'
        ];
    }

    /**
     * Trigger WhatsApp Notification to Parent
     */
    public function triggerParentNotification($studentName, $className, $parentName, $phone, $status = 'Hadir', $time = null)
    {
        $time = $time ?? date('H:i');
        $notifications = $this->session->get('notifications') ?? [];
        $gateway = $this->session->get('gateway') ?? [];

        $statusText = strtoupper($status);
        $message = "Yth. Bapak/Ibu {$parentName}, kami informasikan bahwa putra/putri Anda: {$studentName} ({$className}) telah tercatat {$statusText} di kelas pada pukul {$time} WIB via Scan QR Code. Terima kasih atas kerja samanya.";

        $newNotif = [
            'id' => count($notifications) + 1,
            'student_name' => $studentName,
            'class' => $className,
            'parent_name' => $parentName,
            'parent_phone' => $phone,
            'message' => $message,
            'sent_at' => date('Y-m-d H:i:s'),
            'status' => 'Terkirim',
            'read_status' => 'Terkirim',
        ];

        array_unshift($notifications, $newNotif);
        $this->session->set('notifications', $notifications);

        // Update quota gateway
        if (isset($gateway['quota_used'])) {
            $gateway['quota_used'] += 1;
            $gateway['last_sync'] = date('Y-m-d H:i:s');
            $this->session->set('gateway', $gateway);
        }

        return $newNotif;
    }

    /**
     * Tambah Catatan Jurnal KBM
     */
    public function addJurnal($data)
    {
        $jurnals = $this->session->get('jurnals') ?? [];
        $user = $this->getUser();

        $newJurnal = [
            'id' => count($jurnals) + 1,
            'date' => $data['date'] ?? date('Y-m-d'),
            'class' => $data['class'] ?? 'X RPL 1',
            'subject' => $data['subject'] ?? 'Pemrograman Web & Perangkat Bergerak',
            'session_hours' => $data['session_hours'] ?? 'Jam Ke 1 - 3',
            'topic' => $data['topic'] ?? '',
            'methods' => is_array($data['methods'] ?? null) ? $data['methods'] : explode(',', $data['methods'] ?? 'Diskusi'),
            'notes' => $data['notes'] ?? '',
            'students_present' => (int)($data['students_present'] ?? 30),
            'students_sick' => (int)($data['students_sick'] ?? 0),
            'students_permission' => (int)($data['students_permission'] ?? 0),
            'students_absent' => (int)($data['students_absent'] ?? 0),
            'teacher_name' => $user['name'] ?? 'Naila Salma Az-Zahra, S.Kom',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        array_unshift($jurnals, $newJurnal);
        $this->session->set('jurnals', $jurnals);

        return $newJurnal;
    }

    /**
     * Hitung Metrik Dashboard
     */
    public function getDashboardMetrics()
    {
        $today = date('Y-m-d');
        $attendances = $this->getAttendances(null, $today);
        $notifications = $this->getNotifications();
        $jurnals = $this->getJurnals();
        $students = $this->getStudents();

        $presentCount = count(array_filter($attendances, fn($a) => $a['status'] === 'Hadir'));
        $sickCount = count(array_filter($attendances, fn($a) => $a['status'] === 'Sakit'));
        $permissionCount = count(array_filter($attendances, fn($a) => $a['status'] === 'Izin'));
        $absentCount = count(array_filter($attendances, fn($a) => $a['status'] === 'Alpa'));
        if ($absentCount === 0) {
            // Default realistis untuk demo jika belum ada yang diset alpa
            $absentCount = 2;
        }
        $totalTodayExpected = 150; // Total siswa di sesi hari ini
        $percentage = $totalTodayExpected > 0 ? round(($presentCount / 32) * 100, 1) : 0;
        if ($percentage > 100) $percentage = 100;

        return [
            'present_count' => $presentCount,
            'sick_count' => $sickCount,
            'permission_count' => $permissionCount,
            'absent_count' => $absentCount,
            'total_expected' => $totalTodayExpected,
            'percentage' => $percentage,
            'jurnal_count' => count($jurnals),
            'notif_count' => count($notifications),
            'total_classes' => count($this->getClasses()),
            'classes' => $this->getClasses(),
            'recent_attendances' => array_slice($attendances, 0, 8),
            'schedules' => $this->getSchedules(),
        ];
    }

    /**
     * Manajemen Role Siswa vs Guru
     */
    public function getCurrentRole()
    {
        return $this->session->get('current_role') ?? 'guru';
    }

    public function loginAsStudent($nisn = '0068192001')
    {
        $students = $this->getStudents();
        $target = null;
        foreach ($students as $s) {
            if ($s['nisn'] === $nisn) {
                $target = $s;
                break;
            }
        }
        if (!$target && !empty($students)) {
            $target = $students[0];
        }

        $this->session->set([
            'is_logged_in' => true,
            'current_role' => 'siswa',
            'logged_student' => $target,
        ]);

        return $target;
    }

    public function loginAsTeacher()
    {
        $this->session->set([
            'is_logged_in' => true,
            'current_role' => 'guru',
        ]);
        return $this->getUser();
    }

    public function getLoggedStudent()
    {
        $student = $this->session->get('logged_student');
        if (!$student) {
            $students = $this->getStudents();
            $student = $students[0] ?? [
                'nisn' => '0068192001',
                'name' => 'Ahmad Fauzi Budiarto',
                'class' => 'X RPL 1',
                'gender' => 'L',
                'parent_name' => 'Hendra Budiarto',
                'parent_phone' => '0812-8921-7711',
                'avatar' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=150&q=80',
            ];
            $this->session->set('logged_student', $student);
        }
        return $student;
    }

    public function getStudentAttendanceHistory($nisn)
    {
        $attendances = $this->session->get('attendances') ?? [];
        return array_values(array_filter($attendances, fn($a) => $a['nisn'] === $nisn));
    }

    public function getStudentClassJournals($className)
    {
        return $this->getJurnals($className);
    }
}

