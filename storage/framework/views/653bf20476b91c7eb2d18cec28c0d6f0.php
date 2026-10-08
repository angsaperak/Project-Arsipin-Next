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
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clipboard-check text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-2xl text-gray-900">Detail Arsip Dinilai Kembali</h2>
                        <p class="text-sm text-gray-600 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>Lihat detail arsip yang memerlukan penilaian ulang
                        </p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="<?php echo e(route('admin.re-evaluation.index')); ?>"
                        class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button onclick="deleteArchive()"
                        class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        <i class="fas fa-trash mr-2"></i>Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Archive Details -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Arsip</h3>
                        <span
                            class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                            <?php if($archive->status === 'Aktif'): ?> bg-green-100 text-green-800
                            <?php elseif($archive->status === 'Inaktif'): ?> bg-yellow-100 text-yellow-800
                            <?php elseif($archive->status === 'Permanen'): ?> bg-blue-100 text-blue-800
                            <?php elseif($archive->status === 'Musnah'): ?> bg-red-100 text-red-800
                            <?php elseif($archive->status === 'Dinilai Kembali'): ?> bg-indigo-100 text-indigo-800
                            <?php else: ?> bg-gray-100 text-gray-800 <?php endif; ?>">
                            <?php echo e($archive->status); ?>

                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Information -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Arsip</label>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <?php echo e($archive->index_number ?? 'N/A'); ?>

                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Uraian</label>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <?php echo e($archive->description); ?>

                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <?php echo e($archive->category->nama_kategori ?? 'N/A'); ?>

                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Klasifikasi</label>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <?php echo e($archive->classification->code ?? 'N/A'); ?> -
                                    <?php echo e($archive->classification->nama_klasifikasi ?? 'N/A'); ?>

                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Penyimpanan</label>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <?php if($archive->hasStorageLocation()): ?>
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                            <i class="fas fa-check mr-1"></i>Ditempatkan
                                        </span>
                                        <p class="text-sm text-gray-600 mt-2">
                                            <?php if($archive->storageRack): ?>
                                                <div class="font-medium text-blue-600"><?php echo e($archive->storageRack->name); ?></div>
                                                <div class="text-gray-600">Box: <?php echo e($archive->box_number); ?>, Baris: <?php echo e($archive->row_number); ?></div>
                                            <?php else: ?>
                                                Rak <?php echo e($archive->rack_number); ?>,
                                                Box <?php echo e($archive->box_number); ?>,
                                                Baris <?php echo e($archive->row_number); ?>

                                            <?php endif; ?>
                                        </p>
                                    <?php else: ?>
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                            <i class="fas fa-times mr-1"></i>Belum Ditempatkan
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Dibuat Oleh</label>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <?php echo e($archive->createdByUser->name ?? 'N/A'); ?>

                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dibuat</label>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <?php echo e($archive->created_at ? $archive->created_at->format('d/m/Y H:i') : 'N/A'); ?>

                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Terakhir Diupdate</label>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <?php echo e($archive->updated_at ? $archive->updated_at->format('d/m/Y H:i') : 'N/A'); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Evaluation Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Evaluasi Arsip</h3>

                    <form id="evaluationForm" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <div>
                            <label for="new_status" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-flag mr-2 text-yellow-500"></i>Status Baru
                            </label>
                            <select id="new_status" name="new_status" required
                                class="w-full bg-white border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors py-3 px-4">
                                <option value="">Pilih Status</option>
                                <option value="Aktif" <?php echo e($archive->status === 'Aktif' ? 'selected' : ''); ?>>Aktif
                                </option>
                                <option value="Inaktif" <?php echo e($archive->status === 'Inaktif' ? 'selected' : ''); ?>>Inaktif
                                </option>
                                <option value="Permanen" <?php echo e($archive->status === 'Permanen' ? 'selected' : ''); ?>>
                                    Permanen</option>
                                <option value="Musnah" <?php echo e($archive->status === 'Musnah' ? 'selected' : ''); ?>>Musnah
                                </option>
                                <option value="Dinilai Kembali" <?php echo e($archive->status === 'Dinilai Kembali' ? 'selected' : ''); ?>>Dinilai Kembali (Simpan Catatan)
                                </option>
                                <option value="Berkas Perseorangan" <?php echo e($archive->status === 'Berkas Perseorangan' ? 'selected' : ''); ?>>Berkas Perseorangan
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="evaluation_notes" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-sticky-note mr-2 text-blue-500"></i>Catatan Evaluasi
                            </label>
                            <textarea id="evaluation_notes" name="evaluation_notes" rows="4"
                                class="w-full bg-white border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors py-3 px-4"
                                placeholder="Masukkan catatan evaluasi..."><?php echo e($archive->evaluation_notes); ?></textarea>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="window.history.back()"
                                class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                <i class="fas fa-times mr-2"></i>Batal
                            </button>
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                <i class="fas fa-save mr-2"></i>Simpan Evaluasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Related Archives -->
            

    <?php $__env->startPush('scripts'); ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Evaluation form submission
            $('#evaluationForm').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                Swal.fire({
                    title: 'Memproses...',
                    text: 'Menyimpan evaluasi',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '<?php echo e(route('admin.re-evaluation.update-status', $archive)); ?>',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Berhasil!', response.message, 'success');
                            setTimeout(() => {
                                window.location.href = '<?php echo e(route('admin.re-evaluation.index')); ?>';
                            }, 1500);
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Terjadi kesalahan saat menyimpan evaluasi', 'error');
                    }
                });
            });

            // Delete archive functionality
            function deleteArchive() {
                Swal.fire({
                    title: 'Konfirmasi Penghapusan',
                    text: 'Anda yakin ingin menghapus arsip ini? Tindakan ini tidak dapat dibatalkan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Memproses...',
                            text: 'Menghapus arsip',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: '<?php echo e(route('admin.archives.destroy', $archive)); ?>',
                            method: 'DELETE',
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire('Berhasil!', 'Arsip berhasil dihapus', 'success');
                                    setTimeout(() => {
                                        window.location.href =
                                            '<?php echo e(route('admin.re-evaluation.index')); ?>';
                                    }, 1500);
                                } else {
                                    Swal.fire('Error!', response.message, 'error');
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', 'Terjadi kesalahan saat menghapus arsip', 'error');
                            }
                        });
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
<?php /**PATH E:\New folder\Materi untag\INTERN\cobainiarsip\archivy-main (3)\archivy-main\resources\views/admin/re-evaluation/show.blade.php ENDPATH**/ ?>