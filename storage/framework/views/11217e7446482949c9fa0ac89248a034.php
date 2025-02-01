<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="alert alert-success ">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>


<div class="">
    <div class="topside py-4">
        <h1 class="d-flex justify-center items-center align-middle">List Barang</h1>
        <img src="<?php echo e(asset('images/logo-telkom.jpg')); ?>" alt="" width="100">
    </div>

    <!-- Button for Input Barang -->
    <div class="my-3">
        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary">Input Barang</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nama Produk</th>
                <th>deskripsi</th>
                <th>Jumlah</th>
                
                
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($product->nama); ?></td>
                <td><?php echo e($product->deskripsi); ?></td>
                <td><?php echo e($product->stok); ?></td>
                <td>
                    <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\defaultuser0.LAPTOP-03IR0KMB\Documents\Matkul Perkuliahan\Semester_7\Capstone Design and Project\TUS_Mart\resources\views/admin/index.blade.php ENDPATH**/ ?>