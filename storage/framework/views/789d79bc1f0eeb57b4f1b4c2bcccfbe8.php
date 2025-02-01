
<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="alert alert-success">
    <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="">
  <div class="topside py-4">
      <h1 class="d-flex justify-center items-center align-middle">Pesananmu</h1>
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
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($order->status === 0): ?> 
                    <?php elseif($order->status === 1): ?>
                      <th>Action</th>
                    <?php elseif($order->status === 3): ?> 
                      <th>Action</th>
                    
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="">
                <td><?php echo e($order->order_id); ?></td>
                <td><?php echo e($order->nama_produk); ?></td>
                <td><?php echo e($order->quantity); ?></td>
                <td><?php echo e(number_format($order->amount, 0, ',', '.')); ?></td>
                <?php if($order->status === 1): ?> 
                  <td>Ajukan Surat</td>
                <?php elseif($order->status === 2): ?>
                  <td>menunggu approval surat</td>
                <?php elseif($order->status === 3): ?> 
                  <td>Bayar Pesananmu!</td>
                <?php elseif($order->status === 4): ?> 
                  <td>menunggu approval pembayaran</td>
                <?php elseif($order->status === 5): ?>
                  <td>Pembayaran gagal!</td>
                <?php else: ?>
                  <td>Pesanan sukses!</td>
                <?php endif; ?>
                
                <td>
                    <?php if($order->status === 1): ?>
                    <a href="/applyletters"">
                      <button id="pay-button" class="btn rounded btn-info text-light">Ajukan Surat!</button>
                    </a>
                  <?php elseif($order->status === 3): ?> 
                  <form action="<?php echo e(route('payments')); ?>" method="POST">
                      <?php echo csrf_field(); ?>
                      <input type="hidden" name="order_id" id="order_id" value="<?php echo e($order->order_id); ?>">
                      <button type="submit" id="pay-button" class="btn rounded btn-primary text-light">Bayar Sekarang!</button>
                  </form>
                  <?php endif; ?>
                  </td>

                <?php
                  $order->status
                ?>
                <td><?php echo e($order->created_at); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    
  <?php else: ?>
    <h3>Your cart is empty!</h3>
  <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\defaultuser0.LAPTOP-03IR0KMB\Documents\Matkul Perkuliahan\Semester_7\Capstone Design and Project\TUS_Mart\resources\views/orders/index.blade.php ENDPATH**/ ?>