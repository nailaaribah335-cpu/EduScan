<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6 sm:space-y-8">

    <!-- ========================================================================= -->
    <!-- ROW 1: REF 1 HERO ORANGE BANNER + CHUNKY METRIC TILES                    -->
    <!-- ========================================================================= -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-6 items-stretch">

        <!-- LEFT (7 COLS): TANGERINE BANNER & HORIZONTAL WEEKLY CALENDAR STRIP -->
        <div class="lg:col-span-7 flex flex-col justify-between space-y-5">
            <!-- 1. Ref 1 Warm Tangerine Banner ("Absensi Siswa") -->
            <div class="relative overflow-hidden rounded-[30px] bg-gradient-to-r from-tangerine-500 via-amber-500 to-tangerine-600 text-white p-6 sm:p-7 shadow-tangerine">
                <!-- Organic subtle gradient blurs -->
                <div class="absolute -right-8 -bottom-8 w-44 h-44 rounded-full bg-white/10 blur-xl pointer-events-none"></div>
                <div class="absolute -left-10 -top-10 w-40 h-40 rounded-full bg-sunshine-300/20 blur-lg pointer-events-none"></div>

                <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-5">
                    <div class="space-y-2">
                        <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-[11px] font-bold tracking-wide">
                            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                            <span>SMK BUDI LUHUR • T.A 2026/2027</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-black tracking-tight leading-snug">
                            Absensi & Jurnal KBM
                        </h1>
                        <p class="text-white/90 text-xs sm:text-sm max-w-md leading-relaxed">
                            Halo, Ibu <strong><?= esc($user['name'] ?? 'Naila Salma Az-Zahra, S.Kom') ?></strong>! Ada <strong class="underline decoration-white/60">1 sesi mengajar aktif</strong> di kelas X RPL 1.
                        </p>
                    </div>

                    <!-- Ref 1 Cute Calendar Widget Mockup on Orange Card -->
                    <div class="hidden sm:flex flex-col items-center justify-center p-3.5 rounded-2xl bg-white/20 backdrop-blur-md border border-white/30 text-center shrink-0 w-28 shadow-sm">
                        <div class="flex items-center space-x-1 text-white/90 text-[10px] font-bold uppercase tracking-wider mb-1">
                            <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                            <span><?= date('M Y') ?></span>
                        </div>
                        <span class="text-3xl font-black text-white font-mono"><?= date('d') ?></span>
                        <span class="text-[10px] font-bold text-white/90 uppercase tracking-widest mt-0.5"><?= date('l') ?></span>
                    </div>
                </div>

                <!-- Quick Action Buttons with Ref 2 Rounded Style -->
                <div class="relative z-10 mt-6 pt-4 border-t border-white/20 flex flex-wrap items-center gap-2.5">
                    <a href="<?= base_url('scan-qr') ?>" class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-2xl bg-white hover:bg-slate-50 text-tangerine-600 text-xs font-black shadow-md transition-all transform hover:-translate-y-0.5">
                        <i data-lucide="qr-code" class="w-4 h-4 text-tangerine-600"></i>
                        <span>Buka Sesi QR Kelas</span>
                    </a>
                    <a href="<?= base_url('jurnal-kbm') ?>" class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-2xl bg-white/15 hover:bg-white/25 text-white text-xs font-bold backdrop-blur-md border border-white/25 transition-all">
                        <i data-lucide="edit-3" class="w-4 h-4 text-sunshine-200"></i>
                        <span>Isi Jurnal KBM</span>
                    </a>
                </div>
            </div>

            <!-- 2. Ref 1 Horizontal Weekly Calendar Strip ("Riwayat Absensi Siswa") -->
            <div class="p-5 sm:p-6 rounded-[28px] bg-white dark:bg-[#111C35] border border-slate-100 dark:border-slate-800 shadow-soft">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-2.5 h-2.5 rounded-full bg-tangerine-500"></div>
                        <h3 class="text-sm sm:text-base font-extrabold text-slate-900 dark:text-white">Riwayat Absensi Siswa</h3>
                    </div>
                    <div class="flex items-center space-x-1.5">
                        <span class="text-[11px] font-bold px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 flex items-center space-x-1 border border-transparent dark:border-slate-700">
                            <i data-lucide="calendar-range" class="w-3.5 h-3.5 text-slate-500 dark:text-slate-400"></i>
                            <span><?= date('F Y') ?></span>
                        </span>
                    </div>
                </div>

                <!-- Days Strip (Rabu, Kamis, Jumat [Active], Sabtu, Senin, Selasa) -->
                <div class="grid grid-cols-6 gap-2 text-center">
                    <?php
                    $weekDays = [
                        ['day' => 'Senin', 'date' => '24', 'active' => false, 'att' => '28/32'],
                        ['day' => 'Selasa', 'date' => '25', 'active' => false, 'att' => '29/32'],
                        ['day' => 'Rabu', 'date' => '26', 'active' => false, 'att' => '30/32'],
                        ['day' => 'Kamis', 'date' => '27', 'active' => false, 'att' => '27/32'],
                        ['day' => 'Jumat', 'date' => date('d'), 'active' => true, 'att' => ($metrics['present_count'] ?? 28) . '/32'],
                        ['day' => 'Sabtu', 'date' => '29', 'active' => false, 'att' => 'Libur'],
                    ];
                    ?>
                    <?php foreach ($weekDays as $w): ?>
                        <div class="p-2.5 rounded-2xl transition-all cursor-pointer <?= $w['active'] ? 'bg-coral-500 text-white shadow-md shadow-coral-500/25 ring-2 ring-coral-400' : 'bg-slate-50 dark:bg-slate-800/60 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200/60 dark:border-slate-700/60' ?>">
                            <span class="block text-[10px] font-semibold uppercase tracking-wider <?= $w['active'] ? 'text-white/90' : 'text-slate-400 dark:text-slate-400' ?>"><?= $w['day'] ?></span>
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-black text-sm mx-auto my-1 <?= $w['active'] ? 'bg-white text-coral-600' : 'bg-white dark:bg-slate-700 text-slate-800 dark:text-white shadow-sm' ?>">
                                <?= $w['date'] ?>
                            </div>
                            <span class="block text-[9px] font-bold mt-0.5 <?= $w['active'] ? 'text-white' : 'text-mint-600 dark:text-mint-400' ?>"><?= $w['att'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- RIGHT (5 COLS): REF 1 CHUNKY COLORFUL METRIC TILES -->
        <div class="lg:col-span-5 grid grid-cols-2 gap-4 sm:gap-5 content-between">

            <!-- Chunky Tile 1: Coral Red (Tanpa Keterangan / Alpa) -->
            <div class="p-5 sm:p-6 rounded-[28px] bg-gradient-to-br from-coral-500 to-coral-600 text-white shadow-lg shadow-coral-500/20 flex flex-col justify-between min-h-[140px] relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-20 h-20 rounded-full bg-white/10 blur-md pointer-events-none"></div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-white/90">Alpa</span>
                    <div class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center text-white">
                        <i data-lucide="user-x" class="w-4 h-4"></i>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl sm:text-4xl font-black font-mono tracking-tight text-white"><?= esc($metrics['absent_count'] ?? 2) ?></h3>
                    <p class="text-[11px] font-bold text-white/90 mt-1">Tanpa Keterangan</p>
                </div>
            </div>

            <!-- Chunky Tile 2: Sunny Yellow (Izin / Sakit) -->
            <div class="p-5 sm:p-6 rounded-[28px] bg-gradient-to-br from-sunshine-400 to-sunshine-500 text-white shadow-lg shadow-sunshine-500/20 flex flex-col justify-between min-h-[140px] relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-20 h-20 rounded-full bg-white/10 blur-md pointer-events-none"></div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-white/90">Izin / Sakit</span>
                    <div class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center text-white">
                        <i data-lucide="info" class="w-4 h-4"></i>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl sm:text-4xl font-black font-mono tracking-tight text-white"><?= esc(($metrics['sick_count'] ?? 1) + ($metrics['permission_count'] ?? 1)) ?></h3>
                    <p class="text-[11px] font-bold text-white/90 mt-1">Surat Dokter / Ortu</p>
                </div>
            </div>

            <!-- Chunky Tile 3: Big Emerald Green (125 Hadir - Ref 1 Wide Block) -->
            <div class="col-span-2 p-6 rounded-[28px] bg-gradient-to-br from-mint-500 to-mint-600 text-white shadow-lg shadow-mint-500/25 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 rounded-full bg-white/10 blur-lg pointer-events-none"></div>
                <div class="space-y-1">
                    <div class="flex items-center space-x-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-white animate-pulse"></span>
                        <span class="text-xs font-black uppercase tracking-wider text-white/90">Kehadiran Kelas Hari Ini</span>
                    </div>
                    <div class="flex items-baseline space-x-3">
                        <h3 class="text-4xl sm:text-5xl font-black font-mono tracking-tight text-white"><?= esc($metrics['present_count'] ?? 28) ?></h3>
                        <span class="text-sm font-bold text-white/80">/ 32 Siswa X RPL 1</span>
                    </div>
                    <p class="text-xs font-semibold text-white/90">Validasi otomatis via Dynamic QR & Kamera Web</p>
                </div>

                <div class="flex flex-col items-end justify-center shrink-0">
                    <div class="px-3.5 py-1.5 rounded-full bg-white/20 backdrop-blur-md text-xs font-black tracking-wide border border-white/30">
                        <?= esc($metrics['percentage'] ?? 93.3) ?>% Hadir
                    </div>
                    <span class="text-[10px] text-white/80 mt-1">Status Sangat Baik</span>
                </div>
            </div>

            <!-- Chunky Tile 4: Periwinkle Blue (Total Kelas / Rombel) -->
            <div class="col-span-2 p-5 rounded-[28px] bg-gradient-to-br from-royal-500 to-royal-600 text-white shadow-lg shadow-royal-500/20 flex items-center justify-between">
                <div class="flex items-center space-x-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-white/20 flex items-center justify-center text-white shrink-0">
                        <i data-lucide="layers" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-extrabold text-white">5 Rombel Kejuruan Terdaftar</h4>
                        <p class="text-xs text-white/80">RPL & TKJ SMK Budi Luhur</p>
                    </div>
                </div>
                <a href="<?= base_url('rekapitulasi') ?>" class="px-3.5 py-1.5 rounded-xl bg-white hover:bg-slate-50 text-royal-700 text-xs font-bold shadow-sm transition-all">
                    Lihat Rekap
                </a>
            </div>

        </div>

    </div>

    <!-- ========================================================================= -->
    <!-- ROW 2: REF 1 "ABSENSI KELAS" (CLASS GRID WITH BLUE COUNT BADGES)         -->
    <!-- ========================================================================= -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2.5">
                <div class="w-3 h-3 rounded-full bg-tangerine-500"></div>
                <h3 class="text-base sm:text-lg font-black text-slate-900 dark:text-white">Absensi Kelas Hari Ini</h3>
                <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-tangerine-50 dark:bg-tangerine-950/40 text-tangerine-600 dark:text-tangerine-400 border border-tangerine-200 dark:border-tangerine-800/60">
                    <?= count($metrics['schedules'] ?? []) ?> Sesi Aktif
                </span>
            </div>
            <a href="<?= base_url('scan-qr') ?>" class="text-xs font-bold text-royal-600 dark:text-royal-400 hover:text-royal-700 dark:hover:text-royal-300 flex items-center space-x-1">
                <span>Buka Scanner Kamera</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
            <?php foreach (($metrics['schedules'] ?? []) as $idx => $sc): ?>
                <div class="p-5 rounded-[28px] bg-white dark:bg-[#111C35] border border-slate-100 dark:border-slate-800 shadow-soft hover:shadow-card hover:-translate-y-1 transition-all group relative overflow-hidden flex flex-col justify-between">
                    <?php if ($sc['status'] === 'Berlangsung'): ?>
                        <div class="absolute top-0 right-0 w-24 h-24 overflow-hidden pointer-events-none">
                            <div class="bg-mint-500 text-white font-black text-[9px] uppercase tracking-wider py-1 px-7 text-center rotate-45 transform translate-x-6 translate-y-3 shadow-sm">
                                AKTIF
                            </div>
                        </div>
                    <?php endif; ?>

                    <div>
                        <!-- Header Card with Blue Student Count Pill like Ref 1 -->
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-lg font-black text-slate-900 dark:text-white group-hover:text-royal-600 dark:group-hover:text-royal-400 transition-colors">
                                <?= esc($sc['class']) ?>
                            </h4>
                            <span class="px-2.5 py-1 rounded-full bg-royal-500 text-white font-mono font-bold text-[11px] shadow-sm">
                                <?= esc($sc['total_students']) ?> Siswa
                            </span>
                        </div>

                        <!-- Mapel & Room Outline Badges like Ref 1 -->
                        <div class="space-y-2 mb-4">
                            <div class="p-2.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-700/60 text-xs text-slate-700 dark:text-slate-200 font-semibold flex items-center space-x-2">
                                <i data-lucide="book" class="w-3.5 h-3.5 text-royal-500 shrink-0"></i>
                                <span class="truncate"><?= esc($sc['subject']) ?></span>
                            </div>
                            <div class="flex items-center justify-between text-[11px] text-slate-500 dark:text-slate-400 px-1">
                                <span class="flex items-center space-x-1">
                                    <i data-lucide="map-pin" class="w-3 h-3 text-tangerine-500"></i>
                                    <span><?= esc($sc['room']) ?></span>
                                </span>
                                <span class="font-mono font-semibold"><?= esc($sc['time_start']) ?> - <?= esc($sc['time_end']) ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center space-x-2">
                        <a href="<?= base_url('scan-qr?kelas=' . urlencode($sc['class'])) ?>" class="flex-1 py-2 px-3 rounded-xl <?= $sc['status'] === 'Berlangsung' ? 'bg-tangerine-500 hover:bg-tangerine-600 text-white shadow-sm shadow-tangerine-500/20' : 'bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200' ?> text-xs font-bold text-center inline-flex items-center justify-center space-x-1.5 transition-colors">
                            <i data-lucide="qr-code" class="w-3.5 h-3.5"></i>
                            <span>Buka QR</span>
                        </a>
                        <a href="<?= base_url('jurnal-kbm?kelas=' . urlencode($sc['class'])) ?>" class="py-2 px-3 rounded-xl bg-royal-50 hover:bg-royal-100 dark:bg-royal-950/40 dark:hover:bg-royal-900/50 text-royal-700 dark:text-royal-300 text-xs font-bold border border-royal-100 dark:border-royal-800/60 inline-flex items-center space-x-1 transition-colors">
                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                            <span>Jurnal</span>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- ROW 3: REF 2 INVOICE-STYLE CLEAN ATTENDANCE STREAM                       -->
    <!-- ========================================================================= -->
    <div class="p-5 sm:p-6 rounded-[28px] bg-white dark:bg-[#111C35] border border-slate-100 dark:border-slate-800 shadow-soft space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="text-base font-black text-slate-900 dark:text-white">Aktivitas Presensi Real-Time</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Log kehadiran terverifikasi otomatis dengan trigger notifikasi WhatsApp.</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-mint-50 dark:bg-mint-950/40 text-mint-700 dark:text-mint-300 border border-mint-200 dark:border-mint-800/60">
                    <span class="w-1.5 h-1.5 rounded-full bg-mint-500 animate-ping mr-1.5"></span>
                    Gateway Sync Aktif
                </span>
                <a href="<?= base_url('scan-qr') ?>" class="px-3 py-1.5 rounded-xl bg-royal-50 hover:bg-royal-100 dark:bg-royal-950/40 dark:hover:bg-royal-900/50 text-royal-700 dark:text-royal-300 text-xs font-bold border border-royal-100 dark:border-royal-800/60 transition-colors">
                    Lihat Semua
                </a>
            </div>
        </div>

        <!-- Table View (Desktop) -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-slate-100 dark:border-slate-800 text-slate-400 dark:text-slate-400 font-bold uppercase tracking-wider">
                        <th class="py-3 px-3">Siswa</th>
                        <th class="py-3 px-3">Kelas</th>
                        <th class="py-3 px-3">Waktu</th>
                        <th class="py-3 px-3">Metode</th>
                        <th class="py-3 px-3">Status</th>
                        <th class="py-3 px-3 text-right">Notifikasi WA</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    <?php if (!empty($metrics['recent_attendances'])): ?>
                        <?php foreach ($metrics['recent_attendances'] as $att): ?>
                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition-colors group">
                                <td class="py-3 px-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-royal-500 to-tangerine-500 flex items-center justify-center font-bold text-white text-xs shrink-0 shadow-sm">
                                            <?= strtoupper(substr($att['name'], 0, 2)) ?>
                                        </div>
                                        <div>
                                            <h5 class="font-bold text-slate-900 dark:text-white group-hover:text-royal-600 dark:group-hover:text-royal-400 transition-colors"><?= esc($att['name']) ?></h5>
                                            <p class="text-[10px] text-slate-400 font-mono">NISN: <?= esc($att['nisn']) ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-3 font-semibold text-slate-700 dark:text-slate-300">
                                    <?= esc($att['class']) ?>
                                </td>
                                <td class="py-3 px-3 font-mono font-medium text-slate-600 dark:text-slate-400">
                                    <?= esc($att['time']) ?> WIB
                                </td>
                                <td class="py-3 px-3 text-slate-500 dark:text-slate-400">
                                    <?= esc($att['method']) ?>
                                </td>
                                <td class="py-3 px-3">
                                    <?php
                                    $st = $att['status'] ?? 'Hadir';
                                    $badgeClass = match ($st) {
                                        'Hadir' => 'bg-mint-50 dark:bg-mint-950/50 text-mint-700 dark:text-mint-300 border-mint-200 dark:border-mint-800/50',
                                        'Izin' => 'bg-sunshine-50 dark:bg-amber-950/50 text-sunshine-700 dark:text-amber-300 border-sunshine-200 dark:border-amber-800/50',
                                        'Sakit' => 'bg-royal-50 dark:bg-royal-950/50 text-royal-700 dark:text-royal-300 border-royal-200 dark:border-royal-800/50',
                                        default => 'bg-coral-50 dark:bg-rose-950/50 text-coral-700 dark:text-rose-300 border-coral-200 dark:border-rose-800/50',
                                    };
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold border <?= $badgeClass ?>">
                                        <?= esc($st) ?>
                                    </span>
                                </td>
                                <td class="py-3 px-3 text-right">
                                    <span class="inline-flex items-center space-x-1 text-[11px] font-bold text-mint-600 dark:text-mint-400">
                                        <i data-lucide="check-check" class="w-3.5 h-3.5"></i>
                                        <span>Terkirim</span>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400 text-xs">Belum ada riwayat absensi hari ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?= $this->endSection() ?>
