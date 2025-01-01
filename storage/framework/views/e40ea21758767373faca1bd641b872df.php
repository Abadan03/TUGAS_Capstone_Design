<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="">
    <div class="topside py-4">
        <h1 class="d-flex justify-center items-center align-middle">Keranjangmu</h1>
        <img src="<?php echo e(asset('images/logo-telkom.jpg')); ?>" alt="" width="100">
    </div>

    <?php if(!empty($cartItems)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $total = 0; ?>

                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($cart->product->nama); ?></td>
                    <td>
                        <form action="<?php echo e(route('cart.decrease')); ?>" method="POST" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($cart->id); ?>">
                            <button type="submit" class=""><h3>-</h3></button>
                        </form>
                        <?php echo e($cart->quantity); ?>

                        <form action="<?php echo e(route('cart.increase')); ?>" method="POST" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($cart->id); ?>">
                            <button type="submit" class=""> <h3>+</h3> </button>
                        </form>
                    </td>
                    <td>Rp. <?php echo e(number_format($cart->product->harga, 0, ',', '.')); ?></td>
                    <td>Rp. <?php echo e(number_format($cart->product->harga * $cart->quantity, 0, ',', '.')); ?></td>
                    <?php
                        $total += $cart->product->harga * $cart->quantity;
                    ?>
                    <td>
                        <form action="<?php echo e(route('cart.remove', $cart->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <p class="text-start"><strong>Note:</strong> Minimal pembelian harus 5 atau di atas 5.</p>

        <h3>Total Price: Rp <?php echo e(number_format($total, 0, ',', '.')); ?></h3>

        <!-- Tombol checkout -->

        <form action="<?php echo e(route('cart.checkout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="total" value="<?php echo e($total); ?>">
            <?php
                $isDisabled = true; // Flag untuk menandai apakah tombol harus dinonaktifkan
            ?>
            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="id[]" value="<?php echo e($cart->id); ?>"> <!-- Menggunakan array untuk id -->
                <?php if($cart->quantity >= 5): ?>
                    <?php
                        $isDisabled = false; // Set flag jika ada item dengan kuantitas >= 5
                    ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
            <button type="submit" class="btn btn-primary" <?php echo e($isDisabled ? 'disabled' : ''); ?>>
                Confirm Checkout
            </button>
        </form>
        
    <?php else: ?>
        <h3>Your cart is empty!</h3>
    <?php endif; ?>
</div>

<?php if(session('snapToken')): ?>
    <p>Snap Token: <?php echo e(session('snapToken')); ?></p>
<?php endif; ?>

<?php $__env->startSection("scripts"); ?>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-47Mb1kvUCsl453Fi"></script>


<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const payButton = document.getElementById('pay-button');
  
    payButton.addEventListener('click', function() {
      fetch('<?php echo e(route('cart.checkout')); ?>', {
    //   fetch('https://2cbf-139-195-174-248.ngrok-free.app/cart/checkout', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
      })
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status} - ${response.statusText}`);
        }
        return response.json();
      })
      .then(data => {
        if (data.snapToken) {
            // window.snap.embed(data.snapToken, {
            //     embedId: 'snap-container'
            // });
            window.snap.embed(data.snapToken, {
                embedId: 'snap-container',
                onSuccess: function(result) {
                    // Redirect to the specified URL after successful payment
                    // console.log(` url: ${data.redirectUrl} and result : ${result}`)
                    alert('Payment is success.');
                    return window.location.href = ''; // Redirect to orders page
                    
                },
                onPending: function(result) {
                    alert('Payment is pending.');
                    window.location.href = data.redirectUrl;
                },
                onError: function(result) {
                    alert('Payment failed: ' + result);
                },
                onClose: function() {
                    alert('Payment popup closed.');
                }
            });
        } else if (data.error) {
          console.error('Error from server:', data.error);
          alert('Error from server: ' + data.error);
        } else {
          console.error('Unexpected response from server:', data);
          alert('Unexpected response from server. Please try again.');
        }
      })
      .catch(error => {
        console.error('Error fetching snapToken:', error);
        alert('Error fetching snapToken: ' + error.message);
      });
    });
  </script>
  <?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\defaultuser0.LAPTOP-03IR0KMB\Documents\Matkul Perkuliahan\Semester_7\Capstone Design and Project\TUS_Mart\resources\views/cart/index.blade.php ENDPATH**/ ?>