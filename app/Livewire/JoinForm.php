<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Laravel\Fortify\Fortify;

class JoinForm extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $maxStep = 7;
    public $showPassword = false;
    public $showPasswordConfirm = false;
    public $showFormData = true; // DEV USE

    public $form = [
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
        'account_type' => '',
        'first_name' => '',
        'last_name' => '',
        'address1' => '',
        'address2' => '',
        'city' => '',
        'state' => '',
        'zip' => '',
        'phone' => '',
        'dob' => '',
        'newsletter' => false,
        'is_minor' => false,
        'hid' => '',
        'nid' => '',
        'nlabel' => 'Downtown', // Hardcoded
        'geometry' => 'POLYGON((0 0, 1 1, 1 0, 0 0))', // Hardcoded
        'nickname' => '',
        'avatar' => null,
        'terms' => false,
        'lat' => 37.7749, // Hardcoded
        'lng' => -122.4194, // Hardcoded
    ];

    public function mount()
    {
        \Log::debug("Mounting JoinForm, checking session");
        if (Session::has('join_form_state')) {
            $state = Session::get('join_form_state');
            \Log::info("Session state found:", ['state' => $state]);
            $this->currentStep = $state['currentStep'] ?? 1;
            $this->form = array_merge($this->form, $state['form'] ?? []);
        } else {
            \Log::warning("No join_form_state in session");
        }
        $this->saveStateToSession();
    }

    public function getStepMessageProperty()
    {
        return match ($this->currentStep) {
            1 => 'create login info',
            2 => 'select account type',
            3 => 'enter personal info',
            4 => 'house location',
            5 => 'neighborhood details',
            6 => 'choose nickname and avatar',
            7 => $this->showFormData ? 'Form Data Preview' : 'Thank you for registering!',
            default => 'unknown step',
        };
    }

    protected function rulesForStep($step)
    {
        return match ($step) {
            1 => [
                'form.email' => 'required|email',
                'form.password' => 'required|min:8',
                'form.password_confirmation' => 'nullable',
            ],
            2 => [
                'form.account_type' => 'required|in:single',
            ],
            3 => [
                'form.first_name' => 'required|string|max:255',
                'form.last_name' => 'required|string|max:255',
                'form.address1' => 'required|string|max:255',
                'form.address2' => 'nullable|string|max:255',
                'form.city' => 'required|string|max:255',
                'form.state' => 'required|string|max:2',
                'form.zip' => 'required|string|regex:/^\d{5}(-\d{4})?$/',
                'form.phone' => 'nullable|string|regex:/^\+?\d{10,15}$/',
                'form.dob' => 'required|date|before:today',
            ],
            4 => [], // No validation
            5 => [], // No validation
            6 => [
                'form.nickname' => 'required|string|max:50',
                'form.avatar' => 'nullable|image|mimes:png,jpg,gif|max:2048',
                'form.newsletter' => 'boolean',
                'form.terms' => 'required|accepted',
            ],
            default => [],
        };
    }

    protected $messages = [
        'form.email.required' => 'You must type an email address.',
        'form.email.email' => 'You must enter a valid email address.',
        'form.password.required' => 'You must type a password.',
        'form.password.min' => 'Your password must be at least 8 characters.',
        'form.password.confirmed' => 'Your passwords do not match.',
        'form.account_type.required' => 'You must select an account type.',
        'form.account_type.in' => 'Please select a valid account type.',
        'form.first_name.required' => 'You must enter your first name.',
        'form.first_name.max' => 'Your first name cannot exceed 255 characters.',
        'form.last_name.required' => 'You must enter your last name.',
        'form.last_name.max' => 'Your last name cannot exceed 255 characters.',
        'form.address1.required' => 'You must enter your address.',
        'form.address1.max' => 'Your address cannot exceed 255 characters.',
        'form.address2.max' => 'Your address line 2 cannot exceed 255 characters.',
        'form.city.required' => 'You must enter your city.',
        'form.city.max' => 'Your city cannot exceed 255 characters.',
        'form.state.required' => 'You must select a state.',
        'form.state.max' => 'Please select a valid state.',
        'form.zip.required' => 'You must enter your ZIP code.',
        'form.zip.regex' => 'Please enter a valid ZIP code (e.g., 12345 or 12345-6789).',
        'form.phone.regex' => 'Please enter a valid phone number (10-15 digits).',
        'form.dob.required' => 'You must enter your date of birth.',
        'form.dob.date' => 'Please enter a valid date.',
        'form.dob.before' => 'Your date of birth must be before today.',
        'form.nickname.required' => 'You must enter a nickname.',
        'form.nickname.max' => 'Your nickname cannot exceed 50 characters.',
        'form.avatar.image' => 'The avatar must be an image.',
        'form.avatar.mimes' => 'The avatar must be a PNG, JPG, or GIF file.',
        'form.avatar.max' => 'The avatar file size cannot exceed 2MB.',
        'form.terms.required' => 'You must agree to the Terms and Conditions.',
        'form.terms.accepted' => 'You must agree to the Terms and Conditions.',
    ];

    public function updated($propertyName)
    {
        \Log::debug("Validating property: $propertyName on step {$this->currentStep}");
        if ($this->currentStep === 1 && $propertyName === 'form.password_confirmation' && !empty($this->form['password_confirmation'])) {
            $this->validateOnly('form.password', [
                'form.password' => 'required|min:8|confirmed',
            ], $this->messages);
        } else {
            $this->validateOnly($propertyName, $this->rulesForStep($this->currentStep), $this->messages);
        }
    }

    protected function saveStateToSession()
    {
        Session::put('join_form_state', [
            'currentStep' => $this->currentStep,
            'form' => $this->form,
        ]);
    }

    public function validateStep1()
    {
        $this->validate([
            'form.email' => 'required|email',
            'form.password' => 'required|min:8|confirmed',
        ], $this->messages);

        // Attempt login using Fortify
        if (Auth::attempt([Fortify::username() => $this->form['email'], 'password' => $this->form['password']])) {
            $user = Auth::user();
            \Log::info("Existing user logged in via join form", ['email' => $this->form['email']]);
            Session::forget('join_form_state');
            return redirect()->route('dashboard');
        }

        // If credentials fail, check if email exists
        if (User::where('email', $this->form['email'])->exists()) {
            \Log::info("Email exists but password incorrect, redirecting to password reset", ['email' => $this->form['email']]);
            Session::forget('join_form_state');
            return redirect()->route('password.request')->with('email', $this->form['email']);
        }

        // New user, proceed to step 2
        \Log::info("New user, proceeding to step 2", ['email' => $this->form['email']]);
        $this->currentStep = 2;
        $this->saveStateToSession();
    }

    public function setAccountType($type)
    {
        \Log::debug("Starting setAccountType: $type");
        $start = microtime(true);
        $this->form['account_type'] = $type;
        $this->validate($this->rulesForStep(2), $this->messages);
        $this->currentStep = 3;
        $this->saveStateToSession();
        \Log::debug("setAccountType completed in " . (microtime(true) - $start) . " seconds");
    }

    public function nextStep()
    {
        // Skip validation for steps 4 and 5
        if (!in_array($this->currentStep, [4, 5])) {
            $this->validate($this->rulesForStep($this->currentStep), $this->messages);
        }
        if ($this->currentStep < $this->maxStep) {
            $this->currentStep++;
            $this->saveStateToSession();
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
            $this->saveStateToSession();
        }
    }

    public function goToProgressStep($step)
    {
        if ($step < $this->currentStep && $step >= 1) {
            $this->currentStep = $step;
            $this->saveStateToSession();
        }
    }

    public function clearForm()
    {
        $stepFields = match ($this->currentStep) {
            1 => ['email', 'password', 'password_confirmation'],
            2 => ['account_type'],
            3 => ['first_name', 'last_name', 'address1', 'address2', 'city', 'state', 'zip', 'phone', 'dob'],
            4 => ['hid', 'lat', 'lng'],
            5 => ['nid', 'nlabel', 'geometry'],
            6 => ['nickname', 'avatar', 'newsletter', 'terms'],
            default => [],
        };

        foreach ($stepFields as $field) {
            $this->form[$field] = in_array($field, ['newsletter', 'terms']) ? false : (in_array($field, ['avatar']) ? null : '');
        }
        // Restore hardcoded values
        $this->form['lat'] = 37.7749;
        $this->form['lng'] = -122.4194;
        $this->form['nlabel'] = 'Downtown';
        $this->form['geometry'] = 'POLYGON((0 0, 1 1, 1 0, 0 0))';
        $this->resetValidation();
        $this->saveStateToSession();
    }

    public function cancel()
    {
        $this->form = array_fill_keys(array_keys($this->form), '');
        $this->form['newsletter'] = false;
        $this->form['is_minor'] = false;
        $this->form['terms'] = false;
        $this->form['avatar'] = null;
        $this->form['lat'] = 37.7749;
        $this->form['lng'] = -122.4194;
        $this->form['nlabel'] = 'Downtown';
        $this->form['geometry'] = 'POLYGON((0 0, 1 1, 1 0, 0 0))';
        $this->currentStep = 1;
        $this->resetValidation();
        Session::delete('join_form_state');
        return redirect()->to('/');
    }

    public function submit()
    {
        // Validate all steps except 4 and 5
        for ($step = 1; $step <= 6; $step++) {
            if (!in_array($step, [4, 5])) {
                $this->validate($this->rulesForStep($step), $this->messages);
            }
        }

        // Calculate is_minor based on dob
        if ($this->form['dob']) {
            $dob = Carbon::parse($this->form['dob']);
            $this->form['is_minor'] = $dob->age < 18;
        }

        $this->currentStep = 7;
        $this->saveStateToSession();
    }

    public function render()
    {
        return view('livewire.join-form')
            ->layout('layouts.guest');
    }
}