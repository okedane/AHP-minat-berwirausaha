<nav class="uniba-navbar">
    <div class="uniba-navbar-inner">

        {{-- ── LOGO ── --}}
        <a class="uniba-logo" href="{{ route('user.kuesioner') }}">
            <div class="uniba-logo-img">
                <img src="{{ asset('assets/images/favicon.ico') }}"
                     alt="Logo UNIBA Madura"
                     style="width:36px;height:36px;object-fit:contain;">
            </div>
            <div class="uniba-logo-text">
                <span class="uniba-logo-main">UNIBA</span>
                <span class="uniba-logo-sub">MADURA</span>
            </div>
        </a>

        {{-- ── NAV TABS ── --}}
        <div class="uniba-nav-tabs">
            <a class="uniba-nav-tab {{ request()->routeIs('user.kuesioner*') ? 'active' : '' }}"
               href="{{ route('user.kuesioner') }}">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2
                           M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                </svg>
                Kuesioner
            </a>
            <a class="uniba-nav-tab {{ request()->routeIs('user.hasil*') ? 'active' : '' }}"
               href="{{ route('user.hasil') }}">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0
                           0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0
                           0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Hasil
            </a>
            <a class="uniba-nav-tab {{ request()->routeIs('user.rekap*') ? 'active' : '' }}"
               href="{{ route('user.rekap') }}">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                Rekap
            </a>
        </div>

        {{-- ── USER DROPDOWN ── --}}
        <div class="uniba-user-wrap">
            <button class="uniba-user-btn" id="userDropdownBtn" onclick="toggleDropdown()">
                <div class="uniba-user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
                <span class="uniba-user-name">
                    {{ Str::limit(Auth::user()->name ?? 'User', 12) }}
                </span>
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2.5" class="uniba-chevron">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            {{-- Dropdown --}}
            <div class="uniba-dropdown" id="userDropdown">
                <a href="{{ route('user.profile') }}" class="uniba-dropdown-header">
                    <div class="uniba-dropdown-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div>
                        <div class="uniba-dropdown-name">
                            {{ Auth::user()->name ?? 'User' }}
                        </div>
                        <div class="uniba-dropdown-email">
                            {{ Auth::user()->email ?? '' }}
                        </div>
                    </div>
                </a>
                <div class="uniba-dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="uniba-dropdown-logout">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0
                                   01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>
</nav>

{{-- ── CSS NAVBAR ── --}}


{{-- ── JAVASCRIPT — toggle dropdown ── --}}
<script>
function toggleDropdown() {
    const dd  = document.getElementById('userDropdown');
    const btn = document.getElementById('userDropdownBtn');
    dd.classList.toggle('open');
    btn.classList.toggle('open');
}

// Tutup dropdown jika klik di luar
document.addEventListener('click', function (e) {
    const wrap = document.querySelector('.uniba-user-wrap');
    if (wrap && !wrap.contains(e.target)) {
        document.getElementById('userDropdown')?.classList.remove('open');
        document.getElementById('userDropdownBtn')?.classList.remove('open');
    }
});
</script>