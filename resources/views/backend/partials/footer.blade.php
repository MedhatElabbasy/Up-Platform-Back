<footer class="footer-area">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 text-center">
                <!--<p class="p-3 mt-5">{!! Settings('copyright_text') !!}</p>-->
                <p class="p-3 mt-5">{{'Qutell technology '.date('Y')}}</p>
            </div>
        </div>
    </div>
</footer>
</div>
</div>

<div class="modal fade admin-query" id="commonModal">

</div>

@if(isModuleActive("AIContent"))
    @include('aicontent::content_generator_modal')
@endif

@if(isModuleActive("WhatsappSupport"))
    @include('whatsappsupport::partials._popup')
@endif

@include('backend.partials.script')
{!! Toastr::message() !!}

@if($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{ $error }}', 'Error', {
            closeButton: true,
            progressBar: true,
        });
        @endforeach
    </script>
@endif

@if(env('APP_SYNC') || env('DEMO_MODE'))
    <a target="_blank" href="https://aorasoft.com/" class="float_button"> <i class="ti-shopping-cart-full"></i>
        <h3>Purchase InfixLMS</h3>
    </a>
@endif
@livewireScripts
<script src="{{ asset('public/js/alpine.min.js') }}"></script>

<script>
    window.jsLang = function (key, replace) {
        let translation = true

        let json_file = $.parseJSON(window._translations[window._locale]['json'])
        translation = json_file[key]
            ? json_file[key]
            : key


        $.each(replace, (value, key) => {
            translation = translation.replace(':' + key, value)
        })

        return translation
    }

</script>
@stack('js')

</body>
</html>
