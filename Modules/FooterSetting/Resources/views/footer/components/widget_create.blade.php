@php
    $LanguageList = getLanguageList();
@endphp
<div class="modal fade admin-query" id="CreateModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('footer.Add Link')}}</h4>
                <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
            </div>
            <form method="POST" action="{{ route('footerSetting.footer.widget-store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row pt-0">
                        @if(isModuleActive('FrontendMultiLang'))
                            <ul class="nav nav-tabs no-bottom-border  mt-sm-md-20 mb-10 ml-3"
                                role="tablist">
                                @foreach ($LanguageList as $key => $language)
                                    <li class="nav-item">
                                        <a class="nav-link  @if (auth()->user()->language_code == $language->code) active @endif"
                                           href="#element_add{{$language->code}}"
                                           role="tab"
                                           data-toggle="tab">{{ $language->native }}  </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="tab-content">
                        @foreach ($LanguageList as $key => $language)
                            <div role="tabpanel"
                                 class="tab-pane fade @if (auth()->user()->language_code == $language->code) show active @endif  "
                                 id="element_add{{$language->code}}">
                                <div class="row">
                                    <div class="col-md-12 mt-30">
                                        <div class="input-effect">
                                            <input class="primary-input name form-control" type="text"
                                                   name="name[{{$language->code}}]"
                                                   autocomplete="off" value="">
                                            <label>{{__('footer.Page Name')}} <span class="required_mark">*</span>
                                            </label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">


                        <div class=" ">
                            <div class="input-effect">
                                <input type="hidden" name="category" id="category">
                                {{--                                <select class="niceSelect w-100 bb category form-control">--}}
                                {{--                                    <option data-display="{{__('footer.Widget Title')}}*" value="">--{{__('footer.Widget Title')}}--</option>--}}
                                {{--                                    <option value="1">{{ $FooterContent->footer_section_one_title }}</option>--}}
                                {{--                                    <option value="2">{{ $FooterContent->footer_section_two_title }}</option>--}}
                                {{--                                    <option value="3">{{ $FooterContent->footer_section_three_title }}</option>--}}
                                {{--                                </select>--}}
                                <span class="focus-border"></span>
                            </div>
                            @error('category')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-lg-12 mt-30">
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb category form-control" name="page" id="page">
                                    <option data-display="{{__('footer.Select Page')}} " value="">
                                        --{{__('footer.Select Page')}}--
                                    </option>

                                    @foreach ($staticPageList as $page)
                                        <option
                                            value="{{ $page->slug }}">{{ $page->title }}</option>
                                    @endforeach
                                </select>
                                <span class="focus-border"></span>
                            </div>
                            @error('page')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="primary-btn tr-bg mr-10"
                                    data-dismiss="modal">{{__('common.Cancel')}}</button>
                            <div class="tooltip-wrapper" data-title="" data-original-title="" title="">
                                <button type="submit" class="primary-btn fix-gr-bg tooltip-wrapper "
                                        data-original-title="" title="">
                                    <i class="ti-check"></i>
                                    {{__('common.Save')}} </button>
                            </div>

                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>
