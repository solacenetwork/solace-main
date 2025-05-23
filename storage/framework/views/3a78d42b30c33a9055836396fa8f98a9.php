<div class="grid gap-6">
    <!-- Nickname Field -->
    <div>
        <flux:input
            wire:model.defer="form.nickname"
            :label="__('Nickname')"
            type="text"
            required
            autofocus
            placeholder="Nickname"
        />
        <?php $__errorArgs = ['form.nickname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Avatar Image Select Field -->
    <div>
        <flux:input
            wire:model.defer="form.avatar"
            :label="__('Avatar Image')"
            type="file"
        />
        <?php $__errorArgs = ['form.avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Newsletter Checkbox -->
    <div>
        <flux:input
            wire:model.defer="form.newsletter"
            :label="__('Subscribe to Newsletter')"
            type="checkbox"
        />
    </div>

    <!-- Terms Checkbox -->
    <div>
        <flux:input
            wire:model.defer="form.terms"
            :label="__('I agree to the Terms and Conditions')"
            type="checkbox"
            required
        />
        <?php $__errorArgs = ['form.terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div><?php /**PATH C:\DevServer\UniServerZ\www\solace\resources\views\livewire\steps\step6.blade.php ENDPATH**/ ?>