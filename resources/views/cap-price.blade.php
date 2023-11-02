@extends('backend.master')
@push('styles')
    <link rel="stylesheet" href="{{ asset('public/backend/css/daterangepicker.css') }}">
@endpush
@section('mainContent')
    @include('backend.partials.alertMessage')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @include('backend.partials.alertMessage')

    {!! generateBreadcrumb() !!}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 ">
                <div class="card ">
                    <div class="card-header">{{__('cap.Currency Converter')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('CapPrice.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="currency">{{__('cap.Enter the price of the cap in riyals (SAR)')}}</label>
                                <input id="currency" type="number" step="0.01" class="form-control" name="currency"  value="{{ $valueByCap }}"
                                    required autofocus pattern="[0-9]+(\.[0-9]{1,2})?"
                                    title="Currency must be a number or decimal">
                            </div>


                            <button type="submit" class="primary-btn semi_large fix-gr-bg">{{__('cap.Convert')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        document.querySelector('#currency').addEventListener('blur', function() {
            const currency = this.value;
            if (!/^[0-9]+(\.[0-9]{1,2})?$/.test(currency)) {
                alert({{__('cap.Currency must be a number or decimal')}});
                this.focus();
            }
        });
        
       
        
    </script>
    
    
@endpush

