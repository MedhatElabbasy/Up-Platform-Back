<div class="mdk-drawer  js-mdk-drawer"
id="default-drawer"
data-align="start">
<div class="mdk-drawer__content">
   <div class="sidebar sidebar-light sidebar-left sidebar-p-t" data-perfect-scrollbar>
    
        @foreach ([
            'لوحة التحكم' => [
                ['icon'=>'home', 'link'=>'dashboard', 'url'=>route('dashboard.home'), 'text'=>'الرئيسية'],
                ['icon'=>'class', 'link'=>'dashboard/categories', 'url'=>route('dashboard.categories.index'), 'text'=>'الأقسام'],
            ],
            'قسم التدريب' => [
                ['icon'=>'school', 'link'=>'/', 'url'=>route('dashboard.courses.index'), 'text'=>'مكتبة المهارات'],
                ['icon'=>'videocam', 'link'=>'/', 'url'=>'#', 'text'=>'دورات أون لاين'],
                ['icon'=>'video_library', 'link'=>'/', 'url'=>'#', 'text'=>'مسارات تدريبية'],
            ],
        ] as $key => $sidebar)
       <div class="sidebar-heading">{{ $key }}</div>
       <ul class="sidebar-menu">
        @foreach ($sidebar as $key => $item)
        <!-- Item -->
        <li class="sidebar-menu-item @if(request()->is($sidebar[$key]['link'])) active @endif">
            <a class="sidebar-menu-button"
               href="{{ $sidebar[$key]['url'] }}">
                <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">{{ $sidebar[$key]['icon'] }}</i>
                <span class="sidebar-menu-text">{{ $sidebar[$key]['text'] }}</span>
            </a>
        </li>
        <!-- //Item -->
        @endforeach
       </ul>
       @endforeach

   </div>
</div>
</div>
