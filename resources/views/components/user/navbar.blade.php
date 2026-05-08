<nav class="navbar">
  <div class="navbar-inner">
    <a class="logo-wrap" href="#">
      <!--
        CARA PAKAI LOGO ANDA:
        Ganti div.logo-placeholder dengan:
        <img src="path/to/logo_uniba.png" alt="UNIBA Madura" style="width:48px;height:48px;object-fit:contain;">
      -->
      <div class="logo-placeholder">U</div>
      <span class="logo-text">UNIBA MADURA</span>
    </a>
   <div class="nav-tabs">
      <a class="nav-tab {{ request()->routeIs('kuesioner.kuesioner') ? 'active' : '' }}" href="{{ route('kuesioner.kuesioner') }}">Kuesioner</a>
      <a class="nav-tab {{ request()->routeIs('kuesioner.hasil') ? 'active' : '' }}" href="{{ route('kuesioner.hasil') }}">Hasil</a>
      <a class="nav-tab {{ request()->routeIs('kuesioner.rekap') ? 'active' : '' }}" href="{{ route('kuesioner.rekap') }}">Rekap</a>
    </div>
    <div class="user-btn">
      <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z"/>
      </svg>
    </div>
  </div>
</nav>
