<!DOCTYPE html>
<html lang="id" class="h-full bg-[#F6F8FD]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Presensi & Jurnal Mengajar via QR Code | EduScan QR SMK Budi Luhur</title>
    <meta name="description" content="Platform digital terintegrasi untuk mencatat kehadiran siswa/guru via scan QR Code serta mendokumentasikan jurnal KBM harian secara real-time, akurat, dan tanpa kertas.">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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
                        tangerine: {
                            50: '#FFF7ED',
                            100: '#FFEDD5',
                            200: '#FED7AA',
                            300: '#FDBA74',
                            400: '#FB923C',
                            500: '#FF7A00',
                            600: '#EA580C',
                        },
                        royal: {
                            50: '#EEF2FF',
                            100: '#E0E7FF',
                            200: '#C7D2FE',
                            500: '#4F46E5',
                            600: '#4338CA',
                            700: '#3730A3',
                            800: '#312E81',
                        },
                        mint: {
                            50: '#ECFDF5',
                            100: '#D1FAE5',
                            500: '#10B981',
                            600: '#059669',
                        },
                        posterGreen: {
                            500: '#10B981',
                            600: '#059669',
                        },
                        coral: {
                            50: '#FFF1F2',
                            500: '#FF5252',
                            600: '#EE5253',
                        },
                        sunshine: {
                            50: '#FFFBEB',
                            100: '#FEF3C7',
                            400: '#FBBF24',
                            500: '#FFB703',
                            600: '#D97706',
                        },
                        sand: {
                            400: '#FDE68A',
                            500: '#FFB703',
                        }
                    },
                    boxShadow: {
                        'soft': '0 10px 30px -4px rgba(15, 23, 42, 0.04), 0 4px 10px -2px rgba(15, 23, 42, 0.02)',
                        'card': '0 20px 40px -6px rgba(15, 23, 42, 0.06), 0 6px 14px -3px rgba(15, 23, 42, 0.03)',
                        'tangerine': '0 14px 30px -4px rgba(255, 122, 0, 0.25)',
                        'royal': '0 14px 30px -4px rgba(79, 70, 229, 0.22)',
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

    <!-- Global Dark Mode CSS Overrides -->
    <style>
        html.dark {
            color-scheme: dark;
        }
        
        .dark body {
            background-color: #0B1120 !important;
            color: #F1F5F9 !important;
        }

        .dark header {
            background-color: rgba(15, 23, 42, 0.9) !important;
            border-color: rgba(30, 41, 59, 0.8) !important;
        }

        .dark .bg-white {
            background-color: #111C35 !important;
            border-color: #1E293B !important;
            color: #F1F5F9;
        }

        .dark .bg-slate-50, .dark .bg-slate-50\/80, .dark .bg-slate-50\/60 {
            background-color: #17223B !important;
            border-color: #273553 !important;
        }

        .dark .bg-slate-100, .dark .bg-slate-100\/90, .dark .bg-slate-100\/80 {
            background-color: #1E2A47 !important;
            color: #E2E8F0 !important;
            border-color: #2B3A5E !important;
        }

        .dark .border-slate-100, .dark .border-slate-200, .dark .border-slate-200\/80, .dark .border-slate-200\/70, .dark .border-slate-200\/60 {
            border-color: #1E293B !important;
        }

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

        .dark input, .dark select, .dark textarea {
            background-color: #17223B !important;
            border-color: #334155 !important;
            color: #FFFFFF !important;
        }

        .dark footer {
            background-color: rgba(15, 23, 42, 0.9) !important;
            border-color: rgba(30, 41, 59, 0.8) !important;
        }

        .dark .swal2-popup {
            background-color: #111C35 !important;
            border: 1px solid #1E293B !important;
            color: #F8FAFC !important;
        }

        .dark .swal2-title, .dark .swal2-html-container {
            color: #F8FAFC !important;
        }
    </style>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="min-h-full flex flex-col font-sans antialiased text-slate-800 dark:text-slate-100 bg-[#F6F8FD] dark:bg-[#0B1120] selection:bg-tangerine-500 selection:text-white relative overflow-x-hidden">

    <!-- REF 1: ORGANIC FLUID WAVE BACKGROUND BLOBS -->
    <div class="fixed -top-40 -left-40 w-[600px] h-[600px] rounded-full bg-gradient-to-br from-tangerine-400/20 via-sunshine-400/15 to-transparent blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed -bottom-40 -right-40 w-[620px] h-[620px] rounded-full bg-gradient-to-tl from-royal-500/20 via-blue-400/15 to-transparent blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed top-1/2 right-1/4 w-[350px] h-[350px] rounded-full bg-mint-400/10 blur-3xl pointer-events-none -z-10"></div>

    <!-- TOP HEADER (RESPONSIVE: AUTO-FITS ANY MOBILE SCREEN) -->
    <header class="w-full bg-white/85 dark:bg-[#0F172A]/90 backdrop-blur-md border-b border-slate-200/70 dark:border-slate-800 py-2.5 sm:py-3.5 px-3.5 sm:px-8 sticky top-0 z-20 transition-colors">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-2">
            <!-- Brand Logo & School Tag -->
            <div class="flex items-center space-x-2.5 sm:space-x-3 min-w-0">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl sm:rounded-2xl bg-gradient-to-tr from-tangerine-500 via-sunshine-500 to-royal-500 flex items-center justify-center text-white shadow-md shadow-tangerine-500/20 shrink-0">
                    <i data-lucide="scan-line" class="w-4 h-4 sm:w-5 sm:h-5 text-white stroke-[2.5]"></i>
                </div>
                <div class="min-w-0">
                    <div class="flex items-center space-x-1.5 sm:space-x-2">
                        <span class="text-base sm:text-lg font-black tracking-tight text-slate-900 dark:text-white">EduScan</span>
                        <span class="text-[9px] sm:text-[10px] font-black uppercase px-1.5 sm:px-2 py-0.5 rounded-md bg-tangerine-500 text-white font-mono shrink-0">SMK BUDI LUHUR</span>
                    </div>
                    <p class="text-[10px] sm:text-[11px] font-semibold text-slate-400 hidden xs:block truncate">Presensi & Jurnal Digital</p>
                </div>
            </div>

            <!-- Quick Demo Shortcuts & Dark Mode in Top Bar -->
            <div class="flex items-center space-x-1.5 sm:space-x-2 shrink-0">
                <!-- Dark / Night Mode Toggle Pill -->
                <button type="button" onclick="toggleDarkMode()" id="themeToggleBtn" class="inline-flex items-center space-x-1.5 px-2.5 sm:px-3 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-amber-300 transition-all text-xs font-bold border border-slate-200 dark:border-slate-700 shadow-xs cursor-pointer active:scale-95" title="Ganti Mode Terang / Gelap (Night Mode)">
                    <i data-lucide="moon" id="themeIconMoon" class="w-3.5 h-3.5 text-royal-600 block dark:hidden"></i>
                    <i data-lucide="sun" id="themeIconSun" class="w-3.5 h-3.5 text-amber-400 hidden dark:block"></i>
                    <span id="themeLabelText" class="text-[11px] font-bold hidden sm:inline">Mode</span>
                </button>

                <!-- Compact Quick Demo Guru Link -->
                <a href="<?= base_url('login/demo') ?>" class="inline-flex items-center space-x-1 px-2.5 sm:px-3 py-1.5 rounded-full bg-tangerine-50 hover:bg-tangerine-100 dark:bg-tangerine-950/40 dark:hover:bg-tangerine-900/50 text-tangerine-700 dark:text-tangerine-300 font-bold text-xs border border-tangerine-200/80 dark:border-tangerine-800/60 transition-all shadow-xs" title="Login Demo Guru Cepat">
                    <i data-lucide="zap" class="w-3.5 h-3.5 fill-tangerine-500 text-tangerine-500"></i>
                    <span class="hidden sm:inline">Demo Guru</span>
                    <span class="sm:hidden text-[11px]">Guru</span>
                </a>

                <!-- Compact Quick Demo Siswa Link -->
                <a href="<?= base_url('login/demo-siswa') ?>" class="inline-flex items-center space-x-1 px-2.5 sm:px-3 py-1.5 rounded-full bg-royal-50 hover:bg-royal-100 dark:bg-royal-950/40 dark:hover:bg-royal-900/50 text-royal-700 dark:text-royal-300 font-bold text-xs border border-royal-200/80 dark:border-royal-800/60 transition-all shadow-xs" title="Login Demo Siswa Cepat">
                    <i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-royal-600 dark:text-royal-400"></i>
                    <span class="hidden sm:inline">Demo Siswa</span>
                    <span class="sm:hidden text-[11px]">Siswa</span>
                </a>

                <a href="<?= base_url('dashboard') ?>" class="hidden md:inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-full bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-bold text-xs shadow-sm hover:opacity-90 transition-all">
                    <span>Dashboard</span>
                    <i data-lucide="arrow-right" class="w-3 h-3"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- HERO & LOGIN SECTION (RESPONSIVE: MOBILE-FIRST COMPACT & DESKTOP SPLIT) -->
    <main class="flex-1 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-12 lg:py-16">

            <!-- MOBILE HERO INTRO (Shown on mobile screens for instant context) -->
            <div class="lg:hidden text-center space-y-2 mb-6">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-white dark:bg-slate-800/90 border border-slate-200/80 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-300 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-tangerine-500 animate-ping"></span>
                    <span class="text-tangerine-600 dark:text-tangerine-400 font-extrabold">EDUSCAN QR</span>
                    <span class="text-slate-300 dark:text-slate-600">•</span>
                    <span>SMK BUDI LUHUR</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                    Presensi & Jurnal Mengajar <br>
                    <span class="bg-gradient-to-r from-tangerine-500 via-amber-500 to-royal-600 bg-clip-text text-transparent">Digital Berbasis QR</span>
                </h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 max-w-sm mx-auto leading-relaxed">
                    Masuk dengan akun Guru atau Siswa untuk mengelola presensi kelas dan pencatatan KBM.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start lg:items-center">

                <!-- DESKTOP LEFT COLUMN / MOBILE BOTTOM OVERVIEW: HEADLINE & 4 FEATURE CARDS -->
                <div class="order-2 lg:order-1 lg:col-span-7 space-y-6 sm:space-y-7">
                    <!-- Brand Pill (Desktop only) -->
                    <div class="hidden lg:inline-flex items-center space-x-2.5 px-3.5 py-1.5 rounded-full bg-white dark:bg-slate-850 border border-slate-200/80 dark:border-slate-700 shadow-sm text-slate-700 dark:text-slate-300 text-xs font-bold tracking-wide">
                        <span class="w-2.5 h-2.5 rounded-full bg-tangerine-500 animate-ping"></span>
                        <span class="text-tangerine-600 font-extrabold">SMART ATTENDANCE</span>
                        <span class="text-slate-300 dark:text-slate-600">•</span>
                        <span>SMK BUDI LUHUR 2026/2027</span>
                    </div>

                    <!-- Main Headline (Desktop only) -->
                    <div class="hidden lg:block">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-[1.18]">
                            SISTEM PRESENSI & JURNAL MENGAJAR <br>
                            <span class="bg-gradient-to-r from-tangerine-500 via-amber-500 to-royal-600 bg-clip-text text-transparent">VIA QR CODE</span>
                        </h1>
                        <p class="mt-4 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl">
                            Solusi digital terintegrasi untuk mencatat kehadiran siswa/guru secara cepat via Dynamic QR, mencatat agenda KBM harian, dan mengirim notifikasi WhatsApp otomatis ke wali murid.
                        </p>
                    </div>

                    <!-- Mobile Section Header for Features -->
                    <div class="lg:hidden pt-2 border-t border-slate-200/60 dark:border-slate-800">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-3 text-center sm:text-left">
                            Fitur Utama EduScan QR
                        </h3>
                    </div>

                    <!-- 4 FEATURE CARDS (RESPONSIVE: 1 COL ON MOBILE, 2 COLS ON SM+) -->
                    <div class="space-y-3.5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-3.5">
                            <!-- 1. Scan QR -->
                            <div class="p-3.5 sm:p-4 rounded-2xl sm:rounded-3xl bg-white dark:bg-[#111C35] border border-slate-100 dark:border-slate-800 shadow-soft hover:shadow-card transition-all group flex items-start space-x-3 sm:space-x-3.5">
                                <span class="px-2.5 py-1 rounded-xl bg-tangerine-500 text-white font-black text-xs shrink-0 shadow-sm shadow-tangerine-500/25">
                                    Scan QR
                                </span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white group-hover:text-tangerine-600 dark:group-hover:text-tangerine-400 transition-colors">Validasi Cepat & Anti-Titip</h4>
                                    <p class="text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 mt-0.5 leading-snug">Dynamic QR berputar tiap 15 detik + verifikasi kamera webcam proyektor.</p>
                                </div>
                            </div>

                            <!-- 2. Jurnal KBM Digital -->
                            <div class="p-3.5 sm:p-4 rounded-2xl sm:rounded-3xl bg-white dark:bg-[#111C35] border border-slate-100 dark:border-slate-800 shadow-soft hover:shadow-card transition-all group flex items-start space-x-3 sm:space-x-3.5">
                                <span class="px-2.5 py-1 rounded-xl bg-sunshine-500 text-white font-black text-xs shrink-0 shadow-sm shadow-sunshine-500/25">
                                    Jurnal KBM
                                </span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white group-hover:text-sunshine-600 dark:group-hover:text-sunshine-400 transition-colors">Dokumentasi Mengajar</h4>
                                    <p class="text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 mt-0.5 leading-snug">Catat materi ajar, metode interaktif, dan catatan kelas langsung dari HP.</p>
                                </div>
                            </div>

                            <!-- 3. Notifikasi WhatsApp -->
                            <div class="p-3.5 sm:p-4 rounded-2xl sm:rounded-3xl bg-white dark:bg-[#111C35] border border-slate-100 dark:border-slate-800 shadow-soft hover:shadow-card transition-all group flex items-start space-x-3 sm:space-x-3.5">
                                <span class="px-2.5 py-1 rounded-xl bg-mint-500 text-white font-black text-xs shrink-0 shadow-sm shadow-mint-500/25">
                                    Notifikasi
                                </span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white group-hover:text-mint-600 dark:group-hover:text-mint-400 transition-colors">WhatsApp Real-Time</h4>
                                    <p class="text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 mt-0.5 leading-snug">Info kehadiran siswa otomatis terkirim ke ponsel orang tua/wali seketika.</p>
                                </div>
                            </div>

                            <!-- 4. Rekapitulasi Web -->
                            <div class="p-3.5 sm:p-4 rounded-2xl sm:rounded-3xl bg-white dark:bg-[#111C35] border border-slate-100 dark:border-slate-800 shadow-soft hover:shadow-card transition-all group flex items-start space-x-3 sm:space-x-3.5">
                                <span class="px-2.5 py-1 rounded-xl bg-royal-600 text-white font-black text-xs shrink-0 shadow-sm shadow-royal-600/25">
                                    Rekap Web
                                </span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white group-hover:text-royal-600 dark:group-hover:text-royal-400 transition-colors">Grafik & Ekspor Dokumen</h4>
                                    <p class="text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 mt-0.5 leading-snug">Pantau analitik kehadiran serta unduh laporan PDF resmi & Excel (.xlsx).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: INTERACTIVE ROLE LOGIN CARD (ORDER-1 ON MOBILE FOR ZERO SCROLL) -->
                <div class="order-1 lg:order-2 lg:col-span-5 w-full">
                    <div class="relative bg-white dark:bg-[#111C35] rounded-3xl sm:rounded-[32px] p-5 sm:p-8 shadow-card border border-slate-100 dark:border-slate-800">
                        <!-- Top Floating Pill -->
                        <div class="absolute -top-3 right-4 sm:right-6 bg-gradient-to-r from-tangerine-500 to-amber-500 text-white font-black text-[9px] sm:text-[10px] uppercase tracking-wider px-2.5 sm:px-3.5 py-0.5 sm:py-1 rounded-full shadow-md shadow-tangerine-500/25 flex items-center space-x-1 sm:space-x-1.5">
                            <i data-lucide="shield-check" class="w-3 h-3 sm:w-3.5 sm:h-3.5"></i>
                            <span>Akses Resmi Sekolah</span>
                        </div>

                        <!-- Card Header -->
                        <div class="mb-4 sm:mb-5">
                            <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white tracking-tight">Masuk ke Portal</h2>
                            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">Silakan pilih peran dan masukkan kredensial akun Anda.</p>
                        </div>

                        <!-- ROLE SWITCHER TABS (GURU VS SISWA) -->
                        <div class="flex items-center p-1.5 bg-slate-100 dark:bg-slate-800 rounded-2xl mb-4 sm:mb-5">
                            <button type="button" onclick="selectLoginRole('guru')" id="btnTabRoleGuru" class="flex-1 flex items-center justify-center space-x-1.5 sm:space-x-2 py-2 sm:py-2.5 px-2 sm:px-3 rounded-xl text-xs font-bold transition-all bg-white dark:bg-slate-900 text-royal-600 dark:text-royal-400 shadow-sm cursor-pointer">
                                <i data-lucide="user-check" class="w-4 h-4 text-tangerine-500"></i>
                                <span>Guru / Pengajar</span>
                            </button>
                            <button type="button" onclick="selectLoginRole('siswa')" id="btnTabRoleSiswa" class="flex-1 flex items-center justify-center space-x-1.5 sm:space-x-2 py-2 sm:py-2.5 px-2 sm:px-3 rounded-xl text-xs font-bold transition-all text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white cursor-pointer">
                                <i data-lucide="graduation-cap" class="w-4 h-4 text-royal-500"></i>
                                <span>Siswa</span>
                            </button>
                        </div>

                        <!-- QUICK AUTOFILL SHORTCUTS (RESPONSIVE 2-COL GRID: NEVER OVERFLOWS) -->
                        <div class="mb-4">
                            <div class="flex items-center justify-between mb-2 text-[11px]">
                                <span class="text-slate-400 dark:text-slate-400 font-bold uppercase tracking-wider">Coba Cepat Akun Demo:</span>
                                <button type="button" onclick="showForgotPasswordHelp()" class="text-royal-600 dark:text-royal-400 font-semibold hover:underline cursor-pointer">Info Akun</button>
                            </div>
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <button type="button" onclick="autofillLogin('guru')" class="py-2 px-2.5 rounded-xl bg-tangerine-50 hover:bg-tangerine-100 dark:bg-tangerine-950/40 dark:hover:bg-tangerine-900/50 text-tangerine-700 dark:text-tangerine-300 font-bold border border-tangerine-200/80 dark:border-tangerine-800/60 transition-all text-center flex items-center justify-center space-x-1.5 shadow-xs active:scale-95 cursor-pointer">
                                    <i data-lucide="user-check" class="w-3.5 h-3.5 text-tangerine-600 dark:text-tangerine-400 shrink-0"></i>
                                    <span class="truncate">Ibu Naila (Guru)</span>
                                </button>
                                <button type="button" onclick="autofillLogin('siswa')" class="py-2 px-2.5 rounded-xl bg-royal-50 hover:bg-royal-100 dark:bg-royal-950/40 dark:hover:bg-royal-900/50 text-royal-700 dark:text-royal-300 font-bold border border-royal-200/80 dark:border-royal-800/60 transition-all text-center flex items-center justify-center space-x-1.5 shadow-xs active:scale-95 cursor-pointer">
                                    <i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-royal-600 dark:text-royal-400 shrink-0"></i>
                                    <span class="truncate">Bambang S. (Siswa)</span>
                                </button>
                            </div>
                        </div>

                        <!-- REGULAR LOGIN FORM -->
                        <form action="<?= base_url('login') ?>" method="post" class="space-y-3.5 sm:space-y-4" id="loginForm">
                            <?= csrf_field() ?>
                            <input type="hidden" name="role" id="loginRoleInput" value="guru">

                            <!-- Identifier Field (NIP / NISN) -->
                            <div>
                                <label id="identifierLabel" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1 sm:mb-1.5">NIP / Email Guru</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i data-lucide="user" id="identifierIcon" class="w-4 h-4"></i>
                                    </div>
                                    <input type="text" name="username" id="usernameInput" value="19920815 201802 2 003" placeholder="Masukkan NIP atau Email Guru..." required class="w-full pl-10 pr-3.5 py-2.5 sm:py-3 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50/60 dark:bg-slate-800 text-slate-900 dark:text-white text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-royal-500 font-medium transition-all">
                                </div>
                                <span id="identifierHint" class="block text-[11px] text-slate-400 dark:text-slate-400 mt-1 truncate">Guru Pengampu: Naila Salma Az-Zahra, S.Kom</span>
                            </div>

                            <!-- Password Field -->
                            <div>
                                <div class="flex items-center justify-between mb-1 sm:mb-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300">Password</label>
                                    <button type="button" onclick="showForgotPasswordHelp()" class="text-[11px] text-royal-600 dark:text-royal-400 font-semibold hover:underline cursor-pointer">Lupa password?</button>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i data-lucide="lock" class="w-4 h-4"></i>
                                    </div>
                                    <input type="password" name="password" id="passwordInput" value="guru123" placeholder="••••••••" required class="w-full pl-10 pr-10 py-2.5 sm:py-3 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50/60 dark:bg-slate-800 text-slate-900 dark:text-white text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-royal-500 font-medium transition-all">
                                    <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 cursor-pointer" title="Tampilkan/Sembunyikan Password">
                                        <i data-lucide="eye" id="passwordEyeIcon" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Remember Me Checkbox -->
                            <div class="flex items-center justify-between text-xs text-slate-600 dark:text-slate-400 pt-0.5">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" checked class="w-4 h-4 rounded text-royal-600 focus:ring-royal-500 border-slate-300 dark:border-slate-700">
                                    <span>Ingat saya di perangkat ini</span>
                                </label>
                                <span class="text-[11px] text-mint-600 dark:text-mint-400 font-bold hidden xs:inline">SMK Budi Luhur</span>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" id="btnSubmitLogin" class="w-full flex items-center justify-center space-x-2 py-3 sm:py-3.5 px-4 rounded-2xl bg-gradient-to-r from-royal-600 via-royal-700 to-indigo-700 hover:from-royal-700 hover:to-indigo-800 text-white font-extrabold text-sm shadow-soft hover:shadow-lg hover:shadow-royal-500/25 transition-all active:scale-98 cursor-pointer">
                                <span id="btnSubmitText">Masuk Sebagai Guru</span>
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </button>
                        </form>

                        <!-- Divider -->
                        <div class="relative flex items-center justify-center my-3.5 sm:my-4">
                            <span class="absolute inset-x-0 h-px bg-slate-100 dark:bg-slate-800"></span>
                            <span class="relative bg-white dark:bg-[#111C35] px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-400">Atau 1-Klik Instan</span>
                        </div>

                        <!-- 1-Click Fast Bypass Demo Buttons -->
                        <div class="grid grid-cols-2 gap-2 sm:gap-2.5">
                            <a href="<?= base_url('login/demo') ?>" class="flex items-center justify-center space-x-1.5 py-2.5 px-3 rounded-xl bg-orange-50 hover:bg-orange-100 dark:bg-orange-950/40 dark:hover:bg-orange-900/50 text-tangerine-700 dark:text-tangerine-400 font-bold text-xs border border-orange-200/80 dark:border-orange-800/60 transition-all text-center">
                                <i data-lucide="zap" class="w-3.5 h-3.5 fill-tangerine-500 text-tangerine-500"></i>
                                <span>Demo Guru</span>
                            </a>
                            <a href="<?= base_url('login/demo-siswa') ?>" class="flex items-center justify-center space-x-1.5 py-2.5 px-3 rounded-xl bg-royal-50 hover:bg-royal-100 dark:bg-royal-950/40 dark:hover:bg-royal-900/50 text-royal-700 dark:text-royal-400 font-bold text-xs border border-royal-200/80 dark:border-royal-800/60 transition-all text-center">
                                <i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-royal-600 dark:text-royal-400"></i>
                                <span>Demo Siswa</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- FOOTER (RESPONSIVE) -->
    <footer class="bg-white/80 dark:bg-[#0F172A]/90 backdrop-blur-md border-t border-slate-200/70 dark:border-slate-800 py-4 sm:py-6 px-4 text-center text-xs text-slate-500 dark:text-slate-400">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-1.5 sm:gap-0">
            <p>&copy; <?= date('Y') ?> <strong>EduScan QR</strong> - SMK Budi Luhur.</p>
            <p class="text-royal-600 dark:text-royal-400 font-semibold text-[11px] sm:text-xs">Presensi & Jurnal Mengajar Digital Terintegrasi WhatsApp</p>
        </div>
    </footer>

    <script>
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

        // Role Switcher Handler (Guru vs Siswa)
        function selectLoginRole(role) {
            const roleInput = document.getElementById('loginRoleInput');
            const btnGuru = document.getElementById('btnTabRoleGuru');
            const btnSiswa = document.getElementById('btnTabRoleSiswa');
            const label = document.getElementById('identifierLabel');
            const username = document.getElementById('usernameInput');
            const hint = document.getElementById('identifierHint');
            const btnText = document.getElementById('btnSubmitText');

            roleInput.value = role;

            if (role === 'guru') {
                btnGuru.className = "flex-1 flex items-center justify-center space-x-2 py-2.5 px-3 rounded-xl text-xs font-bold transition-all bg-white dark:bg-slate-900 text-royal-600 dark:text-royal-400 shadow-sm";
                btnSiswa.className = "flex-1 flex items-center justify-center space-x-2 py-2.5 px-3 rounded-xl text-xs font-bold transition-all text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white";
                label.textContent = "NIP / Email Guru";
                username.placeholder = "Masukkan NIP atau Email Guru...";
                hint.textContent = "Guru Pengampu: Naila Salma Az-Zahra, S.Kom";
                btnText.textContent = "Masuk Sebagai Guru";
            } else {
                btnSiswa.className = "flex-1 flex items-center justify-center space-x-2 py-2.5 px-3 rounded-xl text-xs font-bold transition-all bg-white dark:bg-slate-900 text-royal-600 dark:text-royal-400 shadow-sm";
                btnGuru.className = "flex-1 flex items-center justify-center space-x-2 py-2.5 px-3 rounded-xl text-xs font-bold transition-all text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white";
                label.textContent = "NISN Siswa";
                username.placeholder = "Contoh NISN: 0068192001";
                hint.textContent = "Siswa: Ahmad Fauzi Budiarto (X RPL 1)";
                btnText.textContent = "Masuk Sebagai Siswa";
            }
            if (typeof lucide !== 'undefined') lucide.createIcons();
        }

        // Quick Autofill Shortcut
        function autofillLogin(role) {
            selectLoginRole(role);
            const username = document.getElementById('usernameInput');
            const password = document.getElementById('passwordInput');

            if (role === 'guru') {
                username.value = '19920815 201802 2 003';
                password.value = 'guru123';
            } else {
                username.value = '0068192001';
                password.value = 'siswa123';
            }
        }

        // Show/Hide Password Eye Toggle
        function togglePasswordVisibility() {
            const pwdInput = document.getElementById('passwordInput');
            const icon = document.getElementById('passwordEyeIcon');
            if (pwdInput.type === 'password') {
                pwdInput.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                pwdInput.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            if (typeof lucide !== 'undefined') lucide.createIcons();
        }

        // Lupa Password Modal
        function showForgotPasswordHelp() {
            Swal.fire({
                title: 'Bantuan Kredensial Akun',
                html: `
                    <div class="text-left text-xs space-y-2.5 text-slate-600 pt-2">
                        <p>Kredensial resmi akun demo <strong>SMK Budi Luhur</strong>:</p>
                        <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200 font-mono text-[11px] space-y-1.5">
                            <div>👩‍🏫 <strong>Guru</strong>: NIP <code>19920815 201802 2 003</code> / Password: <code>guru123</code></div>
                            <div>👨‍🎓 <strong>Siswa</strong>: NISN <code>0068192001</code> / Password: <code>siswa123</code></div>
                        </div>
                        <p class="text-[11px] text-slate-400">Atau klik tombol <em>Isi Guru</em> / <em>Isi Siswa</em> di atas form.</p>
                    </div>
                `,
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#4F46E5',
                customClass: { popup: 'rounded-2xl p-6 shadow-xl' }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateThemeUI();
            lucide.createIcons();

            <?php if (session()->getFlashdata('swal_error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Masuk',
                    text: '<?= addslashes(session()->getFlashdata('swal_error')) ?>',
                    confirmButtonColor: '#FF5252',
                    customClass: { popup: 'rounded-2xl' }
                });
            <?php endif; ?>

            <?php if (session()->getFlashdata('swal_success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '<?= addslashes(session()->getFlashdata('swal_success')) ?>',
                    timer: 2500,
                    showConfirmButton: false,
                    customClass: { popup: 'rounded-2xl' }
                });
            <?php endif; ?>

            <?php if (session()->getFlashdata('swal_info')): ?>
                Swal.fire({
                    icon: 'info',
                    title: 'Informasi',
                    text: '<?= addslashes(session()->getFlashdata('swal_info')) ?>',
                    timer: 2500,
                    showConfirmButton: false,
                    customClass: { popup: 'rounded-2xl' }
                });
            <?php endif; ?>
        });
    </script>
</body>
</html>
