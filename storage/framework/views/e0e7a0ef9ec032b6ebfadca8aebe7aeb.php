<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- First Name -->
    <div>
        <flux:input
            wire:model.defer="form.first_name"
            :label="__('First Name')"
            type="text"
            required
            autocomplete="given-name"
            placeholder="First Name"
        />
        <p id="first-error" class="mt-2 text-sm text-red-600 hidden">
            <?php $__errorArgs = ['form.first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </p>    
    </div>

    <!-- Last Name -->
    <div>
        <flux:input
            wire:model.defer="form.last_name"
            :label="__('Last Name')"
            type="text"
            required
            autocomplete="family-name"
            placeholder="Last Name"
        />
        <p id="last-error" class="mt-2 text-sm text-red-600 hidden">
            <?php $__errorArgs = ['form.last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </p>     
    </div>

    <!-- Address Line 1 -->
    <div class="col-span-2">
        <flux:input
            wire:model.defer="form.address1"
            :label="__('Address Line 1')"
            type="text"
            required
            autocomplete="address-line1"
            placeholder="Address Line 1"
        />
        <p id="address1-error" class="mt-2 text-sm text-red-600 hidden">
            <?php $__errorArgs = ['form.address1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </p>     
    </div>

    <!-- Address Line 2 -->
    <div class="col-span-2 md:col-span-1">
        <flux:input
            wire:model.defer="form.address2"
            :label="__('Address Line 2 (optional)')"
            type="text"
            autocomplete="address-line2"
            placeholder="Address Line 2"
        />
    </div>

    <!-- City -->
    <div>
        <flux:input
            wire:model.defer="form.city"
            :label="__('City')"
            type="text"
            required
            autocomplete="address-level2"
            placeholder="City"
        />
        <p id="city-error" class="mt-2 text-sm text-red-600 hidden">
            <?php $__errorArgs = ['form.city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </p>     
    </div>

    <!-- State -->
    <div>
        <label class="block text-sm font-medium text-gray-700"><?php echo e(__('State')); ?></label>
        <select wire:model.defer="form.state"
            class="mt-1 block w-full rounded-lg border-gray-300 input-azure text-gray-900 focus:ring-blue-500 focus:border-blue-500 shadow-sm"
            required>
            <option value=""><?php echo e(__('Select')); ?></option>
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
        </select>
        <p id="state-error" class="mt-2 text-sm text-red-600 hidden">
            <?php $__errorArgs = ['form.state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </p>    
    </div>

    <!-- ZIP -->
    <div>
        <flux:input
            wire:model.defer="form.zip"
            :label="__('ZIP')"
            type="text"
            maxlength="10"
            required
            autocomplete="postal-code"
            placeholder="ZIP"
        />
        <p id="zip-error" class="mt-2 text-sm text-red-600 hidden">
            <?php $__errorArgs = ['form.zip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </p>    
    </div>

    <!-- Phone -->
    <div class="col-span-2">
        <flux:input
            wire:model.defer="form.phone"
            :label="__('Phone (optional)')"
            type="text"
            autocomplete="tel"
            placeholder="1 (123) 456-7890"
        />
    </div>

    <!-- Date of Birth -->
    <div class="col-span-2">
        <flux:input
            wire:model.defer="form.dob"
            :label="__('Date of Birth')"
            type="date"
            required
            autocomplete="bday"
        />
        <p id="dob-error" class="mt-2 text-sm text-red-600 hidden">
            <?php $__errorArgs = ['form.dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </p>
    </div>
    
</div><?php /**PATH C:\DevServer\UniServerZ\www\solace\resources\views\partials\single.blade.php ENDPATH**/ ?>