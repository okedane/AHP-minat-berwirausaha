<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kuesioner Minat Wirausaha – UNIBA Madura</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
    rel="stylesheet">
  <style>
    :root {
      --hijau: #1a5c2e;
      --hijau-mid: #226b38;
      --hijau-light: #e8f5ec;
      --coklat: #7b3f00;
      --coklat-mid: #a0521a;
      --coklat-light: #fdf3e7;
      --gold: #c8952a;
      --gold-light: #fff8e8;
      --white: #ffffff;
      --gray-50: #f8faf9;
      --gray-100: #f0f4f1;
      --gray-200: #dde5df;
      --gray-400: #9aaa9e;
      --gray-600: #5a6e5f;
      --gray-800: #2c3e30;
      --shadow-sm: 0 2px 8px rgba(26, 92, 46, .08);
      --shadow-md: 0 4px 20px rgba(26, 92, 46, .12);
      --shadow-lg: 0 8px 40px rgba(26, 92, 46, .16);
      --radius: 16px;
      --radius-sm: 10px;
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: var(--gray-50);
      color: var(--gray-800);
      min-height: 100vh;
    }

    /* ── NAVBAR ── */
    .navbar {
      background: var(--white);
      border-bottom: 1px solid var(--gray-200);
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: var(--shadow-sm);
    }

    .navbar-inner {
      max-width: 960px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      padding: 12px 24px;
      gap: 16px;
    }

    .logo-wrap {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    .logo-placeholder {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--hijau), var(--coklat));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      color: white;
      font-weight: 700;
      /* Ganti img ini dengan <img src="logo_uniba.png"> */
      flex-shrink: 0;
    }

    .logo-text {
      font-family: 'Playfair Display', serif;
      font-size: 20px;
      font-weight: 700;
      background: linear-gradient(90deg, var(--hijau), var(--coklat-mid));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: .5px;
    }

    .nav-tabs {
      display: flex;
      gap: 4px;
      margin-left: auto;
      background: var(--gray-100);
      border-radius: 12px;
      padding: 4px;
    }

    .nav-tab {
      padding: 8px 20px;
      border-radius: 8px;
      border: none;
      text-decoration: none;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all .2s ease;
      color: var(--gray-600);
      background: transparent;
    }

    .nav-tab.active {
      background: var(--white);
      color: var(--hijau);
      box-shadow: var(--shadow-sm);
    }

    .nav-tab:hover:not(.active) {
      color: var(--gray-800);
    }

    .user-btn {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--hijau-light);
      border: 2px solid var(--hijau);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      margin-left: 8px;
      transition: all .2s;
    }

    .user-btn:hover {
      background: var(--hijau);
    }

    .user-btn:hover svg {
      color: white;
    }

    .user-btn svg {
      color: var(--hijau);
    }

    /* ── PAGE WRAPPER ── */
    .page {
      display: none;
    }

    .page.active {
      display: block;
    }

    .container {
      max-width: 720px;
      margin: 0 auto;
      padding: 32px 24px 60px;
    }

    /* ── HERO BANNER ── */
    .hero {
      background: linear-gradient(135deg, var(--hijau) 0%, var(--hijau-mid) 60%, var(--coklat) 100%);
      border-radius: var(--radius);
      padding: 32px 36px;
      margin-bottom: 28px;
      position: relative;
      overflow: hidden;
      box-shadow: var(--shadow-lg);
    }

    .hero::before {
      content: '';
      position: absolute;
      top: -40px;
      right: -40px;
      width: 200px;
      height: 200px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .06);
    }

    .hero::after {
      content: '';
      position: absolute;
      bottom: -60px;
      left: 20px;
      width: 160px;
      height: 160px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .04);
    }

    .hero-label {
      display: inline-block;
      background: rgba(255, 255, 255, .2);
      color: white;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      padding: 4px 12px;
      border-radius: 20px;
      margin-bottom: 12px;
    }

    .hero h1 {
      font-family: 'Playfair Display', serif;
      font-size: 22px;
      color: white;
      line-height: 1.3;
      margin-bottom: 8px;
    }

    .hero p {
      color: rgba(255, 255, 255, .8);
      font-size: 13px;
      line-height: 1.6;
    }

    .hero-meta {
      display: flex;
      gap: 20px;
      margin-top: 20px;
      flex-wrap: wrap;
    }

    .hero-meta-item {
      display: flex;
      align-items: center;
      gap: 6px;
      color: rgba(255, 255, 255, .85);
      font-size: 12px;
      font-weight: 500;
    }

    .hero-meta-item svg {
      opacity: .8;
    }

    /* ── PROGRESS ── */
    .progress-wrap {
      background: var(--white);
      border-radius: var(--radius);
      padding: 20px 24px;
      margin-bottom: 24px;
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--gray-200);
    }

    .progress-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 12px;
    }

    .progress-label {
      font-size: 13px;
      font-weight: 600;
      color: var(--gray-600);
    }

    .progress-count {
      font-size: 13px;
      font-weight: 700;
      color: var(--hijau);
    }

    .progress-bar-bg {
      height: 8px;
      background: var(--gray-100);
      border-radius: 99px;
      overflow: hidden;
    }

    .progress-bar-fill {
      height: 100%;
      border-radius: 99px;
      background: linear-gradient(90deg, var(--hijau), var(--gold));
      transition: width .4s ease;
    }

    .progress-steps {
      display: flex;
      gap: 8px;
      margin-top: 14px;
      flex-wrap: wrap;
    }

    .step-dot {
      display: flex;
      align-items: center;
      gap: 5px;
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 600;
      transition: all .2s;
    }

    .step-dot.done {
      background: var(--hijau-light);
      color: var(--hijau);
    }

    .step-dot.current {
      background: var(--hijau);
      color: white;
    }

    .step-dot.upcoming {
      background: var(--gray-100);
      color: var(--gray-400);
    }

    /* ── KRITERIA SECTION ── */
    .kriteria-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: linear-gradient(90deg, var(--hijau), var(--hijau-mid));
      color: white;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: .5px;
      margin-bottom: 16px;
    }

    /* ── QUESTION CARD ── */
    .question-card {
      background: var(--white);
      border-radius: var(--radius);
      padding: 24px;
      margin-bottom: 16px;
      border: 1.5px solid var(--gray-200);
      box-shadow: var(--shadow-sm);
      transition: border-color .2s, box-shadow .2s;
      animation: slideIn .3s ease;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(12px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .question-card:hover {
      border-color: var(--gray-400);
    }

    .question-card.answered {
      border-color: var(--hijau);
      background: var(--gray-50);
    }

    .q-number {
      font-size: 11px;
      font-weight: 700;
      color: var(--gold);
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 8px;
    }

    .q-text {
      font-size: 15px;
      font-weight: 600;
      color: var(--gray-800);
      line-height: 1.5;
      margin-bottom: 18px;
    }

    /* Radio options */
    .options-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px;
    }

    .option-label {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 14px;
      border-radius: var(--radius-sm);
      border: 1.5px solid var(--gray-200);
      cursor: pointer;
      transition: all .15s ease;
      user-select: none;
      font-size: 13px;
      font-weight: 500;
      color: var(--gray-600);
    }

    .option-label:hover {
      border-color: var(--hijau);
      color: var(--hijau);
      background: var(--hijau-light);
    }

    .option-label input[type="radio"] {
      display: none;
    }

    .option-label.selected {
      border-color: var(--hijau);
      background: var(--hijau-light);
      color: var(--hijau);
      font-weight: 600;
    }

    .radio-dot {
      width: 18px;
      height: 18px;
      border-radius: 50%;
      border: 2px solid var(--gray-200);
      flex-shrink: 0;
      transition: all .15s;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .option-label.selected .radio-dot {
      border-color: var(--hijau);
      background: var(--hijau);
    }

    .radio-dot::after {
      content: '';
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: white;
      opacity: 0;
      transform: scale(0);
      transition: all .15s;
    }

    .option-label.selected .radio-dot::after {
      opacity: 1;
      transform: scale(1);
    }

    /* Nilai badge pada option */
    .option-score {
      margin-left: auto;
      font-size: 11px;
      font-weight: 700;
      color: var(--gray-400);
      background: var(--gray-100);
      padding: 2px 7px;
      border-radius: 99px;
    }

    .option-label.selected .option-score {
      color: var(--hijau);
      background: rgba(26, 92, 46, .1);
    }

    /* ── NAVIGATION BUTTONS ── */
    .btn-row {
      display: flex;
      gap: 12px;
      justify-content: space-between;
      margin-top: 28px;
      align-items: center;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 28px;
      border-radius: var(--radius-sm);
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
      border: none;
      transition: all .2s;
      text-decoration: none;
    }

    .btn-outline {
      background: var(--white);
      color: var(--gray-600);
      border: 1.5px solid var(--gray-200);
    }

    .btn-outline:hover {
      border-color: var(--hijau);
      color: var(--hijau);
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--hijau), var(--hijau-mid));
      color: white;
      box-shadow: 0 4px 14px rgba(26, 92, 46, .3);
    }

    .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(26, 92, 46, .4);
    }

    .btn-primary:disabled {
      opacity: .5;
      cursor: not-allowed;
      transform: none;
    }

    .btn-gold {
      background: linear-gradient(135deg, var(--gold), var(--coklat-mid));
      color: white;
      box-shadow: 0 4px 14px rgba(200, 149, 42, .3);
    }

    .btn-gold:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(200, 149, 42, .4);
    }

    /* ── HASIL PAGE ── */
    .hasil-hero {
      border-radius: var(--radius);
      padding: 36px;
      margin-bottom: 24px;
      text-align: center;
      box-shadow: var(--shadow-lg);
      position: relative;
      overflow: hidden;
    }

    .hasil-hero.tinggi {
      background: linear-gradient(135deg, #1a5c2e, #226b38);
    }

    .hasil-hero.sedang {
      background: linear-gradient(135deg, #7b5800, #a07200);
    }

    .hasil-hero.rendah {
      background: linear-gradient(135deg, #5c1a1a, #7a2c2c);
    }

    .hasil-icon {
      font-size: 52px;
      margin-bottom: 12px;
      display: block;
    }

    .hasil-kategori-label {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, .7);
      margin-bottom: 6px;
    }

    .hasil-kategori {
      font-family: 'Playfair Display', serif;
      font-size: 36px;
      font-weight: 700;
      color: white;
      margin-bottom: 8px;
    }

    .hasil-score {
      display: inline-block;
      background: rgba(255, 255, 255, .2);
      color: white;
      font-size: 15px;
      font-weight: 700;
      padding: 6px 18px;
      border-radius: 99px;
      margin-bottom: 12px;
    }

    .hasil-desc {
      color: rgba(255, 255, 255, .85);
      font-size: 14px;
      line-height: 1.6;
    }

    /* Rekomendasi usaha */
    .rekomen-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      margin-top: 20px;
    }

    .rekomen-card {
      background: var(--white);
      border-radius: var(--radius-sm);
      padding: 16px;
      border: 1.5px solid var(--gray-200);
      box-shadow: var(--shadow-sm);
      display: flex;
      align-items: flex-start;
      gap: 12px;
      transition: all .2s;
      animation: slideIn .4s ease;
    }

    .rekomen-card:hover {
      border-color: var(--hijau);
      box-shadow: var(--shadow-md);
    }

    .rekomen-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      background: var(--hijau-light);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      flex-shrink: 0;
    }

    .rekomen-name {
      font-size: 13px;
      font-weight: 700;
      color: var(--gray-800);
      margin-bottom: 3px;
    }

    .rekomen-desc {
      font-size: 11px;
      color: var(--gray-600);
      line-height: 1.4;
    }

    /* Detail nilai kriteria */
    .nilai-section {
      background: var(--white);
      border-radius: var(--radius);
      padding: 24px;
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--gray-200);
      margin-top: 20px;
    }

    .nilai-title {
      font-size: 14px;
      font-weight: 700;
      color: var(--gray-800);
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .nilai-row {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 12px;
    }

    .nilai-name {
      font-size: 13px;
      font-weight: 500;
      color: var(--gray-600);
      width: 160px;
      flex-shrink: 0;
    }

    .nilai-bar-bg {
      flex: 1;
      height: 8px;
      background: var(--gray-100);
      border-radius: 99px;
      overflow: hidden;
    }

    .nilai-bar-fill {
      height: 100%;
      border-radius: 99px;
      background: linear-gradient(90deg, var(--hijau), var(--gold));
      transition: width .6s ease;
    }

    .nilai-val {
      font-size: 13px;
      font-weight: 700;
      color: var(--hijau);
      width: 36px;
      text-align: right;
    }

    /* ── REKAP PAGE ── */
    .rekap-header {
      background: var(--white);
      border-radius: var(--radius);
      padding: 20px 24px;
      margin-bottom: 20px;
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--gray-200);
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }

    .rekap-title {
      font-family: 'Playfair Display', serif;
      font-size: 20px;
      color: var(--gray-800);
    }

    .rekap-date {
      font-size: 12px;
      color: var(--gray-600);
    }

    .stats-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
      margin-bottom: 20px;
    }

    .stat-card {
      background: var(--white);
      border-radius: var(--radius-sm);
      padding: 16px;
      text-align: center;
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--gray-200);
    }

    .stat-num {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      font-weight: 700;
    }

    .stat-num.hijau {
      color: var(--hijau);
    }

    .stat-num.gold {
      color: var(--gold);
    }

    .stat-num.coklat {
      color: var(--coklat);
    }

    .stat-label {
      font-size: 11px;
      color: var(--gray-600);
      font-weight: 600;
      margin-top: 2px;
    }

    .rekap-table-wrap {
      background: var(--white);
      border-radius: var(--radius);
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--gray-200);
      overflow: hidden;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead tr {
      background: linear-gradient(90deg, var(--hijau), var(--hijau-mid));
    }

    thead th {
      padding: 14px 16px;
      text-align: left;
      color: white;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: .5px;
      text-transform: uppercase;
    }

    tbody tr {
      border-bottom: 1px solid var(--gray-100);
      transition: background .15s;
    }

    tbody tr:last-child {
      border-bottom: none;
    }

    tbody tr:hover {
      background: var(--gray-50);
    }

    tbody td {
      padding: 12px 16px;
      font-size: 13px;
      color: var(--gray-800);
    }

    .kat-badge {
      display: inline-block;
      padding: 3px 10px;
      border-radius: 99px;
      font-size: 11px;
      font-weight: 700;
    }

    .kat-badge.tinggi {
      background: var(--hijau-light);
      color: var(--hijau);
    }

    .kat-badge.sedang {
      background: var(--gold-light);
      color: var(--gold);
    }

    .kat-badge.rendah {
      background: #fdecea;
      color: #9c1616;
    }

    /* ── ALERT INFO ── */
    .info-box {
      background: var(--coklat-light);
      border: 1.5px solid #e8c49a;
      border-radius: var(--radius-sm);
      padding: 14px 16px;
      font-size: 13px;
      color: var(--coklat);
      margin-bottom: 20px;
      display: flex;
      gap: 10px;
      align-items: flex-start;
    }

    /* ── EMPTY STATE ── */
    .empty-state {
      text-align: center;
      padding: 48px 24px;
      color: var(--gray-400);
    }

    .empty-state .empty-icon {
      font-size: 48px;
      margin-bottom: 12px;
    }

    .empty-state p {
      font-size: 14px;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 600px) {
      .options-grid {
        grid-template-columns: 1fr;
      }

      .rekomen-grid {
        grid-template-columns: 1fr;
      }

      .stats-row {
        grid-template-columns: 1fr;
      }

      .logo-text {
        font-size: 16px;
      }

      .nav-tabs {
        gap: 2px;
      }

      .nav-tab {
        padding: 7px 12px;
        font-size: 13px;
      }
    }
  </style>

  <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- ← WAJIB untuk submit --}}
  @stack('styles') {{-- ← untuk @push('styles') --}}
</head>

<body>


  <!-- ══ NAVBAR ══ -->
  @include('components.user.navbar')

  @yield('content')

 



</body>

</html>