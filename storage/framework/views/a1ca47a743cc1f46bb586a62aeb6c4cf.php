<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Page Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-file-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-2xl text-gray-900">Detail Arsip</h2>
                        <p class="text-sm text-gray-600 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>Informasi lengkap arsip <?php echo e($archive->index_number); ?>

                        </p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="<?php echo e(route('admin.archives.edit', $archive)); ?>"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Arsip
                    </a>
                    <a href="javascript:history.back()"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="p-6 space-y-6">

        <!-- Archive Header Card -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold mb-2">
                        <?php echo e($archive->index_number); ?>

                    </h2>
                    <p class="text-blue-100 text-lg"><?php echo e($archive->description); ?></p>
                </div>
                <div class="text-right">
                    <?php
                        $statusClasses = [
                            'Aktif' => 'bg-green-500',
                            'Inaktif' => 'bg-yellow-500',
                            'Permanen' => 'bg-purple-500',
                            'Musnah' => 'bg-red-500',
                            'Dinilai Kembali' => 'bg-indigo-500',
                        ];
                    ?>
                    <div
                        class="inline-flex items-center px-4 py-2 <?php echo e($statusClasses[$archive->status] ?? 'bg-gray-500'); ?> rounded-full text-white font-semibold">
                        <i class="fas fa-flag mr-2"></i><?php echo e($archive->status); ?>

                    </div>
                    <p class="text-blue-100 text-sm mt-2">Status Saat Ini</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Basic Information -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                    Informasi Dasar
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Index Number -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-hashtag text-green-500 mr-2"></i>
                            <span class="text-sm font-medium text-gray-600">Nomor Berkas</span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor Arsip</label>
                            <p class="mt-1 text-sm text-gray-900 font-medium"><?php echo e($archive->index_number); ?></p>
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-calendar-alt text-orange-500 mr-2"></i>
                            <span class="text-sm font-medium text-gray-600">Tanggal Arsip</span>
                        </div>
                        <p class="text-lg font-semibold text-gray-900">
                            <?php echo e($archive->kurun_waktu_start->format('d F Y')); ?></p>
                    </div>

                    <!-- Development Level -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-layer-group text-yellow-500 mr-2"></i>
                            <span class="text-sm font-medium text-gray-600">Tingkat Perkembangan</span>
                        </div>
                        <p class="text-lg font-semibold text-gray-900"><?php echo e($archive->tingkat_perkembangan); ?></p>
                    </div>

                    <!-- File Count -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-sort-numeric-up text-red-500 mr-2"></i>
                            <span class="text-sm font-medium text-gray-600">Jumlah Berkas</span>
                        </div>
                        <p class="text-lg font-semibold text-gray-900"><?php echo e(number_format($archive->jumlah_berkas)); ?>

                            berkas</p>
                    </div>

                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-paperclip text-blue-500 mr-2"></i>
                            <span class="text-sm font-medium text-gray-600">Lampiran Surat</span>
                        </div>
                        <p class="text-lg font-semibold text-gray-900"><?php echo e($archive->lampiran_surat); ?></p>
                    </div>

                    <!-- Storage Location -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                            <span class="text-sm font-medium text-gray-600">Lokasi Penyimpanan</span>
                        </div>
                        <?php if($archive->box_number): ?>
                            <p class="text-lg font-semibold text-gray-900">
                                <?php echo e($archive->storageRack ? $archive->storageRack->name : ($archive->rack_number ?? '-')); ?>, Baris <?php echo e($archive->row_number); ?>, Box
                                <?php echo e($archive->box_number); ?>, No. Arsip <?php echo e($archive->file_number); ?>

                            </p>
                        <?php else: ?>
                            <p class="text-lg font-semibold text-gray-500">Lokasi belum diatur</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6 bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-file-alt text-purple-500 mr-2"></i>
                        <span class="text-sm font-medium text-gray-600">Uraian Arsip</span>
                    </div>
                    <p class="text-gray-900 leading-relaxed"><?php echo e($archive->description); ?></p>
                </div>

                <!-- Document File -->
                <?php if($archive->file_path): ?>
                    <div class="mt-4 bg-green-50 border border-green-200 rounded-lg p-4 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-3 bg-green-100 rounded-lg">
                                <i class="fas fa-file-pdf text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-green-900">Softcopy Dokumen</h4>
                                <p class="text-xs text-green-700"><?php echo e(basename($archive->file_path)); ?></p>
                            </div>
                        </div>
                        <a href="<?php echo e(route('archives.file', $archive)); ?>" target="_blank"
                            class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                            <i class="fas fa-external-link-alt mr-2"></i>Lihat File
                        </a>
                    </div>
                    <div class="mt-4">
                        <?php if(\Illuminate\Support\Str::endsWith($archive->file_path, ['.pdf'])): ?>
                            <iframe src="<?php echo e(route('archives.file', $archive)); ?>" class="w-full h-96 rounded-lg border"></iframe>
                        <?php else: ?>
                            <img src="<?php echo e(route('archives.file', $archive)); ?>" alt="<?php echo e(basename($archive->file_path)); ?>" class="max-w-full rounded-lg border">
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Notes -->
                <?php if($archive->ket): ?>
                    <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-sticky-note text-blue-500 mr-2"></i>
                            <span class="text-sm font-medium text-blue-800">Keterangan</span>
                        </div>
                        <p class="text-blue-900"><?php echo e($archive->ket); ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Classification & Retention Info -->
            <div class="space-y-6">

                <!-- Classification Info -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-sitemap text-cyan-500 mr-2"></i>
                        Klasifikasi & Kategori
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kategori -->
                        <div class="bg-gray-50 rounded-lg p-5 border border-gray-100 shadow-sm">
                            <div class="flex items-center mb-3">
                                <i class="fas fa-folder text-indigo-500 mr-2"></i>
                                <span class="text-sm font-medium text-gray-600">Kategori</span>
                            </div>
                            <p class="text-indigo-900 text-base font-semibold">
                                <?php echo e($archive->category->nama_kategori ?? 'N/A'); ?>

                            </p>
                        </div>

                        <!-- Klasifikasi -->
                        <div class="bg-gray-50 rounded-lg p-5 border border-gray-100 shadow-sm">
                            <div class="flex items-center mb-3">
                                <i class="fas fa-tags text-cyan-500 mr-2"></i>
                                <span class="text-sm font-medium text-gray-600">Klasifikasi</span>
                            </div>
                            <p class="text-cyan-900 truncate-255 text-base font-semibold">
                                <?php echo e($archive->classification ? $archive->classification->code . ' - ' . $archive->classification->nama_klasifikasi : 'N/A'); ?>

                            </p>
                        </div>
                    </div>
                </div>


                <!-- Retention Info -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-clock mr-2 text-blue-500"></i>
                        Informasi Retensi
                    </h3>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <div>
                                <p class="text-sm text-green-600 font-medium">Retensi Aktif</p>
                                <p class="text-green-900 font-semibold"><?php echo e($archive->retention_aktif); ?> tahun</p>
                            </div>
                            <i class="fas fa-calendar-check text-green-500 text-xl"></i>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                            <div>
                                <p class="text-sm text-yellow-600 font-medium">Retensi Inaktif</p>
                                <p class="text-yellow-900 font-semibold"><?php echo e($archive->retention_inaktif); ?> tahun</p>
                            </div>
                            <i class="fas fa-calendar-times text-yellow-500 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-history mr-2 text-purple-500"></i>
                        Timeline Transisi
                    </h3>

                    <div class="space-y-3">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Transisi ke Inaktif</p>
                                <p class="text-xs text-gray-500">
                                    <?php echo e($archive->transition_active_due->format('d F Y')); ?>

                                </p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-purple-500 rounded-full mr-3"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Transisi Final</p>
                                <p class="text-xs text-gray-500">
                                    <?php echo e($archive->transition_inactive_due->format('d F Y')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- System Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-cog mr-2 text-gray-500"></i>
                Informasi Sistem
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-user-plus text-blue-500 mr-2"></i>
                        <span class="text-sm font-medium text-gray-600">Dibuat Oleh</span>
                    </div>
                    <p class="font-semibold text-gray-900"><?php echo e($archive->createdByUser->name ?? 'Mahasiswa Magang'); ?></p>
                    <p class="text-sm text-gray-500"><?php echo e($archive->created_at->format('d F Y, H:i')); ?> WIB</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-user-edit text-green-500 mr-2"></i>
                        <span class="text-sm font-medium text-gray-600">Terakhir Diperbarui</span>
                    </div>
                    <p class="font-semibold text-gray-900"><?php echo e($archive->updatedByUser->name ?? 'Mahasiswa Magang'); ?></p>
                    <p class="text-sm text-gray-500"><?php echo e($archive->updated_at->format('d F Y, H:i')); ?> WIB</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-tools mr-2 text-orange-500"></i>
                Aksi Tersedia
            </h3>

            <div class="flex flex-wrap gap-3">
                <a href="<?php echo e(route('admin.archives.edit', $archive)); ?>"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-colors shadow-sm">
                    <i class="fas fa-edit mr-2"></i>Edit Arsip
                </a>

                <a href="<?php echo e(route('admin.archives.related', $archive)); ?>"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-link mr-2"></i>
                    Arsip Terkait
                </a>
                <a href="<?php echo e(route('admin.archives.create-related', $archive)); ?>"
                    class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Tambah Berkas Arsip yang Sama
                </a>

                <?php if(Auth::user()->hasRole('admin')): ?>
                    <button type="button"
                        onclick="confirmDeleteArchive('<?php echo e($archive->index_number); ?>', '<?php echo e($archive->description); ?>')"
                        class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl transition-colors shadow-sm">
                        <i class="fas fa-trash mr-2"></i>Hapus Arsip
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function exportSingle(archiveId) {
                // Implement single archive export
                alert('Fitur export tunggal akan segera tersedia!');
            }

            function printArchive() {
                window.print();
            }

            function confirmDeleteArchive(indexNumber, description) {
                Swal.fire({
                    title: 'Konfirmasi Hapus Arsip',
                    html: `
                        <div class="text-left">
                            <p class="mb-3">Apakah Anda yakin ingin menghapus arsip ini?</p>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="font-semibold text-gray-800">Nomor Arsip: ${indexNumber}</p>
                                <p class="text-gray-600 text-sm">${description}</p>
                            </div>
                            <p class="text-red-600 text-sm mt-3">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Data akan hilang secara permanen dan tidak dapat dikembalikan!
                            </p>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: '<i class="fas fa-trash mr-2"></i>Hapus Arsip',
                    cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'swal2-confirm',
                        cancelButton: 'swal2-cancel'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Menghapus Arsip...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Create form and submit
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '<?php echo e(route('admin.archives.destroy', $archive)); ?>';

                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '<?php echo e(csrf_token()); ?>';

                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';

                        form.appendChild(csrfToken);
                        form.appendChild(methodField);
                        document.body.appendChild(form);

                        form.submit();
                    }
                });
            }
        </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH E:\New folder\Materi untag\INTERN\cobainiarsip\archivy-main (3)\archivy-main\resources\views/admin/archives/show.blade.php ENDPATH**/ ?>