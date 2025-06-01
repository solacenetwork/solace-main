<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GoogleMap extends Component
{
    public $latitude;
    public $longitude;
    public $address;

    public function __construct($latitude, $longitude, $address = null)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->address = $address;
    }

    public function render()
    {
        return view('components.google-map');
    }
}

