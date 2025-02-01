

<?php $__env->startSection('content'); ?>
<div class="">
    <div class="topside py-4">
      <h1 class="d-flex justify-center items-center align-middle">Masukkan Surat Pernyataan</h1>
      <img src="<?php echo e(asset('images/logo-telkom.jpg')); ?>" alt="" width="100">
    </div>

    <form action="<?php echo e(route('orders.createletters')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="ormawa" class="form-label">Nama Ormawa</label>
            <input type="text" class="form-control" id="ormawa" name="ormawa" required>
        </div>
        <div class="mb-3">
            <label for="acara" class="form-label">Nama Kegiatan Acara</label>
            <input type="text" class="form-control" id="acara" name="acara" required>
        </div>
        
        <div class="mb-3">
            
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" class="form-control" id="orders_id" name="orders_id" value="<?php echo e($order->order_id); ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mb-3">
          <label for="surat" class="form-label">Upload Bukti Surat</label>
          <input type="file" class="form-control" id="surat" name="surat" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\defaultuser0.LAPTOP-03IR0KMB\Documents\Matkul Perkuliahan\Semester_7\Capstone Design and Project\TUS_Mart\resources\views/orders/applyletters.blade.php ENDPATH**/ ?>