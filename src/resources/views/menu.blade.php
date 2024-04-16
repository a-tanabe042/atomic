@if(isset($_COOKIE["menu_keep"]) && $_COOKIE["menu_keep"] == "off")
<div class="hamburger_keep_pc">
@else
<div class="hamburger_pc active">
@endif
    <span></span>
    <span></span>
    <span></span>
</div>

@if(isset($_COOKIE["menu_keep"]) && $_COOKIE["menu_keep"] == "off")
<div id="left_menu_keep_area" class="on off bg-color-brown">
@else
<div id="left_menu_area" class="on bg-color-brown">
@endif

    @if(isset($_COOKIE["menu_keep"]) && $_COOKIE["menu_keep"] == "off")
    <div class="left-menu_keep">
    @else
    <div class="left-menu">
    @endif
        <div class="menu-list">
            <p class="menu-category-title mb-0 text-white">レジュメ</p>
            <a href="/resume-list">
                <p class="menu-text mb-0 text-white">一覧</p>
            </a>
            <hr>
            @if (session()->get('auth_name') === 'admin')
                <p class="menu-category-title mb-0 text-white">マスタ管理</p>
                <a class="" href="/master/skill">
                    <p class="menu-text mb-0 text-white">スキル</p>
                </a>
                <a href="/master/department">
                    <p class="menu-text mb-0 text-white">部署</p>
                </a>
                <a href="/master/announcements">
                    <p class="menu-text mb-0 text-white">お知らせ</p>
                </a>
                <hr>
            @endif
            @if (session()->get('auth_name') === 'admin' ||
                    session()->get('auth_name') === 'sales' ||
                    session()->get('auth_name') === 'manager')
                <p class="menu-category-title mb-0 text-white">営業管理</p>
                <a href="/contract-list">
                    <p class="menu-text mb-0 text-white">契約管理・延長情報</p>
                </a>
                @if (session()->get('auth_name') === 'admin' || session()->get('auth_name') === 'sales')
                    <a href="/calendar">
                        <p class="menu-text mb-0 text-white">カレンダー招待</p>
                    </a>
                @endif
                <a href="/company">
                    <p class="menu-text mb-0 text-white">企業登録</p>
                </a>
                <hr>
            @endif
            <a href="/logout">
                <p class="menu-text mb-0 text-white">ログアウト</p>
            </a>
        </div>
    </div>
</div>

<div class="top-menu bg-color-brown">
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <nav class="globalMenuSp hide" id="hidden2">
        <ul>
            <li><a href="/resume-list">レジュメ一覧</a></li>
            <li>
                <form method="GET"name="logoutHide" action="{{ route('logout') }}">
                    @csrf
                    <a href="javascript:logoutHide.submit()">ログアウト</a>
                </form>
            </li>
        </ul>
    </nav>
</div>
