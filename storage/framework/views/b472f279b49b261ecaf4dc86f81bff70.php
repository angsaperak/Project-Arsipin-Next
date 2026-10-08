<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        const detectSimilarUrl = '<?php echo e(route('archives.detect-similar')); ?>';
        let similarityDetected = false;
        let lastCheckedText = '';
        let similarityData = null;
        let skipDetectionSubmit = false;

        function extractYearFromDate(dateString) {
            if (!dateString) return null;
            const parts = dateString.split('-');
            return parts.length >= 1 ? parseInt(parts[0], 10) : null;
        }

        async function runSimilarDetection({ descriptionText, lampiranText, indexNumber }) {
            try {
                const text = [descriptionText, lampiranText].filter(Boolean).join(' ').trim();
                const archiveYear = extractYearFromDate($('#kurun_waktu_start').val());
                const checkKey = `${text}||${indexNumber || ''}||${archiveYear ?? ''}`;
                if ((!text && !indexNumber) || checkKey === lastCheckedText) return null; // Prevent duplicate checks
                lastCheckedText = checkKey;

                const resp = await fetch(detectSimilarUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({
                        text: text,
                        index_number: indexNumber,
                        archive_year: archiveYear
                    })
                });

                if (!resp.ok) return null;
                return await resp.json();
            } catch (e) {
                console.error('detectSimilar error', e);
                return null;
            }
        }

        const detectDetailBaseUrl = '<?php echo e(url('/archives')); ?>';

        async function getArchiveDetail(archiveId) {
            try {
                const resp = await fetch(`${detectDetailBaseUrl}/${archiveId}/detect-detail`, {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                });

                if (!resp.ok) {
                    throw new Error('Fetch failed');
                }

                const data = await resp.json();
                return data.success ? data.archive : null;
            } catch (e) {
                console.error('getArchiveDetail error', e);
                return null;
            }
        }

        function detailFieldRow(label, value) {
            if (!value) return '';
            return `<div class="mb-2"><span class="font-semibold">${label}:</span> <span class="text-sm text-gray-700">${value}</span></div>`;
        }

        function validateRequiredFieldsForRelated() {
            const requiredFields = [
                { selector: '#category_id', name: 'Kategori' },
                { selector: '#classification_id', name: 'Klasifikasi' },
                { selector: '#index_number', name: 'Nomor Arsip' },
                { selector: '#kurun_waktu_start', name: 'Tanggal Arsip' },
                { selector: '#description', name: 'Uraian Arsip' },
                { selector: '#tingkat_perkembangan', name: 'Tingkat Perkembangan' },
                { selector: '#skkad', name: 'SKKAD' },
                { selector: '#jumlah_berkas', name: 'Jumlah Berkas' }
            ];

            const missing = requiredFields.filter(field => {
                const el = document.querySelector(field.selector);
                if (!el) return true;
                return !el.value || el.value.toString().trim() === '';
            }).map(field => field.name);

            if (missing.length > 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Lengkapi data terlebih dahulu',
                    html: `Silakan isi field berikut sebelum mengaitkan arsip:<ul class="text-left mt-2">${missing.map(name => `<li>${name}</li>`).join('')}</ul>`,
                    confirmButtonText: 'Oke'
                });
                return false;
            }

            return true;
        }

        async function showArchiveDetailModal(archiveId, previousResults) {
            const loadingModal = Swal.fire({
                title: 'Memuat detail arsip...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const archive = await getArchiveDetail(archiveId);
            Swal.close();

            if (!archive) {
                return Swal.fire('Gagal memuat', 'Tidak dapat mengambil detail arsip. Silakan coba lagi.', 'error');
            }

            const archiveHtml = `
                <div class="text-left space-y-3">
                    ${detailFieldRow('No Arsip', archive.index_number ?? archive.id)}
                    ${detailFieldRow('Tanggal Arsip', archive.kurun_waktu_start ?? '-')}
                    ${detailFieldRow('Kategori', archive.category ?? '-')}
                    ${detailFieldRow('Klasifikasi', archive.classification ?? '-')}
                    ${detailFieldRow('Created By', archive.created_by ?? '-')}
                    ${detailFieldRow('Updated By', archive.updated_by ?? '-')}
                    <div class="rounded-lg bg-gray-50 p-3 border border-gray-200">
                        <div class="font-semibold text-gray-700 mb-2">Uraian Arsip</div>
                        <div class="text-sm text-gray-800 whitespace-pre-wrap">${archive.description ?? '-'}</div>
                    </div>
                    ${archive.lampiran_surat ? `<div class="rounded-lg bg-gray-50 p-3 border border-gray-200">
                        <div class="font-semibold text-gray-700 mb-2">Lampiran Surat</div>
                        <div class="text-sm text-gray-800 whitespace-pre-wrap">${archive.lampiran_surat}</div>
                    </div>` : ''}
                    <div class="mt-3 text-right">
                        <button type="button" id="swal-link-related-archive" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg shadow-sm hover:bg-green-700 transition-colors">
                            <i class="fas fa-link mr-2"></i>Terkaitkan dengan arsip ini
                        </button>
                    </div>
                </div>
            `;

            return Swal.fire({
                title: `Detail Arsip ${archive.index_number ?? archive.id}`,
                html: archiveHtml,
                icon: 'info',
                width: '640px',
                showCancelButton: true,
                cancelButtonText: 'Kembali ke daftar',
                confirmButtonText: 'Tutup',
                reverseButtons: true,
                didOpen: () => {
                    const container = Swal.getHtmlContainer();
                    if (container) {
                        container.style.maxHeight = '50vh';
                        container.style.overflowY = 'auto';
                    }

                    const relatedButton = document.querySelector('#swal-link-related-archive');
                    if (relatedButton) {
                        relatedButton.addEventListener('click', () => {
                            if (!validateRequiredFieldsForRelated()) {
                                return;
                            }

                            const form = document.querySelector('#archive-create-form');
                            const relatedParentInput = document.querySelector('#related_parent_archive_id');
                            if (!form) {
                                return Swal.fire('Gagal', 'Form tambah arsip tidak ditemukan.', 'error');
                            }
                            if (!relatedParentInput) {
                                return Swal.fire('Gagal', 'Field relasi arsip tidak ditemukan.', 'error');
                            }

                            relatedParentInput.value = archive.id;
                            skipDetectionSubmit = true;
                            form.submit();
                        });
                    }
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.cancel || result.dismiss === Swal.DismissReason.close || result.dismiss === Swal.DismissReason.esc) {
                    showDetectedModal(previousResults);
                }
            });
        }

        function showDetectedModal(results) {
            if (!results || results.length === 0) return;

            const listItems = results
                .slice(0, 6)
                .map(r => {
                    const reasonLines = [];
                    if (r.matched_by_index) {
                        reasonLines.push('<div class="text-xs text-green-600 mb-1">Nomor arsip sama</div>');
                    }
                    if (r.matched_by_description) {
                        reasonLines.push('<div class="text-xs text-green-600 mb-1">Uraian arsip sama</div>');
                    }
                    if (r.matched_by_lampiran) {
                        reasonLines.push('<div class="text-xs text-green-600 mb-1">Lampiran sama</div>');
                    }
                    if (r.matched_by_corporate_name) {
                        const companyLabel = r.matched_company_name ? `Perusahaan / Atas nama serupa: ${r.matched_company_name}` : 'Perusahaan / Atas nama serupa';
                        reasonLines.push(`<div class="text-xs text-green-600 mb-1">${companyLabel}</div>`);
                    }

                    const lampiranLine = r.lampiran_surat ? `<div class="text-xs text-gray-700 line-clamp-2">Lampiran: ${r.lampiran_surat}</div>` : '';
                    const yearLine = r.same_year ? `<div class="text-xs text-indigo-600 mb-1">Tahun arsip sama</div>` : '';
                    const createdAtLine = r.created_at ? `<div class="text-xs text-gray-500">Dibuat: ${r.created_at}</div>` : '';

                    return `
                        <li data-archive-id="${r.id}" class="swal-archive-item cursor-pointer rounded-lg p-3 hover:bg-gray-100 transition-colors border border-transparent hover:border-gray-200">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-medium text-blue-600">No: ${r.index_number ?? r.id}</span>
                                <span class="text-xs text-gray-500">Klik untuk detail</span>
                            </div>
                            ${reasonLines.join('')}
                            ${yearLine}
                            <div class="text-xs text-gray-800 line-clamp-2 mb-1">Uraian: ${r.description ?? '-'}</div>
                            ${lampiranLine}
                            ${createdAtLine}
                        </li>
                    `;
                })
                .join('');

            return Swal.fire({
                title: 'Arsip Serupa Ditemukan!',
                html: `
                    <div class="text-left">
                        <p class="mb-3 text-sm text-gray-600">Terdapat arsip yang memiliki nomor arsip sama atau nama perusahaan / a.n. sama. Deteksi hanya menandai kesamaan nama setelah prefix seperti a.n., CV, PT, atau UD.</p>
                        <div class="max-h-56 overflow-y-auto mb-3 bg-gray-50 p-2 rounded">
                            <ul class="space-y-2">${listItems}</ul>
                        </div>
                        <p class="mt-3 text-xs text-gray-500">Tip: Klik item untuk melihat detail arsip tanpa meninggalkan halaman tambah arsip.</p>
                    </div>
                `,
                icon: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Batal & Cek Data',
                cancelButtonText: 'Tetap Simpan',
                cancelButtonColor: '#3085d6',
                confirmButtonColor: '#d33',
                reverseButtons: true,
                didOpen: () => {
                    const container = Swal.getHtmlContainer();
                    if (!container) return;
                    const clickableItems = container.querySelectorAll('.swal-archive-item');
                    clickableItems.forEach(item => {
                        item.addEventListener('click', async () => {
                            const archiveId = item.getAttribute('data-archive-id');
                            if (!archiveId) return;
                            await showArchiveDetailModal(archiveId, results);
                        });
                    });
                }
            });
        }

        // On Blur Event for Realtime check (optional, but good UX)
        $('#description, #lampiran_surat, #kurun_waktu_start, #index_number').on('blur change', async function() {
            const descriptionText = $('#description').val() || '';
            const lampiranText = $('#lampiran_surat').val() || '';
            const indexNumber = $('#index_number').val() || '';

            if (!descriptionText.trim() && !lampiranText.trim() && !indexNumber.trim()) return;

            const detection = await runSimilarDetection({
                descriptionText,
                lampiranText,
                indexNumber
            });

            if (detection && detection.detected && detection.results && detection.results.length > 0) {
                similarityDetected = true;
                similarityData = detection.results;

                // Show detected archives in a modal so user can review similar entries before continuing
                //await showDetectedModal(detection.results);
            } else if (detection) {
                similarityDetected = false;
                similarityData = null;
            }
        });

        // Pre-submit detection blocking
        $('#archive-create-form').on('submit', async function(e) {
            const relatedParentId = $('#related_parent_archive_id').val();
            if (relatedParentId) {
                return true; // Skip duplicate detection when explicitly linking to an existing archive
            }

            if (skipDetectionSubmit) {
                return true; // Allow native submission after user confirmed save
            }

            const descriptionText = $('#description').val() || '';
            const lampiranText = $('#lampiran_surat').val() || '';
            const indexNumber = $('#index_number').val() || '';

            if (!descriptionText.trim() && !lampiranText.trim() && !indexNumber.trim()) return true;

            // If we already detected similarity on blur, we use that data
            // Otherwise, we do a quick check just in case they typed very fast and clicked submit
            let detectionResults = similarityData;
            
            // Re-check if text or year changed since last blur
            const archiveYear = extractYearFromDate($('#kurun_waktu_start').val());
            const currentKey = `${[descriptionText, lampiranText].filter(Boolean).join(' ').trim()}||${indexNumber || ''}||${archiveYear ?? ''}`;
            if (currentKey !== lastCheckedText || !detectionResults) {
                const detection = await runSimilarDetection({
                    descriptionText,
                    lampiranText,
                    indexNumber
                });
                
                if (detection && detection.detected && detection.results && detection.results.length > 0) {
                    detectionResults = detection.results;
                } else {
                    detectionResults = null;
                }
            }

            if (detectionResults && detectionResults.length > 0) {
                e.preventDefault(); // Stop submission until user confirms
                
                const formElement = this;
                showDetectedModal(detectionResults).then((result) => {
                    if (result.isConfirmed) {
                        // User chose to review data first. Keep form open.
                        skipDetectionSubmit = false;
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // User chose to save anyway. Submit by native DOM method.
                        skipDetectionSubmit = true;
                        formElement.submit();
                    }
                });
            }
            // else: let the form submit normally
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH E:\New folder\Materi untag\INTERN\cobainiarsip\archivy-main (3)\archivy-main\resources\views/components/archive-detection-script.blade.php ENDPATH**/ ?>