<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6 sm:space-y-8">

    <!-- PAGE HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/60">
        <div>
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-tangerine-500/10 text-tangerine-600 text-xs font-bold mb-2">
                <span class="w-2 h-2 rounded-full bg-tangerine-500 animate-pulse"></span>
                <span>ANALITIK & REKAPITULASI RESMI</span>
                <span>•</span>
                <span>SMK BUDI LUHUR</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Rekapitulasi Presensi & KBM</h1>
            <p class="text-sm text-slate-500 mt-0.5">Visualisasi kehadiran real-time, grafik analitik, dan ekspor dokumen cetak resmi PDF & Excel.</p>
        </div>

        <!-- EXPORT ACTION BUTTONS -->
        <div class="flex items-center space-x-3 shrink-0">
            <!-- Unduh Excel -->
            <button onclick="exportToExcel()" class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-2xl bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs sm:text-sm border border-slate-200 shadow-soft hover:shadow-md transition-all active:scale-95">
                <i data-lucide="file-spreadsheet" class="w-4 h-4 text-mint-600"></i>
                <span>Unduh Excel (.xlsx)</span>
            </button>

            <!-- Unduh PDF -->
            <button onclick="exportToPDF()" class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-2xl bg-gradient-to-r from-tangerine-500 to-amber-500 hover:from-tangerine-600 hover:to-amber-600 text-white font-bold text-xs sm:text-sm shadow-soft hover:shadow-lg hover:shadow-tangerine-500/25 transition-all active:scale-95">
                <i data-lucide="file-text" class="w-4 h-4"></i>
                <span>Unduh Laporan PDF</span>
            </button>
        </div>
    </div>

    <!-- FILTER INTERAKTIF CARD (Gaya Ref 2 "All Invoices" Pastel Filter Banner) -->
    <div class="relative overflow-hidden bg-gradient-to-br from-orange-50/70 via-rose-50/40 to-royal-50/50 rounded-[30px] p-6 sm:p-7 border border-orange-200/50 shadow-soft">
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="space-y-1">
                <div class="inline-flex items-center space-x-2 px-2.5 py-0.5 rounded-lg bg-white/80 text-tangerine-600 font-bold text-xs shadow-xs">
                    <i data-lucide="sliders-horizontal" class="w-3.5 h-3.5"></i>
                    <span>Filter & Penyesuaian Periode</span>
                </div>
                <h3 class="text-lg font-black text-slate-900">Filter Analitik KBM & Presensi</h3>
                <p class="text-xs text-slate-500">Sesuaikan data kelas, mata pelajaran, dan rentang tanggal untuk generate laporan.</p>
            </div>

            <!-- Form Filter Inline -->
            <form action="<?= base_url('rekapitulasi') ?>" method="get" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 w-full lg:w-auto items-center">
                <!-- Kelas -->
                <div class="bg-white rounded-2xl p-2.5 border border-slate-200/80 shadow-xs focus-within:border-royal-500">
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Kelas</span>
                    <select name="kelas" class="w-full bg-transparent text-xs font-bold text-slate-800 focus:outline-none">
                        <?php foreach ($classes as $cls): ?>
                            <option value="<?= esc($cls) ?>" <?= $selectedClass === $cls ? 'selected' : '' ?>><?= esc($cls) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Mapel -->
                <div class="bg-white rounded-2xl p-2.5 border border-slate-200/80 shadow-xs focus-within:border-royal-500">
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Mata Pelajaran</span>
                    <select name="mapel" class="w-full bg-transparent text-xs font-bold text-slate-800 focus:outline-none">
                        <option value="Semua Mata Pelajaran">Semua Mapel</option>
                        <?php foreach ($subjects as $sbj): ?>
                            <option value="<?= esc($sbj) ?>" <?= $selectedSubject === $sbj ? 'selected' : '' ?>><?= esc($sbj) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Rentang Tanggal -->
                <div class="bg-white rounded-2xl p-2.5 border border-slate-200/80 shadow-xs focus-within:border-royal-500">
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Rentang Tanggal</span>
                    <div class="flex items-center space-x-1">
                        <input type="date" name="tgl_mulai" value="<?= esc($dateStart) ?>" class="w-1/2 bg-transparent text-[11px] font-mono text-slate-800 focus:outline-none">
                        <span class="text-slate-400 text-xs">-</span>
                        <input type="date" name="tgl_selesai" value="<?= esc($dateEnd) ?>" class="w-1/2 bg-transparent text-[11px] font-mono text-slate-800 focus:outline-none">
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full h-full min-h-[48px] flex items-center justify-center space-x-2 py-2.5 px-5 rounded-2xl bg-royal-600 hover:bg-royal-700 text-white font-bold text-xs sm:text-sm shadow-soft hover:shadow-md transition-all active:scale-95">
                        <i data-lucide="filter" class="w-4 h-4"></i>
                        <span>Terapkan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- AGGREGATE SUMMARY PILLS (Gaya Ref 1 Chunky Colorful Clay Tiles) -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3.5 sm:gap-4">
        <!-- Hadir -->
        <div class="relative overflow-hidden p-5 rounded-[26px] bg-gradient-to-br from-mint-500 to-emerald-600 text-white shadow-soft transition-transform hover:-translate-y-1">
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-100">Total Hadir</span>
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-200"></i>
                </div>
                <div class="my-2">
                    <p class="text-3xl font-black"><?= esc($stats['total_present']) ?></p>
                </div>
                <span class="text-[11px] text-emerald-100 font-medium">Siswa Terverifikasi</span>
            </div>
            <div class="absolute -right-4 -bottom-4 w-16 h-16 rounded-full bg-white/10 blur-sm pointer-events-none"></div>
        </div>

        <!-- Sakit -->
        <div class="relative overflow-hidden p-5 rounded-[26px] bg-gradient-to-br from-sunshine-400 to-amber-500 text-slate-900 shadow-soft transition-transform hover:-translate-y-1">
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-amber-900/80">Total Sakit</span>
                    <i data-lucide="thermometer" class="w-5 h-5 text-amber-800"></i>
                </div>
                <div class="my-2">
                    <p class="text-3xl font-black text-amber-950"><?= esc($stats['total_sick']) ?></p>
                </div>
                <span class="text-[11px] text-amber-900/80 font-medium">Surat Dokter / Ortu</span>
            </div>
            <div class="absolute -right-4 -bottom-4 w-16 h-16 rounded-full bg-white/20 blur-sm pointer-events-none"></div>
        </div>

        <!-- Izin -->
        <div class="relative overflow-hidden p-5 rounded-[26px] bg-gradient-to-br from-royal-500 to-indigo-600 text-white shadow-soft transition-transform hover:-translate-y-1">
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-indigo-100">Total Izin</span>
                    <i data-lucide="clock" class="w-5 h-5 text-indigo-200"></i>
                </div>
                <div class="my-2">
                    <p class="text-3xl font-black"><?= esc($stats['total_permission']) ?></p>
                </div>
                <span class="text-[11px] text-indigo-100 font-medium">Izin Terkonfirmasi</span>
            </div>
            <div class="absolute -right-4 -bottom-4 w-16 h-16 rounded-full bg-white/10 blur-sm pointer-events-none"></div>
        </div>

        <!-- Alpa -->
        <div class="relative overflow-hidden p-5 rounded-[26px] bg-gradient-to-br from-coral-500 to-rose-600 text-white shadow-soft transition-transform hover:-translate-y-1">
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-rose-100">Total Alpa</span>
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-200"></i>
                </div>
                <div class="my-2">
                    <p class="text-3xl font-black"><?= esc($stats['total_absent']) ?></p>
                </div>
                <span class="text-[11px] text-rose-100 font-medium">Tanpa Keterangan</span>
            </div>
            <div class="absolute -right-4 -bottom-4 w-16 h-16 rounded-full bg-white/10 blur-sm pointer-events-none"></div>
        </div>

        <!-- Rata-rata Kehadiran -->
        <div class="relative overflow-hidden p-5 rounded-[26px] bg-gradient-to-br from-tangerine-500 to-amber-500 text-white shadow-soft col-span-2 sm:col-span-1 transition-transform hover:-translate-y-1">
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-orange-100">Rata-Rata</span>
                    <i data-lucide="award" class="w-5 h-5 text-orange-200"></i>
                </div>
                <div class="my-2">
                    <p class="text-3xl font-black"><?= esc($stats['overall_percentage']) ?>%</p>
                </div>
                <span class="text-[11px] text-orange-100 font-medium">Kehadiran Kelas</span>
            </div>
            <div class="absolute -right-4 -bottom-4 w-16 h-16 rounded-full bg-white/15 blur-sm pointer-events-none"></div>
        </div>
    </div>

    <!-- 2 CHART.JS ANALYTICS VISUALIZATIONS -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8">
        <!-- Chart 1: Bar Chart Trend -->
        <div class="lg:col-span-7 bg-white rounded-3xl p-6 border border-slate-200 shadow-soft space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Grafik Tren Kehadiran Harian Siswa</h3>
                    <p class="text-xs text-slate-500">Komparasi jumlah siswa hadir per hari di kelas <?= esc($selectedClass) ?>.</p>
                </div>
                <span class="text-xs font-bold px-2 py-0.5 rounded bg-royal-50 text-royal-700 font-mono">5 Hari Terakhir</span>
            </div>
            <div class="h-64 relative">
                <canvas id="chartAttendanceTrend"></canvas>
            </div>
        </div>

        <!-- Chart 2: Doughnut Composition Chart -->
        <div class="lg:col-span-5 bg-white rounded-3xl p-6 border border-slate-200 shadow-soft space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Distribusi Status Kehadiran</h3>
                    <p class="text-xs text-slate-500">Persentase Hadir, Sakit, Izin, dan Alpa.</p>
                </div>
            </div>
            <div class="h-64 relative flex items-center justify-center">
                <canvas id="chartAttendanceStatus"></canvas>
            </div>
        </div>
    </div>

    <!-- TABEL REKAPITULASI DETAIL -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-soft overflow-hidden" id="reportTableCard">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h3 class="text-base font-bold text-slate-900">Tabel Rangkuman Presensi & Jurnal Mengajar</h3>
                <p class="text-xs text-slate-500">Data lengkap siap disahkan dan dilaporkan ke Kepala Sekolah & Dinas.</p>
            </div>
            <span class="text-xs text-slate-500">Format: Dokumen Resmi Terverifikasi Digital</span>
        </div>

        <!-- 1. TAMPILAN MOBILE: KARTU REKAPITULASI (TANPA PERLU GESER SAMPING!) -->
        <div class="md:hidden divide-y divide-slate-100" id="recapMobileCards">
            <?php foreach ($dailyRecap as $row): ?>
                <div class="p-4 space-y-3 hover:bg-slate-50/60 transition-colors">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <span class="text-[10px] font-bold uppercase text-slate-400 font-mono"><?= esc($row['date']) ?></span>
                            <h4 class="text-xs font-extrabold text-slate-900"><?= esc($row['day']) ?> • <span class="text-royal-700"><?= esc($row['class']) ?></span></h4>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-posterGreen-500/15 text-posterGreen-700">
                            <?= esc($row['percentage']) ?>% Hadir
                        </span>
                    </div>

                    <!-- Breakdown Quick Badges -->
                    <div class="flex items-center space-x-2 text-[11px] font-bold">
                        <span class="px-2 py-0.5 rounded-md bg-posterGreen-500/15 text-posterGreen-700">H: <?= esc($row['present']) ?></span>
                        <span class="px-2 py-0.5 rounded-md bg-amber-500/15 text-amber-700">S: <?= esc($row['sick']) ?></span>
                        <span class="px-2 py-0.5 rounded-md bg-royal-100 text-royal-700">I: <?= esc($row['permission']) ?></span>
                        <span class="px-2 py-0.5 rounded-md bg-rose-500/15 text-rose-700">A: <?= esc($row['absent']) ?></span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="text-[10px] font-bold uppercase text-slate-400">Materi KBM Guru:</span>
                        <p class="text-[11px] text-slate-700 font-medium line-clamp-2 mt-0.5 leading-snug">
                            <?= esc($row['topic']) ?>
                        </p>
                    </div>

                    <button onclick="openRecapDetailModal('<?= esc(addslashes($row['date'])) ?>', '<?= esc(addslashes($row['day'])) ?>', '<?= esc(addslashes($row['class'])) ?>', <?= esc($row['present']) ?>, <?= esc($row['sick']) ?>, <?= esc($row['permission']) ?>, <?= esc($row['absent']) ?>, '<?= esc($row['percentage']) ?>', '<?= esc(addslashes($row['topic'])) ?>')" class="w-full py-2 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs flex items-center justify-center space-x-1 transition-colors">
                        <i data-lucide="eye" class="w-3.5 h-3.5 text-royal-700"></i>
                        <span>Lihat Selengkapnya</span>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- 2. TAMPILAN DESKTOP: TABEL RANGKUMAN LEGA -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs" id="recapMainTable">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-6">Tanggal</th>
                        <th class="py-3.5 px-6">Hari</th>
                        <th class="py-3.5 px-6">Kelas</th>
                        <th class="py-3.5 px-6 text-center">Hadir</th>
                        <th class="py-3.5 px-6 text-center">Sakit</th>
                        <th class="py-3.5 px-6 text-center">Izin</th>
                        <th class="py-3.5 px-6 text-center">Alpa</th>
                        <th class="py-3.5 px-6 text-center">% Kehadiran</th>
                        <th class="py-3.5 px-6">Topik Jurnal KBM Guru</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    <?php foreach ($dailyRecap as $row): ?>
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3.5 px-6 font-mono text-slate-800 whitespace-nowrap"><?= esc($row['date']) ?></td>
                            <td class="py-3.5 px-6 font-bold text-slate-700"><?= esc($row['day']) ?></td>
                            <td class="py-3.5 px-6 font-bold text-royal-700"><?= esc($row['class']) ?></td>
                            <td class="py-3.5 px-6 text-center font-bold text-posterGreen-600"><?= esc($row['present']) ?></td>
                            <td class="py-3.5 px-6 text-center text-amber-600 font-semibold"><?= esc($row['sick']) ?></td>
                            <td class="py-3.5 px-6 text-center text-royal-600 font-semibold"><?= esc($row['permission']) ?></td>
                            <td class="py-3.5 px-6 text-center text-rose-600 font-semibold"><?= esc($row['absent']) ?></td>
                            <td class="py-3.5 px-6 text-center">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-posterGreen-500/15 text-posterGreen-700">
                                    <?= esc($row['percentage']) ?>%
                                </span>
                            </td>
                            <td class="py-3.5 px-6 max-w-xs truncate text-slate-700 font-medium">
                                <?= esc($row['topic']) ?>
                            </td>
                            <td class="py-3.5 px-6 text-center whitespace-nowrap">
                                <button onclick="openRecapDetailModal('<?= esc(addslashes($row['date'])) ?>', '<?= esc(addslashes($row['day'])) ?>', '<?= esc(addslashes($row['class'])) ?>', <?= esc($row['present']) ?>, <?= esc($row['sick']) ?>, <?= esc($row['permission']) ?>, <?= esc($row['absent']) ?>, '<?= esc($row['percentage']) ?>', '<?= esc(addslashes($row['topic'])) ?>')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-[11px] inline-flex items-center space-x-1 transition-colors">
                                    <i data-lucide="eye" class="w-3 h-3 text-royal-700"></i>
                                    <span>Detail</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- ========================================================================= -->
<!-- PRINTABLE TEMPLATE (FOR FORMAL PDF EXPORT WITH OFFICIAL KOP & SIGNATURE) -->
<!-- ========================================================================= -->
<div id="printableReportTemplate" style="display: none; background: white; padding: 35px; color: #1e293b; font-family: 'Plus Jakarta Sans', Arial, sans-serif;">
    <!-- KOP SURAT SEKOLAH RESMI -->
    <div style="border-bottom: 3px double #000; padding-bottom: 12px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between;">
        <div style="width: 75px; text-align: center;">
            <div style="width: 65px; height: 65px; background: #2B3082; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 22px;">
                BL
            </div>
        </div>
        <div style="text-align: center; flex: 1; padding: 0 15px;">
            <h4 style="margin: 0; font-size: 13px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; color: #475569;">YAYASAN BUDI LUHUR CAKRAWALA</h4>
            <h3 style="margin: 2px 0; font-size: 15px; font-weight: bold; text-transform: uppercase; color: #334155;">SMK BUDI LUHUR</h3>
            <h2 style="margin: 4px 0; font-size: 18px; font-weight: 900; text-transform: uppercase; color: #2B3082;">BIDANG KEAHLIAN TEKNOLOGI INFORMASI</h2>
            <p style="margin: 0; font-size: 10px; color: #64748b;">
                Jl. Raden Saleh No. 45, Karang Tengah, Kota Tangerang • Telp: (021) 585-3753 • Website: www.smkbudiluhur.sch.id
            </p>
        </div>
        <div style="width: 75px; text-align: center;">
            <div style="width: 65px; height: 65px; border: 2px solid #38C682; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; color: #38C682; font-weight: bold; font-size: 11px; text-align: center; line-height: 1.2;">
                BUDI<br>LUHUR
            </div>
        </div>
    </div>

    <!-- REPORT TITLE -->
    <div style="text-align: center; margin-bottom: 22px;">
        <h3 style="margin: 0; font-size: 15px; font-weight: 800; text-decoration: underline; text-transform: uppercase; color: #0f172a;">
            LAPORAN REKAPITULASI PRESENSI & JURNAL KBM
        </h3>
        <p style="margin: 4px 0 0; font-size: 11px; color: #64748b;">
            Nomor: 421.5 / 108 / SMK-BL / <?= date('m/Y') ?>
        </p>
    </div>

    <!-- METADATA TABLE -->
    <table style="width: 100%; font-size: 11px; margin-bottom: 16px; border-collapse: collapse;">
        <tr>
            <td style="width: 18%; font-weight: bold; padding: 3px 0;">Kelas / Rombel</td>
            <td style="width: 32%; padding: 3px 0;">: <strong><?= esc($selectedClass) ?></strong></td>
            <td style="width: 18%; font-weight: bold; padding: 3px 0;">Guru Pengampu</td>
            <td style="width: 32%; padding: 3px 0;">: <?= esc($user['name'] ?? 'Naila Salma Az-Zahra, S.Kom') ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold; padding: 3px 0;">Mata Pelajaran</td>
            <td style="padding: 3px 0;">: <?= esc($selectedSubject) ?></td>
            <td style="font-weight: bold; padding: 3px 0;">NIP Guru</td>
            <td style="padding: 3px 0;">: <?= esc($user['nip'] ?? '19920815 201802 2 003') ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold; padding: 3px 0;">Periode Laporan</td>
            <td style="padding: 3px 0;">: <?= esc($dateStart) ?> s.d <?= esc($dateEnd) ?></td>
            <td style="font-weight: bold; padding: 3px 0;">Metode Presensi</td>
            <td style="padding: 3px 0;">: Dynamic QR Code Anti-Titip Absen</td>
        </tr>
    </table>

    <!-- MAIN DATA TABLE FOR PDF -->
    <table style="width: 100%; border-collapse: collapse; font-size: 10px; margin-bottom: 25px;" border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr style="background: #f1f5f9; text-align: center; font-weight: bold;">
                <th style="padding: 6px; width: 5%;">No</th>
                <th style="padding: 6px; width: 14%;">Tanggal</th>
                <th style="padding: 6px; width: 8%;">Hadir</th>
                <th style="padding: 6px; width: 8%;">Sakit</th>
                <th style="padding: 6px; width: 8%;">Izin</th>
                <th style="padding: 6px; width: 8%;">Alpa</th>
                <th style="padding: 6px; width: 11%;">% Kehadiran</th>
                <th style="padding: 6px; width: 38%;">Materi Pokok / Jurnal KBM</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dailyRecap as $idx => $row): ?>
                <tr>
                    <td style="text-align: center; padding: 5px;"><?= $idx + 1 ?></td>
                    <td style="text-align: center; padding: 5px;"><?= esc($row['date']) ?></td>
                    <td style="text-align: center; padding: 5px; font-weight: bold; color: #059669;"><?= esc($row['present']) ?></td>
                    <td style="text-align: center; padding: 5px;"><?= esc($row['sick']) ?></td>
                    <td style="text-align: center; padding: 5px;"><?= esc($row['permission']) ?></td>
                    <td style="text-align: center; padding: 5px; color: #e11d48;"><?= esc($row['absent']) ?></td>
                    <td style="text-align: center; padding: 5px; font-weight: bold;"><?= esc($row['percentage']) ?>%</td>
                    <td style="padding: 5px;"><?= esc($row['topic']) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr style="background: #f8fafc; font-weight: bold;">
                <td colspan="2" style="text-align: center; padding: 6px;">TOTAL AGREGAT</td>
                <td style="text-align: center; padding: 6px; color: #059669;"><?= esc($stats['total_present']) ?></td>
                <td style="text-align: center; padding: 6px;"><?= esc($stats['total_sick']) ?></td>
                <td style="text-align: center; padding: 6px;"><?= esc($stats['total_permission']) ?></td>
                <td style="text-align: center; padding: 6px; color: #e11d48;"><?= esc($stats['total_absent']) ?></td>
                <td style="text-align: center; padding: 6px;"><?= esc($stats['overall_percentage']) ?>%</td>
                <td style="padding: 6px;">Terdokumentasi Otomatis via EduScan QR</td>
            </tr>
        </tbody>
    </table>

    <!-- SIGNATURE COLUMNS (TANDA TANGAN RESMI) -->
    <div style="margin-top: 30px; display: flex; justify-content: space-between; font-size: 11px;">
        <div style="width: 45%; text-align: center;">
            <p style="margin: 0;">Mengetahui,</p>
            <p style="margin: 0; font-weight: bold;">Kepala SMK Budi Luhur</p>
            <div style="height: 70px;"></div>
            <p style="margin: 0; font-weight: bold; text-decoration: underline;">Drs. H. Bambang Sudarsono, M.Pd</p>
            <p style="margin: 2px 0 0; color: #64748b;">NIP. 19680512 199303 1 004</p>
        </div>
        <div style="width: 45%; text-align: center;">
            <p style="margin: 0;">Tangerang, <?= date('d F Y') ?></p>
            <p style="margin: 0; font-weight: bold;">Guru Pengampu Mata Pelajaran</p>
            <div style="height: 70px;"></div>
            <p style="margin: 0; font-weight: bold; text-decoration: underline;"><?= esc($user['name'] ?? 'Naila Salma Az-Zahra, S.Kom') ?></p>
            <p style="margin: 2px 0 0; color: #64748b;">NIP. <?= esc($user['nip'] ?? '19920815 201802 2 003') ?></p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Initialize Chart.js
    document.addEventListener('DOMContentLoaded', function() {
        // Trend Bar Chart
        const ctxTrend = document.getElementById('chartAttendanceTrend').getContext('2d');
        new Chart(ctxTrend, {
            type: 'bar',
            data: {
                labels: ['4 Hari Lalu', '3 Hari Lalu', '2 Hari Lalu', 'Kemarin', 'Hari Ini'],
                datasets: [
                    {
                        label: 'Siswa Hadir',
                        data: [28, 32, 30, 31, 29],
                        backgroundColor: '#FF7A00', // Tangerine Ref 1
                        borderRadius: 12,
                    },
                    {
                        label: 'Sakit / Izin / Alpa',
                        data: [4, 0, 2, 1, 3],
                        backgroundColor: '#CBD5E1',
                        borderRadius: 12,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { font: { family: 'Plus Jakarta Sans', weight: 'bold' } }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 35,
                        grid: { color: '#F1F5F9' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        // Doughnut Status Distribution Chart
        const ctxStatus = document.getElementById('chartAttendanceStatus').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Hadir', 'Sakit', 'Izin', 'Alpa'],
                datasets: [{
                    data: [
                        <?= esc($stats['total_present']) ?>,
                        <?= esc($stats['total_sick']) ?>,
                        <?= esc($stats['total_permission']) ?>,
                        <?= esc($stats['total_absent']) ?>
                    ],
                    backgroundColor: [
                        '#10B981', // Mint (Ref 1)
                        '#FFB703', // Sunshine Yellow (Ref 1)
                        '#4F46E5', // Royal Blue (Ref 1 & 2)
                        '#FF5252'  // Coral Red (Ref 1)
                    ],
                    borderWidth: 3,
                    borderColor: '#FFFFFF'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { family: 'Plus Jakarta Sans', weight: 'bold' }, padding: 15 }
                    }
                },
                cutout: '65%'
            }
        });
    });

    // EXPORT TO PDF VIA html2pdf.js
    function exportToPDF() {
        const element = document.getElementById('printableReportTemplate');
        element.style.display = 'block';

        const opt = {
            margin: [10, 10, 10, 10],
            filename: `Laporan_Rekap_Presensi_Jurnal_<?= esc(str_replace(' ', '_', $selectedClass)) ?>_<?= date('Ymd') ?>.pdf`,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        Swal.fire({
            title: 'Mempersiapkan Berkas PDF...',
            text: 'Merender kop sekolah resmi dan tabel rekapitulasi...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        html2pdf().set(opt).from(element).save().then(() => {
            element.style.display = 'none';
            Swal.fire({
                icon: 'success',
                title: 'PDF Berhasil Diunduh!',
                text: 'Berkas PDF resmi lengkap dengan kop dan tanda tangan siap dicetak atau dilaporkan.',
                timer: 3000,
                confirmButtonColor: '#38C682',
                customClass: { popup: 'rounded-2xl' }
            });
        }).catch(err => {
            element.style.display = 'none';
            console.error('PDF error:', err);
        });
    }

    // EXPORT TO EXCEL VIA SheetJS (xlsx)
    function exportToExcel() {
        const dataRows = [
            ["REKAPITULASI PRESENSI & JURNAL KBM - SMK BUDI LUHUR"],
            ["Kelas:", "<?= esc($selectedClass) ?>", "Periode:", "<?= esc($dateStart) ?> s.d <?= esc($dateEnd) ?>"],
            ["Guru Pengampu:", "<?= esc($user['name'] ?? 'Naila Salma Az-Zahra, S.Kom') ?>", "NIP:", "<?= esc($user['nip'] ?? '19920815 201802 2 003') ?>"],
            [],
            ["No", "Tanggal", "Hari", "Kelas", "Hadir", "Sakit", "Izin", "Alpa", "% Kehadiran", "Materi Pokok / Jurnal KBM"]
        ];

        <?php foreach ($dailyRecap as $idx => $r): ?>
            dataRows.push([
                <?= $idx + 1 ?>,
                "<?= esc($r['date']) ?>",
                "<?= esc($r['day']) ?>",
                "<?= esc($r['class']) ?>",
                <?= esc($r['present']) ?>,
                <?= esc($r['sick']) ?>,
                <?= esc($r['permission']) ?>,
                <?= esc($r['absent']) ?>,
                "<?= esc($r['percentage']) ?>%",
                "<?= esc($r['topic']) ?>"
            ]);
        <?php endforeach; ?>

        dataRows.push([]);
        dataRows.push(["TOTAL AGREGAT", "", "", "", <?= esc($stats['total_present']) ?>, <?= esc($stats['total_sick']) ?>, <?= esc($stats['total_permission']) ?>, <?= esc($stats['total_absent']) ?>, "<?= esc($stats['overall_percentage']) ?>%", "Dokumen Terverifikasi Digital"]);

        const ws = XLSX.utils.aoa_to_sheet(dataRows);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Rekap Presensi");

        const fileName = `Rekap_Presensi_Jurnal_<?= esc(str_replace(' ', '_', $selectedClass)) ?>_<?= date('Ymd') ?>.xlsx`;
        XLSX.writeFile(wb, fileName);

        Swal.fire({
            icon: 'success',
            title: 'Excel Berhasil Diunduh!',
            text: `File spreadsheet ${fileName} siap digunakan untuk pelaporan data rekapitulasi.`,
            timer: 3000,
            confirmButtonColor: '#38C682',
            customClass: { popup: 'rounded-2xl' }
        });
    }

    // Modal Detail Selengkapnya Rekapitulasi (Tanpa Perlu Geser Layar!)
    function openRecapDetailModal(date, day, className, present, sick, permission, absent, percentage, topic) {
        showDetailModal(
            `Detail Sesi KBM & Presensi: ${day}`,
            `
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3.5 rounded-2xl bg-royal-50 border border-royal-200">
                    <div>
                        <span class="text-[10px] font-bold uppercase text-royal-700 font-mono">${date}</span>
                        <h4 class="text-sm font-bold text-slate-900">${day} • Kelas: <strong class="text-royal-700">${className}</strong></h4>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-black bg-posterGreen-500 text-white shadow-sm">
                        ${percentage}% Hadir
                    </span>
                </div>

                <div class="grid grid-cols-4 gap-2 text-center text-xs">
                    <div class="p-2.5 rounded-xl bg-posterGreen-50 border border-posterGreen-200">
                        <span class="text-[10px] font-bold uppercase text-posterGreen-700">Hadir</span>
                        <p class="font-extrabold text-slate-900 text-base mt-0.5">${present}</p>
                    </div>
                    <div class="p-2.5 rounded-xl bg-amber-50 border border-amber-200">
                        <span class="text-[10px] font-bold uppercase text-amber-700">Sakit</span>
                        <p class="font-extrabold text-slate-900 text-base mt-0.5">${sick}</p>
                    </div>
                    <div class="p-2.5 rounded-xl bg-royal-50 border border-royal-200">
                        <span class="text-[10px] font-bold uppercase text-royal-700">Izin</span>
                        <p class="font-extrabold text-slate-900 text-base mt-0.5">${permission}</p>
                    </div>
                    <div class="p-2.5 rounded-xl bg-rose-50 border border-rose-200">
                        <span class="text-[10px] font-bold uppercase text-rose-700">Alpa</span>
                        <p class="font-extrabold text-slate-900 text-base mt-0.5">${absent}</p>
                    </div>
                </div>

                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                    <span class="text-[10px] font-bold uppercase text-slate-400">Materi Pokok / Jurnal KBM Guru:</span>
                    <p class="text-xs text-slate-800 font-medium leading-relaxed">
                        ${topic}
                    </p>
                </div>

                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between text-[11px] text-slate-500">
                    <span>Verifikasi: <strong class="text-posterGreen-600">Digital Smart School</strong></span>
                    <span>Format: Terarsip Otomatis</span>
                </div>
            </div>
            `
        );
    }
</script>
<?= $this->endSection() ?>
