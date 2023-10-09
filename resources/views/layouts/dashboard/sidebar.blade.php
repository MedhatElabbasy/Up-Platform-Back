<div class="mdk-drawer  js-mdk-drawer"
id="default-drawer"
data-align="start">
<div class="mdk-drawer__content">
   <div class="sidebar sidebar-mini sidebar-primary ps ps--active-x sidebar-dark bg-dark sidebar-right" data-perfect-scrollbar>
    
        @foreach ([
            null => [
                ['icon'=>'home', 'link'=>'dashboard', 'url'=>route('dashboard.home'), 'text'=>'الرئيسية'],
                ['icon'=>'class', 'link'=>'dashboard/categories', 'url'=>route('dashboard.categories.index'), 'text'=>'الأقسام'],
                ['icon'=>'school', 'link'=>'/', 'url'=>route('dashboard.courses.index'), 'text'=>'مكتبة المهارات'],
                ['icon'=>'videocam', 'link'=>'/', 'url'=>'#', 'text'=>'دورات أون لاين'],
                ['icon'=>'video_library', 'link'=>'/', 'url'=>route('dashboard.learning-path.index'), 'text'=>'مسارات تدريبية'],
            ],
        ] as $key => $sidebar)
       <div class="sidebar-heading">{{ $key }}</div>
       <ul class="sidebar-menu">
        @foreach ($sidebar as $key => $item)
        <!-- Item -->
        <li class="sidebar-menu-item @if(request()->is($sidebar[$key]['link'])) active @endif" data-toggle="tooltip" data-title="{{ $sidebar[$key]['text'] }}" data-placement="right" data-boundary="window" data-original-title="" title="" aria-describedby="tooltip819815">
            <a class="sidebar-menu-button active" href="{{ $sidebar[$key]['url'] }}" data-toggle="tab" role="tab" aria-selected="true">
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
