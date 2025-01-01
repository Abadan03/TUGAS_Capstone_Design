
<?php $__env->startSection('content'); ?>

<div class="">
  <div class="topside py-4">
      <h1 class="d-flex justify-center items-center align-middle">Cek Bukti Berkas Pesanan</h1>
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
      <p class="text-start">Rp <?php echo e(number_format($order->amount, 0, ',', '.')); ?></p>
    </div>
    <div>
      <h4 class="fw-semibold">Status</h4>
      <?php if($order->status === 0): ?>
        <p class="text-start">Pesanan Sukses!</p>
      <?php elseif($order->status === 5): ?> 
        <p class="text-start">Pesanan Gagal!</p>
      <?php endif; ?>
    </div>
    <div>
      <h4 class="fw-semibold">Bukti Surat</h4>
      <?php if($letter): ?>
        <iframe src="<?php echo e(asset('storage/' . $letter->letter)); ?>" width="800px" height="600px" frameborder="0"></iframe>
      <?php else: ?>
        <p>No letter found.</p>
       <?php endif; ?>
    </div>
    <div>
      <h4 class="fw-semibold">Bukti Pembayaran</h4>
      
      <?php if(!isset($payment)): ?>  
      <div>
        Pesanan Gagal
      </div>
      <?php else: ?>
        <img src="<?php echo e(asset('storage/' . $payment->payment_proof)); ?>" alt="" width="500px" height="800px">
      <?php endif; ?>
    </div>
    
    
    <div class="d-flex gap-2 my-4">
      <a href="<?php echo e(route('payments.list')); ?>">
        <button class="btn btn-info text-light">Back</button>
      </a>
    </div>
    
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\defaultuser0.LAPTOP-03IR0KMB\Documents\Matkul Perkuliahan\Semester_7\Capstone Design and Project\TUS_Mart\resources\views/admin/history/check.blade.php ENDPATH**/ ?>