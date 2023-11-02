<div>
    <style data-type="aoraeditor-style">
        :root {
            --system_primery_color: #415094 {{-- $color->primary_color??'#415094' --}};
            --system_secendory_color: {{$color->secondary_color??'#202E3B' }} ;
            --footer_background_color: {{$color->footer_background_color??'#1E2147' }} ;
            --footer_headline_color: {{$color->footer_headline_color??'#ffffff' }} ;
            --footer_text_color: {{$color->footer_text_color??'#5B5C6E' }} ;
            --footer_text_hover_color: {{$color->footer_text_hover_color??'#1E2147' }} ;
            --bg_color: {{$color->bg_color??'#FFFFFF' }} ;

            --menu_bg: {{Settings('menu_bg')?Settings('menu_bg'):'#f8f9fa'}};
            --menu_text: {{Settings('menu_text')?Settings('menu_text'):'#2b3d4e'}} ;
            --menu_hover_text: {{Settings('menu_hover_text')?Settings('menu_hover_text'):'#171D27'}};
            --menu_title_text: {{Settings('menu_title_text')?Settings('menu_title_text'):'#171D27'}} ;


            --system_primery_color_0: {{ ($color->primary_color??'#1E2147').'00' }};
            --system_primery_color_05: {{ ($color->primary_color??'#1E2147').'0d' }};
            --system_primery_color_07: {{ ($color->primary_color??'#1E2147').'12' }};
            --system_primery_color_08: {{ ($color->primary_color??'#1E2147').'14' }};
            --system_primery_color_10: {{ ($color->primary_color??'#1E2147').'1a' }};
            --system_primery_color_20: {{ ($color->primary_color??'#1E2147').'33' }};
            --system_primery_color_30: {{ ($color->primary_color??'#1E2147').'4d' }};
            --system_primery_color_50: {{ ($color->primary_color??'#1E2147').'80' }};
            --system_primery_color_60: {{ ($color->primary_color??'#1E2147').'99' }};
            --system_primery_color_70: {{ ($color->primary_color??'#1E2147').'b3' }};
            --system_secendory_color_10: {{($color->secondary_color??'#202E3B').'1a' }} ;
            --sytem_gradient_2: {{ ($color->secondary_color??'#202E3B') }};


            --font_family1: "{{Settings('google_font_is_active') && Settings('google_font_family1') ? Settings('google_font_family1'):'Source Sans Pro'}}", sans-serif;
            --font_family2: "{{Settings('google_font_is_active') && Settings('google_font_family2') ? Settings('google_font_family2'):'Jost'}}", sans-serif;


        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                families: [
                    "{{Settings('google_font_is_active') && Settings('google_font_family1') ? Settings('google_font_family1'):'Source Sans Pro'}}",
                    "{{Settings('google_font_is_active') && Settings('google_font_family2') ? Settings('google_font_family2'):'Jost'}}"
                ]
            }
        });
    </script>
</div>

