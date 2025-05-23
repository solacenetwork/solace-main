<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class JoinForm extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $maxStep = 7;
    public $showPassword = false;
    public $showPasswordConfirm = false;

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
        'nlabel' => '',
        'geometry' => '',
        'nickname' => '',
        'avatar' => null,
        'terms' => false,
    ];

    public function mount()
    {
        // Restore state from session if available
        if (Session::has('join_form_state')) {
            $state = Session::get('join_form_state');
            $this->currentStep = $state['currentStep'] ?? 1;
            $this->form = array_merge($this->form, $state['form'] ?? []);
        }
    }

    public function getStepMessageProperty()
    {
        return match ($this->currentStep) {
            1 => 'Enter your email and password',
            2 => 'Select account type',
            3 => 'Enter your personal information',
            4 => 'House ID (Coming Soon)',
            5 => 'Neighborhood ID (Coming Soon)',
            6 => 'Choose a nickname and avatar',
            7 => 'Form data review',
            default => 'Unknown step',
        };
    }

    protected function rulesForStep($step)
    {
        return match ($step) {
            1 => [
                'form.email' => 'required|email',
                'form.password' => 'required|min:8|confirmed',
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
            4 => [
                'form.hid' => 'required|string|max:255',
            ],
            5 => [
                'form.nid' => 'required|string|max:255',
                'form.nlabel' => 'nullable|string|max:255',
                'form.geometry' => 'nullable|string',
            ],
            6 => [
                'form.nickname' => 'required|string|max:50',
                'form.avatar' => 'nullable|image|mimes:png,jpg,gif|max:2048',
                'form.newsletter' => 'boolean',
                'form.terms' => 'required|accepted',
            ],
            default => [],
        };
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rulesForStep($this->currentStep));
    }

    protected function saveStateToSession()
    {
        // Store current step and all form data
        Session::put('join_form_state', [
            'currentStep' => $this->currentStep,
            'form' => $this->form,
        ]);
    }

    public function validateStep1()
    {
        $this->validate($this->rulesForStep(1));

        // Check if user exists
        $user = User::where('email', $this->form['email'])->first();
        if ($user) {
            if (Hash::check($this->form['password'], $user->password)) {
                // Log in the user
                Auth::login($user);
                Session::forget('join_form_state');
                return redirect()->route('dashboard');
            } else {
                // Redirect to forgot password
                Session::forget('join_form_state');
                return redirect()->route('password.request')->with('email', $this->form['email']);
            }
        }

        // New user, proceed to step 2
        $this->currentStep = 2;
        $this->saveStateToSession();
    }

    public function setAccountType($type)
    {
        $this->form['account_type'] = $type;
        $this->validate($this->rulesForStep(2));
        $this->currentStep = 3;
        $this->saveStateToSession();
    }

    public function nextStep()
    {
        if ($this->currentStep < $this->maxStep) {
            $this->validate($this->rulesForStep($this->currentStep));
            if ($this->currentStep == 4 && empty($this->form['hid'])) {
                $this->generateHouseId();
            }
            if ($this->currentStep == 5 && empty($this->form['nid'])) {
                $this->generateNeighborhoodId();
            }
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

    public function generateHouseId()
    {
        $this->form['hid'] = 'HID-' . uniqid();
    }

    public function generateNeighborhoodId()
    {
        $this->form['nid'] = 'NID-' . uniqid();
    }

    public function clearForm()
    {
        $stepFields = match ($this->currentStep) {
            1 => ['email', 'password', 'password_confirmation'],
            2 => ['account_type'],
            3 => ['first_name', 'last_name', 'address1', 'address2', 'city', 'state', 'zip', 'phone', 'dob'],
            4 => ['hid'],
            5 => ['nid', 'nlabel', 'geometry'],
            6 => ['nickname', 'avatar', 'newsletter', 'terms'],
            default => [],
        };

        foreach ($stepFields as $field) {
            $this->form[$field] = in_array($field, ['newsletter', 'terms']) ? false : (in_array($field, ['avatar']) ? null : '');
        }
        $this->resetValidation();
        $this->saveStateToSession();
    }

    public function cancel()
    {
        // Clear form and session
        $this->form = array_fill_keys(array_keys($this->form), '');
        $this->form['newsletter'] = false;
        $this->form['is_minor'] = false;
        $this->form['terms'] = false;
        $this->form['avatar'] = null;
        $this->currentStep = 1;
        $this->resetValidation();
        Session::forget('join_form_state');
        return redirect()->to('/');
    }

    public function submit()
    {
        $this->validate($this->rulesForStep(6));
        // Calculate is_minor based on dob
        if ($this->form['dob']) {
            $dob = Carbon::parse($this->form['dob']);
            $this->form['is_minor'] = $dob->age < 18;
        }
        $this->currentStep = 7;
        $this->saveStateToSession();
    }

    public function goToDashboard()
    {
        $this->validate($this->rulesForStep($this->currentStep));

        // Create user
        $user = app(CreatesNewUsers::class)->create([
            'name' => $this->form['first_name'] . ' ' . $this->form['last_name'],
            'email' => $this->form['email'],
            'password' => $this->form['password'],
            'password_confirmation' => $this->form['password_confirmation'],
            'account_type' => $this->form['account_type'],
            'terms' => $this->form['terms'],
            'newsletter' => $this->form['newsletter'],
            'is_minor' => $this->form['is_minor'],
            'phone' => $this->form['phone'],
            'dob' => $this->form['dob'],
            'nickname' => $this->form['nickname'],
            'avatar' => $this->form['avatar'],
        ]);

        // Create team
        $team = \App\Models\Team::create([
            'user_id' => $user->sid,
            'name' => $this->form['first_name'] . "'s Team",
            'personal_team' => true,
        ]);

        // Create neighborhood
        $neighborhood = \App\Models\Neighborhood::create([
            'label' => $this->form['nlabel'],
            'geometry' => $this->form['geometry'] ?: json_encode(['type' => 'Point', 'coordinates' => [0, 0]]),
        ]);

        // Create house
        $house = \App\Models\House::create([
            'team_id' => $team->id,
            'neighborhood_id' => $neighborhood->nid,
            'address_line_1' => $this->form['address1'],
            'address_line_2' => $this->form['address2'],
            'city' => $this->form['city'],
            'state' => $this->form['state'],
            'zip' => $this->form['zip'],
            'lat' => 0.0, // Replace with geocoding
            'lng' => 0.0, // Replace with geocoding
        ]);

        // Link user to house
        \App\Models\HouseUser::create([
            'house_id' => $house->hid,
            'user_id' => $user->sid,
            'is_primary' => true,
        ]);

        // Login and set session
        Auth::login($user);
        Session::put('extended_lifetime', true);
        Session::put('expires_at', now()->addMinutes(1440)->timestamp);
        Session::forget('join_form_state');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.join-form')
            ->layout('layouts.guest');
    }
}