<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50 overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= esc($title ?? 'EduScan QR - Presensi & Jurnal Mengajar') ?></title>
    <meta name="description" content="Platform digital terintegrasi untuk mencatat kehadiran siswa/guru via scan QR Code serta mendokumentasikan jurnal KBM harian secara real-time, akurat, dan tanpa kertas.">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        // Ref 1 Warm Tangerine Orange
                        tangerine: {
                            50: '#FFF7ED',
                            100: '#FFEDD5',
                            200: '#FED7AA',
                            300: '#FDBA74',
                            400: '#FB923C',
                            500: '#FF7A00',
                            600: '#EA580C',
                            700: '#C2410C',
                        },
                        // Ref 1 & 2 Vibrant Royal / Periwinkle Indigo Blue
                        royal: {
                            50: '#EEF2FF',
                            100: '#E0E7FF',
                            200: '#C7D2FE',
                            300: '#A5B4FC',
                            400: '#818CF8',
                            500: '#4F46E5',
                            600: '#4338CA',
                            700: '#3730A3',
                            800: '#312E81',
                            900: '#1E1B4B',
                        },
                        // Ref 1 & 2 Emerald Mint Green
                        mint: {
                            50: '#ECFDF5',
                            100: '#D1FAE5',
                            200: '#A7F3D0',
                            400: '#34D399',
                            500: '#10B981',
                            600: '#059669',
                            700: '#047857',
                        },
                        posterGreen: {
                            400: '#34D399',
                            500: '#10B981',
                            600: '#059669',
                            700: '#047857',
                        },
                        // Ref 1 Coral Red for Absent/Alerts
                        coral: {
                            50: '#FFF1F2',
                            100: '#FFE4E6',
                            200: '#FECDD3',
                            400: '#FB7185',
                            500: '#FF5252',
                            600: '#EE5253',
                            700: '#E11D48',
                        },
                        // Ref 1 Sunny Yellow for Permission/Warning
                        sunshine: {
                            50: '#FFFBEB',
                            100: '#FEF3C7',
                            200: '#FDE68A',
                            400: '#FBBF24',
                            500: '#FFB703',
                            600: '#D97706',
                        },
                        sand: {
                            300: '#FEF3C7',
                            400: '#FDE68A',
                            500: '#FFB703',
                            600: '#D97706',
                        },
                    },
                    boxShadow: {
                        'soft': '0 10px 30px -4px rgba(15, 23, 42, 0.04), 0 4px 10px -2px rgba(15, 23, 42, 0.02)',
                        'card': '0 20px 40px -6px rgba(15, 23, 42, 0.06), 0 6px 14px -3px rgba(15, 23, 42, 0.03)',
                        'tangerine': '0 12px 28px -4px rgba(255, 122, 0, 0.3)',
                        'royal': '0 12px 28px -4px rgba(79, 70, 229, 0.25)',
                        'mint': '0 12px 28px -4px rgba(16, 185, 129, 0.25)',
                    }
                }
            }
        };

        // Deteksi & Inisialisasi Cepat Tema Terang / Gelap
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Global Dark Mode CSS Overrides for Premium Sleek Night Mode -->
    <style>
        html.dark {
            color-scheme: dark;
        }
        
        /* Ambient glowing background */
        html.dark body {
            background-color: #0B1120 !important;
            color: #F1F5F9 !important;
        }

        /* Glassmorphism sidebar & header in dark mode */
        .dark aside {
            background-color: rgba(15, 23, 42, 0.95) !important;
            border-color: rgba(30, 41, 59, 0.8) !important;
        }

        .dark header {
            background-color: rgba(15, 23, 42, 0.85) !important;
            border-color: rgba(30, 41, 59, 0.8) !important;
        }

        /* Solid White Cards to Deep Navy/Slate Glass */
        .dark .bg-white {
            background-color: #111C35 !important;
            border-color: #1E293B !important;
            color: #F1F5F9;
        }

        /* Inner slate tinted boxes (e.g. form inputs, inner panels) */
        .dark .bg-slate-50,
        .dark .bg-slate-50\/80,
        .dark .bg-slate-50\/60,
        .dark .bg-slate-50\/50 {
            background-color: #17223B !important;
            border-color: #273553 !important;
        }

        .dark .bg-slate-100,
        .dark .bg-slate-100\/90,
        .dark .bg-slate-100\/80 {
            background-color: #1E2A47 !important;
            color: #E2E8F0 !important;
            border-color: #2B3A5E !important;
        }

        /* High-contrast typography in dark mode */
        .dark .text-slate-900 {
            color: #FFFFFF !important;
        }

        .dark .text-slate-800 {
            color: #F1F5F9 !important;
        }

        .dark .text-slate-700 {
            color: #CBD5E1 !important;
        }

        .dark .text-slate-600 {
            color: #94A3B8 !important;
        }

        .dark .text-slate-500 {
            color: #94A3B8 !important;
        }

        .dark .text-slate-400 {
            color: #94A3B8 !important;
        }

        /* Inputs, Select, Textareas */
        .dark input,
        .dark select,
        .dark textarea {
            background-color: #17223B !important;
            border-color: #334155 !important;
            color: #FFFFFF !important;
        }

        /* Fix gradient cards in dark mode: preserve deep rich gradients */
        .dark .bg-gradient-to-br.from-orange-50\/60,
        .dark .bg-gradient-to-br.from-tangerine-50\/70,
        .dark .bg-gradient-to-br.from-royal-50 {
            background-image: linear-gradient(135deg, rgba(30, 27, 46, 0.95), rgba(20, 28, 50, 0.95)) !important;
            border-color: rgba(255, 122, 0, 0.3) !important;
        }

        .dark .bg-gradient-to-br.from-royal-50\/70,
        .dark .bg-gradient-to-br.from-royal-50.via-white {
            background-image: linear-gradient(135deg, rgba(20, 28, 52, 0.95), rgba(15, 23, 42, 0.95)) !important;
            border-color: rgba(79, 70, 229, 0.3) !important;
        }

        /* Table dividers and hover */
        .dark .divide-slate-100 > :not([hidden]) ~ :not([hidden]),
        .dark .divide-slate-200 > :not([hidden]) ~ :not([hidden]),
        .dark .border-slate-100,
        .dark .border-slate-200,
        .dark .border-slate-200\/80,
        .dark .border-slate-200\/70,
        .dark .border-slate-200\/60 {
            border-color: #1E293B !important;
        }

        .dark tr:hover td {
            background-color: rgba(30, 41, 69, 0.6) !important;
        }

        /* Modal popups */
        .dark .swal2-popup {
            background-color: #111C35 !important;
            border: 1px solid #1E293B !important;
            color: #F8FAFC !important;
        }

        .dark .swal2-title,
        .dark .swal2-html-container {
            color: #F8FAFC !important;
        }
    </style>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- QR Code & Scanner Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- html2pdf.js & SheetJS (xlsx) for clean reporting exports -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
        }

        /* Prevent unwanted horizontal drag/swipe */
        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }

        /* Pulse scan laser effect */
        @keyframes scanLaser {
            0% { top: 4%; opacity: 0.8; }
            50% { top: 92%; opacity: 1; }
            100% { top: 4%; opacity: 0.8; }
        }
        .animate-scan-laser {
            animation: scanLaser 2.2s ease-in-out infinite;
        }
    </style>
</head>
<body class="h-full flex flex-col md:flex-row text-slate-800 antialiased selection:bg-tangerine-500 selection:text-white overflow-x-hidden relative">

    <!-- REF 1: ORGANIC AMBIENT BACKGROUND BLOBS -->
    <!-- Top-Left Warm Tangerine Orange Wave Blob -->
    <div class="fixed -top-36 -left-36 w-[560px] h-[560px] rounded-full bg-gradient-to-br from-tangerine-400/20 via-sunshine-400/15 to-transparent blur-3xl pointer-events-none -z-10"></div>
    <!-- Bottom-Right Electric Royal Blue Wave Blob -->
    <div class="fixed -bottom-40 -right-40 w-[600px] h-[600px] rounded-full bg-gradient-to-tl from-royal-500/20 via-blue-400/15 to-transparent blur-3xl pointer-events-none -z-10"></div>
    <!-- Subtle Center-Left Accent -->
    <div class="fixed top-1/2 -left-20 w-[300px] h-[300px] rounded-full bg-mint-400/10 blur-3xl pointer-events-none -z-10"></div>

    <?php
    $currentRole = session()->get('current_role') ?? 'guru';
    $isStudent = ($currentRole === 'siswa');
    $studentData = session()->get('logged_student') ?? [];
    $teacherData = session()->get('user') ?? [
        'name' => 'Naila Salma Az-Zahra, S.Kom',
        'role' => 'Guru Produktif RPL',
        'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=250&q=80'
    ];
    ?>

    <!-- DESKTOP SIDEBAR (REF 2: CLEAN WHITE LOZEQ-STYLE SIDEBAR) -->
    <aside class="hidden md:flex md:w-72 md:flex-col md:fixed md:inset-y-0 z-30 bg-white/95 backdrop-blur-xl border-r border-slate-200/80 shadow-[2px_0_24px_rgba(0,0,0,0.02)]">
        <!-- Logo & Header with Ref 2 cute dual-color mark -->
        <div class="px-6 py-6 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-tangerine-500 via-sunshine-500 to-royal-500 flex items-center justify-center shadow-md shadow-tangerine-500/20 text-white font-black text-base">
                    <i data-lucide="scan-line" class="w-5 h-5 text-white stroke-[2.5]"></i>
                </div>
                <div>
                    <div class="flex items-center space-x-1.5">
                        <span class="text-lg font-black tracking-tight text-slate-900">EduScan</span>
                        <span class="text-[10px] font-black uppercase px-1.5 py-0.5 rounded-md bg-tangerine-500 text-white font-mono">QR</span>
                    </div>
                    <p class="text-[11px] font-semibold text-slate-400">SMK Budi Luhur</p>
                </div>
            </div>
        </div>

        <!-- User Profile Card in Sidebar (Adaptive: Guru vs Siswa) -->
        <div class="px-4 py-3 mx-4 my-3 rounded-2xl bg-slate-50 border border-slate-200/70 flex items-center space-x-3">
            <div class="relative shrink-0">
                <img src="<?= esc($isStudent ? ($studentData['avatar'] ?? 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=150&q=80') : ($teacherData['avatar'] ?? 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=250&q=80')) ?>" alt="User Avatar" class="w-10 h-10 rounded-xl object-cover ring-2 ring-tangerine-400">
                <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-mint-500 border-2 border-white rounded-full"></span>
            </div>
            <div class="overflow-hidden">
                <h4 class="text-xs font-bold text-slate-900 truncate"><?= esc($isStudent ? ($studentData['name'] ?? 'Ahmad Fauzi Budiarto') : ($teacherData['name'] ?? 'Naila Salma Az-Zahra, S.Kom')) ?></h4>
                <p class="text-[11px] text-slate-500 font-medium truncate"><?= esc($isStudent ? ('Siswa: ' . ($studentData['class'] ?? 'X RPL 1')) : ($teacherData['role'] ?? 'Guru Produktif RPL')) ?></p>
            </div>
        </div>

        <!-- Navigation Menu with Ref 2 Rounded Pill Nav Items -->
        <div class="flex-1 px-4 py-2 space-y-1 overflow-y-auto">
            <?php if ($isStudent): ?>
                <!-- SISWA MENU -->
                <div class="px-3 pt-2 pb-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">Portal Siswa</div>
                <a href="<?= base_url('siswa') ?>" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-2xl text-sm font-bold transition-all bg-royal-50 text-royal-600 shadow-sm border border-royal-100">
                    <i data-lucide="id-card" class="w-5 h-5 text-royal-600"></i>
                    <span>Portal & Kartu Siswa</span>
                </a>
                <a href="<?= base_url('switch-role/guru') ?>" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-2xl text-sm font-semibold transition-all text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                    <i data-lucide="arrow-left" class="w-5 h-5 text-tangerine-500"></i>
                    <span>Kembali ke Mode Guru</span>
                </a>
            <?php else: ?>
                <!-- GURU / ADMIN MENU -->
                <div class="px-3 pt-2 pb-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">Menu Utama</div>

                <!-- Dashboard -->
                <a href="<?= base_url('dashboard') ?>" class="relative flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-sm font-semibold transition-all duration-200 <?= ($active_nav ?? '') === 'dashboard' ? 'bg-royal-50 text-royal-600 font-bold border border-royal-100 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' ?>">
                    <?php if (($active_nav ?? '') === 'dashboard'): ?>
                        <span class="absolute left-0 inset-y-2 w-1.5 bg-royal-600 rounded-r-full"></span>
                    <?php endif; ?>
                    <div class="flex items-center space-x-3">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 <?= ($active_nav ?? '') === 'dashboard' ? 'text-royal-600' : 'text-slate-400' ?>"></i>
                        <span>Dashboard</span>
                    </div>
                </a>

                <!-- 4 FITUR UTAMA POSTER -->
                <div class="px-3 pt-4 pb-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">Fitur Presensi & KBM</div>

                <!-- Fitur 1: Scan QR -->
                <a href="<?= base_url('scan-qr') ?>" class="relative flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-sm font-semibold transition-all duration-200 <?= ($active_nav ?? '') === 'scan_qr' ? 'bg-royal-50 text-royal-600 font-bold border border-royal-100 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' ?>">
                    <?php if (($active_nav ?? '') === 'scan_qr'): ?>
                        <span class="absolute left-0 inset-y-2 w-1.5 bg-royal-600 rounded-r-full"></span>
                    <?php endif; ?>
                    <div class="flex items-center space-x-3">
                        <i data-lucide="qr-code" class="w-5 h-5 <?= ($active_nav ?? '') === 'scan_qr' ? 'text-royal-600' : 'text-slate-400' ?>"></i>
                        <span>1. Scan QR Presensi</span>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full <?= ($active_nav ?? '') === 'scan_qr' ? 'bg-tangerine-500 text-white' : 'bg-tangerine-50 text-tangerine-600 border border-tangerine-200' ?>">QR Sesi</span>
                </a>

                <!-- Fitur 2: Jurnal KBM Digital -->
                <a href="<?= base_url('jurnal-kbm') ?>" class="relative flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-sm font-semibold transition-all duration-200 <?= ($active_nav ?? '') === 'jurnal_kbm' ? 'bg-royal-50 text-royal-600 font-bold border border-royal-100 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' ?>">
                    <?php if (($active_nav ?? '') === 'jurnal_kbm'): ?>
                        <span class="absolute left-0 inset-y-2 w-1.5 bg-royal-600 rounded-r-full"></span>
                    <?php endif; ?>
                    <div class="flex items-center space-x-3">
                        <i data-lucide="book-open" class="w-5 h-5 <?= ($active_nav ?? '') === 'jurnal_kbm' ? 'text-royal-600' : 'text-slate-400' ?>"></i>
                        <span>2. Jurnal KBM</span>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full <?= ($active_nav ?? '') === 'jurnal_kbm' ? 'bg-mint-500 text-white' : 'bg-mint-50 text-mint-600 border border-mint-200' ?>">Digital</span>
                </a>

                <!-- Fitur 3: Notifikasi Real-Time -->
                <a href="<?= base_url('notifikasi') ?>" class="relative flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-sm font-semibold transition-all duration-200 <?= ($active_nav ?? '') === 'notifikasi' ? 'bg-royal-50 text-royal-600 font-bold border border-royal-100 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' ?>">
                    <?php if (($active_nav ?? '') === 'notifikasi'): ?>
                        <span class="absolute left-0 inset-y-2 w-1.5 bg-royal-600 rounded-r-full"></span>
                    <?php endif; ?>
                    <div class="flex items-center space-x-3">
                        <i data-lucide="message-square-more" class="w-5 h-5 <?= ($active_nav ?? '') === 'notifikasi' ? 'text-royal-600' : 'text-slate-400' ?>"></i>
                        <span>3. Notifikasi WA</span>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full <?= ($active_nav ?? '') === 'notifikasi' ? 'bg-mint-500 text-white' : 'bg-mint-50 text-mint-600 border border-mint-200' ?>">Live</span>
                </a>

                <!-- Fitur 4: Rekapitulasi Web -->
                <a href="<?= base_url('rekapitulasi') ?>" class="relative flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-sm font-semibold transition-all duration-200 <?= ($active_nav ?? '') === 'rekapitulasi' ? 'bg-royal-50 text-royal-600 font-bold border border-royal-100 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' ?>">
                    <?php if (($active_nav ?? '') === 'rekapitulasi'): ?>
                        <span class="absolute left-0 inset-y-2 w-1.5 bg-royal-600 rounded-r-full"></span>
                    <?php endif; ?>
                    <div class="flex items-center space-x-3">
                        <i data-lucide="bar-chart-3" class="w-5 h-5 <?= ($active_nav ?? '') === 'rekapitulasi' ? 'text-royal-600' : 'text-slate-400' ?>"></i>
                        <span>4. Rekapitulasi Web</span>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full <?= ($active_nav ?? '') === 'rekapitulasi' ? 'bg-royal-500 text-white' : 'bg-royal-50 text-royal-600 border border-royal-200' ?>">PDF/XLS</span>
                </a>

                <!-- Direct Link to Student Portal for Demo -->
                <div class="px-3 pt-4 pb-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">Portal Siswa</div>
                <a href="<?= base_url('switch-role/siswa') ?>" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-sm font-semibold transition-all duration-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                    <div class="flex items-center space-x-3">
                        <i data-lucide="graduation-cap" class="w-5 h-5 text-sunshine-500"></i>
                        <span>Buka Akun Siswa</span>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-sunshine-50 text-sunshine-600 border border-sunshine-200">Demo</span>
                </a>
            <?php endif; ?>
        </div>

        <!-- REF 2: FLOATING HELPER / PROMO CARD IN SIDEBAR BOTTOM -->
        <div class="p-4 border-t border-slate-100 dark:border-slate-800 space-y-2.5">
            <div class="p-3.5 rounded-2xl bg-gradient-to-br from-royal-50 via-white to-tangerine-50 dark:from-slate-800/90 dark:via-slate-800/60 dark:to-slate-800/90 border border-royal-100/70 dark:border-slate-700/80 shadow-sm">
                <div class="flex items-center space-x-2 mb-1.5">
                    <div class="w-7 h-7 rounded-xl bg-gradient-to-tr from-tangerine-500 to-royal-500 flex items-center justify-center text-white shadow-sm">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                    </div>
                    <div>
                        <h5 class="text-xs font-bold text-slate-900 dark:text-white">Mode Demo Aktif</h5>
                        <p class="text-[10px] text-slate-500 dark:text-slate-400">In-Memory Session State</p>
                    </div>
                </div>
                <div class="mt-2.5 pt-2 border-t border-slate-100 dark:border-slate-700/60 flex items-center space-x-1.5">
                    <?php if ($isStudent): ?>
                        <a href="<?= base_url('switch-role/guru') ?>" class="flex-1 py-1.5 px-2 rounded-xl bg-royal-600 hover:bg-royal-700 text-white font-bold text-[10px] text-center shadow-sm transition-all">
                            Pindah Guru
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('switch-role/siswa') ?>" class="flex-1 py-1.5 px-2 rounded-xl bg-royal-600 hover:bg-royal-700 text-white font-bold text-[10px] text-center shadow-sm transition-all">
                            Coba Siswa
                        </a>
                    <?php endif; ?>
                    <a href="<?= base_url('reset-demo') ?>" class="py-1.5 px-2 rounded-xl bg-white hover:bg-slate-50 dark:bg-slate-700 dark:hover:bg-slate-600 border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-200 font-bold text-[10px] flex items-center space-x-1 transition-all" title="Reset Data Demo">
                        <i data-lucide="rotate-ccw" class="w-3 h-3 text-tangerine-500"></i>
                        <span>Reset</span>
                    </a>
                    <a href="<?= base_url('logout') ?>" class="py-1.5 px-2 rounded-xl bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/40 dark:hover:bg-rose-900/50 border border-rose-200 dark:border-rose-900/60 text-rose-600 dark:text-rose-400 font-bold text-[10px] flex items-center space-x-1 transition-all" title="Keluar / Logout ke Halaman Login">
                        <i data-lucide="log-out" class="w-3 h-3 text-rose-500"></i>
                        <span>Keluar</span>
                    </a>
                </div>
            </div>

            <!-- WhatsApp Gateway Quick Status Bar -->
            <div class="px-3 py-2 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-700/60 flex items-center justify-between text-[11px]">
                <span class="text-slate-500 dark:text-slate-400 font-medium">Gateway Node</span>
                <span class="inline-flex items-center px-1.5 py-0.5 rounded-md font-bold text-[10px] bg-mint-50 dark:bg-mint-950/40 text-mint-600 dark:text-mint-400 border border-mint-200 dark:border-mint-900/60">
                    <span class="w-1.5 h-1.5 rounded-full bg-mint-500 animate-pulse mr-1"></span> ONLINE
                </span>
            </div>
        </div>
    </aside>

    <!-- MOBILE SLIDE-OVER DRAWER -->
    <div id="mobileDrawerBackdrop" onclick="toggleMobileDrawer()" class="hidden fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-sm transition-opacity md:hidden"></div>
    <div id="mobileDrawerContent" class="fixed inset-y-0 left-0 z-50 w-72 bg-white text-slate-800 shadow-2xl transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center space-x-2.5">
                <div class="w-9 h-9 rounded-2xl bg-gradient-to-tr from-tangerine-500 to-royal-500 flex items-center justify-center text-white">
                    <i data-lucide="scan-line" class="w-4 h-4 text-white stroke-[2.5]"></i>
                </div>
                <div>
                    <span class="font-black text-slate-900 text-base tracking-tight">EduScan QR</span>
                    <p class="text-[10px] text-slate-400">SMK Budi Luhur</p>
                </div>
            </div>
            <button onclick="toggleMobileDrawer()" class="p-1 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto p-4 space-y-2">
            <?php if ($isStudent): ?>
                <a href="<?= base_url('siswa') ?>" class="block py-2.5 px-3 rounded-2xl bg-royal-50 text-royal-600 font-bold text-xs">Portal Siswa</a>
                <a href="<?= base_url('switch-role/guru') ?>" class="block py-2.5 px-3 rounded-2xl bg-slate-100 text-slate-700 font-bold text-xs">Pindah ke Mode Guru</a>
            <?php else: ?>
                <a href="<?= base_url('dashboard') ?>" class="block py-2.5 px-3 rounded-2xl <?= ($active_nav ?? '') === 'dashboard' ? 'bg-royal-50 text-royal-600 font-bold' : 'text-slate-600' ?> text-xs">Dashboard Utama</a>
                <a href="<?= base_url('scan-qr') ?>" class="block py-2.5 px-3 rounded-2xl <?= ($active_nav ?? '') === 'scan_qr' ? 'bg-royal-50 text-royal-600 font-bold' : 'text-slate-600' ?> text-xs">1. Scan QR Presensi</a>
                <a href="<?= base_url('jurnal-kbm') ?>" class="block py-2.5 px-3 rounded-2xl <?= ($active_nav ?? '') === 'jurnal_kbm' ? 'bg-royal-50 text-royal-600 font-bold' : 'text-slate-600' ?> text-xs">2. Jurnal KBM Digital</a>
                <a href="<?= base_url('notifikasi') ?>" class="block py-2.5 px-3 rounded-2xl <?= ($active_nav ?? '') === 'notifikasi' ? 'bg-royal-50 text-royal-600 font-bold' : 'text-slate-600' ?> text-xs">3. Notifikasi Ortu WA</a>
                <a href="<?= base_url('rekapitulasi') ?>" class="block py-2.5 px-3 rounded-2xl <?= ($active_nav ?? '') === 'rekapitulasi' ? 'bg-royal-50 text-royal-600 font-bold' : 'text-slate-600' ?> text-xs">4. Rekapitulasi Web</a>
                <div class="pt-3 border-t border-slate-100">
                    <a href="<?= base_url('switch-role/siswa') ?>" class="block py-2 px-3 rounded-2xl bg-sunshine-500 text-slate-950 font-bold text-xs text-center">Coba Mode Siswa</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="p-4 border-t border-slate-100">
            <a href="<?= base_url('reset-demo') ?>" class="w-full flex items-center justify-center space-x-1.5 py-2.5 px-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-xs font-bold text-slate-700 transition-colors">
                <i data-lucide="rotate-ccw" class="w-3.5 h-3.5 text-tangerine-500"></i>
                <span>Reset Data Demo</span>
            </a>
        </div>
    </div>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col md:pl-72 min-h-screen max-w-full overflow-x-hidden">
        <!-- REF 2: CRISP WHITE TOP APP BAR WITH DARK MODE SUPPORT -->
        <header class="sticky top-0 z-20 bg-white/80 dark:bg-[#0F172A]/90 backdrop-blur-xl border-b border-slate-200/70 dark:border-slate-800 px-4 sm:px-6 py-3.5 flex items-center justify-between gap-4">
            <div class="flex items-center space-x-3 min-w-0 flex-1">
                <!-- Hamburger on Mobile -->
                <button onclick="toggleMobileDrawer()" class="md:hidden p-2 rounded-2xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 transition-colors shrink-0">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>

                <a href="<?= $isStudent ? base_url('siswa') : base_url('dashboard') ?>" class="md:hidden flex items-center space-x-1.5 shrink-0">
                    <span class="font-black text-slate-900 dark:text-white tracking-tight text-base">EduScan</span>
                    <span class="text-[10px] font-black uppercase px-1.5 py-0.5 rounded bg-tangerine-500 text-white font-mono">QR</span>
                </a>

                <!-- Ref 2 Clean Page Header Title with No-Wrap & Truncate -->
                <div class="hidden sm:block min-w-0">
                    <h2 class="text-sm sm:text-base font-black text-slate-900 dark:text-white tracking-tight truncate whitespace-nowrap max-w-[220px] lg:max-w-xs xl:max-w-md">
                        <?= esc($title ?? 'Dashboard') ?>
                    </h2>
                </div>

                <!-- Search Input Pill like Ref 2 -->
                <div class="relative hidden 2xl:block shrink-0">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    </div>
                    <input type="text" placeholder="Cari siswa, mapel..." class="w-48 pl-8 pr-3 py-1.5 rounded-full bg-slate-100/80 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/80 text-xs text-slate-700 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-royal-500/20 transition-all">
                </div>
            </div>

            <!-- Header Right: Quick Role Switcher, Clock Pill, Bell & Profile Avatar -->
            <div class="flex items-center space-x-2 sm:space-x-2.5 shrink-0">
                <!-- Role Switcher Button -->
                <?php if ($isStudent): ?>
                    <a href="<?= base_url('switch-role/guru') ?>" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-full bg-royal-50 dark:bg-royal-950/40 hover:bg-royal-100 dark:hover:bg-royal-900/50 text-royal-700 dark:text-royal-300 text-xs font-bold border border-royal-200/80 dark:border-royal-800/60 transition-colors shadow-xs">
                        <i data-lucide="user-check" class="w-3.5 h-3.5 text-royal-600 dark:text-royal-400"></i>
                        <span class="hidden md:inline">Peran: </span>
                        <span>Siswa</span>
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('switch-role/siswa') ?>" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-full bg-tangerine-50 dark:bg-tangerine-950/40 hover:bg-tangerine-100 dark:hover:bg-tangerine-900/50 text-tangerine-700 dark:text-tangerine-300 text-xs font-bold border border-tangerine-200/80 dark:border-tangerine-800/60 transition-colors shadow-xs">
                        <i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-tangerine-600 dark:text-tangerine-400"></i>
                        <span class="hidden md:inline">Peran: </span>
                        <span>Guru</span>
                    </a>
                <?php endif; ?>

                <!-- Live WIB Clock Pill -->
                <div class="hidden xl:flex items-center space-x-1.5 px-3 py-1.5 rounded-full bg-slate-100/90 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-600 dark:text-slate-300 font-mono">
                    <i data-lucide="clock" class="w-3.5 h-3.5 text-tangerine-500"></i>
                    <span id="liveDigitalClock" class="font-bold">--:--:-- WIB</span>
                </div>

                <!-- Dark / Night Mode Toggle Pill -->
                <button type="button" onclick="toggleDarkMode()" id="themeToggleBtn" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-amber-300 transition-all text-xs font-bold border border-slate-200 dark:border-slate-700 shadow-xs cursor-pointer active:scale-95" title="Ganti Mode Terang / Gelap (Night Mode)">
                    <i data-lucide="moon" id="themeIconMoon" class="w-3.5 h-3.5 text-royal-600 block dark:hidden"></i>
                    <i data-lucide="sun" id="themeIconSun" class="w-3.5 h-3.5 text-amber-400 hidden dark:block"></i>
                    <span id="themeLabelText" class="text-[11px] font-bold">Mode</span>
                </button>

                <!-- Notification Bell Pill -->
                <a href="<?= base_url('notifikasi') ?>" class="relative p-2 rounded-full bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 transition-colors" title="Lihat Notifikasi WhatsApp">
                    <i data-lucide="bell" class="w-4 h-4"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-coral-500 animate-pulse"></span>
                </a>

                <!-- Tombol Logout / Keluar -->
                <a href="<?= base_url('logout') ?>" class="inline-flex items-center space-x-1 px-3 py-1.5 rounded-full bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/40 dark:hover:bg-rose-900/50 text-rose-600 dark:text-rose-300 text-xs font-bold border border-rose-200 dark:border-rose-900/60 transition-all shadow-xs" title="Keluar / Logout ke Halaman Login">
                    <i data-lucide="log-out" class="w-3.5 h-3.5 text-rose-500"></i>
                    <span class="hidden sm:inline">Keluar</span>
                </a>

                <!-- User Mini Avatar Pill -->
                <div class="flex items-center space-x-2 pl-1 border-l border-slate-200 dark:border-slate-800">
                    <img src="<?= esc($isStudent ? ($studentData['avatar'] ?? 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=150&q=80') : ($teacherData['avatar'] ?? 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=250&q=80')) ?>" alt="Profile" class="w-8 h-8 rounded-full object-cover ring-2 ring-tangerine-400">
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT CONTAINER -->
        <main class="flex-1 p-3.5 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto pb-24 md:pb-12 overflow-x-hidden">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <!-- MOBILE BOTTOM NAVIGATION BAR -->
    <nav class="md:hidden fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur-lg border-t border-slate-200/90 py-1.5 px-3 shadow-2xl flex items-center justify-around">
        <?php if ($isStudent): ?>
            <a href="<?= base_url('siswa') ?>" class="flex flex-col items-center py-1 px-3 rounded-lg text-posterGreen-600 font-bold">
                <i data-lucide="id-card" class="w-5 h-5"></i>
                <span class="text-[10px] mt-0.5">Portal Siswa</span>
            </a>
            <a href="<?= base_url('switch-role/guru') ?>" class="flex flex-col items-center py-1 px-3 rounded-lg text-royal-700 font-bold">
                <i data-lucide="user-cog" class="w-5 h-5"></i>
                <span class="text-[10px] mt-0.5">Mode Guru</span>
            </a>
        <?php else: ?>
            <a href="<?= base_url('dashboard') ?>" class="flex flex-col items-center py-1 px-2 rounded-lg <?= ($active_nav ?? '') === 'dashboard' ? 'text-royal-700 font-bold' : 'text-slate-500' ?>">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span class="text-[10px] mt-0.5">Beranda</span>
            </a>
            <a href="<?= base_url('scan-qr') ?>" class="flex flex-col items-center py-1 px-2 rounded-lg <?= ($active_nav ?? '') === 'scan_qr' ? 'text-posterGreen-600 font-bold' : 'text-slate-500' ?>">
                <div class="relative">
                    <i data-lucide="qr-code" class="w-5 h-5"></i>
                    <span class="absolute -top-1 -right-1 w-2 h-2 rounded-full bg-posterGreen-500"></span>
                </div>
                <span class="text-[10px] mt-0.5">Scan QR</span>
            </a>
            <a href="<?= base_url('jurnal-kbm') ?>" class="flex flex-col items-center py-1 px-2 rounded-lg <?= ($active_nav ?? '') === 'jurnal_kbm' ? 'text-royal-700 font-bold' : 'text-slate-500' ?>">
                <i data-lucide="book-open" class="w-5 h-5"></i>
                <span class="text-[10px] mt-0.5">Jurnal KBM</span>
            </a>
            <a href="<?= base_url('notifikasi') ?>" class="flex flex-col items-center py-1 px-2 rounded-lg <?= ($active_nav ?? '') === 'notifikasi' ? 'text-royal-700 font-bold' : 'text-slate-500' ?>">
                <i data-lucide="message-square" class="w-5 h-5"></i>
                <span class="text-[10px] mt-0.5">Notifikasi</span>
            </a>
            <a href="<?= base_url('rekapitulasi') ?>" class="flex flex-col items-center py-1 px-2 rounded-lg <?= ($active_nav ?? '') === 'rekapitulasi' ? 'text-royal-700 font-bold' : 'text-slate-500' ?>">
                <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                <span class="text-[10px] mt-0.5">Rekap</span>
            </a>
        <?php endif; ?>
    </nav>

    <!-- GLOBAL HELPER SCRIPTS -->
    <script>
        function toggleMobileDrawer() {
            const backdrop = document.getElementById('mobileDrawerBackdrop');
            const content = document.getElementById('mobileDrawerContent');
            if (backdrop.classList.contains('hidden')) {
                backdrop.classList.remove('hidden');
                content.classList.remove('-translate-x-full');
            } else {
                backdrop.classList.add('hidden');
                content.classList.add('-translate-x-full');
            }
        }

        // Web Audio API Synthesizer
        const AudioContext = window.AudioContext || window.webkitAudioContext;
        let audioCtx = null;

        function playBeepSound(type = 'success') {
            try {
                if (!audioCtx) audioCtx = new AudioContext();
                if (audioCtx.state === 'suspended') audioCtx.resume();

                const osc = audioCtx.createOscillator();
                const gain = audioCtx.createGain();
                osc.connect(gain);
                gain.connect(audioCtx.destination);

                if (type === 'success') {
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(1046.5, audioCtx.currentTime);
                    osc.frequency.setValueAtTime(1318.5, audioCtx.currentTime + 0.08);
                    gain.gain.setValueAtTime(0.3, audioCtx.currentTime);
                    gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.22);
                    osc.start(audioCtx.currentTime);
                    osc.stop(audioCtx.currentTime + 0.22);
                } else {
                    osc.type = 'square';
                    osc.frequency.setValueAtTime(300, audioCtx.currentTime);
                    gain.gain.setValueAtTime(0.2, audioCtx.currentTime);
                    gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.25);
                    osc.start(audioCtx.currentTime);
                    osc.stop(audioCtx.currentTime + 0.25);
                }
            } catch (e) {
                console.log('AudioContext not allowed yet:', e);
            }
        }

        // Live Clock script
        function updateLiveClock() {
            const now = new Date();
            const clockEl = document.getElementById('liveDigitalClock');
            if (clockEl) {
                const h = String(now.getHours()).padStart(2, '0');
                const m = String(now.getMinutes()).padStart(2, '0');
                const s = String(now.getSeconds()).padStart(2, '0');
                clockEl.textContent = `${h}:${m}:${s} WIB`;
            }
        }
        setInterval(updateLiveClock, 1000);
        updateLiveClock();

        // Dark / Night Mode Toggle Handler
        function toggleDarkMode() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateThemeUI();
        }

        function updateThemeUI() {
            const isDark = document.documentElement.classList.contains('dark');
            const labelEl = document.getElementById('themeLabelText');
            if (labelEl) {
                labelEl.textContent = isDark ? 'Malam' : 'Siang';
            }
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        // Universal Detail Modal Helper so users never need to scroll/geser horizontally!
        function showDetailModal(title, contentHtml) {
            Swal.fire({
                title: `<span class="text-lg font-bold text-slate-900">${title}</span>`,
                html: `<div class="text-left text-xs text-slate-700 max-h-96 overflow-y-auto space-y-3 pt-2">${contentHtml}</div>`,
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#38C682',
                customClass: { popup: 'rounded-3xl p-6 shadow-2xl max-w-lg w-full' }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateThemeUI();
            lucide.createIcons();

            <?php if (session()->getFlashdata('swal_success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '<?= addslashes(session()->getFlashdata('swal_success')) ?>',
                    timer: 3500,
                    showConfirmButton: false,
                    confirmButtonColor: '#38C682',
                    customClass: { popup: 'rounded-2xl shadow-xl' }
                });
            <?php endif; ?>

            <?php if (session()->getFlashdata('swal_info')): ?>
                Swal.fire({
                    icon: 'info',
                    title: 'Informasi',
                    text: '<?= addslashes(session()->getFlashdata('swal_info')) ?>',
                    timer: 3000,
                    showConfirmButton: false,
                    confirmButtonColor: '#3B41A3',
                    customClass: { popup: 'rounded-2xl shadow-xl' }
                });
            <?php endif; ?>
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>
</html>
