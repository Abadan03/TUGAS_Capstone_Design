<?php $__env->startSection('content'); ?>


<?php if(session('success')): ?>
    <div class="alert alert-success">
    <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="topside py-4">
    <div class="subtopside">
        <div class="d-flex items-center justify-center align-middle">
            <a href="#" class="text-decoration-none text-reset w-full">
                <li class="d-flex flex-column align-items-center justify-content-center text-center w-full rounded-pill">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13v-2a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L14 4.757V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L4.929 6.343a1 1 0 0 0 0 1.414l.536.536L4.757 10H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535 1.707.707V20a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H20a1 1 0 0 0 1-1Z"/>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                    </svg>                                   
                </li>
                
            </a>
            <a href="#" class="text-decoration-none text-reset w-full">
                <li class="d-flex flex-column align-items-center justify-content-center text-center w-full rounded-pill">
                  <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                  </svg>                
                </li>
                
            </a>
            <a href="#" class="text-decoration-none text-reset w-full">
                <li class="d-flex flex-column align-items-center justify-content-center text-center w-full rounded-pill">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175 0 .593 0 1.292-.538 1.292H5.538C5 18 5 17.301 5 16.708c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.365ZM8.733 18c.094.852.306 1.54.944 2.112a3.48 3.48 0 0 0 4.646 0c.638-.572 1.236-1.26 1.33-2.112h-6.92Z"/>
                    </svg>                                     
                </li>
                
            </a>
        </div>
        <img src="<?php echo e(asset('images/logo-telkom.jpg')); ?>" alt="" width="100">
    </div>
    <div>
        <h1 class="d-flex justify-center items-center align-middle">Produk</h1>
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 w-full">
                    
                    <img src="<?php echo e(asset($product->gambar)); ?>" class="card-img-top " alt="<?php echo e($product->nama); ?>">
                    
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($product->nama); ?></h5>
                        <p class="card-text"><?php echo e($product->deskripsi); ?></p>
                        <p class="card-text"><strong>Harga:</strong> Rp. <?php echo e(number_format($product->harga, 0, ',', '.')); ?></p>

                        <!-- Tombol Tambah ke Keranjang -->
                        <form action="<?php echo e(route('cart.add', $product->id)); ?>" class="d-flex w-full justify-content-center" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<!-- CSS -->
<style>
    .img-fixed-size {
        width: 100%;
        height: 250px; /* Sesuaikan tinggi sesuai kebutuhan */
        object-fit: cover; /* Agar gambar tetap proporsional */
    }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\defaultuser0.LAPTOP-03IR0KMB\Documents\Matkul Perkuliahan\Semester_7\Capstone Design and Project\TUS_Mart\resources\views/home.blade.php ENDPATH**/ ?>