<?php

namespace App\View\Components;


use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use App\Models\ConsultantPackageDetail;

class consultantPageSection extends Component
{
    public $id, $consultant;

    public function __construct($id, $consultant)
    {
        $this->consultant = $consultant;
        $this->id = $id;
    }


    public function render()
    {
        $consultantPackageDetails = ConsultantPackageDetail::where('user_id', $this->id)->get();
        return view(theme('components.consultant-page-section'), compact('consultantPackageDetails'));
    }
}
