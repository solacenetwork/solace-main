<div class="w-full flex flex-col gap-4">
    <label class="block text-sm font-medium text-gray-700">Account Type</label>
    <div class="flex flex-col md:flex-row gap-4">
        <!-- Single Card -->
        <button
            type="button"
            wire:click="setAccountType('single')"
            class="group block w-full md:w-auto flex-1 bg-white border rounded-lg shadow-md hover:bg-gray-100 focus:outline-none <?php echo e($form['account_type'] === 'single' ? 'border-blue-600 ring-2 ring-blue-300' : 'border-gray-300'); ?>"
        >
            <div class="p-6 text-center flex flex-col items-center">
                <img src="<?php echo e(asset('assets/img/user-single.svg')); ?>" alt="User Icon" class="w-16 h-16 mb-2" />
                <h2 class="text-lg font-bold">Single</h2>
                <p class="text-sm text-gray-600">Select this option for individual accounts.</p>
            </div>
        </button>

        <!-- Family Card -->
        <button
            type="button"
            disabled
            class="group block w-full md:w-auto flex-1 bg-white border border-gray-300 rounded-lg shadow-md opacity-50 cursor-not-allowed"
        >
            <div class="p-6 text-center flex flex-col items-center">
                <img src="<?php echo e(asset('assets/img/user-family.svg')); ?>" alt="User Icon" class="w-16 h-16 mb-2" />
                <h2 class="text-lg font-bold">Family</h2>
                <p class="text-sm text-gray-600">Family accounts are coming soon.</p>
            </div>
        </button>
    </div>
    <?php $__errorArgs = ['form.account_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div><?php /**PATH C:\DevServer\UniServerZ\www\solace\resources\views\livewire\steps\step2.blade.php ENDPATH**/ ?>