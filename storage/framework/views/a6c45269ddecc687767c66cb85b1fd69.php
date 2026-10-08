


<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
        <i class="fas fa-magic text-indigo-500"></i>
        BERKAS ARSIP
    </h3>

    
    <div class="mb-6">
        <div class="flex gap-3 mb-4">
            <button type="button" id="upload-btn"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                <i class="fas fa-upload mr-1"></i> Upload File
            </button>
            <button type="button" id="scan-camera-btn"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                <i class="fas fa-camera mr-1"></i> Scan Camera
            </button>
            <span id="ocr-status" class="text-sm text-gray-500"></span>
        </div>

        
        <input type="file" id="file-input" class="hidden" accept=".pdf,.jpg,.jpeg,.png">
        <input type="file" id="file_path" name="file_path" class="hidden" accept=".pdf,.jpg,.jpeg,.png">
        <input type="hidden" id="existing-file-url" value="<?php echo e(isset($archive) && $archive->file_path ? asset('storage/'.$archive->file_path) : ''); ?>">
        <input type="hidden" id="existing-file-name" value="<?php echo e(isset($archive) && $archive->file_path ? basename($archive->file_path) : ''); ?>">
        <input type="hidden" id="existing-file-type" value="<?php echo e(isset($archive) && $archive->file_path ? strtolower(pathinfo($archive->file_path, PATHINFO_EXTENSION)) : ''); ?>">
        <?php if(isset($archive) && $archive->file_path): ?>
            <div class="text-xs text-gray-500 mt-2">
                <strong>Softfile tersimpan:</strong> <?php echo e(basename($archive->file_path)); ?>

            </div>
        <?php endif; ?>
    </div>

    
    <div id="ocr-split-view" class="hidden grid grid-cols-1 lg:grid-cols-2 gap-6 min-h-[600px]">

        
        <div class="bg-gray-50 rounded-lg p-4 border">
            <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                <i class="fas fa-image mr-2 text-blue-500"></i>
                Preview Dokumen
            </h4>

            
            <div id="preview-container" class="relative border rounded-lg overflow-hidden bg-white min-h-[400px] flex items-center justify-center">
                <div id="no-preview" class="text-gray-400 text-center">
                    <i class="fas fa-file-upload text-4xl mb-2"></i>
                    <p>Upload file atau scan kamera untuk mulai</p>
                </div>

                <iframe id="pdf-preview" class="w-full h-full min-h-[500px] hidden" src=""></iframe>
                <img id="image-preview" class="max-w-full hidden" src="" alt="Preview">
                <div id="image-selection-overlay" class="hidden absolute inset-0 cursor-crosshair"></div>
                <div id="selection-box" class="hidden absolute border-2 border-blue-500 bg-blue-500 bg-opacity-10"></div>

                
                <button type="button" id="maximize-preview" class="absolute top-2 right-2 z-10 bg-gray-900 bg-opacity-75 text-white p-2 rounded-lg hover:bg-black hover:bg-opacity-90 transition-all hidden" title="Maximize">
                    <i class="fas fa-expand"></i>
                </button>
            </div>

            
            <div class="mt-4 flex gap-2">
                <button type="button" id="scan-ocr-btn"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                    <i class="fas fa-search mr-1"></i> Scan Teks
                </button>
                <button type="button" id="reset-ocr-btn"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg text-sm transition-colors hidden">
                    <i class="fas fa-redo-alt mr-1"></i> Reset
                </button>
            </div>

            
            <div id="crop-preview" class="hidden mt-3">
                <h5 class="text-xs text-gray-500 mb-2">Area Terpilih:</h5>
                <img id="crop-preview-img" class="max-w-full border border-gray-200 rounded" src="" alt="Crop Preview" />
            </div>
        </div>

        
        <div class="bg-gray-50 rounded-lg p-4 border">
            <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                <i class="fas fa-file-alt mr-2 text-green-500"></i>
                Hasil Deteksi Teks
            </h4>

            
            <div class="mb-4">
                <label class="block text-xs text-gray-600 mb-1">Teks yang terdeteksi:</label>
                <textarea id="ocr-result" rows="8"
                    class="w-full border border-gray-300 rounded-lg p-3 text-sm bg-white resize-none"
                    placeholder="Hasil Deteksi Teks akan muncul di sini..."
                    readonly></textarea>
            </div>

            
            <div class="grid grid-cols-2 gap-2 mb-4">
                <button type="button" id="copy-ocr-result"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-xs transition-colors">
                    <i class="fas fa-copy mr-1"></i> Copy
                </button>
                <button type="button" id="clear-ocr-result"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-3 py-2 rounded text-xs transition-colors">
                    <i class="fas fa-trash mr-1"></i> Clear
                </button>
            </div>

        </div>
    </div>

    
    <div id="ocr-single-view" class="text-center py-12">
        <i class="fas fa-magic text-4xl text-gray-300 mb-4"></i>
        <h4 class="text-lg font-medium text-gray-600 mb-2">Siap untuk Deteksi Teks</h4>
        <p class="text-sm text-gray-500">Upload file atau scan kamera untuk mulai</p>
    </div>
</div>


<div id="camera-modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-2xl w-full p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-camera mr-2 text-blue-500"></i>
                Scan Kamera
            </h3>
            <button type="button" id="close-camera-modal" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="mb-4">
            <video id="camera-video" autoplay playsinline class="w-full border border-gray-300 rounded-lg"></video>
            <canvas id="camera-canvas" class="hidden"></canvas>
        </div>

        <div class="flex gap-3">
            <button type="button" id="capture-frame" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-camera mr-1"></i> Ambil Gambar
            </button>
        </div>
    </div>
</div>


<div id="fullscreen-modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-95 flex items-center justify-center p-4">
    <button type="button" id="close-fullscreen" class="absolute top-4 right-4 text-white text-3xl hover:text-gray-300 z-50 focus:outline-none">
        <i class="fas fa-times"></i>
    </button>
    <div class="w-full h-full flex items-center justify-center relative">
         <iframe id="fullscreen-pdf" class="w-full h-full hidden rounded-lg" src=""></iframe>
         <img id="fullscreen-image" class="max-w-full max-h-full object-contain hidden rounded-lg" src="">
    </div>
</div>

<?php /**PATH E:\New folder\Materi untag\INTERN\cobainiarsip\archivy-main (3)\archivy-main\resources\views/components/ocr-system.blade.php ENDPATH**/ ?>