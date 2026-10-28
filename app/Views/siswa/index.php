<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6 sm:space-y-8 max-w-6xl mx-auto">

    <!-- STUDENT HERO BANNER -->
    <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-royal-600 via-indigo-600 to-royal-700 p-6 sm:p-8 text-white shadow-soft">
        <div class="absolute -right-12 -bottom-12 w-64 h-64 rounded-full bg-tangerine-500/20 blur-3xl pointer-events-none"></div>
        <div class="absolute right-40 -top-12 w-48 h-48 rounded-full bg-mint-500/20 blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center space-x-4">
                <img src="<?= esc($student['avatar']) ?>" class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl object-cover ring-4 ring-white/30 shadow-md">
                <div class="space-y-1">
                    <div class="inline-flex items-center space-x-2 px-3 py-0.5 rounded-full bg-white/15 backdrop-blur-md text-[11px] font-bold text-mint-200">
                        <span class="w-2 h-2 rounded-full bg-mint-400 animate-pulse"></span>
                        <span>PORTAL RESMI SISWA</span>
                        <span>•</span>
                        <span>SMK BUDI LUHUR</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-black tracking-tight text-white"><?= esc($student['name']) ?></h1>
                    <p class="text-xs sm:text-sm text-indigo-100">
                        NISN: <strong class="text-white font-mono"><?= esc($student['nisn']) ?></strong> • Kelas: <strong class="text-sunshine-300"><?= esc($student['class']) ?></strong>
                    </p>
                </div>
            </div>

            <!-- Switch Back to Guru Mode Button -->
            <div class="flex flex-wrap items-center gap-2 shrink-0">
                <a href="<?= base_url('switch-role/guru') ?>" class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-2xl bg-white text-royal-600 font-extrabold text-xs shadow-soft hover:bg-slate-50 transition-all active:scale-95">
                    <i data-lucide="user-cog" class="w-4 h-4"></i>
                    <span>Kembali ke Mode Guru / Admin</span>
                </a>
            </div>
        </div>
    </div>

    <!-- STATUS KEHADIRAN HARI INI CARD -->
    <div class="p-6 rounded-[28px] bg-white border border-slate-200/80 shadow-soft">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center space-x-4">
                <div class="w-13 h-13 rounded-2xl <?= $todayRecord ? 'bg-mint-500/10 text-mint-600' : 'bg-amber-500/10 text-amber-600' ?> flex items-center justify-center shrink-0 p-3">
                    <i data-lucide="<?= $todayRecord ? 'check-circle' : 'alert-circle' ?>" class="w-7 h-7"></i>
                </div>
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Status Kehadiran Hari Ini (<?= date('d M Y') ?>)</span>
                    <h3 class="text-lg font-black text-slate-900 mt-0.5" id="todayStatusText">
                        <?= $todayRecord ? 'TERCATAT HADIR (' . esc($todayRecord['time']) . ' WIB)' : 'Belum Melakukan Presensi Sesi Kelas' ?>
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">
                        <?= $todayRecord ? 'Verifikasi via ' . esc($todayRecord['method']) . ' • WhatsApp otomatis terkirim ke Orang Tua.' : 'Silakan scan Dynamic QR di proyektor kelas atau tunjukkan kartu ini ke Guru.' ?>
                    </p>
                </div>
            </div>

            <!-- Direct Action for Student -->
            <button onclick="studentSimulateScan()" class="px-5 py-3 rounded-2xl bg-gradient-to-r from-tangerine-500 to-amber-500 hover:from-tangerine-600 hover:to-amber-600 text-white font-extrabold text-xs shadow-soft hover:shadow-lg hover:shadow-tangerine-500/25 transition-all active:scale-95 flex items-center space-x-2 shrink-0">
                <i data-lucide="scan" class="w-4 h-4"></i>
                <span>Scan Dynamic QR Kelas Sekarang</span>
            </button>
        </div>
    </div>

    <!-- GRID: KARTU PELAJAR DIGITAL & SCANNER DARI HP SISWA -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">

        <!-- KARTU PELAJAR DIGITAL SISWA DENGAN QR CODE (BISA DI-SCAN GURU) -->
        <div class="lg:col-span-6 space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i data-lucide="credit-card" class="w-4 h-4 text-royal-700"></i>
                    <h3 class="text-base font-bold text-slate-900">Kartu Pelajar Digital (QR Siswa)</h3>
                </div>
                <span class="text-[11px] font-bold text-posterGreen-600 bg-posterGreen-500/10 px-2 py-0.5 rounded-full">Resmi Sekolah</span>
            </div>

            <!-- Virtual ID Card Mockup -->
            <div class="relative rounded-3xl bg-gradient-to-br from-royal-700 via-royal-700 to-royal-800 text-white p-6 shadow-xl border border-white/10 overflow-hidden space-y-5">
                <!-- Header Card -->
                <div class="flex items-center justify-between border-b border-white/15 pb-4">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-9 h-9 rounded-xl bg-posterGreen-500 flex items-center justify-center font-black text-slate-950 text-sm">
                            BL
                        </div>
                        <div>
                            <h4 class="text-xs font-black uppercase tracking-wider text-white">SMK BUDI LUHUR</h4>
                            <p class="text-[10px] text-posterGreen-300">KARTU TANDA PELAJAR DIGITAL</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-mono text-sand-300 font-bold">2026/2027</span>
                </div>

                <!-- Body Card: Photo & QR -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center space-x-3.5">
                        <img src="<?= esc($student['avatar']) ?>" class="w-20 h-24 rounded-2xl object-cover ring-2 ring-posterGreen-400 shadow-md">
                        <div class="space-y-1">
                            <h3 class="text-base font-bold text-white"><?= esc($student['name']) ?></h3>
                            <p class="text-xs text-posterGreen-300 font-mono">NISN: <?= esc($student['nisn']) ?></p>
                            <p class="text-xs text-slate-300">Kelas: <strong class="text-white"><?= esc($student['class']) ?></strong></p>
                            <p class="text-[10px] text-slate-400">Wali: <?= esc($student['parent_name']) ?></p>
                        </div>
                    </div>

                    <!-- Student Personal QR Code -->
                    <div class="p-2.5 bg-white rounded-2xl shadow-lg shrink-0 flex flex-col items-center">
                        <div id="studentPersonalQr"></div>
                        <span class="text-[9px] font-bold text-slate-800 font-mono mt-1">SCAN UNTUK ABSEN</span>
                    </div>
                </div>

                <!-- Footer Card -->
                <div class="pt-3 border-t border-white/15 flex items-center justify-between text-[10px] text-slate-300">
                    <span>Validasi: <strong class="text-posterGreen-400 font-mono">ENCRYPTED ID</strong></span>
                    <span>Tahun Ajaran 2026/2027</span>
                </div>
            </div>

            <p class="text-xs text-slate-500 bg-slate-50 p-3 rounded-2xl border border-slate-200">
                💡 <strong>Info Siswa:</strong> Anda dapat menunjukkan QR Code kartu ini langsung ke kamera laptop/HP Guru saat guru membuka mode <em>Scanner Kamera</em>.
            </p>
        </div>

        <!-- KAMERA SCANNER HP SISWA (SCAN PROYEKTOR KELAS) -->
        <div class="lg:col-span-6 space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i data-lucide="camera" class="w-4 h-4 text-royal-700"></i>
                    <h3 class="text-base font-bold text-slate-900">Kamera Scanner HP Siswa</h3>
                </div>
                <span class="text-[11px] font-bold text-royal-700 bg-royal-100 px-2 py-0.5 rounded-full">Scan Proyektor</span>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-soft space-y-4">
                <div class="text-center p-6 rounded-2xl bg-slate-50 border-2 border-dashed border-slate-200 space-y-3">
                    <div class="w-14 h-14 rounded-2xl bg-royal-100 text-royal-700 flex items-center justify-center mx-auto">
                        <i data-lucide="qr-code" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Pindai Dynamic QR di Layar Kelas</h4>
                        <p class="text-xs text-slate-500 max-w-xs mx-auto mt-1">
                            Arahkan kamera ke layar proyektor. Token QR berganti otomatis tiap 15 detik untuk memastikan Anda hadir di kelas.
                        </p>
                    </div>

                    <!-- 1-Click Simulation Button for Student Phone Scan -->
                    <button onclick="studentSimulateScan()" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-posterGreen-500 to-posterGreen-600 hover:from-posterGreen-600 hover:to-posterGreen-700 text-white font-extrabold text-xs shadow-md shadow-posterGreen-500/25 transition-all active:scale-98 flex items-center justify-center space-x-2">
                        <i data-lucide="zap" class="w-4 h-4"></i>
                        <span>SIMULASI SCAN BERHASIL DARI HP SISWA</span>
                    </button>
                </div>

                <div class="p-3.5 rounded-2xl bg-royal-50 border border-royal-200 text-xs text-royal-800 space-y-1">
                    <p class="font-bold flex items-center space-x-1.5">
                        <i data-lucide="bell-ring" class="w-3.5 h-3.5 text-posterGreen-600"></i>
                        <span>Notifikasi Otomatis Orang Tua Aktif</span>
                    </p>
                    <p class="text-slate-600 text-[11px]">
                        Begitu presensi tervalidasi, pesan WhatsApp resmi sekolah otomatis terkirim ke Bapak/Ibu: <strong><?= esc($student['parent_name']) ?></strong> (<?= esc($student['parent_phone']) ?>).
                    </p>
                </div>
            </div>
        </div>

    </div>

    <!-- MATERI JURNAL KBM HARI INI & RIWAYAT KEHADIRAN SISWA -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">

        <!-- RIWAYAT PRESENSI SAYA (NO HORIZONTAL SCROLL) -->
        <div class="lg:col-span-6 space-y-4">
            <h3 class="text-base font-bold text-slate-900 flex items-center space-x-2">
                <i data-lucide="history" class="w-4 h-4 text-royal-700"></i>
                <span>Riwayat Kehadiran Siswa</span>
            </h3>

            <div class="bg-white rounded-3xl p-5 border border-slate-200 shadow-soft space-y-3">
                <div class="divide-y divide-slate-100" id="studentHistoryList">
                    <?php if (!empty($history)): ?>
                        <?php foreach ($history as $h): ?>
                            <div class="py-3 first:pt-0 last:pb-0 flex items-center justify-between text-xs">
                                <div class="space-y-0.5">
                                    <div class="font-bold text-slate-800"><?= esc($h['date']) ?> • <span class="font-mono text-royal-700"><?= esc($h['time']) ?> WIB</span></div>
                                    <p class="text-[11px] text-slate-400"><?= esc($h['method']) ?></p>
                                </div>
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-posterGreen-500/15 text-posterGreen-700">
                                    <?= esc($h['status']) ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="py-6 text-center text-slate-400 text-xs">Belum ada riwayat presensi tersimpan.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- MATERI KBM KELAS DARI GURU HARI INI -->
        <div class="lg:col-span-6 space-y-4">
            <h3 class="text-base font-bold text-slate-900 flex items-center space-x-2">
                <i data-lucide="book-open" class="w-4 h-4 text-posterGreen-600"></i>
                <span>Materi KBM Kelas Terkini (Jurnal Guru)</span>
            </h3>

            <div class="bg-white rounded-3xl p-5 border border-slate-200 shadow-soft space-y-3">
                <div class="divide-y divide-slate-100">
                    <?php if (!empty($journals)): ?>
                        <?php foreach (array_slice($journals, 0, 3) as $j): ?>
                            <div class="py-3.5 first:pt-0 last:pb-0 space-y-1.5 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-royal-700"><?= esc($j['subject']) ?></span>
                                    <span class="text-[10px] font-mono text-slate-400"><?= esc($j['date']) ?></span>
                                </div>
                                <h4 class="text-sm font-bold text-slate-900 leading-snug"><?= esc($j['topic']) ?></h4>
                                <p class="text-[11px] text-slate-500 italic">"<?= esc($j['notes']) ?>"</p>
                                <div class="flex flex-wrap gap-1 pt-1">
                                    <?php foreach ($j['methods'] as $met): ?>
                                        <span class="px-2 py-0.5 rounded bg-posterGreen-500/10 text-posterGreen-700 text-[10px] font-bold"><?= esc($met) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="py-6 text-center text-slate-400 text-xs">Belum ada jurnal mengajar untuk kelas ini.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Render Personal QR for Student ID Card
    document.addEventListener('DOMContentLoaded', function() {
        const qrContainer = document.getElementById('studentPersonalQr');
        if (qrContainer) {
            new QRCode(qrContainer, {
                text: "EDUSCAN::<?= esc($student['class']) ?>::<?= esc($student['nisn']) ?>",
                width: 90,
                height: 90,
                colorDark: "#2B3082",
                colorLight: "#FFFFFF",
                correctLevel: QRCode.CorrectLevel.M
            });
        }
    });

    // Student Simulate Scanning Teacher Classroom Dynamic QR
    async function studentSimulateScan() {
        try {
            const formData = new FormData();
            formData.append('token', 'TOKEN-DYNAMIC-CLASSROOM');

            const response = await fetch('<?= base_url('siswa/scan-class') ?>', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const data = await response.json();

            if (data.success) {
                playBeepSound('success');

                // Update today status badge in DOM
                document.getElementById('todayStatusText').textContent = `TERCATAT HADIR (${data.attendance.time} WIB)`;

                // Add to history list
                const historyList = document.getElementById('studentHistoryList');
                if (historyList) {
                    const newItem = document.createElement('div');
                    newItem.className = "py-3 flex items-center justify-between text-xs bg-posterGreen-50/60 p-2.5 rounded-xl border border-posterGreen-200";
                    newItem.innerHTML = `
                        <div class="space-y-0.5">
                            <div class="font-bold text-slate-800">Hari Ini • <span class="font-mono text-posterGreen-700">${data.attendance.time} WIB</span></div>
                            <p class="text-[11px] text-posterGreen-600 font-semibold">Scan via Ponsel Siswa • Notif Ortu Terkirim</p>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-posterGreen-500 text-white shadow-sm">
                            HADIR
                        </span>
                    `;
                    historyList.prepend(newItem);
                }

                Swal.fire({
                    title: '<span class="text-xl font-extrabold text-slate-900">Presensi Berhasil Tervalidasi!</span>',
                    html: `
                        <div class="text-center space-y-3 py-2 text-xs">
                            <div class="w-16 h-16 rounded-full bg-posterGreen-500 text-white flex items-center justify-center mx-auto shadow-lg shadow-posterGreen-500/30">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-slate-900">${data.student.name}</h3>
                                <p class="text-slate-500 font-mono">NISN: ${data.student.nisn} • Kelas: ${data.student.class}</p>
                                <span class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-bold bg-posterGreen-500/20 text-posterGreen-700">STATUS: HADIR (${data.attendance.time} WIB)</span>
                            </div>
                            <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200 text-left space-y-1">
                                <p class="text-posterGreen-600 font-bold flex items-center space-x-1">
                                    <span>✓ WhatsApp Otomatis Terkirim ke Orang Tua</span>
                                </p>
                                <p class="text-slate-600 text-[11px]">
                                    "Yth. Bapak/Ibu <strong>${data.student.parent_name}</strong>, putra/putri Anda telah tercatat HADIR di kelas pada pukul ${data.attendance.time} WIB."
                                </p>
                            </div>
                        </div>
                    `,
                    confirmButtonText: 'Selesai',
                    confirmButtonColor: '#38C682',
                    customClass: { popup: 'rounded-3xl p-6 shadow-2xl' }
                });
            }
        } catch (e) {
            console.error('Error student scan:', e);
        }
    }
</script>
<?= $this->endSection() ?>
