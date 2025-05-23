<div class="container mx-auto px-4 py-8">
    
    <h1 class="text-5xl mb-4 font-bold text-center">Join SOLACE Network</h1>

    <!-- Progress Meter -->
    <?php
        $progressStep = $currentStep;
        $progressMax = 6; // Show steps 1-6
    ?>

    <div class="mb-6 flex justify-center">
        <div class="max-w-md mx-auto border-2 border-black rounded-lg p-4 bg-white">
            <div class="text-center mb-3 text-gray-700 font-semibold">
                Step <?php echo e($progressStep <= $progressMax ? $progressStep : $progressMax); ?> of <?php echo e($progressMax); ?>: <?php echo e($this->stepMessage); ?>

            </div>
            <div class="mt-3">
                <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 sm:text-base">
                    <!--[if BLOCK]><![endif]--><?php for($i = 1; $i <= $progressMax; $i++): ?>
                        <li class="flex items-center">
                            <!--[if BLOCK]><![endif]--><?php if($progressStep > $i): ?>
                                <button
                                    type="button"
                                    wire:click="goToProgressStep(<?php echo e($i); ?>)"
                                    class="flex items-center justify-center w-8 h-8 rounded-full border-2 border-blue-600 bg-white/60 text-blue-600 font-bold hover:bg-blue-600 hover:text-white transition focus:outline-none focus:ring-2 focus:ring-blue-300"
                                    title="Go to Step <?php echo e($i); ?>"
                                >
                                    <?php echo e($i); ?>

                                </button>
                            <?php else: ?>
                                <span class="flex items-center justify-center w-8 h-8 rounded-full <?php echo e($progressStep == $i ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600'); ?>">
                                    <?php echo e($i); ?>

                                </span>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            <!--[if BLOCK]><![endif]--><?php if($i < $progressMax): ?>
                                <div class="w-6 h-0.5 mx-2 rounded <?php echo e($progressStep > $i ? 'bg-blue-600' : 'bg-gray-300'); ?>"></div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </li>
                    <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
                </ol>
            </div>
        </div>
    </div>

    <!-- Form Content -->
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg border-2 border-black shadow-md">
        <!--[if BLOCK]><![endif]--><?php switch($currentStep):
            case (1): ?>
                <?php echo $__env->make('livewire.steps.step1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php break; ?>
            <?php case (2): ?>
                <?php echo $__env->make('livewire.steps.step2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php break; ?>
            <?php case (3): ?>
                <?php echo $__env->make('livewire.steps.step3', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php break; ?>
            <?php case (4): ?>
                <?php echo $__env->make('livewire.steps.step4', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php break; ?>
            <?php case (5): ?>
                <?php echo $__env->make('livewire.steps.step5', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php break; ?>
            <?php case (6): ?>
                <?php echo $__env->make('livewire.steps.step6', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php break; ?>
            <?php case (7): ?>
                <?php echo $__env->make('livewire.steps.step7', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php break; ?>
        <?php endswitch; ?><!--[if ENDBLOCK]><![endif]-->

        <!-- Navigation Buttons -->
        <!--[if BLOCK]><![endif]--><?php if($currentStep <= 7): ?>
            <div class="mt-6 flex justify-center gap-3">
                <!-- Cancel Button (All Steps) -->
                <flux:button
                    color="outline"
                    size="base"
                    wire:click="cancel"
                    wire:confirm="Any form progress will be lost. Are you sure you wish to exit?"
                    class="text-black border-black hover:bg-black hover:text-white"
                >
                    Cancel
                </flux:button>

                <!-- Clear Button (Steps 1, 3, 6) -->
                <!--[if BLOCK]><![endif]--><?php if(in_array($currentStep, [1, 3, 6])): ?>
                    <flux:button
                        color="outline"
                        size="base"
                        wire:click="clearForm"
                        wire:confirm="Are you sure you want to clear the form fields on this step?"
                        class="text-black border-black hover:bg-black hover:text-white"
                    >
                        Clear
                    </flux:button>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <!-- Previous Button (Steps 2-7) -->
                <!--[if BLOCK]><![endif]--><?php if($currentStep > 1): ?>
                    <flux:button
                        color="outline"
                        size="base"
                        wire:click="previousStep"
                        class="text-black border-black hover:bg-black hover:text-white"
                    >
                        Previous
                    </flux:button>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <!-- Next or Dashboard Button -->
                <!--[if BLOCK]><![endif]--><?php if($currentStep < 6): ?>
                    <flux:button
                        color="primary"
                        size="base"
                        wire:click="<?php echo e($currentStep === 1 ? 'validateStep1' : 'nextStep'); ?>"
                        wire:loading.attr="disabled"
                        wire:target="<?php echo e($currentStep === 1 ? 'validateStep1' : 'nextStep'); ?>"
                        class="bg-blue-600 hover:bg-blue-700 text-white"
                    >
                        Next
                    </flux:button>
                <?php elseif($currentStep === 6): ?>
                    <flux:button
                        color="primary"
                        size="base"
                        wire:click="submit"
                        wire:confirm="Are you sure you want to submit the form?"
                        class="bg-blue-600 hover:bg-blue-700 text-white"
                    >
                        Next
                    </flux:button>
                <?php elseif($currentStep === 7): ?>
                    <flux:button
                        color="primary"
                        size="base"
                        wire:click="goToDashboard"
                        class="bg-blue-600 hover:bg-blue-700 text-white"
                    >
                        Dashboard
                    </flux:button>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div><?php /**PATH C:\DevServer\UniServerZ\www\solace\resources\views/livewire/join-form.blade.php ENDPATH**/ ?>