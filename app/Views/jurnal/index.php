<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6 sm:space-y-8">

    <!-- PAGE HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/60">
        <div>
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-tangerine-500/10 text-tangerine-600 text-xs font-bold mb-2">
                <span class="w-2 h-2 rounded-full bg-tangerine-500 animate-pulse"></span>
                <span>JURNAL KBM DIGITAL GURU</span>
                <span>•</span>
                <span>MOBILE-FIRST</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Jurnal KBM Digital Guru</h1>
            <p class="text-sm text-slate-500 mt-0.5">Dokumentasikan materi ajar, metode pembelajaran interaktif, dan catatan kelas secara instan.</p>
        </div>

        <!-- Quick Template Demo Button -->
        <button onclick="fillDemoJournalTemplate()" class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-2xl bg-gradient-to-r from-orange-50 to-amber-50 hover:from-orange-100 hover:to-amber-100 text-tangerine-700 text-xs font-bold border border-orange-200/80 transition-all shadow-soft active:scale-95">
            <i data-lucide="sparkles" class="w-4 h-4 text-tangerine-600"></i>
            <span>Isi Otomatis Template KBM</span>
        </button>
    </div>

    <!-- MAIN FORM GRID (MOBILE-FIRST CARD DESIGN) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">

        <!-- LEFT COLUMN: FORM INPUT JURNAL KBM -->
        <div class="lg:col-span-7 bg-white rounded-[32px] p-6 sm:p-8 border border-slate-200/80 shadow-soft space-y-6">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-2xl bg-royal-50 flex items-center justify-center text-royal-600 border border-royal-100">
                        <i data-lucide="edit-3" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Form Catatan KBM Harian</h3>
                        <p class="text-xs text-slate-500">Tanggal: <strong class="text-slate-800"><?= date('d F Y') ?></strong></p>
                    </div>
                </div>

                <span class="text-xs font-bold text-mint-700 bg-mint-500/10 px-3 py-1 rounded-full flex items-center space-x-1.5 border border-mint-200/60">
                    <span class="w-2 h-2 rounded-full bg-mint-500 animate-pulse"></span>
                    <span>Tersinkron Presensi</span>
                </span>
            </div>

            <form id="formJurnalKbm" onsubmit="submitJurnalForm(event)" class="space-y-5">
                <?= csrf_field() ?>
                <input type="hidden" name="date" value="<?= date('Y-m-d') ?>">

                <!-- Grid Row 1: Kelas, Mapel & Jam Ke- -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kelas</label>
                        <select name="class" id="inputClass" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/60 text-slate-800 text-xs sm:text-sm font-semibold focus:ring-2 focus:ring-royal-500 focus:bg-white focus:outline-none">
                            <?php foreach ($classes as $cls): ?>
                                <option value="<?= esc($cls) ?>" <?= $selectedClass === $cls ? 'selected' : '' ?>><?= esc($cls) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Jam Pelajaran</label>
                        <select name="session_hours" id="inputSessionHours" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/60 text-slate-800 text-xs sm:text-sm font-semibold focus:ring-2 focus:ring-royal-500 focus:bg-white focus:outline-none">
                            <option value="Jam Ke 1 - 3 (07:15 - 09:30)">Jam Ke 1 - 3 (07:15 - 09:30)</option>
                            <option value="Jam Ke 4 - 6 (09:45 - 11:45)">Jam Ke 4 - 6 (09:45 - 11:45)</option>
                            <option value="Jam Ke 7 - 9 (12:45 - 14:45)">Jam Ke 7 - 9 (12:45 - 14:45)</option>
                        </select>
                    </div>
                </div>

                <!-- Mata Pelajaran -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Mata Pelajaran</label>
                    <select name="subject" id="inputSubject" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/60 text-slate-800 text-xs sm:text-sm font-semibold focus:ring-2 focus:ring-royal-500 focus:bg-white focus:outline-none">
                        <?php foreach ($subjects as $sbj): ?>
                            <option value="<?= esc($sbj) ?>"><?= esc($sbj) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Materi Ajar / Kompetensi Dasar -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Materi Pokok / Bahasan KBM</label>
                    <input type="text" name="topic" id="inputTopic" placeholder="Contoh: Implementasi Form Validasi & Restful API CodeIgniter 4" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/60 text-slate-800 text-xs sm:text-sm font-medium focus:ring-2 focus:ring-royal-500 focus:bg-white focus:outline-none">
                </div>

                <!-- METODE PEMBELAJARAN INTERACTIVE CHIPS -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Metode Pembelajaran (Klik untuk memilih)
                        </label>
                        <span class="text-[11px] text-slate-400">Dapat memilih lebih dari satu</span>
                    </div>

                    <div class="flex flex-wrap gap-2" id="methodChipsContainer">
                        <?php foreach ($availableMethods as $idx => $m): ?>
                            <button type="button" onclick="toggleMethodChip(this, '<?= esc($m) ?>')" class="method-chip px-3 py-1.5 rounded-xl text-xs font-bold border transition-all <?= in_array($idx, [0, 1]) ? 'bg-posterGreen-500 text-white border-posterGreen-600 shadow-sm active-chip' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100' ?>">
                                <?= esc($m) ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                    <input type="hidden" name="methods" id="inputMethodsHidden" value="Diskusi Kelompok,Praktikum Lab">
                </div>

                <!-- Kejadian / Catatan Khusus Kelas -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kejadian / Catatan Kelas</label>
                    <textarea name="notes" id="inputNotes" rows="3" placeholder="Catat progress siswa, kendala praktikum, kebersihan lab, atau catatan khusus..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/60 text-slate-800 text-xs sm:text-sm font-medium focus:ring-2 focus:ring-royal-500 focus:bg-white focus:outline-none"></textarea>
                </div>

                <!-- RINGKASAN OTOMATIS KEHADIRAN (TERHUBUNG KE PRESENSI) -->
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-600 flex items-center space-x-1.5">
                            <i data-lucide="calculator" class="w-3.5 h-3.5 text-royal-600"></i>
                            <span>Rekapitulasi Kehadiran Siswa di Kelas Ini</span>
                        </span>
                        <span class="text-[11px] text-slate-400">Total: 32 Siswa</span>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                        <div class="bg-white p-2.5 rounded-xl border border-slate-200 text-center">
                            <span class="text-[10px] font-bold uppercase text-posterGreen-600">Hadir</span>
                            <input type="number" name="students_present" id="numPresent" value="<?= esc($summaryAttendance['hadir']) ?>" class="w-full text-center text-base font-extrabold text-slate-900 focus:outline-none mt-0.5">
                        </div>
                        <div class="bg-white p-2.5 rounded-xl border border-slate-200 text-center">
                            <span class="text-[10px] font-bold uppercase text-amber-600">Sakit</span>
                            <input type="number" name="students_sick" id="numSick" value="<?= esc($summaryAttendance['sakit']) ?>" class="w-full text-center text-base font-extrabold text-slate-900 focus:outline-none mt-0.5">
                        </div>
                        <div class="bg-white p-2.5 rounded-xl border border-slate-200 text-center">
                            <span class="text-[10px] font-bold uppercase text-royal-600">Izin</span>
                            <input type="number" name="students_permission" id="numPermission" value="<?= esc($summaryAttendance['izin']) ?>" class="w-full text-center text-base font-extrabold text-slate-900 focus:outline-none mt-0.5">
                        </div>
                        <div class="bg-white p-2.5 rounded-xl border border-slate-200 text-center">
                            <span class="text-[10px] font-bold uppercase text-rose-600">Alpa</span>
                            <input type="number" name="students_absent" id="numAbsent" value="<?= esc($summaryAttendance['alpa']) ?>" class="w-full text-center text-base font-extrabold text-slate-900 focus:outline-none mt-0.5">
                        </div>
                    </div>
                </div>

                <!-- SUBMIT BUTTON -->
                <button type="submit" id="btnSubmitJurnal" class="w-full flex items-center justify-center space-x-2 py-3.5 px-6 rounded-2xl bg-gradient-to-r from-tangerine-500 to-amber-500 hover:from-tangerine-600 hover:to-amber-600 text-white font-black text-sm sm:text-base shadow-soft hover:shadow-lg hover:shadow-tangerine-500/25 transition-all active:scale-98">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    <span>SIMPAN JURNAL KBM HARI INI</span>
                </button>
            </form>
        </div>

        <!-- RIGHT COLUMN: STATS PREVIEW & TIPS MOBILE -->
        <div class="lg:col-span-5 space-y-6">
            <!-- Mobile First Feature Highlight -->
            <div class="p-6 sm:p-7 rounded-[30px] bg-gradient-to-br from-royal-600 via-indigo-600 to-royal-700 text-white shadow-soft space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-11 h-11 rounded-2xl bg-white/15 flex items-center justify-center text-mint-300">
                        <i data-lucide="smartphone" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-bold">Desain Ramah Ponsel (Mobile-First)</h4>
                        <p class="text-xs text-indigo-100">Pengisian praktis di dalam ruang kelas.</p>
                    </div>
                </div>
                <p class="text-xs text-indigo-100/90 leading-relaxed">
                    Guru dapat mengisi form jurnal ini langsung melalui browser HP saat jam mengajar berakhir tanpa harus membuka laptop atau mencetak lembar jurnal kertas.
                </p>
                <div class="pt-2 flex items-center space-x-2 text-[11px] font-semibold text-mint-300">
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-mint-300"></i>
                    <span>Tervalidasi Tanda Tangan Digital Guru</span>
                </div>
            </div>

            <!-- Guru Pengampu Info Card -->
            <div class="p-5 rounded-[28px] bg-white border border-slate-200/80 shadow-soft flex items-center space-x-4">
                <img src="<?= esc($user['avatar'] ?? 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=250&q=80') ?>" class="w-14 h-14 rounded-2xl object-cover ring-4 ring-orange-50 shadow-sm">
                <div class="overflow-hidden">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-tangerine-600">Guru Pengampu</span>
                    <h4 class="text-sm font-extrabold text-slate-900 truncate"><?= esc($user['name'] ?? 'Naila Salma Az-Zahra, S.Kom') ?></h4>
                    <p class="text-xs text-slate-500 font-mono mt-0.5"><?= esc($user['nip'] ?? '19920815 201802 2 003') ?></p>
                </div>
            </div>
        </div>

    </div>

    <!-- ========================================================================= -->
    <!-- RIWAYAT JURNAL MENGAJAR TERDAFTAR -->
    <!-- ========================================================================= -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-soft overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="text-base font-bold text-slate-900">Riwayat Jurnal Mengajar</h3>
                <p class="text-xs text-slate-500">Seluruh sesi KBM terdokumentasi otomatis ke sistem in-memory.</p>
            </div>
            <span class="text-xs font-bold px-3 py-1 rounded-full bg-slate-100 text-slate-700 border border-slate-200 w-fit">
                Total: <strong class="text-royal-700" id="journalCountBadge"><?= count($jurnals) ?></strong> Sesi KBM
            </span>
        </div>

        <div class="divide-y divide-slate-100" id="journalHistoryList">
            <?php foreach ($jurnals as $j): ?>
                <div class="p-6 hover:bg-slate-50/60 transition-colors">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                        <div class="space-y-2 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-lg text-xs font-bold bg-royal-100 text-royal-700">
                                    <?= esc($j['class']) ?>
                                </span>
                                <span class="text-xs font-medium text-slate-500"><?= esc($j['session_hours']) ?></span>
                                <span class="text-slate-300">•</span>
                                <span class="text-xs font-medium text-slate-500 flex items-center space-x-1">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i>
                                    <span><?= esc($j['date']) ?></span>
                                </span>
                            </div>

                            <h4 class="text-base font-bold text-slate-900"><?= esc($j['topic']) ?></h4>
                            <p class="text-xs text-slate-500 font-semibold"><?= esc($j['subject']) ?></p>

                            <p class="text-xs text-slate-600 italic bg-slate-50 p-3 rounded-xl border border-slate-100">
                                "<?= esc($j['notes']) ?>"
                            </p>

                            <!-- Method Tags -->
                            <div class="flex flex-wrap gap-1.5 pt-1">
                                <?php foreach ($j['methods'] as $met): ?>
                                    <span class="px-2 py-0.5 rounded-md bg-posterGreen-500/10 text-posterGreen-700 text-[10px] font-bold">
                                        <?= esc($met) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>

                            <!-- Action Button & Attendance Breakdown -->
                            <div class="flex flex-col items-end gap-2 shrink-0">
                                <div class="flex items-center space-x-1.5 text-xs font-bold">
                                    <span class="px-2 py-0.5 rounded-md bg-posterGreen-500/15 text-posterGreen-700">H: <?= esc($j['students_present']) ?></span>
                                    <span class="px-2 py-0.5 rounded-md bg-amber-500/15 text-amber-700">S: <?= esc($j['students_sick']) ?></span>
                                    <span class="px-2 py-0.5 rounded-md bg-royal-100 text-royal-700">I: <?= esc($j['students_permission']) ?></span>
                                    <span class="px-2 py-0.5 rounded-md bg-rose-500/15 text-rose-700">A: <?= esc($j['students_absent']) ?></span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-[10px] text-slate-400">Oleh: <?= esc($j['teacher_name']) ?></span>
                                    <button onclick="openJournalDetailModal('<?= esc(addslashes($j['date'])) ?>', '<?= esc(addslashes($j['session_hours'])) ?>', '<?= esc(addslashes($j['class'])) ?>', '<?= esc(addslashes($j['subject'])) ?>', '<?= esc(addslashes($j['topic'])) ?>', '<?= esc(implode(', ', $j['methods'])) ?>', '<?= esc(addslashes($j['notes'])) ?>', <?= esc($j['students_present']) ?>, <?= esc($j['students_sick']) ?>, <?= esc($j['students_permission']) ?>, <?= esc($j['students_absent']) ?>, '<?= esc(addslashes($j['teacher_name'])) ?>')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-[11px] inline-flex items-center space-x-1 transition-colors">
                                        <i data-lucide="eye" class="w-3 h-3 text-royal-700"></i>
                                        <span>Detail</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let selectedMethods = ['Diskusi Kelompok', 'Praktikum Lab'];

    function toggleMethodChip(btn, method) {
        if (selectedMethods.includes(method)) {
            selectedMethods = selectedMethods.filter(m => m !== method);
            btn.className = "method-chip px-3 py-1.5 rounded-xl text-xs font-bold border transition-all bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100";
        } else {
            selectedMethods.push(method);
            btn.className = "method-chip px-3 py-1.5 rounded-xl text-xs font-bold border transition-all bg-posterGreen-500 text-white border-posterGreen-600 shadow-sm active-chip";
        }
        document.getElementById('inputMethodsHidden').value = selectedMethods.join(',');
    }

    // Quick fill template demo
    function fillDemoJournalTemplate() {
        document.getElementById('inputTopic').value = "Penerapan Filter Interaktif & Visualisasi Grafik Kehadiran Menggunakan Chart.js";
        document.getElementById('inputNotes').value = "Seluruh siswa kelas X RPL 1 aktif menyimak demonstrasi. 30 siswa berhasil mempraktikkan konfigurasi chart dan pengunduhan laporan PDF.";
        document.getElementById('inputSessionHours').value = "Jam Ke 1 - 3 (07:15 - 09:30)";
        document.getElementById('inputSubject').value = "Pemrograman Web & Perangkat Bergerak";

        Swal.fire({
            icon: 'info',
            title: 'Template Terisi!',
            text: 'Data form telah disiapkan untuk materi KBM terkini. Silakan klik "SIMPAN JURNAL KBM HARI INI".',
            timer: 2000,
            showConfirmButton: false,
            confirmButtonColor: '#3B41A3'
        });
    }

    // Submit handler via AJAX for real-time list update
    async function submitJurnalForm(e) {
        e.preventDefault();
        const form = document.getElementById('formJurnalKbm');
        const formData = new FormData(form);

        try {
            const response = await fetch('<?= base_url('jurnal-kbm/store') ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            if (data.success) {
                playBeepSound('success');

                // Prepend new journal record to the history list immediately
                const j = data.jurnal;
                const container = document.getElementById('journalHistoryList');

                const methodsBadges = j.methods.map(m => `
                    <span class="px-2 py-0.5 rounded-md bg-posterGreen-500/10 text-posterGreen-700 text-[10px] font-bold">
                        ${m}
                    </span>
                `).join('');

                const newCard = document.createElement('div');
                newCard.className = "p-6 bg-posterGreen-50/40 border-l-4 border-posterGreen-500 transition-all";
                newCard.innerHTML = `
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                        <div class="space-y-2 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-lg text-xs font-bold bg-royal-100 text-royal-700">
                                    ${j.class}
                                </span>
                                <span class="text-xs font-medium text-slate-500">${j.session_hours}</span>
                                <span class="text-slate-300">•</span>
                                <span class="text-xs font-medium text-slate-500 flex items-center space-x-1">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i>
                                    <span>${j.date}</span>
                                </span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-posterGreen-500 text-white">BARU DITAMBAHKAN</span>
                            </div>

                            <h4 class="text-base font-bold text-slate-900">${j.topic}</h4>
                            <p class="text-xs text-slate-500 font-semibold">${j.subject}</p>

                            <p class="text-xs text-slate-600 italic bg-white p-3 rounded-xl border border-slate-100">
                                "${j.notes}"
                            </p>

                            <div class="flex flex-wrap gap-1.5 pt-1">
                                ${methodsBadges}
                            </div>
                        </div>

                        <div class="flex md:flex-col items-end justify-between md:justify-center gap-2 shrink-0">
                            <div class="flex items-center space-x-1.5 text-xs font-bold">
                                <span class="px-2 py-0.5 rounded-md bg-posterGreen-500/15 text-posterGreen-700">H: ${j.students_present}</span>
                                <span class="px-2 py-0.5 rounded-md bg-amber-500/15 text-amber-700">S: ${j.students_sick}</span>
                                <span class="px-2 py-0.5 rounded-md bg-royal-100 text-royal-700">I: ${j.students_permission}</span>
                                <span class="px-2 py-0.5 rounded-md bg-rose-500/15 text-rose-700">A: ${j.students_absent}</span>
                            </div>
                            <span class="text-[10px] text-slate-400">Oleh: ${j.teacher_name}</span>
                        </div>
                    </div>
                `;
                container.prepend(newCard);
                document.getElementById('journalCountBadge').textContent = data.total_jurnals;
                lucide.createIcons();

                Swal.fire({
                    icon: 'success',
                    title: 'Jurnal KBM Berhasil Disimpan!',
                    text: 'Catatan mengajar telah terarsip ke sistem dan langsung tampil di riwayat KBM.',
                    confirmButtonColor: '#38C682',
                    customClass: { popup: 'rounded-2xl' }
                });

                // Reset form fields
                document.getElementById('inputTopic').value = '';
                document.getElementById('inputNotes').value = '';
            }
        } catch (err) {
            console.error('Error submitting journal:', err);
        }
    }

    // Modal popup detail jurnal KBM (tanpa perlu scroll samping)
    function openJournalDetailModal(date, hours, className, subject, topic, methods, notes, present, sick, permission, absent, teacher) {
        showDetailModal(
            `Detail Jurnal KBM: ${className}`,
            `
            <div class="space-y-4">
                <div class="p-3.5 rounded-2xl bg-royal-50 border border-royal-200">
                    <div class="flex items-center justify-between text-xs mb-1">
                        <span class="font-bold text-royal-700">${className} • ${hours}</span>
                        <span class="text-slate-500 font-mono">${date}</span>
                    </div>
                    <h4 class="text-sm font-bold text-slate-900">${subject}</h4>
                </div>

                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                    <span class="text-[10px] font-bold uppercase text-slate-400">Topik / Bahasan KBM:</span>
                    <p class="text-xs font-bold text-slate-800 leading-snug">${topic}</p>
                </div>

                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                    <span class="text-[10px] font-bold uppercase text-slate-400">Catatan & Kejadian Kelas:</span>
                    <p class="text-xs text-slate-700 italic leading-relaxed">"${notes}"</p>
                </div>

                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 space-y-1">
                    <span class="text-[10px] font-bold uppercase text-slate-400">Metode Pembelajaran:</span>
                    <p class="text-xs font-semibold text-posterGreen-700">${methods}</p>
                </div>

                <div class="grid grid-cols-4 gap-2 text-center text-xs">
                    <div class="p-2 rounded-xl bg-posterGreen-50 border border-posterGreen-200">
                        <span class="text-[10px] font-bold text-posterGreen-700">Hadir</span>
                        <p class="font-extrabold text-slate-900">${present}</p>
                    </div>
                    <div class="p-2 rounded-xl bg-amber-50 border border-amber-200">
                        <span class="text-[10px] font-bold text-amber-700">Sakit</span>
                        <p class="font-extrabold text-slate-900">${sick}</p>
                    </div>
                    <div class="p-2 rounded-xl bg-royal-50 border border-royal-200">
                        <span class="text-[10px] font-bold text-royal-700">Izin</span>
                        <p class="font-extrabold text-slate-900">${permission}</p>
                    </div>
                    <div class="p-2 rounded-xl bg-rose-50 border border-rose-200">
                        <span class="text-[10px] font-bold text-rose-700">Alpa</span>
                        <p class="font-extrabold text-slate-900">${absent}</p>
                    </div>
                </div>

                <div class="pt-2 text-[10px] text-slate-400 text-right">
                    Guru Pengampu: <strong class="text-slate-700">${teacher}</strong>
                </div>
            </div>
            `
        );
    }
</script>
<?= $this->endSection() ?>
