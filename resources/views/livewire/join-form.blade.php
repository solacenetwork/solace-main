<div class="container mx-auto px-4 py-8">

    {{-- Don't show progress meter or title on step 7  --}}
    @if($currentStep < 7)
        <h1 class="text-5xl mt-2 mb-5 font-bold text-center">Join SOLACE Network</h1>
        <!-- Progress Meter -->
        @php
            $progressStep = $currentStep;
            $progressMax = 6; // Show only steps 1-6 on meter
        @endphp
        <div class="mb-6 mt-4 flex justify-center">
            <div class="max-w-md mx-auto border-2 border-black rounded-lg p-4 bg-white">
                <div class="text-center mb-3 text-gray-700 font-semibold">
                    Step {{ $progressStep <= $progressMax ? $progressStep : $progressMax }} of {{ $progressMax }}: {{ $this->stepMessage }}
                </div>
                <div class="mt-3">
                    <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 sm:text-base">
                        @for ($i = 1; $i <= $progressMax; $i++)
                            <li class="flex items-center">
                                @if ($progressStep > $i)
                                    <button
                                        type="button"
                                        wire:click="goToProgressStep({{ $i }})"
                                        class="flex items-center justify-center w-8 h-8 rounded-full border-2 border-indigo-600 bg-white/60 text-indigo-600 font-bold hover:bg-indigo-600 hover:text-white transition focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        title="Go to Step {{ $i }}"
                                    >
                                        {{ $i }}
                                    </button>
                                @else
                                    <span class="flex items-center justify-center w-8 h-8 rounded-full {{ $progressStep == $i ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-600' }}">
                                        {{ $i }}
                                    </span>
                                @endif
                                @if ($i < $progressMax)
                                    <div class="w-6 h-0.5 mx-2 rounded {{ $progressStep > $i ? 'bg-indigo-600' : 'bg-gray-300' }}"></div>
                                @endif
                            </li>
                        @endfor
                    </ol>
                </div>
            </div>
        </div>
    @endif

    <!-- Form Content -->
    @if(!in_array($currentStep, [4, 5]))
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg border-2 border-black shadow-md">
    @endif

        @switch($currentStep)
            @case(1)
                @include('livewire.steps.step1')
                @break
            @case(2)
                @include('livewire.steps.step2')
                @break
            @case(3)
                @include('livewire.steps.step3')
                @break
            @case(4)
                @include('livewire.steps.step4')
                @break
            @case(5)
                @include('livewire.steps.step5')
                @break
            @case(6)
                @include('livewire.steps.step6')
                @break
            @case(7)
                @include('livewire.steps.step7')
                @break
        @endswitch

        <!-- Navigation Buttons -->
        @if($currentStep <= 7)
            <div class="mt-8 flex justify-center gap-3">
                
                <!-- Cancel Button (All Steps) -->
                <x-button
                    type="button"
                    wire:click="cancel"
                    wire:confirm="Any form progress will be lost. Are you sure you wish to exit?"
                    class="bg-gray-100 text-gray-900 border border-gray-300 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                    {{ __('Cancel') }}
                </x-button>

                <!-- Clear Button (Steps 1, 3, 6) -->
                @if(in_array($currentStep, [1, 3, 6]))
                    <x-button
                        type="button"
                        wire:click="clearForm"
                        wire:confirm="Are you sure you want to clear the form fields on this step?"
                        class="bg-gray-100 text-gray-900 border border-gray-300 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                        {{ __('Clear') }}
                    </x-button>
                @endif

                <!-- Previous Button (Steps 2-7) -->
                @if($currentStep > 1)
                    @if($currentStep === 4)
                        <x-button
                            type="button"
                            wire:click="previousStep"
                            class="bg-gray-100 text-gray-900 border border-gray-300 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                            No, Not My Address
                        </x-button>
                    @else
                        <x-button
                            type="button"
                            wire:click="previousStep"
                            class="bg-gray-100 text-gray-900 border border-gray-300 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                            {{ __('Previous') }}
                        </x-button>
                    @endif
                @endif

                <!-- Next or Dashboard Button -->
                @if($currentStep < 6)
                    @if($currentStep === 4)
                        <x-button
                            type="button"
                            wire:click="nextStep"
                            class="bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                            Yes, It's My Address
                        </x-button>
                    @else
                        <x-button
                            type="button"
                            wire:click="{{ $currentStep === 1 ? 'validateStep1' : 'nextStep' }}"
                            wire:loading.attr="disabled"
                            wire:target="{{ $currentStep === 1 ? 'validateStep1' : 'nextStep' }}"
                            class="bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                            {{ __('Next') }}
                        </x-button>
                    @endif
                @elseif($currentStep === 6)
                    <x-button
                        type="button"
                        wire:click="submit"
                        class="bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                        {{ __('Submit') }}
                    </x-button>
                @elseif($currentStep === 7)
                    <x-button
                        type="button"
                        wire:click="$emit('redirectToDashboard')"
                        class="bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                        {{ __('Dashboard') }}
                    </x-button>
                @endif

            </div>
        @endif

    @if(!in_array($currentStep, [4, 5]))
    </div> <!-- Close wrapper for steps 1, 2, 3, 6 -->
    @endif

</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('redirectToDashboard', () => {
            window.location.href = '{{ route('dashboard') }}';
        });
    });
</script>
@endpush