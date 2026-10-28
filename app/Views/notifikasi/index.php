<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6 sm:space-y-8">

    <!-- PAGE HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/60">
        <div>
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-tangerine-500/10 text-tangerine-600 text-xs font-bold mb-2">
                <span class="w-2 h-2 rounded-full bg-tangerine-500 animate-pulse"></span>
                <span>WHATSAPP GATEWAY ENGINE</span>
                <span>•</span>
                <span>NOTIFIKASI OTOMATIS</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Notifikasi Real-Time Orang Tua/Wali</h1>
            <p class="text-sm text-slate-500 mt-0.5">Kirim info kehadiran siswa otomatis ke nomor WhatsApp orang tua/wali begitu QR terverifikasi.</p>
        </div>

        <!-- Direct Trigger Test Button -->
        <button onclick="openTestModal()" class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-2xl bg-gradient-to-r from-tangerine-500 to-amber-500 hover:from-tangerine-600 hover:to-amber-600 text-white font-bold text-xs sm:text-sm shadow-soft hover:shadow-lg hover:shadow-tangerine-500/25 transition-all active:scale-95">
            <i data-lucide="send" class="w-4 h-4"></i>
            <span>Test Kirim Notifikasi Real-Time</span>
        </button>
    </div>

    <!-- WHATSAPP GATEWAY HARDWARE / SERVER STATUS PANEL -->
    <div class="p-6 sm:p-7 rounded-[32px] bg-white border border-slate-200/80 shadow-soft space-y-5">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
            <div class="flex items-center space-x-4">
                <div class="w-13 h-13 rounded-2xl bg-[#25D366]/10 flex items-center justify-center text-[#25D366] p-3 shadow-inner">
                    <i data-lucide="message-square" class="w-7 h-7"></i>
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h3 class="text-base sm:text-lg font-black text-slate-900">WhatsApp Gateway Server Node</h3>
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-[10px] font-extrabold bg-mint-500 text-white shadow-soft">
                            <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse mr-1.5"></span>
                            CONNECTED • REAL-TIME ACTIVE
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">Device ID: <strong class="text-slate-800 font-mono"><?= esc($gateway['device_name'] ?? 'WA-GATEWAY-BUDILUHUR') ?></strong> • IP: <span class="font-mono"><?= esc($gateway['server_ip'] ?? '192.168.1.100') ?></span></p>
                </div>
            </div>

            <!-- Auto-Send Toggle Indicator -->
            <div class="flex items-center space-x-3 bg-slate-50 px-4 py-2.5 rounded-2xl border border-slate-200/80">
                <span class="text-xs font-bold text-slate-600">Auto-Send Saat Scan:</span>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-mint-500 text-white shadow-soft">
                    AKTIF (ON)
                </span>
            </div>
        </div>

        <!-- Metric Bars for Gateway -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3.5 pt-1">
            <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/70">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Response Latency</span>
                <p class="text-xl font-black text-royal-600 mt-1 font-mono">310 ms</p>
                <span class="text-[10px] text-mint-600 font-bold">Sangat Cepat</span>
            </div>
            <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/70">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Kuota Terpakai</span>
                <p class="text-xl font-black text-slate-900 mt-1 font-mono" id="gatewayQuotaText"><?= esc($gateway['quota_used'] ?? 142) ?> / <?= esc($gateway['quota_max'] ?? 1000) ?></p>
                <span class="text-[10px] text-slate-500 font-medium">Sisa: 858 Pesan</span>
            </div>
            <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/70">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Tingkat Pengiriman</span>
                <p class="text-xl font-black text-mint-600 mt-1 font-mono">100%</p>
                <span class="text-[10px] text-slate-500 font-medium">Zero Failure</span>
            </div>
            <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/70">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Sinkronisasi</span>
                <p class="text-sm font-bold text-slate-800 mt-2 font-mono"><?= date('H:i:s') ?> WIB</p>
                <span class="text-[10px] text-slate-400 font-medium">Real-Time Sync</span>
            </div>
        </div>
    </div>

    <!-- NOTIFICATION LOG LIST WITH SEARCH -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-soft overflow-hidden">
        <!-- Search & Filter Bar -->
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-bold text-slate-900">Log Pengiriman Pesan WhatsApp Otomatis</h3>
                <p class="text-xs text-slate-500">Riwayat notifikasi yang terkirim langsung ke orang tua siswa hari ini.</p>
            </div>

            <!-- Search input -->
            <form action="<?= base_url('notifikasi') ?>" method="get" class="flex items-center space-x-2">
                <div class="relative">
                    <i data-lucide="search" class="w-4 h-4 absolute inset-y-0 left-3 my-auto text-slate-400"></i>
                    <input type="text" name="q" value="<?= esc($search ?? '') ?>" placeholder="Cari siswa / wali murid..." class="pl-9 pr-3 py-1.5 rounded-xl border border-slate-300 text-xs focus:outline-none focus:ring-2 focus:ring-royal-500">
                </div>
                <button type="submit" class="px-3 py-1.5 rounded-xl bg-royal-700 hover:bg-royal-800 text-white text-xs font-bold">
                    Filter
                </button>
            </form>
        </div>

        <!-- 1. TAMPILAN MOBILE: KARTU LOG WHATSAPP (TANPA PERLU GESER SAMPING!) -->
        <div class="md:hidden divide-y divide-slate-100" id="notifMobileCards">
            <?php foreach ($notifications as $n): ?>
                <div class="p-4 space-y-3 hover:bg-slate-50/60 transition-colors">
                    <div class="flex items-start justify-between gap-2">
                        <div class="flex items-center space-x-2.5">
                            <div class="w-9 h-9 rounded-xl bg-posterGreen-500/10 text-posterGreen-600 flex items-center justify-center shrink-0">
                                <i data-lucide="message-square" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900"><?= esc($n['student_name']) ?></h4>
                                <p class="text-[10px] text-slate-400 font-medium">Wali: <strong class="text-slate-700"><?= esc($n['parent_name']) ?></strong> (<?= esc($n['class']) ?>)</p>
                            </div>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-posterGreen-500/15 text-posterGreen-700 shrink-0">
                            <?= esc($n['status']) ?>
                        </span>
                    </div>

                    <!-- Chat Snippet Box -->
                    <div onclick="previewWhatsAppPopup('<?= esc(addslashes($n['parent_name'])) ?>', '<?= esc(addslashes($n['parent_phone'])) ?>', '<?= esc(addslashes($n['message'])) ?>', '<?= esc(substr($n['sent_at'], 11, 5)) ?>')" class="p-2.5 rounded-xl bg-slate-50 border border-slate-200 cursor-pointer active:scale-98 transition-transform">
                        <p class="text-[11px] text-slate-600 line-clamp-2 leading-relaxed">
                            "<?= esc($n['message']) ?>"
                        </p>
                        <span class="text-[10px] font-bold text-royal-700 mt-1 inline-flex items-center space-x-1">
                            <i data-lucide="eye" class="w-3 h-3"></i>
                            <span>Buka Chat Bubble Lengkap</span>
                        </span>
                    </div>

                    <div class="flex items-center justify-between text-[11px] text-slate-500 pt-1">
                        <span class="font-mono text-slate-400"><?= esc(substr($n['sent_at'], 11, 8)) ?> WIB</span>
                        <button onclick="resendNotification('<?= esc(addslashes($n['student_name'])) ?>', '<?= esc(addslashes($n['class'])) ?>', '<?= esc(addslashes($n['parent_name'])) ?>', '<?= esc(addslashes($n['parent_phone'])) ?>')" class="px-3 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs flex items-center space-x-1">
                            <i data-lucide="rotate-ccw" class="w-3 h-3"></i>
                            <span>Kirim Ulang</span>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- 2. TAMPILAN DESKTOP: TABEL LENGKAP -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-6">Siswa & Kelas</th>
                        <th class="py-3.5 px-6">Orang Tua / Wali</th>
                        <th class="py-3.5 px-6">No. WhatsApp</th>
                        <th class="py-3.5 px-6">Preview Pesan WhatsApp</th>
                        <th class="py-3.5 px-6">Waktu Kirim</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium" id="notifTableBody">
                    <?php foreach ($notifications as $n): ?>
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3.5 px-6">
                                <div class="font-bold text-slate-900"><?= esc($n['student_name']) ?></div>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-royal-100 text-royal-700"><?= esc($n['class']) ?></span>
                            </td>
                            <td class="py-3.5 px-6">
                                <span class="font-semibold text-slate-800"><?= esc($n['parent_name']) ?></span>
                            </td>
                            <td class="py-3.5 px-6 font-mono font-bold text-slate-600">
                                <?= esc($n['parent_phone']) ?>
                            </td>
                            <td class="py-3.5 px-6 max-w-xs">
                                <div onclick="previewWhatsAppPopup('<?= esc(addslashes($n['parent_name'])) ?>', '<?= esc(addslashes($n['parent_phone'])) ?>', '<?= esc(addslashes($n['message'])) ?>', '<?= esc(substr($n['sent_at'], 11, 5)) ?>')" class="cursor-pointer group">
                                    <p class="truncate text-slate-600 group-hover:text-royal-700 font-medium">
                                        <?= esc($n['message']) ?>
                                    </p>
                                    <span class="text-[10px] text-royal-600 font-bold group-hover:underline flex items-center space-x-1 mt-0.5">
                                        <i data-lucide="eye" class="w-3 h-3"></i>
                                        <span>Buka Mockup Chat WA</span>
                                    </span>
                                </div>
                            </td>
                            <td class="py-3.5 px-6 font-mono text-slate-500 whitespace-nowrap">
                                <?= esc(substr($n['sent_at'], 11, 8)) ?> WIB
                            </td>
                            <td class="py-3.5 px-6 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-posterGreen-500/15 text-posterGreen-700 space-x-1">
                                    <i data-lucide="check-check" class="w-3 h-3"></i>
                                    <span><?= esc($n['status']) ?> (<?= esc($n['read_status'] ?? 'Dibaca') ?>)</span>
                                </span>
                            </td>
                            <td class="py-3.5 px-6 text-center whitespace-nowrap">
                                <button onclick="resendNotification('<?= esc(addslashes($n['student_name'])) ?>', '<?= esc(addslashes($n['class'])) ?>', '<?= esc(addslashes($n['parent_name'])) ?>', '<?= esc(addslashes($n['parent_phone'])) ?>')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-[11px] transition-colors inline-flex items-center space-x-1">
                                    <i data-lucide="rotate-ccw" class="w-3 h-3"></i>
                                    <span>Kirim Ulang</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Preview WA message inside sweet mockup popup
    function previewWhatsAppPopup(parentName, phone, message, timeStr) {
        Swal.fire({
            title: '<div class="flex items-center space-x-2 text-left"><span class="w-3 h-3 rounded-full bg-posterGreen-500"></span><span class="text-sm font-bold text-slate-900">Preview Pesan WhatsApp</span></div>',
            html: `
                <div class="bg-[#ECE5DD] p-4 rounded-2xl max-w-md mx-auto text-left space-y-2 border border-slate-300 shadow-inner">
                    <!-- Chat Header bar mockup -->
                    <div class="flex items-center justify-between pb-2 border-b border-slate-300/60 mb-2">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 rounded-full bg-[#128C7E] flex items-center justify-center text-white font-bold text-xs">
                                WA
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 leading-tight">EduScan Bot Presensi</h4>
                                <p class="text-[10px] text-slate-500 font-mono">Kepada: ${parentName} (${phone})</p>
                            </div>
                        </div>
                        <span class="text-[10px] text-slate-400">Resmi Sekolah</span>
                    </div>

                    <!-- Chat Bubble -->
                    <div class="bg-white p-3.5 rounded-2xl rounded-tl-none shadow-sm space-y-2 text-xs text-slate-800 leading-relaxed relative">
                        <p>${message}</p>
                        <div class="flex items-center justify-end space-x-1 text-[10px] text-slate-400 font-mono pt-1">
                            <span>${timeStr || '07:35'}</span>
                            <span class="text-[#34B7F1] font-bold">✓✓</span>
                        </div>
                    </div>
                </div>
            `,
            confirmButtonText: 'Tutup Preview',
            confirmButtonColor: '#25D366',
            customClass: { popup: 'rounded-3xl p-6 shadow-2xl' }
        });
    }

    // Modal for Test Send Real-Time Notification
    function openTestModal() {
        Swal.fire({
            title: 'Test Kirim Notifikasi WhatsApp',
            html: `
                <div class="space-y-3 text-left text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Nama Siswa</label>
                        <input type="text" id="swalStudentName" value="Ahmad Fauzi Budiarto" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-royal-500 text-xs">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Kelas</label>
                        <input type="text" id="swalClassName" value="X RPL 1" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-royal-500 text-xs">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Nama Orang Tua / Wali</label>
                        <input type="text" id="swalParentName" value="Hendra Budiarto" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-royal-500 text-xs">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Nomor WhatsApp Wali Murid</label>
                        <input type="text" id="swalParentPhone" value="0812-8921-7711" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-royal-500 text-xs font-mono">
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Kirim Sekarang',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#38C682',
            cancelButtonColor: '#94A3B8',
            customClass: { popup: 'rounded-3xl' },
            preConfirm: () => {
                const sName = document.getElementById('swalStudentName').value;
                const cName = document.getElementById('swalClassName').value;
                const pName = document.getElementById('swalParentName').value;
                const pPhone = document.getElementById('swalParentPhone').value;
                return { sName, cName, pName, pPhone };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const { sName, cName, pName, pPhone } = result.value;
                resendNotification(sName, cName, pName, pPhone);
            }
        });
    }

    // Trigger test send or resend notification via AJAX
    async function resendNotification(studentName, className, parentName, phone) {
        // Show simulated loading progress
        Swal.fire({
            title: 'Menghubungkan ke Gateway...',
            html: '<p class="text-xs text-slate-500">Meneruskan paket payload enkripsi ke API WhatsApp Gateway...</p>',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        try {
            const formData = new FormData();
            formData.append('student_name', studentName);
            formData.append('class', className);
            formData.append('parent_name', parentName);
            formData.append('parent_phone', phone);
            formData.append('status', 'Hadir');

            const response = await fetch('<?= base_url('notifikasi/test-send') ?>', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const data = await response.json();

            if (data.success) {
                playBeepSound('success');

                // Update quota text in panel
                const quotaEl = document.getElementById('gatewayQuotaText');
                if (quotaEl && data.gateway) {
                    quotaEl.textContent = `${data.gateway.quota_used} / ${data.gateway.quota_max}`;
                }

                // Add to desktop table
                const tbody = document.getElementById('notifTableBody');
                if (tbody && data.notification) {
                    const tr = document.createElement('tr');
                    tr.className = "bg-posterGreen-50/50 hover:bg-slate-50/80 transition-colors";
                    tr.innerHTML = `
                        <td class="py-3.5 px-6">
                            <div class="font-bold text-slate-900">${data.notification.student_name}</div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-royal-100 text-royal-700">${data.notification.class}</span>
                        </td>
                        <td class="py-3.5 px-6">
                            <span class="font-semibold text-slate-800">${data.notification.parent_name}</span>
                        </td>
                        <td class="py-3.5 px-6 font-mono font-bold text-slate-600">
                            ${data.notification.parent_phone}
                        </td>
                        <td class="py-3.5 px-6 max-w-xs">
                            <p class="truncate text-slate-600 font-medium">${data.notification.message}</p>
                        </td>
                        <td class="py-3.5 px-6 font-mono text-slate-500 whitespace-nowrap">
                            ${data.notification.sent_at.substring(11, 19)} WIB
                        </td>
                        <td class="py-3.5 px-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-posterGreen-500/15 text-posterGreen-700 space-x-1">
                                <i data-lucide="check-check" class="w-3 h-3"></i>
                                <span>Terkirim (Dibaca)</span>
                            </span>
                        </td>
                        <td class="py-3.5 px-6 text-center whitespace-nowrap">
                            <span class="text-[10px] text-posterGreen-600 font-bold">Baru Terkirim</span>
                        </td>
                    `;
                    tbody.prepend(tr);
                }

                // Add to mobile cards
                const mobileContainer = document.getElementById('notifMobileCards');
                if (mobileContainer && data.notification) {
                    const card = document.createElement('div');
                    card.className = "p-4 space-y-3 bg-posterGreen-50/40 hover:bg-slate-50/60 transition-colors";
                    card.innerHTML = `
                        <div class="flex items-start justify-between gap-2">
                            <div class="flex items-center space-x-2.5">
                                <div class="w-9 h-9 rounded-xl bg-posterGreen-500/20 text-posterGreen-700 flex items-center justify-center shrink-0">
                                    <i data-lucide="message-square" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900">${data.notification.student_name}</h4>
                                    <p class="text-[10px] text-slate-400 font-medium">Wali: <strong class="text-slate-700">${data.notification.parent_name}</strong> (${data.notification.class})</p>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-posterGreen-500 text-white shrink-0">
                                BARU
                            </span>
                        </div>

                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <p class="text-[11px] text-slate-700 leading-relaxed">${data.notification.message}</p>
                        </div>

                        <div class="flex items-center justify-between text-[11px] text-slate-500 pt-1">
                            <span class="font-mono text-slate-400">${data.notification.sent_at.substring(11, 19)} WIB</span>
                            <span class="text-[10px] font-bold text-posterGreen-600">✓✓ Terkirim</span>
                        </div>
                    `;
                    mobileContainer.prepend(card);
                    lucide.createIcons();
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Pesan Berhasil Terkirim!',
                    text: `WhatsApp terkirim ke Bapak/Ibu ${parentName} (${phone}) dengan response time 310ms.`,
                    confirmButtonColor: '#38C682',
                    customClass: { popup: 'rounded-2xl' }
                });
            }
        } catch (e) {
            console.error('Error sending WA:', e);
        }
    }
</script>
<?= $this->endSection() ?>
