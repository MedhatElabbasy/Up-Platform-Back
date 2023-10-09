<div class="navbar-collapse collapse flex">
    <ul class="nav navbar-nav">
        @foreach ([
            'لوحة التحكم' => [
                ['link'=>'dashboard', 'url'=>route('dashboard.home'), 'text'=>'الرئيسية'],
            ],
        ] as $key => $sidebar)
        <li class="nav-item dropdown">
            <a href="#"
               class="nav-link dropdown-toggle"
               data-toggle="dropdown">{{ $key }}</a>
            <div class="dropdown-menu">
                @foreach ($sidebar as $key => $item)
                <a class="dropdown-item"
                   href="{{ $sidebar[$key]['url'] }}">{{ $sidebar[$key]['text'] }}</a>
                @endforeach
            </div>
        </li>
        @endforeach
    </ul>
</div>