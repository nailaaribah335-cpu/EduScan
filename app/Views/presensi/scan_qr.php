<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/60 dark:border-slate-800">
        <div>
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-tangerine-500/10 dark:bg-tangerine-500/20 text-tangerine-600 dark:text-tangerine-400 text-xs font-bold mb-2">
                <span class="w-2 h-2 rounded-full bg-tangerine-500 animate-pulse"></span>
                <span>PRESENSI REAL-TIME VIA QR</span>
                <span>•</span>
                <span>ANTI-TITIP ABSEN</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Presensi Kelas via Scan QR Code</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">Validasi kehadiran siswa menggunakan Dynamic QR berputar tiap 15 detik atau Scanner Kamera Guru.</p>
        </div>

        <!-- Class Selector & Quick Stats -->
        <div class="flex flex-wrap items-center gap-3">
            <div class="flex items-center space-x-2 bg-white dark:bg-slate-800/90 px-4 py-2 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-soft">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400">Pilih Kelas:</span>
                <select id="selectClassFilter" onchange="window.location.href='<?= base_url('scan-qr') ?>?kelas='+this.value" class="text-xs font-bold text-royal-700 dark:text-royal-300 bg-transparent focus:outline-none cursor-pointer">
                    <?php foreach ($classes as $cls): ?>
                        <option value="<?= esc($cls) ?>" class="bg-white dark:bg-slate-900 text-slate-900 dark:text-white" <?= $selectedClass === $cls ? 'selected' : '' ?>><?= esc($cls) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex items-center space-x-2 bg-gradient-to-r from-mint-500 to-emerald-600 text-white px-4 py-2 rounded-2xl text-xs font-bold shadow-soft">
                <i data-lucide="users" class="w-4 h-4"></i>
                <span id="statHadirDisplay"><?= esc($presentCount) ?> / <?= esc($totalStudents) ?> Hadir</span>
            </div>
        </div>
    </div>

    <!-- TABS CONTROLLER (2 MODES CLEAN) -->
    <div class="flex items-center p-1.5 bg-white dark:bg-slate-800/90 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-soft max-w-md">
        <button id="btnTabDynamic" onclick="switchMode('dynamic')" class="flex-1 flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all bg-royal-600 text-white shadow-soft">
            <i data-lucide="qr-code" class="w-4 h-4"></i>
            <span>Mode 1: Dynamic QR Kelas</span>
        </button>
        <button id="btnTabScanner" onclick="switchMode('scanner')" class="flex-1 flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">
            <i data-lucide="camera" class="w-4 h-4"></i>
            <span>Mode 2: Kamera Scanner</span>
        </button>
    </div>

    <!-- ========================================================================= -->
    <!-- TAB 1: DYNAMIC QR KELAS (ANTI-TITIP ABSEN) -->
    <!-- ========================================================================= -->
    <div id="sectionDynamicQR" class="space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- QR Display Card -->
            <div class="lg:col-span-7 bg-white dark:bg-[#111C35] rounded-[32px] p-6 sm:p-8 border border-slate-200/80 dark:border-slate-700/80 shadow-soft flex flex-col items-center text-center relative overflow-hidden" id="qrContainerBox">
                <!-- Top Header Info in QR Card -->
                <div class="w-full flex items-center justify-between pb-4 mb-4 border-b border-slate-100 dark:border-slate-800">
                    <div class="text-left">
                        <span class="text-[10px] font-extrabold uppercase tracking-widest text-tangerine-600 dark:text-tangerine-400 bg-tangerine-500/10 dark:bg-tangerine-500/20 px-2.5 py-0.5 rounded-full">SESI KBM AKTIF</span>
                        <h3 class="text-xl font-black text-slate-900 dark:text-white mt-1"><?= esc($selectedClass) ?></h3>
                    </div>
                    <button onclick="toggleFullscreenQR()" class="flex items-center space-x-1.5 px-3.5 py-2 rounded-2xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-xs font-bold text-slate-700 dark:text-slate-200 transition-colors" title="Tampilkan Layar Penuh untuk Proyektor Kelas">
                        <i data-lucide="maximize" class="w-3.5 h-3.5"></i>
                        <span>Layar Penuh (Proyektor)</span>
                    </button>
                </div>

                <!-- Animated Rotating QR Center Area -->
                <div class="relative p-6 rounded-[28px] bg-slate-50 dark:bg-[#0B1120] border-2 border-dashed border-royal-200/70 dark:border-royal-500/40 shadow-inner my-2 flex flex-col items-center">
                    <!-- QR Target Canvas / Div -->
                    <div id="dynamicQrcodeWrapper" class="p-4 bg-white rounded-2xl shadow-soft">
                        <div id="qrcodeCanvas"></div>
                    </div>

                    <!-- Watermark Logo overlay -->
                    <div class="mt-3 flex items-center space-x-1 text-[11px] font-extrabold text-royal-700 dark:text-royal-300 tracking-wider">
                        <i data-lucide="shield-check" class="w-4 h-4 text-mint-500"></i>
                        <span>ANTI-TITIP ABSEN ENCRYPTED</span>
                    </div>
                </div>

                <!-- 15-SECOND ROTATING TIMER INDICATOR -->
                <div class="w-full max-w-sm mt-5 space-y-2">
                    <div class="flex items-center justify-between text-xs font-bold">
                        <span class="text-slate-500 dark:text-slate-400 flex items-center space-x-1.5">
                            <i data-lucide="refresh-cw" class="w-3.5 h-3.5 text-tangerine-500 animate-spin"></i>
                            <span>Rotasi Token Otomatis:</span>
                        </span>
                        <span id="countdownTimerText" class="text-tangerine-600 dark:text-tangerine-400 font-mono text-sm font-extrabold">15 detik</span>
                    </div>

                    <!-- Progress Bar Timer -->
                    <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2.5 overflow-hidden border border-slate-200 dark:border-slate-700">
                        <div id="timerProgressBar" class="h-full bg-gradient-to-r from-tangerine-500 via-amber-400 to-mint-500 transition-all duration-1000 ease-linear" style="width: 100%"></div>
                    </div>

                    <!-- Token Hash Indicator -->
                    <div class="pt-2 text-center">
                        <span class="text-[11px] text-slate-400 font-mono">Token Aktif: </span>
                        <span id="currentTokenHash" class="text-xs font-bold font-mono text-royal-700 dark:text-royal-300 bg-royal-50 dark:bg-royal-950/60 px-3 py-1 rounded-full border border-royal-200/60 dark:border-royal-800/80">
                            TOKEN-<?= str_replace(' ', '-', esc($selectedClass)) ?>-89F2A
                        </span>
                    </div>
                </div>

                <div class="mt-6 text-xs text-slate-600 dark:text-slate-300 bg-orange-50/50 dark:bg-slate-800/60 p-4 rounded-2xl border border-orange-200/50 dark:border-slate-700/60 max-w-md text-left flex items-start space-x-2.5">
                    <i data-lucide="info" class="w-4 h-4 text-tangerine-500 shrink-0 mt-0.5"></i>
                    <span>Tampilkan QR ini di layar proyektor / smartboard kelas. Siswa memindai dari ponsel mereka. Token QR berganti otomatis tiap 15 detik sehingga tidak dapat difoto/disebarkan ke luar kelas!</span>
                </div>
            </div>

            <!-- Dynamic Session Live Roster & Quick Simulation -->
            <div class="lg:col-span-5 space-y-4">
                <!-- DEMO TRIGGER BUTTON -->
                <div class="p-6 rounded-[30px] bg-gradient-to-br from-orange-50/70 via-amber-50/50 to-white dark:from-[#1E1B2E] dark:via-[#1A1E36] dark:to-[#131B2E] border-2 border-orange-200/80 dark:border-orange-500/30 shadow-soft space-y-3.5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2 text-xs font-black uppercase text-tangerine-600 dark:text-tangerine-400">
                            <i data-lucide="zap" class="w-4 h-4"></i>
                            <span>Demo Presensi Instan</span>
                        </div>
                        <span class="text-[10px] bg-tangerine-500 text-white font-extrabold px-2.5 py-0.5 rounded-full shadow-xs">1-Klik Demo</span>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-snug">
                        Simulasikan siswa masuk memindai QR code ini. Akan membunyikan nada scanner, memunculkan popup siswa, dan otomatis mengirim WhatsApp ke orang tua siswa!
                    </p>
                    <button onclick="simulateScanAttendance()" class="w-full flex items-center justify-center space-x-2 py-3.5 px-4 rounded-2xl bg-gradient-to-r from-tangerine-500 to-amber-500 hover:from-tangerine-600 hover:to-amber-600 text-white font-black text-sm shadow-soft hover:shadow-lg hover:shadow-tangerine-500/25 transition-all active:scale-98">
                        <i data-lucide="scan" class="w-4 h-4"></i>
                        <span>SIMULASI SCAN SISWA SEKARANG</span>
                    </button>
                </div>

                <!-- Recent Attendees in this class -->
                <div class="bg-white dark:bg-[#111C35] rounded-[28px] p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-soft space-y-3">
                    <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                        <h4 class="text-sm font-bold text-slate-900 dark:text-white">Siswa Hadir di Sesi Ini</h4>
                        <span id="sessionCounterBadge" class="text-xs font-bold px-2 py-0.5 rounded-full bg-royal-100 dark:bg-royal-950/60 text-royal-700 dark:text-royal-300 border border-transparent dark:border-royal-800/60">
                            <?= esc($presentCount) ?> Siswa
                        </span>
                    </div>

                    <div id="sessionAttendeesList" class="divide-y divide-slate-100 dark:divide-slate-800 max-h-80 overflow-y-auto pr-1 space-y-2">
                        <?php foreach ($attendances as $att): ?>
                            <div class="pt-2 flex items-center justify-between text-xs">
                                <div class="flex items-center space-x-2.5">
                                    <div class="w-7 h-7 rounded-lg bg-royal-50 dark:bg-royal-950/60 font-bold text-royal-700 dark:text-royal-300 flex items-center justify-center text-[10px] border border-transparent dark:border-royal-800/40">
                                        <?= strtoupper(substr($att['name'], 0, 2)) ?>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 dark:text-slate-100 leading-tight"><?= esc($att['name']) ?></p>
                                        <p class="text-[10px] text-slate-400 dark:text-slate-400"><?= esc($att['nisn']) ?> • <span class="font-mono"><?= esc($att['time']) ?></span></p>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-posterGreen-500/15 dark:bg-emerald-950/50 text-posterGreen-700 dark:text-emerald-300 border border-transparent dark:border-emerald-800/50">
                                    <?= esc($att['status']) ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- TAB 2: KAMERA SCANNER QR (WEBCAM BROWSER) -->
    <!-- ========================================================================= -->
    <div id="sectionWebcamScanner" class="space-y-6 hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- Webcam Viewport Card -->
            <div class="lg:col-span-7 bg-white dark:bg-[#111C35] rounded-3xl p-6 border border-slate-200 dark:border-slate-800 shadow-soft space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">Kamera Scanner Presensi</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Arahkan kartu QR siswa atau layar HP ke kamera ini.</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button id="btnStartCamera" onclick="startScanner()" class="px-3.5 py-1.5 rounded-xl bg-posterGreen-500 hover:bg-posterGreen-600 text-white font-bold text-xs flex items-center space-x-1.5 shadow-sm">
                            <i data-lucide="video" class="w-3.5 h-3.5"></i>
                            <span>Buka Kamera</span>
                        </button>
                        <button id="btnStopCamera" onclick="stopScanner()" class="hidden px-3.5 py-1.5 rounded-xl bg-rose-500 hover:bg-rose-600 text-white font-bold text-xs flex items-center space-x-1.5 shadow-sm">
                            <i data-lucide="video-off" class="w-3.5 h-3.5"></i>
                            <span>Tutup Kamera</span>
                        </button>
                    </div>
                </div>

                <!-- Video Viewport Container -->
                <div class="relative w-full aspect-video bg-slate-900 rounded-2xl overflow-hidden flex items-center justify-center border-2 border-slate-700 shadow-inner">
                    <div id="qrScannerReader" class="w-full h-full"></div>

                    <!-- Laser Overlay (Visual effect) -->
                    <div id="scanLaserLine" class="hidden absolute inset-x-4 h-1 bg-gradient-to-r from-transparent via-posterGreen-400 to-transparent shadow-glow-green animate-scan-laser pointer-events-none"></div>

                    <!-- Placeholder when camera is not started -->
                    <div id="cameraPlaceholder" class="text-center p-6 space-y-3">
                        <div class="w-16 h-16 rounded-3xl bg-white/10 flex items-center justify-center mx-auto text-posterGreen-400">
                            <i data-lucide="camera" class="w-8 h-8"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-white">Kamera Belum Aktif</p>
                            <p class="text-xs text-slate-400 max-w-xs mt-1">Klik tombol "Buka Kamera" di atas untuk mengakses webcam, atau gunakan tombol simulasi instan.</p>
                        </div>
                        <button onclick="startScanner()" class="px-4 py-2 rounded-xl bg-royal-700 hover:bg-royal-600 text-white font-bold text-xs">
                            Izinkan & Buka Kamera
                        </button>
                    </div>
                </div>

                <!-- Camera Status Notification bar -->
                <div id="scannerStatusMsg" class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700/60 text-xs text-slate-600 dark:text-slate-300 flex items-center justify-between">
                    <span class="flex items-center space-x-2">
                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                        <span>Status: <strong class="text-slate-800 dark:text-slate-100">Menunggu Inisialisasi</strong></span>
                    </span>
                    <span class="text-[11px] text-slate-400 font-mono">html5-qrcode engine v2.3</span>
                </div>
            </div>

            <!-- Manual NISN Input & Demo Scanner Trigger -->
            <div class="lg:col-span-5 space-y-4">
                <!-- Simulasi Demo Button -->
                <div class="p-5 rounded-3xl bg-royal-50 dark:bg-royal-950/40 border border-royal-200 dark:border-royal-800/60 shadow-soft space-y-3">
                    <div class="flex items-center space-x-2 text-xs font-bold text-royal-700 dark:text-royal-300 uppercase">
                        <i data-lucide="sparkles" class="w-4 h-4 text-posterGreen-500"></i>
                        <span>Simulasi Tanpa Kartu Fisik</span>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-300">
                        Sangat berguna saat presentasi demo di depan audiens/penguji tanpa perlu kartu fisik.
                    </p>
                    <button onclick="simulateScanAttendance()" class="w-full flex items-center justify-center space-x-2 py-3 px-4 rounded-xl bg-royal-700 hover:bg-royal-800 text-white font-extrabold text-xs shadow-md transition-all active:scale-98">
                        <i data-lucide="play" class="w-4 h-4 fill-white"></i>
                        <span>SIMULASI SCAN SATU SISWA</span>
                    </button>
                </div>

                <!-- Input Manual NISN / Kartu Hilang -->
                <div class="bg-white dark:bg-[#111C35] rounded-3xl p-5 border border-slate-200 dark:border-slate-800 shadow-soft space-y-4">
                    <div>
                        <h4 class="text-sm font-bold text-slate-900 dark:text-white">Verifikasi Manual NISN</h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Gunakan bila barcode siswa rusak atau tidak terbaca.</p>
                    </div>

                    <form id="formManualScan" onsubmit="handleManualScan(event)" class="space-y-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Pilih Siswa / Masukkan NISN</label>
                            <select id="inputManualNisn" class="w-full px-3 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-800 dark:text-white text-xs font-medium focus:ring-2 focus:ring-royal-500 focus:outline-none">
                                <?php foreach ($students as $s): ?>
                                    <option value="<?= esc($s['nisn']) ?>"><?= esc($s['name']) ?> (<?= esc($s['nisn']) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Status Kehadiran</label>
                            <div class="grid grid-cols-3 gap-2">
                                <label class="flex items-center justify-center space-x-1 p-2 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold cursor-pointer hover:bg-posterGreen-500/10 has-[:checked]:bg-posterGreen-500 has-[:checked]:text-white">
                                    <input type="radio" name="manual_status" value="Hadir" checked class="hidden">
                                    <span>Hadir</span>
                                </label>
                                <label class="flex items-center justify-center space-x-1 p-2 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold cursor-pointer hover:bg-amber-500/10 has-[:checked]:bg-amber-500 has-[:checked]:text-white">
                                    <input type="radio" name="manual_status" value="Sakit" class="hidden">
                                    <span>Sakit</span>
                                </label>
                                <label class="flex items-center justify-center space-x-1 p-2 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold cursor-pointer hover:bg-royal-500/10 has-[:checked]:bg-royal-600 has-[:checked]:text-white">
                                    <input type="radio" name="manual_status" value="Izin" class="hidden">
                                    <span>Izin</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="w-full flex items-center justify-center space-x-1.5 py-2.5 px-4 rounded-xl bg-slate-800 hover:bg-slate-900 dark:bg-royal-600 dark:hover:bg-royal-700 text-white font-bold text-xs transition-colors">
                            <i data-lucide="check" class="w-4 h-4"></i>
                            <span>Verifikasi & Kirim Notif</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- LOG PRESENSI REAL-TIME HARI INI (RESPONSIF: DESKTOP TABEL + MOBILE KARTU) -->
    <!-- ========================================================================= -->
    <div class="bg-white dark:bg-[#111C35] rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Daftar Kehadiran Siswa: <?= esc($selectedClass) ?></h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Diperbarui real-time setiap scan QR berlangsung.</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-xs font-semibold text-slate-400 dark:text-slate-400">Total: <strong class="text-slate-700 dark:text-slate-200" id="tableRowCountDisplay"><?= count($attendances) ?></strong> rekaman</span>
            </div>
        </div>

        <!-- 1. TAMPILAN MOBILE: KARTU VERTIKAL (TIDAK PERLU DIGESER SAMPING!) -->
        <div class="md:hidden divide-y divide-slate-100 dark:divide-slate-800" id="attendanceMobileCards">
            <?php if (!empty($attendances)): ?>
                <?php foreach ($attendances as $idx => $att): ?>
                    <div class="p-4 space-y-2.5 hover:bg-slate-50/60 dark:hover:bg-slate-800/40 transition-colors">
                        <div class="flex items-start justify-between gap-2">
                            <div class="flex items-center space-x-2.5">
                                <div class="w-9 h-9 rounded-xl bg-royal-100 dark:bg-royal-950/60 text-royal-700 dark:text-royal-300 font-bold flex items-center justify-center text-xs shrink-0">
                                    <?= strtoupper(substr($att['name'], 0, 2)) ?>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900 dark:text-white leading-tight"><?= esc($att['name']) ?></h4>
                                    <p class="text-[10px] text-slate-400 font-mono">NISN: <?= esc($att['nisn']) ?> • <strong class="text-royal-700 dark:text-royal-400"><?= esc($att['class']) ?></strong></p>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold shrink-0 <?= $att['status'] === 'Hadir' ? 'bg-posterGreen-500/15 dark:bg-emerald-950/50 text-posterGreen-700 dark:text-emerald-300 border border-transparent dark:border-emerald-800/50' : 'bg-amber-500/15 dark:bg-amber-950/50 text-amber-700 dark:text-amber-300 border border-transparent dark:border-amber-800/50' ?>">
                                <?= esc($att['status']) ?>
                            </span>
                        </div>

                        <div class="flex items-center justify-between text-[11px] text-slate-500 dark:text-slate-400 pt-1 border-t border-slate-100 dark:border-slate-800">
                            <span class="font-mono flex items-center space-x-1">
                                <i data-lucide="clock" class="w-3 h-3 text-slate-400"></i>
                                <span><?= esc($att['time']) ?> WIB</span>
                            </span>
                            <button onclick="openStudentDetailModal('<?= esc(addslashes($att['name'])) ?>', '<?= esc(addslashes($att['nisn'])) ?>', '<?= esc(addslashes($att['class'])) ?>', '<?= esc(addslashes($att['time'])) ?>', '<?= esc(addslashes($att['method'])) ?>', '<?= esc(addslashes($att['status'])) ?>')" class="text-royal-700 dark:text-royal-400 hover:text-royal-900 dark:hover:text-royal-300 font-bold flex items-center space-x-1">
                                <span>Lihat Selengkapnya</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="p-6 text-center text-slate-400 text-xs">Belum ada data presensi untuk kelas ini.</div>
            <?php endif; ?>
        </div>

        <!-- 2. TAMPILAN DESKTOP: TABEL LEGA DAN RAPI -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/80 border-b border-slate-200/80 dark:border-slate-800 text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                        <th class="py-3.5 px-6">No</th>
                        <th class="py-3.5 px-6">Siswa</th>
                        <th class="py-3.5 px-6">Kelas</th>
                        <th class="py-3.5 px-6">Waktu Presensi</th>
                        <th class="py-3.5 px-6">Metode</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6">Notifikasi Ortu WA</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="attendanceTableBody" class="divide-y divide-slate-100 dark:divide-slate-800 font-medium">
                    <?php if (!empty($attendances)): ?>
                        <?php foreach ($attendances as $idx => $att): ?>
                            <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/40 transition-colors">
                                <td class="py-3.5 px-6 text-slate-400"><?= $idx + 1 ?></td>
                                <td class="py-3.5 px-6">
                                    <div class="font-bold text-slate-900 dark:text-white"><?= esc($att['name']) ?></div>
                                    <div class="text-[11px] text-slate-400 font-mono">NISN: <?= esc($att['nisn']) ?></div>
                                </td>
                                <td class="py-3.5 px-6 font-bold text-royal-700 dark:text-royal-400"><?= esc($att['class']) ?></td>
                                <td class="py-3.5 px-6 font-mono text-slate-700 dark:text-slate-300"><?= esc($att['time']) ?> WIB</td>
                                <td class="py-3.5 px-6 text-slate-600 dark:text-slate-300">
                                    <span class="inline-flex items-center space-x-1">
                                        <i data-lucide="qr-code" class="w-3.5 h-3.5 text-posterGreen-500"></i>
                                        <span><?= esc($att['method']) ?></span>
                                    </span>
                                </td>
                                <td class="py-3.5 px-6">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold <?= $att['status'] === 'Hadir' ? 'bg-posterGreen-500/15 dark:bg-emerald-950/50 text-posterGreen-700 dark:text-emerald-300 border border-transparent dark:border-emerald-800/50' : ($att['status'] === 'Sakit' ? 'bg-amber-500/15 dark:bg-amber-950/50 text-amber-700 dark:text-amber-300 border border-transparent dark:border-amber-800/50' : 'bg-royal-100 dark:bg-royal-950/50 text-royal-700 dark:text-royal-300') ?>">
                                        <?= esc($att['status']) ?>
                                    </span>
                                </td>
                                <td class="py-3.5 px-6">
                                    <span class="inline-flex items-center text-[11px] font-semibold text-posterGreen-600 dark:text-emerald-400 space-x-1">
                                        <i data-lucide="check-check" class="w-3.5 h-3.5"></i>
                                        <span>Terkirim Otomatis</span>
                                    </span>
                                </td>
                                <td class="py-3.5 px-6 text-center">
                                    <button onclick="openStudentDetailModal('<?= esc(addslashes($att['name'])) ?>', '<?= esc(addslashes($att['nisn'])) ?>', '<?= esc(addslashes($att['class'])) ?>', '<?= esc(addslashes($att['time'])) ?>', '<?= esc(addslashes($att['method'])) ?>', '<?= esc(addslashes($att['status'])) ?>')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold text-[11px] inline-flex items-center space-x-1 transition-colors">
                                        <i data-lucide="eye" class="w-3 h-3 text-royal-700 dark:text-royal-400"></i>
                                        <span>Detail</span>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="py-8 text-center text-slate-400">Belum ada data presensi untuk kelas ini hari ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const currentClass = "<?= esc($selectedClass) ?>";
    let qrGenerator = null;
    let countdownInterval = null;
    let secondsLeft = 15;
    let html5QrScanner = null;

    // Switch between Mode 1 (Dynamic QR) and Mode 2 (Webcam Scanner)
    function switchMode(mode) {
        const btnDynamic = document.getElementById('btnTabDynamic');
        const btnScanner = document.getElementById('btnTabScanner');
        const secDynamic = document.getElementById('sectionDynamicQR');
        const secScanner = document.getElementById('sectionWebcamScanner');

        if (mode === 'dynamic') {
            btnDynamic.className = "flex-1 flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all bg-royal-600 text-white shadow-soft";
            btnScanner.className = "flex-1 flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white";
            secDynamic.classList.remove('hidden');
            secScanner.classList.add('hidden');
        } else {
            btnScanner.className = "flex-1 flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all bg-royal-600 text-white shadow-soft";
            btnDynamic.className = "flex-1 flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white";
            secScanner.classList.remove('hidden');
            secDynamic.classList.add('hidden');
        }
    }

    // Generate Dynamic Rotating QR Code
    function generateDynamicToken() {
        const randHash = Math.random().toString(36).substring(2, 7).toUpperCase();
        const timestamp = new Date().getTime();
        const tokenString = `EDUSCAN::${currentClass}::${randHash}::${timestamp}`;

        const qrcodeCanvas = document.getElementById('qrcodeCanvas');
        if (qrcodeCanvas) {
            qrcodeCanvas.innerHTML = '';
            qrGenerator = new QRCode(qrcodeCanvas, {
                text: tokenString,
                width: 210,
                height: 210,
                colorDark: "#2B3082",
                colorLight: "#FFFFFF",
                correctLevel: QRCode.CorrectLevel.H
            });
        }

        const hashEl = document.getElementById('currentTokenHash');
        if (hashEl) {
            hashEl.textContent = `TOKEN-${currentClass.replace(/ /g, '-')}-${randHash}`;
        }
    }

    // Timer 15 detik countdown
    function startCountdown() {
        secondsLeft = 15;
        generateDynamicToken();

        if (countdownInterval) clearInterval(countdownInterval);

        countdownInterval = setInterval(() => {
            secondsLeft--;
            const timerText = document.getElementById('countdownTimerText');
            const progressBar = document.getElementById('timerProgressBar');

            if (timerText) timerText.textContent = `${secondsLeft} detik`;
            if (progressBar) {
                const percent = (secondsLeft / 15) * 100;
                progressBar.style.width = `${percent}%`;
            }

            if (secondsLeft <= 0) {
                secondsLeft = 15;
                generateDynamicToken();
            }
        }, 1000);
    }

    // Toggle Fullscreen untuk Proyektor Kelas
    function toggleFullscreenQR() {
        const elem = document.getElementById('qrContainerBox');
        if (!document.fullscreenElement) {
            elem.requestFullscreen().catch(err => {
                alert(`Error attempt fullscreen: ${err.message}`);
            });
        } else {
            document.exitFullscreen();
        }
    }

    // SIMULASI SCAN PRESENSI (1-KLIK DEMO)
    async function simulateScanAttendance() {
        try {
            const formData = new FormData();
            formData.append('kelas', currentClass);

            const response = await fetch('<?= base_url('scan-qr/simulate') ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            if (data.success) {
                // Play audio beep POS synthesizer
                playBeepSound('success');

                // Update UI data real-time
                updateAttendanceUI(data);

                // Show SweetAlert with student details and parent notification preview
                Swal.fire({
                    title: '<span class="text-xl font-extrabold text-slate-900">Presensi Berhasil Diverifikasi!</span>',
                    html: `
                        <div class="text-center space-y-3 py-2">
                            <div class="relative w-20 h-20 mx-auto">
                                <img src="${data.student.avatar}" class="w-20 h-20 rounded-2xl object-cover ring-4 ring-posterGreen-400 mx-auto shadow-md">
                                <span class="absolute -bottom-1 -right-1 bg-posterGreen-500 text-white rounded-full p-1 shadow">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                </span>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-slate-900">${data.student.name}</h3>
                                <p class="text-xs text-slate-500 font-mono">NISN: ${data.student.nisn} • Kelas ${data.student.class}</p>
                                <span class="inline-block mt-1 px-3 py-0.5 rounded-full text-xs font-bold bg-posterGreen-500/20 text-posterGreen-700">Status: HADIR (${data.attendance.time || '07:35'} WIB)</span>
                            </div>
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 text-left text-xs space-y-1">
                                <div class="flex items-center text-posterGreen-600 font-bold space-x-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.767 5.766 0 1.258.405 2.422 1.096 3.374l-.715 2.611 2.671-.701c.829.452 1.777.716 2.715.716 3.182 0 5.768-2.586 5.768-5.766 0-3.18-2.586-5.766-5.768-5.766z"/></svg>
                                    <span>Notifikasi WhatsApp Terkirim Otomatis:</span>
                                </div>
                                <p class="text-slate-600 text-[11px] leading-relaxed">
                                    "Yth. Bapak/Ibu <strong>${data.student.parent_name}</strong>, putra/putri Anda <strong>${data.student.name}</strong> telah tercatat HADIR di kelas."
                                </p>
                            </div>
                        </div>
                    `,
                    confirmButtonText: 'Tutup Selesai',
                    confirmButtonColor: '#38C682',
                    customClass: {
                        popup: 'rounded-3xl shadow-2xl p-6'
                    }
                });
            }
        } catch (e) {
            console.error('Error during simulated scan:', e);
        }
    }

    // Manual Scan Form Handler
    async function handleManualScan(e) {
        e.preventDefault();
        const nisn = document.getElementById('inputManualNisn').value;
        const status = document.querySelector('input[name="manual_status"]:checked').value;

        const formData = new FormData();
        formData.append('nisn', nisn);
        formData.append('kelas', currentClass);
        formData.append('status', status);
        formData.append('method', 'Input Verifikasi Guru');

        const response = await fetch('<?= base_url('scan-qr/process') ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const data = await response.json();
        if (data.success) {
            playBeepSound('success');
            updateAttendanceUI(data);

            Swal.fire({
                icon: 'success',
                title: 'Presensi Tercatat!',
                text: `${data.student.name} berhasil tercatat ${status}. Notifikasi WA telah dikirimkan ke orang tua.`,
                timer: 3000,
                confirmButtonColor: '#38C682',
                customClass: { popup: 'rounded-2xl' }
            });
        }
    }

    // Update DOM table & counter widgets dynamically
    function updateAttendanceUI(data) {
        // Update stats
        if (data.presentCount !== undefined) {
            document.getElementById('statHadirDisplay').textContent = `${data.presentCount} / ${data.totalStudents} Hadir`;
            document.getElementById('sessionCounterBadge').textContent = `${data.presentCount} Siswa`;
        }

        // Re-render recent session attendee list
        const attendeesList = document.getElementById('sessionAttendeesList');
        if (attendeesList && data.student) {
            const initials = data.student.name.substring(0, 2).toUpperCase();
            const newItem = document.createElement('div');
            newItem.className = "pt-2 flex items-center justify-between text-xs bg-posterGreen-50/50 dark:bg-emerald-950/30 p-2 rounded-xl transition-all border border-transparent dark:border-emerald-800/40";
            newItem.innerHTML = `
                <div class="flex items-center space-x-2.5">
                    <div class="w-7 h-7 rounded-lg bg-posterGreen-500 text-white font-bold flex items-center justify-center text-[10px]">
                        ${initials}
                    </div>
                    <div>
                        <p class="font-bold text-slate-800 dark:text-slate-100 leading-tight">${data.student.name}</p>
                        <p class="text-[10px] text-slate-400 dark:text-slate-400">${data.student.nisn} • <span class="font-mono">${data.attendance.time}</span></p>
                    </div>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-posterGreen-500/15 dark:bg-emerald-950/50 text-posterGreen-700 dark:text-emerald-300 border border-transparent dark:border-emerald-800/50">
                    ${data.attendance.status}
                </span>
            `;
            attendeesList.prepend(newItem);
        }

        // Re-render main table row (Desktop)
        const tbody = document.getElementById('attendanceTableBody');
        if (tbody && data.attendances) {
            tbody.innerHTML = '';
            data.attendances.forEach((att, idx) => {
                const tr = document.createElement('tr');
                tr.className = "hover:bg-slate-50/80 dark:hover:bg-slate-800/40 transition-colors";
                tr.innerHTML = `
                    <td class="py-3.5 px-6 text-slate-400">${idx + 1}</td>
                    <td class="py-3.5 px-6">
                        <div class="font-bold text-slate-900 dark:text-white">${att.name}</div>
                        <div class="text-[11px] text-slate-400 font-mono">NISN: ${att.nisn}</div>
                    </td>
                    <td class="py-3.5 px-6 font-bold text-royal-700 dark:text-royal-400">${att.class}</td>
                    <td class="py-3.5 px-6 font-mono text-slate-700 dark:text-slate-300">${att.time} WIB</td>
                    <td class="py-3.5 px-6 text-slate-600 dark:text-slate-300">
                        <span class="inline-flex items-center space-x-1">
                            <i data-lucide="qr-code" class="w-3.5 h-3.5 text-posterGreen-500"></i>
                            <span>${att.method}</span>
                        </span>
                    </td>
                    <td class="py-3.5 px-6">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold ${att.status === 'Hadir' ? 'bg-posterGreen-500/15 dark:bg-emerald-950/50 text-posterGreen-700 dark:text-emerald-300 border border-transparent dark:border-emerald-800/50' : 'bg-amber-500/15 dark:bg-amber-950/50 text-amber-700 dark:text-amber-300 border border-transparent dark:border-amber-800/50'}">
                            ${att.status}
                        </span>
                    </td>
                    <td class="py-3.5 px-6">
                        <span class="inline-flex items-center text-[11px] font-semibold text-posterGreen-600 dark:text-emerald-400 space-x-1">
                            <i data-lucide="check-check" class="w-3.5 h-3.5"></i>
                            <span>Terkirim Otomatis</span>
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-center">
                        <button onclick="openStudentDetailModal('${att.name}', '${att.nisn}', '${att.class}', '${att.time}', '${att.method}', '${att.status}')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold text-[11px] inline-flex items-center space-x-1 transition-colors">
                            <i data-lucide="eye" class="w-3 h-3 text-royal-700 dark:text-royal-400"></i>
                            <span>Detail</span>
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
            document.getElementById('tableRowCountDisplay').textContent = data.attendances.length;
        }

        // Re-render mobile cards (Mobile)
        const mobileContainer = document.getElementById('attendanceMobileCards');
        if (mobileContainer && data.attendances) {
            mobileContainer.innerHTML = '';
            data.attendances.forEach((att) => {
                const card = document.createElement('div');
                card.className = "p-4 space-y-2.5 hover:bg-slate-50/60 dark:hover:bg-slate-800/40 transition-colors";
                card.innerHTML = `
                    <div class="flex items-start justify-between gap-2">
                        <div class="flex items-center space-x-2.5">
                            <div class="w-9 h-9 rounded-xl bg-royal-100 dark:bg-royal-950/60 text-royal-700 dark:text-royal-300 font-bold flex items-center justify-center text-xs shrink-0">
                                ${att.name.substring(0, 2).toUpperCase()}
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 dark:text-white leading-tight">${att.name}</h4>
                                <p class="text-[10px] text-slate-400 font-mono">NISN: ${att.nisn} • <strong class="text-royal-700 dark:text-royal-400">${att.class}</strong></p>
                            </div>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold shrink-0 ${att.status === 'Hadir' ? 'bg-posterGreen-500/15 dark:bg-emerald-950/50 text-posterGreen-700 dark:text-emerald-300 border border-transparent dark:border-emerald-800/50' : 'bg-amber-500/15 dark:bg-amber-950/50 text-amber-700 dark:text-amber-300 border border-transparent dark:border-amber-800/50'}">
                            ${att.status}
                        </span>
                    </div>

                    <div class="flex items-center justify-between text-[11px] text-slate-500 dark:text-slate-400 pt-1 border-t border-slate-100 dark:border-slate-800">
                        <span class="font-mono flex items-center space-x-1">
                            <i data-lucide="clock" class="w-3 h-3 text-slate-400"></i>
                            <span>${att.time} WIB</span>
                        </span>
                        <button onclick="openStudentDetailModal('${att.name}', '${att.nisn}', '${att.class}', '${att.time}', '${att.method}', '${att.status}')" class="text-royal-700 dark:text-royal-400 hover:text-royal-900 dark:hover:text-royal-300 font-bold flex items-center space-x-1">
                            <span>Lihat Selengkapnya</span>
                            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                `;
                mobileContainer.appendChild(card);
            });
            lucide.createIcons();
        }
    }

    // Modal popup detail lengkap siswa (tanpa perlu geser layar!)
    function openStudentDetailModal(name, nisn, className, time, method, status) {
        showDetailModal(
            `Detail Presensi Siswa`,
            `
            <div class="space-y-4">
                <div class="flex items-center space-x-3.5 p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80">
                    <div class="w-12 h-12 rounded-2xl bg-royal-700 dark:bg-royal-600 text-white font-extrabold flex items-center justify-center text-base shadow-sm">
                        ${name.substring(0, 2).toUpperCase()}
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900 dark:text-white">${name}</h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-mono">NISN: ${nisn} • Kelas: ${className}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80">
                        <span class="text-[10px] font-bold uppercase text-slate-400 dark:text-slate-400">Waktu Presensi</span>
                        <p class="font-mono font-bold text-slate-800 dark:text-white text-sm mt-0.5">${time} WIB</p>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80">
                        <span class="text-[10px] font-bold uppercase text-slate-400 dark:text-slate-400">Status Kehadiran</span>
                        <p class="font-bold text-posterGreen-600 dark:text-emerald-400 text-sm mt-0.5">${status}</p>
                    </div>
                </div>

                <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80 space-y-1 text-xs">
                    <span class="text-[10px] font-bold uppercase text-slate-400 dark:text-slate-400">Metode Verifikasi</span>
                    <p class="font-semibold text-slate-800 dark:text-slate-200 flex items-center space-x-1.5">
                        <svg class="w-4 h-4 text-posterGreen-600 dark:text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                        <span>${method}</span>
                    </p>
                </div>

                <div class="p-3.5 rounded-xl bg-posterGreen-50 dark:bg-emerald-950/40 border border-posterGreen-200 dark:border-emerald-800/60 space-y-1 text-xs">
                    <span class="text-[10px] font-bold uppercase text-posterGreen-700 dark:text-emerald-300">Notifikasi WhatsApp Orang Tua</span>
                    <p class="font-semibold text-slate-800 dark:text-slate-100">Status: <strong class="text-posterGreen-600 dark:text-emerald-400">TERKIRIM OTOMATIS</strong></p>
                    <p class="text-[11px] text-slate-600 dark:text-slate-300 italic">"Pesan konfirmasi kehadiran otomatis telah diteruskan ke nomor WhatsApp orang tua/wali murid."</p>
                </div>
            </div>
            `
        );
    }

    // WEBCAM SCANNER (html5-qrcode)
    function startScanner() {
        const placeholder = document.getElementById('cameraPlaceholder');
        const laser = document.getElementById('scanLaserLine');
        const btnStart = document.getElementById('btnStartCamera');
        const btnStop = document.getElementById('btnStopCamera');
        const statusMsg = document.getElementById('scannerStatusMsg');

        if (!html5QrScanner) {
            html5QrScanner = new Html5Qrcode("qrScannerReader");
        }

        const config = { fps: 10, qrbox: { width: 250, height: 250 } };

        html5QrScanner.start(
            { facingMode: "environment" },
            config,
            (decodedText, decodedResult) => {
                // QR Code detected successfully!
                playBeepSound('success');
                handleScannedDecodedQR(decodedText);
            },
            (errorMessage) => {
                // Scanning ongoing...
            }
        ).then(() => {
            if (placeholder) placeholder.classList.add('hidden');
            if (laser) laser.classList.remove('hidden');
            if (btnStart) btnStart.classList.add('hidden');
            if (btnStop) btnStop.classList.remove('hidden');
            if (statusMsg) statusMsg.innerHTML = '<span class="flex items-center space-x-2 text-posterGreen-600 font-bold"><span class="w-2 h-2 rounded-full bg-posterGreen-500 animate-ping"></span><span>Kamera Aktif • Silakan Arahkan QR Code</span></span>';
        }).catch(err => {
            console.error('Camera open error:', err);
            Swal.fire({
                icon: 'warning',
                title: 'Akses Kamera',
                text: 'Browser memerlukan izin webcam atau perangkat ini tidak memiliki kamera aktif. Anda tetap dapat menggunakan tombol "Simulasi Scan Siswa" untuk mendemokan aplikasi dengan mulus!',
                confirmButtonColor: '#3B41A3',
                customClass: { popup: 'rounded-2xl' }
            });
        });
    }

    function stopScanner() {
        if (html5QrScanner) {
            html5QrScanner.stop().then(() => {
                document.getElementById('cameraPlaceholder').classList.remove('hidden');
                document.getElementById('scanLaserLine').classList.add('hidden');
                document.getElementById('btnStartCamera').classList.remove('hidden');
                document.getElementById('btnStopCamera').classList.add('hidden');
                document.getElementById('scannerStatusMsg').innerHTML = '<span>Status: Kamera Ditutup</span>';
            });
        }
    }

    async function handleScannedDecodedQR(qrText) {
        // Parse QR content (misal: "EDUSCAN::X RPL 1::0068192001")
        let studentNisn = null;
        if (qrText.includes('::')) {
            const parts = qrText.split('::');
            studentNisn = parts[parts.length - 1];
        }

        const formData = new FormData();
        if (studentNisn) formData.append('nisn', studentNisn);
        formData.append('kelas', currentClass);
        formData.append('method', 'Kamera Scanner Web');

        const response = await fetch('<?= base_url('scan-qr/process') ?>', {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const data = await response.json();
        if (data.success) {
            updateAttendanceUI(data);
            Swal.fire({
                icon: 'success',
                title: 'QR Terbaca!',
                text: `Siswa: ${data.student.name} berhasil tercatat Hadir.`,
                timer: 2000,
                showConfirmButton: false
            });
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        startCountdown();
    });
</script>
<?= $this->endSection() ?>
