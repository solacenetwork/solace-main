<div class="max-w-lg mx-auto bg-white p-8 rounded-lg border-2 border-black shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-center"><?php echo e($stepMessage); ?></h2>

    <?php if($showFormData): ?>
        <?php echo $__env->make('partials.form-data', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('partials.success', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
</div><?php /**PATH C:\DevServer\UniServerZ\www\solace\resources\views\livewire\steps\step7.blade.php ENDPATH**/ ?>