<div class="w-full flex flex-col gap-4">
    <?php if($form['account_type'] === 'single'): ?>
        <?php echo $__env->make('partials.single', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php elseif($form['account_type'] === 'family'): ?>
        <?php echo $__env->make('partials.family', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php else: ?>
        <p class="text-red-600">Please select an account type in Step 2.</p>
    <?php endif; ?>
</div><?php /**PATH C:\DevServer\UniServerZ\www\solace\resources\views\livewire\steps\step3.blade.php ENDPATH**/ ?>