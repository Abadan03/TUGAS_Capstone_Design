
<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="alert alert-success ">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="">
  <div class="topside py-4">
      <h1 class="d-flex justify-center items-center align-middle">Daftar Pesanan</h1>
      <img src="<?php echo e(asset('images/logo-telkom.jpg')); ?>" alt="" width="100">
  </div>

  <?php if(!empty($orders)): ?>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th> <!-- Kolom Action hanya ditampilkan sekali -->
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="">
                <td><?php echo e($order->order_id); ?></td>
                <td><?php echo e($order->nama_produk); ?></td>
                <td><?php echo e($order->quantity); ?></td>
                <td>Rp <?php echo e(number_format($order->amount, 0, ',', '.')); ?></td>
                
                <?php if($order->status === 1): ?> 
                  <td>Ajukan Surat</td>
                <?php elseif($order->status === 2): ?>
                  <td>Menunggu approval surat</td>
                <?php elseif($order->status === 3): ?> 
                  <td>Menunggu Pembayaran</td>
                <?php elseif($order->status === 4): ?> 
                  <td>Menunggu approval pembayaran</td>
                <?php elseif($order->status === 5): ?>
                  <td>Pesanan gagal!</td>
                <?php else: ?>
                  <td>Pesanan sukses</td>
                <?php endif; ?>
                
                <td>
                  <?php if($order->status === 2): ?>
                    <form action="<?php echo e(route('checkletter')); ?>" method="POST">
                      <?php echo csrf_field(); ?>
                      <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
                      <button id="pay-button" class="btn rounded btn-info text-light">Cek Surat!</button>
                    </form>
                  <?php elseif($order->status === 4): ?>
                  <form  action="<?php echo e(route('payments.check')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
                    <button type="submit" id="pay-button" class="btn rounded btn-info text-light">Cek Pembayaran!</button>
                  </form>
                  <?php else: ?>
                    <span>-</span>
                  <?php endif; ?>
                </td>
                
                <td><?php echo e($order->created_at); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    
  <?php else: ?>
    <h3>Belum ada pesanan!</h3>
  <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\defaultuser0.LAPTOP-03IR0KMB\Documents\Matkul Perkuliahan\Semester_7\Capstone Design and Project\TUS_Mart\resources\views/admin/order/index.blade.php ENDPATH**/ ?>