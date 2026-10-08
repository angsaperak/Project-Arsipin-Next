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
                    <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-warehouse text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-2xl text-gray-900">Manajemen Lokasi Arsip</h2>
                        <p class="text-sm text-gray-600 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>Kelola rak, baris, dan kapasitas penyimpanan arsip
                        </p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="<?php echo e(route('admin.storage-management.create')); ?>"
                        class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors">
                        <i class="fas fa-plus mr-2"></i>Tambah Rak
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="p-6 space-y-6">
        <?php if(session('success')): ?>
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?php echo e(session('success')); ?>

                </div>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <?php echo e(session('error')); ?>

                </div>
            </div>
        <?php endif; ?>

        <!-- Racks Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $racks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rack): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900"><?php echo e($rack->name); ?></h3>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            <?php echo e($rack->status === 'active' ? 'bg-green-100 text-green-800' :
                               ($rack->status === 'inactive' ? 'bg-gray-100 text-gray-800' :
                               'bg-red-100 text-red-800')); ?>">
                            <?php echo e(ucfirst($rack->status)); ?>

                        </span>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Total Baris:</span>
                            <span class="font-semibold"><?php echo e($rack->total_rows); ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Total Box:</span>
                            <span class="font-semibold"><?php echo e($rack->total_boxes); ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Kapasitas per Box:</span>
                            <span class="font-semibold"><?php echo e($rack->capacity_per_box); ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Box Tersedia:</span>
                            <span class="font-semibold text-green-600"><?php echo e($rack->getAvailableBoxesCount()); ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Utilisasi:</span>
                            <span class="font-semibold"><?php echo e($rack->getUtilizationPercentage()); ?>%</span>
                        </div>
                    </div>

                    <?php if($rack->description): ?>
                        <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-600"><?php echo e($rack->description); ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Progress Bar -->
                    <div class="mt-4">
                        <div class="flex items-center justify-between text-xs text-gray-600 mb-1">
                            <span>Kapasitas</span>
                            <span><?php echo e($rack->getUtilizationPercentage()); ?>%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full transition-all duration-300"
                                style="width: <?php echo e($rack->getUtilizationPercentage()); ?>%"></div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200">
                        <a href="<?php echo e(route('admin.storage-management.show', $rack->id)); ?>"
                            class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs rounded-lg transition-colors">
                            <i class="fas fa-eye mr-1"></i>Detail
                        </a>
                        <a href="<?php echo e(route('admin.storage-management.edit', $rack->id)); ?>"
                            class="inline-flex items-center px-3 py-1 bg-yellow-600 hover:bg-yellow-700 text-white text-xs rounded-lg transition-colors">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <button onclick="confirmDeleteRack(<?php echo e($rack->id); ?>, '<?php echo e($rack->name); ?>')"
                            class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs rounded-lg transition-colors">
                            <i class="fas fa-trash mr-1"></i>Hapus
                        </button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if($racks->isEmpty()): ?>
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-warehouse text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada rak</h3>
                <p class="text-gray-600 mb-6">Mulai dengan membuat rak pertama untuk penyimpanan arsip</p>
                <a href="<?php echo e(route('admin.storage-management.create')); ?>"
                    class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-plus mr-2"></i>Tambah Rak Pertama
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeleteRack(rackId, rackName) {
            Swal.fire({
                title: 'Konfirmasi Hapus Rak',
                html: `
                    <div class="text-left">
                        <p class="mb-3">Apakah Anda yakin ingin menghapus rak ini?</p>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <p class="font-semibold text-gray-800">Nama Rak: ${rackName}</p>
                        </div>
                        <p class="text-red-600 text-sm mt-3">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Rak akan dihapus secara permanen!
                        </p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fas fa-trash mr-2"></i>Hapus Rak',
                cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/storage-management/${rackId}`;

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
<?php /**PATH E:\New folder\Materi untag\INTERN\cobainiarsip\archivy-main (3)\archivy-main\resources\views/admin/storage-management/index.blade.php ENDPATH**/ ?>