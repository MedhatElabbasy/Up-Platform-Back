<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ConsultantsPageSection extends Component
{

    public function render()
    {
        return view(theme('components.consultants-page-section'));
    }
}
