
<?php $__env->startSection('content'); ?>

<div class="">
  <div class="topside py-4">
      <h1 class="d-flex justify-center items-center align-middle">Pembayaran</h1>
      <img src="<?php echo e(asset('images/logo-telkom.jpg')); ?>" alt="" width="100">
  </div>
  <div class="mt-4 text-start">
    
      
    <div>
      <h4 class="fw-semibold">Nama Produk</h4>
      <p class="text-start"><?php echo e($order->nama_produk); ?></p>
    </div>
    <div>
      <h4 class="fw-semibold">Jumlah</h4>
      <p class="text-start"><?php echo e($order->quantity); ?></p>
    </div>
    <div>
      <h4 class="fw-semibold">Total Harga</h4>
      <p class="text-start"><?php echo e(number_format($order->amount, 0, ',', '.')); ?></p>
    </div>
    <div>
      <h4 class="fw-semibold">Kode QR</h4>
      <img src="<?php echo e(asset('images/kode_qr.jpg')); ?>" alt="" width="450">
    </div>
    <form action="<?php echo e(route('payments.create')); ?>" method="POST" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="order_id" id="order_id" value="<?php echo e($order->order_id); ?>">
      <div class="mb-4">
          <label for="bukti_transfer" class="form-label fs-4 fw-semibold">Bukti Transfer</label>
          <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" placeholder="Masukkan Bukti Transfer">
      </div>
      <div class="d-flex justify-content-start gap-2">
          <button type="submit" class="btn btn-success">Confirm</button>
          <a href="<?php echo e(route('orders.index')); ?>">
              <button type="button" class="btn btn-secondary">Cancel</button>
          </a>
      </div>
    </form>
    
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\defaultuser0.LAPTOP-03IR0KMB\Documents\Matkul Perkuliahan\Semester_7\Capstone Design and Project\TUS_Mart\resources\views/payments/index.blade.php ENDPATH**/ ?>