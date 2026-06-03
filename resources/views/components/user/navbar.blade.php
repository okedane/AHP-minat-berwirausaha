{{-- resources/views/components/user/navbar.blade.php --}}
{{-- Atau letakkan langsung di dalam layout app.blade.php --}}

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
                <div class="uniba-dropdown-header">
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
                </div>
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
<style>
/* ─── Variabel warna UNIBA ─────────────────────────── */
:root {
    --uniba-hijau:      #1a5c2e;
    --uniba-hijau-mid:  #226b38;
    --uniba-hijau-dark: #163f22;
    --uniba-coklat:     #7b3f00;
    --uniba-gold:       #c8952a;
    --uniba-gold-light: #fff8e8;
    --uniba-white:      #ffffff;
    --uniba-gray-50:    #f8faf9;
    --uniba-gray-100:   #f0f4f1;
    --uniba-gray-200:   #dde5df;
    --uniba-gray-600:   #5a6e5f;
    --uniba-shadow:     0 2px 16px rgba(26,92,46,.10);
}

/* ─── Navbar wrapper ───────────────────────────────── */
.uniba-navbar {
    position: sticky;
    top: 0;
    z-index: 999;
    background: var(--uniba-white);
    border-bottom: 1px solid var(--uniba-gray-200);
    box-shadow: var(--uniba-shadow);
}

.uniba-navbar-inner {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 24px;
    height: 64px;
    display: flex;
    align-items: center;
    gap: 16px;
}

/* ─── Logo ─────────────────────────────────────────── */
.uniba-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    flex-shrink: 0;
}

.uniba-logo-img {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: var(--uniba-gray-50);
    border: 1.5px solid var(--uniba-gray-200);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.uniba-logo-text {
    display: flex;
    flex-direction: column;
    line-height: 1;
}

.uniba-logo-main {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 17px;
    font-weight: 700;
    color: var(--uniba-hijau);
    letter-spacing: .5px;
}

.uniba-logo-sub {
    font-size: 10px;
    font-weight: 600;
    color: var(--uniba-coklat);
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-top: 1px;
}

/* ─── Nav Tabs ─────────────────────────────────────── */
.uniba-nav-tabs {
    display: flex;
    gap: 2px;
    background: var(--uniba-gray-100);
    border-radius: 12px;
    padding: 4px;
    margin: 0 auto; /* tengahkan */
}

.uniba-nav-tab {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 7px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    color: var(--uniba-gray-600);
    text-decoration: none;
    transition: all .18s ease;
    white-space: nowrap;
}

.uniba-nav-tab svg {
    opacity: .6;
    transition: opacity .18s;
}

.uniba-nav-tab:hover {
    color: var(--uniba-hijau);
    background: rgba(26,92,46,.08);
}

.uniba-nav-tab:hover svg { opacity: 1; }

.uniba-nav-tab.active {
    background: var(--uniba-white);
    color: var(--uniba-hijau);
    box-shadow: 0 1px 6px rgba(26,92,46,.14);
}

.uniba-nav-tab.active svg { opacity: 1; }

/* ─── User Dropdown ────────────────────────────────── */
.uniba-user-wrap {
    position: relative;
    flex-shrink: 0;
}

.uniba-user-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px 12px 6px 6px;
    border-radius: 999px;
    background: var(--uniba-gray-100);
    border: 1.5px solid var(--uniba-gray-200);
    cursor: pointer;
    transition: all .18s;
}

.uniba-user-btn:hover {
    background: var(--uniba-gray-50);
    border-color: var(--uniba-hijau);
}

.uniba-user-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--uniba-hijau), var(--uniba-coklat));
    color: white;
    font-size: 13px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.uniba-user-name {
    font-size: 13px;
    font-weight: 600;
    color: #2c3e30;
    max-width: 100px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.uniba-chevron {
    color: var(--uniba-gray-600);
    transition: transform .18s;
}

.uniba-user-btn.open .uniba-chevron {
    transform: rotate(180deg);
}

/* ─── Dropdown Panel ───────────────────────────────── */
.uniba-dropdown {
    display: none;
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    min-width: 220px;
    background: var(--uniba-white);
    border: 1px solid var(--uniba-gray-200);
    border-radius: 14px;
    box-shadow: 0 8px 30px rgba(0,0,0,.12);
    overflow: hidden;
    animation: dropIn .18s ease;
    z-index: 100;
}

.uniba-dropdown.open { display: block; }

@keyframes dropIn {
    from { opacity: 0; transform: translateY(-6px); }
    to   { opacity: 1; transform: translateY(0); }
}

.uniba-dropdown-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 16px;
    background: var(--uniba-gray-50);
}

.uniba-dropdown-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--uniba-hijau), var(--uniba-coklat));
    color: white;
    font-size: 16px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.uniba-dropdown-name {
    font-size: 13px;
    font-weight: 700;
    color: #2c3e30;
}

.uniba-dropdown-email {
    font-size: 11px;
    color: var(--uniba-gray-600);
    margin-top: 2px;
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.uniba-dropdown-divider {
    height: 1px;
    background: var(--uniba-gray-200);
}

.uniba-dropdown-logout {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    border: none;
    background: none;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    color: #c0392b;
    transition: background .15s;
    text-align: left;
}

.uniba-dropdown-logout:hover {
    background: #fdecea;
}

/* ─── Responsive ───────────────────────────────────── */
@media (max-width: 600px) {
    .uniba-navbar-inner { padding: 0 12px; }
    .uniba-logo-text    { display: none; }
    .uniba-user-name    { display: none; }
    .uniba-nav-tab span { display: none; }
    .uniba-nav-tab      { padding: 7px 12px; }
}
</style>

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