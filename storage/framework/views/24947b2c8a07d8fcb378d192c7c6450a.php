
<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="alert alert-success ">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="">
  <div class="topside py-4">
      <h1 class="d-flex justify-center items-center align-middle">Cek Bukti Pembayaran</h1>
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
      <h4 class="fw-semibold">Bukti Pembayaran</h4>
      <img src="<?php echo e(asset('storage/' . $payment->payment_proof)); ?>" alt="" width="500px" height="800px">
    </div>
    
    <div class="d-flex gap-2 my-4">
      <form action="<?php echo e(route('payments.approve')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input class="" type="hidden" name="order_id" id="order_id" value="<?php echo e($order->order_id); ?>">
        <button type="submit" class="btn btn-success">Approve</button>
      </form>
      <a href="<?php echo e(route('pesanan_pengguna')); ?>">
        <button class="btn btn-secondary">Cancel</button>
      </a>
    </div>
    
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\defaultuser0.LAPTOP-03IR0KMB\Documents\Matkul Perkuliahan\Semester_7\Capstone Design and Project\TUS_Mart\resources\views/admin/payments/index.blade.php ENDPATH**/ ?>