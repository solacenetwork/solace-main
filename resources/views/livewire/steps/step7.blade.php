<div class="max-w-lg mx-auto bg-white p-8 rounded-lg border-2 border-black shadow-md">
    @if ($showFormData)
        @include('partials.form-data')
    @else
        @include('partials.success')
    @endif
</div>