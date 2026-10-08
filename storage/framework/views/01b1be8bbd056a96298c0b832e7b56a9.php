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
                    <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-edit text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-2xl text-gray-900">Edit Arsip</h2>
                        <p class="text-sm text-gray-600 mt-1">
                            <i class="fas fa-pencil-alt mr-1"></i>Ubah informasi dan data arsip: <?php echo e($archive->index_number); ?>

                        </p>
                        <?php if($archive->box_number): ?>
                            <p class="text-xs text-blue-600 mt-1">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                Lokasi: <?php echo e($archive->storageRack ? $archive->storageRack->name : ($archive->rack_number ?? '-')); ?>, Baris <?php echo e($archive->row_number); ?>, Box <?php echo e($archive->box_number); ?>, No. Arsip <?php echo e($archive->file_number); ?>

                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="<?php echo e(route('admin.archives.edit-location', $archive)); ?>"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                        <?php echo e($archive->box_number ? 'Edit Lokasi' : 'Set Lokasi'); ?>

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
    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            
            <?php if($errors->any()): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <h4 class="font-medium">Terdapat kesalahan:</h4>
                    </div>
                    <ul class="list-disc list-inside space-y-1">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="text-sm"><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.archives.update', $archive)); ?>" method="POST" class="space-y-6" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Information Notice -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-400 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-blue-800">Informasi Penting</h4>
                            <div class="mt-2 text-sm text-blue-700">
                                <p><strong>Kategori JRA:</strong> Sistem otomatis untuk retensi aktif/inaktif, dan nasib akhir</p>
                                <p><strong>Kategori Manual:</strong> Beberapa field mungkin memerlukan input manual sesuai peraturan pergub</p>
                                <p><strong>Kategori LAINNYA:</strong> Semua field retensi dan nasib akhir manual</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <?php echo $__env->make('components.ocr-system', ['archive' => $archive], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>





                <!-- Basic Information Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Informasi Dasar
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kategori -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-folder mr-2 text-indigo-500"></i>Kategori
                            </label>
                            <select name="category_id" id="category_id"
                                class="select2-dropdown w-full bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors py-3 px-4" required>
                                <option value="">Pilih Kategori...</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $archive->category_id) == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->nama_kategori); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Klasifikasi -->
                        <div>
                            <label for="classification_id" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-tags mr-2 text-cyan-500"></i>Klasifikasi
                            </label>
                            <select name="classification_id" id="classification_id"
                                class="select2-dropdown w-full bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors py-3 px-4" required>
                                <option value="">Pilih Klasifikasi...</option>
                            </select>
                            <?php $__errorArgs = ['classification_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Manual Input Indicator -->
                        <input type="hidden" name="is_manual_input" id="is_manual_input" value="<?php echo e(old('is_manual_input', $archive->is_manual_input ? '1' : '0')); ?>">

                        <!-- Nomor Arsip -->
                        <div id="index_number_container">
                            <label for="index_number" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-hashtag mr-2 text-green-500"></i>Nomor Arsip
                            </label>
                            <input type="text" name="index_number" id="index_number"
                                class="w-full bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors py-3 px-4"
                                value="<?php echo e(old('index_number', $archive->index_number)); ?>" required placeholder="Contoh: 001/SKPD">
                            <div id="index_number_example" class="mt-1 text-xs text-gray-500">
                                <strong>Format:</strong> Masukkan nomor arsip sesuai format yang diinginkan<br>
                                <small class="text-gray-600">Input manual sesuai format yang diinginkan</small>
                            </div>
                            <?php $__errorArgs = ['index_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Tanggal Arsip -->
                        <div>
                            <label for="kurun_waktu_start" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar-alt mr-2 text-orange-500"></i>Tanggal Arsip
                            </label>
                            <input type="date" name="kurun_waktu_start" id="kurun_waktu_start"
                                class="w-full bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors py-3 px-4"
                                value="<?php echo e(old('kurun_waktu_start', $archive->kurun_waktu_start->format('Y-m-d'))); ?>" required>
                            <?php $__errorArgs = ['kurun_waktu_start'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Uraian Arsip -->
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-file-alt mr-2 text-purple-500"></i>Uraian Arsip
                        </label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors py-3 px-4"
                            required placeholder="Masukkan uraian atau deskripsi arsip"><?php echo e(old('description', $archive->description)); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Lampiran Surat -->
                    <div class="mt-6">
                        <label for="lampiran_surat" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-paperclip mr-2 text-teal-500"></i>Lampiran Surat (Opsional)
                        </label>
                        <textarea name="lampiran_surat" id="lampiran_surat" rows="3"
                            class="w-full bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors py-3 px-4"
                            placeholder="Deskripsi lampiran arsip (bukan nomor arsip)"><?php echo e(old('lampiran_surat', $archive->lampiran_surat)); ?></textarea>
                        <?php $__errorArgs = ['lampiran_surat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Manual Input Fields (Hidden by default, shown for hybrid cases) -->
                <div id="manual_input_section" class="border-b border-gray-200 pb-6 <?php echo e($archive->is_manual_input ? '' : 'hidden'); ?>">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-edit mr-2 text-orange-500"></i>
                        Input Manual
                    </h3>

                    <div class="bg-orange-50 border border-orange-200 rounded-lg p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-orange-400 text-lg"></i>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-orange-800">Klasifikasi Manual</h4>
                                <div class="mt-1 text-sm text-orange-700">
                                    <p><strong>Field Informasi Retensi perlu diisi manual:</strong> Hanya field yang ditandai di bawah ini</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <!-- Manual Active Retention -->
                        <div id="manual_retention_aktif_group" class="hidden">
                            <label for="manual_retention_aktif" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-clock mr-2 text-orange-500"></i><span id="retention_aktif_label">Retensi Aktif Manual (Tahun)</span>
                            </label>
                            <input type="number" name="manual_retention_aktif" id="manual_retention_aktif" min="0"
                                class="w-full border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors py-3 px-4"
                                value="<?php echo e(old('manual_retention_aktif', $archive->manual_retention_aktif)); ?>" placeholder="Contoh: 2">
                            <?php $__errorArgs = ['manual_retention_aktif'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Manual Inactive Retention -->
                        <div id="manual_retention_inaktif_group" class="hidden">
                            <label for="manual_retention_inaktif" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-pause-circle mr-2 text-orange-500"></i><span id="retention_inaktif_label">Retensi Inaktif Manual (Tahun)</span>
                            </label>
                            <input type="number" name="manual_retention_inaktif" id="manual_retention_inaktif" min="0"
                                class="w-full border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors py-3 px-4"
                                value="<?php echo e(old('manual_retention_inaktif', $archive->manual_retention_inaktif)); ?>" placeholder="Contoh: 5">
                            <?php $__errorArgs = ['manual_retention_inaktif'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Manual Nasib Akhir -->
                        <div id="manual_nasib_akhir_group" class="hidden">
                            <label for="manual_nasib_akhir" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-flag mr-2 text-orange-500"></i><span id="nasib_akhir_label">Nasib Akhir Manual</span>
                            </label>
                            <select name="manual_nasib_akhir" id="manual_nasib_akhir"
                                class="w-full border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors py-3 px-4">
                                <option value="">Pilih Nasib Akhir...</option>
                                <option value="Musnah" <?php echo e(old('manual_nasib_akhir', $archive->manual_nasib_akhir) == 'Musnah' ? 'selected' : ''); ?>>Musnah</option>
                                <option value="Permanen" <?php echo e(old('manual_nasib_akhir', $archive->manual_nasib_akhir) == 'Permanen' ? 'selected' : ''); ?>>Permanen</option>
                                <option value="Dinilai Kembali" <?php echo e(old('manual_nasib_akhir', $archive->manual_nasib_akhir) == 'Dinilai Kembali' ? 'selected' : ''); ?>>Dinilai Kembali</option>
                                <option value="Masuk ke Berkas Perseorangan" <?php echo e(old('manual_nasib_akhir', $archive->manual_nasib_akhir) == 'Masuk ke Berkas Perseorangan' ? 'selected' : ''); ?>>Masuk ke Berkas Perseorangan</option>
                            </select>
                            <?php $__errorArgs = ['manual_nasib_akhir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Archive Details Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-cogs mr-2 text-green-500"></i>
                        Detail Arsip
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tingkat Perkembangan (Manual Input) -->
                        <div>
                            <label for="tingkat_perkembangan" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-layer-group mr-2 text-yellow-500"></i>Tingkat Perkembangan
                            </label>
                            <input type="text" name="tingkat_perkembangan" id="tingkat_perkembangan"
                                class="w-full bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors py-3 px-4"
                                value="<?php echo e(old('tingkat_perkembangan', $archive->tingkat_perkembangan)); ?>" required placeholder="Contoh: Asli, Salinan, Tembusan">
                            <?php $__errorArgs = ['tingkat_perkembangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- SKKAD -->
                        <div>
                            <label for="skkad" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-shield-alt mr-2 text-red-500"></i>SKKAD (Sifat Keamanan)
                            </label>
                            <select name="skkad" id="skkad"
                                class="w-full bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors py-3 px-4" required>
                                <option value="">Pilih SKKAD...</option>
                                <option value="SANGAT RAHASIA" <?php echo e(old('skkad', $archive->skkad) == 'SANGAT RAHASIA' ? 'selected' : ''); ?>>SANGAT RAHASIA</option>
                                <option value="TERBATAS" <?php echo e(old('skkad', $archive->skkad) == 'TERBATAS' ? 'selected' : ''); ?>>TERBATAS</option>
                                <option value="RAHASIA" <?php echo e(old('skkad', $archive->skkad) == 'RAHASIA' ? 'selected' : ''); ?>>RAHASIA</option>
                                <option value="BIASA/TERBUKA" <?php echo e(old('skkad', $archive->skkad) == 'BIASA/TERBUKA' ? 'selected' : ''); ?>>BIASA/TERBUKA</option>
                            </select>
                            <?php $__errorArgs = ['skkad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Jumlah Berkas -->
                        <div>
                            <label for="jumlah_berkas" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-sort-numeric-up mr-2 text-blue-500"></i>Jumlah Berkas
                            </label>
                            <input type="number" name="jumlah_berkas" id="jumlah_berkas" min="1" step="1"
                                class="w-full bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors py-3 px-4"
                                value="<?php echo e(old('jumlah_berkas', $archive->jumlah_berkas)); ?>" required placeholder="Masukkan jumlah berkas">
                            <?php $__errorArgs = ['jumlah_berkas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="mt-6">
                        <label for="ket" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-sticky-note mr-2 text-pink-500"></i>Keterangan (Opsional)
                        </label>
                        <textarea name="ket" id="ket" rows="3"
                            class="w-full bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors py-3 px-4"
                            placeholder="Tambahkan keterangan tambahan jika diperlukan"><?php echo e(old('ket', $archive->ket)); ?></textarea>
                        <?php $__errorArgs = ['ket'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Retention Information (Editable) -->
                <div id="retention_section">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-hourglass-half mr-2 text-amber-500"></i>
                        Informasi Retensi
                    </h3>
                    <div id="retention_info" class="bg-gray-50 p-4 rounded-xl">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div class="bg-green-100 p-3 rounded-lg">
                                <div class="font-medium text-green-800 mb-1">Retensi Aktif (Tahun)</div>
                                <input type="number" name="manual_retention_aktif" class="w-full border-green-300 rounded-md text-sm shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50" value="<?php echo e(old('manual_retention_aktif', $archive->retention_aktif)); ?>" required>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-lg">
                                <div class="font-medium text-yellow-800 mb-1">Retensi Inaktif (Tahun)</div>
                                <input type="number" name="manual_retention_inaktif" class="w-full border-yellow-300 rounded-md text-sm shadow-sm focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50" value="<?php echo e(old('manual_retention_inaktif', $archive->retention_inaktif)); ?>" required>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-lg">
                                <div class="font-medium text-purple-800 mb-1">Nasib Akhir</div>
                                <select name="manual_nasib_akhir" class="w-full border-purple-300 rounded-md text-sm shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50" required>
                                    <option value="">Pilih Nasib Akhir...</option>
                                    <option value="Musnah" <?php echo e(old('manual_nasib_akhir', $archive->nasib_akhir) == 'Musnah' ? 'selected' : ''); ?>>Musnah</option>
                                    <option value="Permanen" <?php echo e(old('manual_nasib_akhir', $archive->nasib_akhir) == 'Permanen' ? 'selected' : ''); ?>>Permanen</option>
                                    <option value="Dinilai Kembali" <?php echo e(old('manual_nasib_akhir', $archive->nasib_akhir) == 'Dinilai Kembali' ? 'selected' : ''); ?>>Dinilai Kembali</option>
                                    <option value="Masuk ke Berkas Perseorangan" <?php echo e(old('manual_nasib_akhir', $archive->nasib_akhir) == 'Masuk ke Berkas Perseorangan' ? 'selected' : ''); ?>>Masuk ke Berkas Perseorangan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                    <a href="<?php echo e(route('admin.archives.index')); ?>"
                        class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Update Arsip
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php $__env->startPush('styles'); ?>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            .select2-container--default .select2-selection--single {
                height: 48px;
                border: 1px solid #d1d5db;
                border-radius: 0.75rem;
                padding: 0 12px;
                font-size: 14px;
                display: flex;
                align-items: center;
            }
            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 48px;
                padding: 0;
            }
            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 46px;
                right: 12px;
            }
            .select2-dropdown {
                border: 1px solid #d1d5db;
                border-radius: 0.75rem;
                margin-top: 4px;
            }
        </style>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('scripts'); ?>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                // Initialize Select2
                $('#category_id, #classification_id').select2({
                    theme: 'default',
                    width: '100%',
                    placeholder: 'Pilih...'
                });

                // Store all classifications and categories data
                const allClassifications = <?php echo json_encode($classifications, 15, 512) ?>;
                const allCategories = <?php echo json_encode($categories, 15, 512) ?>;

                // Find LAINNYA category
                const lainnyaCategory = allCategories.find(c => c.nama_kategori === 'LAINNYA');
                const lainnyaCategoryId = lainnyaCategory ? lainnyaCategory.id : null;

                function updateRetentionInfoFromClassification(classificationId) {
                    const retentionSection = $('#retention_section');
                    const retentionInfo = $('#retention_info');

                    if (!classificationId) {
                        // If no classification selected, clear the fields or set to default
                        $('input[name="manual_retention_aktif"]').val('');
                        $('input[name="manual_retention_inaktif"]').val('');
                        $('select[name="manual_nasib_akhir"]').val('');
                        return;
                    }

                    const classification = allClassifications.find(c => c.id == classificationId);
                    if (classification) {
                        // Get values from database (JRA defaults)
                        const activeYears = classification.retention_aktif || 0;
                        const inactiveYears = classification.retention_inaktif || 0;
                        const nasibAkhir = classification.nasib_akhir || ''; // Use empty string for default select

                        // Update the input fields directly
                        $('input[name="manual_retention_aktif"]').val(activeYears);
                        $('input[name="manual_retention_inaktif"]').val(inactiveYears);
                        $('select[name="manual_nasib_akhir"]').val(nasibAkhir);
                    }
                }

                function toggleManualInput(isManual) {
                    const manualSection = $('#manual_input_section');
                    const isManualInput = $('#is_manual_input');
                    const retentionSection = $('#retention_section');
                    
                    // Always enable manual input mode
                    isManualInput.val('1'); 
                    
                    // Hide the old dedicated manual section
                    manualSection.addClass('hidden');
                    
                    // Show retention info section
                    retentionSection.removeClass('hidden');
                }

                function populateClassifications(categoryId, selectedClassificationId = null) {
                    const classificationSelect = $('#classification_id');
                    classificationSelect.empty().append('<option value="">Pilih Klasifikasi...</option>');

                    // Show all classifications if no category selected OR if LAINNYA category is selected
                    const filteredClassifications = (categoryId && categoryId != lainnyaCategoryId) ?
                        allClassifications.filter(c => c.category_id == categoryId) :
                        allClassifications;

                    filteredClassifications.forEach(function(classification) {
                        const isSelected = classification.id == selectedClassificationId;
                        classificationSelect.append(new Option(
                            `${classification.code} - ${classification.nama_klasifikasi}`,
                            classification.id, false, isSelected
                        ));
                    });
                    classificationSelect.trigger('change.select2');
                }

                // Event Handlers
                $('#category_id').on('change', function() {
                    const categoryId = $(this).val();
                    const isLainnya = categoryId == lainnyaCategoryId;
                    
                    toggleManualInput(isLainnya);

                       const currentClassId = $('#classification_id').val();
                    const currentClass = allClassifications.find(c => c.id == currentClassId);
                    
    
                     populateClassifications(categoryId); 
                     $('#classification_id').val('').trigger('change.select2');

                     updateRetentionInfoFromClassification(null); // Clear retention info
                });

                $('#classification_id').on('change', function() {
                    const classificationId = $(this).val();

                    if (classificationId) {
                        const selectedClassification = allClassifications.find(c => c.id == classificationId);
                        const currentCategoryId = $('#category_id').val();

 
                         if (selectedClassification && 
                            currentCategoryId != selectedClassification.category_id && 
                            currentCategoryId != lainnyaCategoryId) {
                            $('#category_id').val(selectedClassification.category_id).trigger('change.select2');
                        }
                        
                        // Update retention info with new classification defaults
                        updateRetentionInfoFromClassification(classificationId);
                        toggleManualInput(true); // Ensure manual flag is on
                    } else {
                        updateRetentionInfoFromClassification(null); // Clear retention info if classification is unselected
                    }
                });

                // Initial Load Logic
                const existingCategoryId = '<?php echo e($archive->category_id); ?>';
                const existingClassificationId = '<?php echo e($archive->classification_id); ?>';
                
                // Initialize manual input to true
                toggleManualInput(true);

                if (existingCategoryId) {
                    populateClassifications(existingCategoryId, existingClassificationId);
                } else {
                     populateClassifications(null);
                }
                

                // File Upload Preview Logic
                const fileInput = $('#file_path');
                const dropZone = $('#drop-zone');
                const previewContainer = $('#preview-container');
                const pdfPreview = $('#pdf-preview');
                const imagePreview = $('#image-preview');
                const noPreview = $('#no-preview');
                const fileNameDisplay = $('#file-name-display');
                const removeFilePreviewBtn = $('#remove-file-preview');
                
                // Fullscreen Elements
                const maximizeBtn = $('#maximize-preview');
                const fullscreenModal = $('#fullscreen-modal');
                const closeFullscreenBtn = $('#close-fullscreen');
                const fullscreenPdf = $('#fullscreen-pdf');
                const fullscreenImage = $('#fullscreen-image');

                function handleFile(file) {
                    if (file) {
                        fileNameDisplay.text(file.name).removeClass('hidden');
                        previewContainer.removeClass('hidden');
                        removeFilePreviewBtn.removeClass('hidden');
                        maximizeBtn.removeClass('hidden');

                        const fileType = file.type;
                        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
                        const validPdfTypes = ['application/pdf'];

                        if (validImageTypes.includes(fileType)) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                imagePreview.attr('src', e.target.result).removeClass('hidden');
                                pdfPreview.addClass('hidden');
                                noPreview.addClass('hidden');
                            }
                            reader.readAsDataURL(file);
                        } else if (validPdfTypes.includes(fileType)) {
                            const fileURL = URL.createObjectURL(file);
                            pdfPreview.attr('src', fileURL).removeClass('hidden');
                            imagePreview.addClass('hidden');
                            noPreview.addClass('hidden');
                        } else {
                            imagePreview.addClass('hidden');
                            pdfPreview.addClass('hidden');
                            noPreview.removeClass('hidden');
                            maximizeBtn.addClass('hidden');
                        }
                    }
                }

                fileInput.on('change', function() {
                    handleFile(this.files[0]);
                });

                removeFilePreviewBtn.on('click', function() {
                    fileInput.val('');
                    // Reload page to reset state is simplest if user wants to cancel substitution
                    location.reload(); 
                });
                
                // Fullscreen Handlers
                maximizeBtn.on('click', function() {
                    // Determine which mode to show based on visibility in normal preview
                    // For edit view, we copy src dynamically because it could be existing file or new blob
                    if (!pdfPreview.hasClass('hidden')) {
                        fullscreenPdf.attr('src', pdfPreview.attr('src'));
                        fullscreenPdf.removeClass('hidden');
                        fullscreenImage.addClass('hidden');
                    } else if (!imagePreview.hasClass('hidden')) {
                        fullscreenImage.attr('src', imagePreview.attr('src'));
                        fullscreenImage.removeClass('hidden');
                        fullscreenPdf.addClass('hidden');
                    }
                    fullscreenModal.removeClass('hidden');
                    $('body').css('overflow', 'hidden'); // Prevent scrolling
                });
                
                closeFullscreenBtn.on('click', function() {
                    fullscreenModal.addClass('hidden');
                    $('body').css('overflow', ''); // Restore scrolling
                    fullscreenPdf.attr('src', ''); // Clear src to stop video/audio if applicable
                    fullscreenImage.attr('src', '');
                });
                
                // Close on click outside
                fullscreenModal.on('click', function(e) {
                    if (e.target === this) {
                        fullscreenModal.addClass('hidden');
                        $('body').css('overflow', '');
                        fullscreenPdf.attr('src', '');
                        fullscreenImage.attr('src', '');
                    }
                });

                // Drag and Drop
                dropZone.on('dragover', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).addClass('border-orange-500 bg-orange-50');
                });

                dropZone.on('dragleave', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).removeClass('border-orange-500 bg-orange-50');
                });

                dropZone.on('drop', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).removeClass('border-orange-500 bg-orange-50');
                    
                    const files = e.originalEvent.dataTransfer.files;
                    if (files.length > 0) {
                        fileInput[0].files = files;
                        handleFile(files[0]);
                    }
                });
            });
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
```
<?php /**PATH E:\New folder\Materi untag\INTERN\cobainiarsip\archivy-main (3)\archivy-main\resources\views/admin/archives/edit.blade.php ENDPATH**/ ?>