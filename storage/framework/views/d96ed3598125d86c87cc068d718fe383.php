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
    <!-- Page Header with Better Layout -->
    <div class="bg-white shadow-sm border-b">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Left Side - Title & Greetings -->
                <div class="flex-1">
                    <div class="flex items-baseline space-x-4">
                        <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
                        
                    </div>
                    
                </div>

                <!-- Right Side - Time, Email, Profile -->
                <div class="flex items-center space-x-6">
                    <!-- Time -->
                    

                    <!-- Email -->
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900"><?php echo e(Auth::user()->name); ?></p>
                        <p class="text-xs text-gray-500"><?php echo e(Auth::user()->email); ?></p>
                    </div>

                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                <span
                                    class="text-white font-semibold text-sm"><?php echo e(substr(Auth::user()->username, 0, 1)); ?></span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">

                            <div class="py-2">
                                <a href="<?php echo e(route('profile.edit')); ?>"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <i class="fas fa-user-cog mr-3 text-gray-400"></i>
                                    Edit Profile
                                </a>

                                <div class="border-t border-gray-100 my-1"></div>

                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit"
                                        class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <i class="fas fa-sign-out-alt mr-3 text-red-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Content -->
    <div class="p-6 space-y-8 max-w-full">

        <!-- Welcome Greeting -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <?php
                        $hour = now()->hour;
                        $greeting =
                            $hour < 12
                                ? 'Selamat Pagi'
                                : ($hour < 15
                                    ? 'Selamat Siang'
                                    : ($hour < 18
                                        ? 'Selamat Sore'
                                        : 'Selamat Malam'));
                    ?>
                    <h2 class="text-2xl font-bold mb-2"><?php echo e($greeting); ?>, <?php echo e(Auth::user()->username); ?>! 👋</h2>
                    <p class="text-blue-100">Selamat datang di ARSIPIN. Mari kelola arsip digital dengan efisien!</p>
                </div>
                <div class="text-right text-blue-100">
                    <p class="text-lg font-semibold"><?php echo e(now()->format('H:i')); ?> WIB</p>
                    <p class="text-sm"><?php echo e(now()->translatedFormat('l, d F Y')); ?></p>
                </div>
            </div>
        </div>

        <!-- Notification Examples -->
        

        <!-- Archive Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Arsip -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Arsip</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($totalArchives ?? 0); ?></p>
                        <p class="text-xs text-gray-500 mt-1">Semua status arsip</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-archive text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Arsip Aktif -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Arsip Aktif</p>
                        <p class="text-3xl font-bold text-green-600 mt-2"><?php echo e($activeArchives ?? 0); ?></p>
                        <p class="text-xs text-gray-500 mt-1">
                            <?php echo e($totalArchives > 0 ? round((($activeArchives ?? 0) / $totalArchives) * 100, 1) : 0); ?>%
                            dari total
                        </p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-folder-open text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Arsip Inaktif -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Arsip Inaktif</p>
                        <p class="text-3xl font-bold text-yellow-600 mt-2"><?php echo e($inactiveArchives ?? 0); ?></p>
                        <p class="text-xs text-gray-500 mt-1">
                            <?php echo e($totalArchives > 0 ? round((($inactiveArchives ?? 0) / $totalArchives) * 100, 1) : 0); ?>%
                            dari total
                        </p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-folder text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Arsip Permanen -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Arsip Permanen</p>
                        <p class="text-3xl font-bold text-purple-600 mt-2"><?php echo e($permanentArchives ?? 0); ?></p>
                        <p class="text-xs text-gray-500 mt-1">
                            <?php echo e($totalArchives > 0 ? round((($permanentArchives ?? 0) / $totalArchives) * 100, 1) : 0); ?>%
                            dari total
                        </p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Arsip Musnah -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Arsip Musnah</p>
                        <p class="text-3xl font-bold text-red-600 mt-2"><?php echo e($destroyedArchives ?? 0); ?></p>
                        <p class="text-xs text-gray-500 mt-1">Sudah dimusnahkan</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-trash-alt text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Input Bulan Ini -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Input Bulan Ini</p>
                        <p class="text-3xl font-bold text-indigo-600 mt-2"><?php echo e($thisMonthArchives ?? 0); ?></p>
                        <p class="text-xs text-gray-500 mt-1">Arsip baru di <?php echo e(now()->format('F Y')); ?></p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-plus-circle text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Retensi Mendekati -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Retensi Mendekati</p>
                        <p class="text-3xl font-bold text-orange-600 mt-2"><?php echo e($nearRetention ?? 0); ?></p>
                        <p class="text-xs text-gray-500 mt-1">30 hari ke depan</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-white text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Re-evaluation Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-clipboard-check mr-2 text-indigo-600"></i>Arsip Dinilai Kembali
                </h3>
                <a href="<?php echo e(route('admin.re-evaluation.index')); ?>"
                    class="inline-flex items-center px-3 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition ease-in-out duration-150">
                    <i class="fas fa-eye mr-1"></i>Lihat Detail
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-indigo-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-clipboard-check text-indigo-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-indigo-600">Total Dinilai Kembali</p>
                            <p class="text-2xl font-bold text-indigo-900"><?php echo e($reEvaluationCount ?? 0); ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-yellow-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-yellow-600">Menunggu Evaluasi</p>
                            <p class="text-2xl font-bold text-yellow-900"><?php echo e($waitingEvaluationCount ?? 0); ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-green-600">Sudah Dievaluasi</p>
                            <p class="text-2xl font-bold text-green-900"><?php echo e($evaluatedCount ?? 0); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts & Quick Actions Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Status Distribution Chart -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Distribusi Status Arsip</h3>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-xs text-gray-600">Realtime</span>
                    </div>
                </div>

                <!-- Chart Container -->
                <div class="relative h-48">
                    <canvas id="statusChart"></canvas>
                </div>

                <!-- Legend -->
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                        <span class="text-sm text-gray-700">Aktif (<?php echo e($activeArchives ?? 0); ?>)</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-yellow-500 rounded mr-2"></div>
                        <span class="text-sm text-gray-700">Inaktif (<?php echo e($inactiveArchives ?? 0); ?>)</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-purple-500 rounded mr-2"></div>
                        <span class="text-sm text-gray-700">Permanen (<?php echo e($permanentArchives ?? 0); ?>)</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-red-500 rounded mr-2"></div>
                        <span class="text-sm text-gray-700">Musnah (<?php echo e($destroyedArchives ?? 0); ?>)</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions 1 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Quick Actions</h3>
                <div class="space-y-4">
                    <a href="<?php echo e(route('admin.archives.create')); ?>"
                        class="flex items-center justify-between p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors group">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-plus text-white"></i>
                            </div>
                            <span class="font-medium text-gray-900">Input Arsip Baru</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-500"></i>
                    </a>

                    <a href="<?php echo e(route('admin.archives.index')); ?>"
                        class="flex items-center justify-between p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors group">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-search text-white"></i>
                            </div>
                            <span class="font-medium text-gray-900">Cari Arsip</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-green-500"></i>
                    </a>

                    <a href="<?php echo e(route('admin.bulk.index')); ?>"
                        class="flex items-center justify-between p-4 bg-orange-50 hover:bg-orange-100 rounded-lg transition-colors group">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-tasks text-white"></i>
                            </div>
                            <span class="font-medium text-gray-900">Operasi Massal</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-orange-500"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Actions 2 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Fitur Lainnya</h3>
                <div class="space-y-4">
                    <a href="<?php echo e(route('admin.categories.index')); ?>"
                        class="flex items-center justify-between p-4 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors group">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-indigo-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-tags text-white"></i>
                            </div>
                            <span class="font-medium text-gray-900">Master Kategori</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-indigo-500"></i>
                    </a>

                    <a href="<?php echo e(route('admin.classifications.index')); ?>"
                        class="flex items-center justify-between p-4 bg-cyan-50 hover:bg-cyan-100 rounded-lg transition-colors group">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-cyan-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-sitemap text-white"></i>
                            </div>
                            <span class="font-medium text-gray-900">Master Klasifikasi</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-cyan-500"></i>
                    </a>

                    <!-- Download Manual Book -->
                    <a href="<?php echo e(asset('manuals/Manual Book - ARSIPIN.pdf')); ?>" target="_blank"
                        class="flex items-center justify-between p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors group">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-book text-white"></i>
                            </div>
                            <span class="font-medium text-gray-900">Download Manual Book</span>
                        </div>
                        <i class="fas fa-download text-gray-400 group-hover:text-purple-500"></i>
                    </a>

                    <a href="<?php echo e(route('admin.search.index')); ?>"
                        class="flex items-center justify-between p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors group">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-search-plus text-white"></i>
                            </div>
                            <span class="font-medium text-gray-900">Pencarian Lanjutan</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-purple-500"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                <a href="<?php echo e(route('admin.archives.index')); ?>"
                    class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Semua →</a>
            </div>

            <div class="space-y-4">
                <?php $__empty_1 = true; $__currentLoopData = $recentArchives ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $archive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div
                        class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                <?php echo e($archive->description ?? 'Arsip Baru'); ?></p>
                            <p class="text-xs text-gray-500">
                                <?php echo e($archive->classification ? $archive->classification->code . ' - ' . $archive->classification->nama_klasifikasi : 'N/A'); ?>

                            </p>
                            <p class="text-xs text-gray-400 mt-1">Oleh:
                                <?php echo e($archive->createdByUser->name ?? 'System'); ?></p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">
                                <?php echo e($archive->created_at ? $archive->created_at->diffForHumans() : 'Baru saja'); ?></p>
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium mt-1
                                <?php echo e(($archive->status ?? 'Aktif') === 'Aktif'
                                    ? 'bg-green-100 text-green-800'
                                    : (($archive->status ?? 'Aktif') === 'Inaktif'
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : (($archive->status ?? 'Aktif') === 'Permanen'
                                            ? 'bg-purple-100 text-purple-800'
                                            : (($archive->status ?? 'Aktif') === 'Musnah'
                                                ? 'bg-red-100 text-red-800'
                                                : (($archive->status ?? 'Aktif') === 'Dinilai Kembali'
                                                    ? 'bg-indigo-200 text-indigo-800'
                                                    : (($archive->status ?? 'Aktif') === 'Berkas Perseorangan'
                                                        ? 'bg-indigo-100 text-indigo-800'
                                                        : 'bg-red-100 text-red-800')))))); ?>">
                                <?php echo e(ucfirst($archive->status ?? 'Aktif')); ?>

                            </span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-12">
                        <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500 text-lg mb-2">Belum ada aktivitas terbaru</p>
                        <p class="text-gray-400 text-sm mb-4">Mulai input arsip untuk melihat aktivitas di sini</p>
                        <a href="<?php echo e(route('admin.archives.create')); ?>"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Input Arsip Pertama
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- System Status Footer -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold mb-2">Sistem ARSIPIN</h3>
                    <p class="text-blue-100">Sistem arsip pintar dengan automasi Peraturan JRA (Jadwal Retensi Arsip) Gubernur Provinsi Jawa Timur </p>
                    <p class="text-blue-200 text-sm mt-2">DPMPTSP Provinsi Jawa Timur</p>
                </div>
                <div class="text-right">
                    <div class="flex items-center justify-end space-x-2 mb-2">
                        <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-sm font-medium">Status: Online</span>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Status Distribution Pie Chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Aktif', 'Inaktif', 'Permanen', 'Musnah', 'Dinilai Kembali'],
                    datasets: [{
                        data: [
                            <?php echo e($activeArchives ?? 0); ?>,
                            <?php echo e($inactiveArchives ?? 0); ?>,
                            <?php echo e($permanentArchives ?? 0); ?>,
                            <?php echo e($destroyedArchives ?? 0); ?>,
                            <?php echo e($reEvaluationArchives ?? 0); ?>

                        ],
                        backgroundColor: [
                            '#10B981', // Green
                            '#F59E0B', // Yellow
                            '#8B5CF6', // Purple
                            '#EF4444', // Red
                            '#6366F1' // Indigo
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    cutout: '60%'
                }
            });

            // Notification function
            function showNotification(type, message) {
                const flashMessages = document.getElementById('flash-messages');
                const alertDiv = document.createElement('div');

                const alertClasses = {
                    'success': 'bg-green-50 border-green-200 text-green-700',
                    'error': 'bg-red-50 border-red-200 text-red-700',
                    'warning': 'bg-yellow-50 border-yellow-200 text-yellow-700',
                    'info': 'bg-blue-50 border-blue-200 text-blue-700'
                };

                const iconClasses = {
                    'success': 'fas fa-check-circle text-green-500',
                    'error': 'fas fa-exclamation-triangle text-red-500',
                    'warning': 'fas fa-exclamation-triangle text-yellow-500',
                    'info': 'fas fa-info-circle text-blue-500'
                };

                alertDiv.className = `flex items-center p-4 border rounded-lg ${alertClasses[type]}`;
                alertDiv.innerHTML = `
                <div class="flex-shrink-0">
                    <i class="${iconClasses[type]}"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">${message}</p>
                </div>
            `;

                flashMessages.appendChild(alertDiv);

                // Auto-hide after 5 seconds
                setTimeout(() => {
                    alertDiv.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                    alertDiv.style.opacity = '0';
                    alertDiv.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        alertDiv.remove();
                    }, 500);
                }, 5000);
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
<?php /**PATH E:\New folder\Materi untag\INTERN\cobainiarsip\archivy-main (3)\archivy-main\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>