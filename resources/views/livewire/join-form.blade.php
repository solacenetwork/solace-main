<div class="container mx-auto px-4 py-8">
    
    <h1 class="text-5xl mb-4 font-bold text-center">Join SOLACE Network</h1>

    <!-- Progress Meter -->
    @php
        $progressStep = $currentStep;
        $progressMax = 6; // Show steps 1-6
    @endphp

    <div class="mb-6 flex justify-center">
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

    <!-- Form Content -->
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg border-2 border-black shadow-md">
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
                    <x-button
                        type="button"
                        wire:click="previousStep"
                        class="bg-gray-100 text-gray-900 border border-gray-300 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                        {{ __('Previous') }}
                    </x-button>
                @endif

                <!-- Next or Dashboard Button -->
                @if($currentStep < 6)
                    <x-button
                        type="button"
                        wire:click="{{ $currentStep === 1 ? 'validateStep1' : 'nextStep' }}"
                        wire:loading.attr="disabled"
                        wire:target="{{ $currentStep === 1 ? 'validateStep1' : 'nextStep' }}"
                        class="bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                        {{ __('Next') }}
                    </x-button>
                @elseif($currentStep === 6)
                    <x-button
                        type="button"
                        wire:click="submit"
                        wire:confirm="Are you sure you want to submit the form?"
                        class="bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                        {{ __('Next') }}
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
    </div>
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