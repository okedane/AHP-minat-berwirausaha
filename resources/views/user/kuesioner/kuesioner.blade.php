@extends('components.user.app')
@section('title', 'Kuesioner')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kuesioner.css') }}">

<style>
/* ── Override: card lebih compact ── */
.question-card {
    background: #fff;
    border-radius: 12px !important;
    padding: 16px 20px !important;  /* dikurangi dari 24px */
    margin-top: 16px !important;     /* dikurangi dari 24px */
    box-shadow: 0 2px 8px rgba(0,0,0,.07) !important;
    border: 1.5px solid #f0f0f0;
}

/* ── Badge pertanyaan ── */
.q-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 999px;
    background: #fbbf24;
    color: #78350f;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .4px;
}

/* ── Teks pertanyaan ── */
.q-title {
    margin: 8px 0 2px;
    font-size: 14px;        /* dikurangi dari 16px */
    font-weight: 600;
    line-height: 1.4;
    color: #1a1a1a;
}

.q-subtitle {
    font-size: 11px;
    color: #9aaa9e;
    margin: 0 0 12px;
}

/* ── Grid opsi jawaban — 1 baris horizontal ── */
.options-grid {
    display: flex;
    flex-direction: column;
    gap: 6px;               /* dikurangi dari default besar */
}

/* ── Tiap opsi ── */
.option-label {
    cursor: pointer;
}

.option-label input[type="radio"] {
    display: none;
}

.option-box {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 14px;      /* lebih kecil */
    border-radius: 8px;
    border: 1.5px solid #e8e8e8;
    background: #fafafa;
    transition: all .15s ease;
    user-select: none;
}

.option-box:hover {
    border-color: #1a5c2e;
    background: #f0faf4;
}

/* Saat dipilih */
.option-label input[type="radio"]:checked + .option-box {
    border-color: #1a5c2e;
    background: #e8f5ec;
}

.option-label input[type="radio"]:checked + .option-box .option-number {
    background: #1a5c2e;
    color: white;
}

.option-number {
    width: 24px;            /* dikurangi dari ukuran besar */
    height: 24px;
    border-radius: 50%;
    background: #e8e8e8;
    color: #555;
    font-size: 11px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all .15s;
}

.option-text {
    font-size: 13px;        /* dikurangi */
    font-weight: 500;
    color: #333;
}

/* ── Responsive: grid 2 kolom di layar lebar ── */
@media (min-width: 500px) {
    .options-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6px;
    }
}
</style>
@endpush

@section('content')

<div style="max-width:680px; margin:0 auto; padding:24px 20px 48px;">

    {{-- HERO BANNER (compact) --}}
    <div class="hero" style="padding:24px 28px; margin-bottom:16px;">
        <div class="hero-label">Penelitian Akademik</div>
        <h1 style="font-size:18px; margin-bottom:4px;">
            Kuesioner Minat Berwirausaha Mahasiswa ICA
        </h1>
        <p style="font-size:12px; opacity:.85; margin:0;">
            Universitas Bahaudin Mudhary Madura —
            AHP {{ count($kriteria) }} kriteria utama
        </p>
        <div class="hero-meta" style="margin-top:12px;">
            <div class="hero-meta-item" style="font-size:11px;">
                📋 {{ collect($kriteria)->sum(fn($k) => count($k['pertanyaan'])) }} Pertanyaan
            </div>
            <!-- <div class="hero-meta-item" style="font-size:11px;">
                ⏱ ±5 Menit
            </div> -->
            <div class="hero-meta-item" style="font-size:11px;">
                {{ count($kriteria) }} Kriteria
            </div>
        </div>
    </div>

    {{-- ERROR --}}
    @if ($errors->any())
    <div style="background:#fdecea;border:1px solid #f5c6cb;border-radius:8px;padding:12px 16px;margin-bottom:12px;">
        <ul style="margin:0;padding-left:16px;font-size:13px;color:#9c1616;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Progress text --}}
    <div id="wizard-progress"
         style="font-size:12px;color:#6b7280;font-weight:600;margin-bottom:4px;">
        Pertanyaan 1–3 dari {{ collect($kriteria)->sum(fn($k) => count($k['pertanyaan'])) }}
    </div>

    {{-- Progress bar --}}
    <div style="height:5px;background:#e5e7eb;border-radius:99px;margin-bottom:16px;overflow:hidden;">
        <div id="progress-bar-fill"
             style="height:100%;background:linear-gradient(90deg,#1a5c2e,#c8952a);
                    border-radius:99px;width:15%;transition:width .3s ease;">
        </div>
    </div>

    {{-- FORM --}}
    <form action="{{ route('user.kuesioner.store') }}" method="POST">
        @csrf

        @php
            $questionCounter = 0;
            $totalQuestions  = collect($kriteria)->sum(fn($k) => count($k['pertanyaan']));
        @endphp

        @foreach($kriteria as $i => $k)
            @forelse($k['pertanyaan'] as $j => $pertanyaan)
                @php $questionCounter++ @endphp

                <div class="question-card"
                     data-question-index="{{ $questionCounter - 1 }}">

                    {{-- Badge + Teks pertanyaan --}}
                    <span class="q-badge">
                        Pertanyaan {{ $questionCounter }} dari {{ $totalQuestions }}
                    </span>

                    <h3 class="q-title">{{ $pertanyaan }}</h3>

                    <p class="q-subtitle">Kriteria: {{ $k['nama'] }}</p>

                    {{-- Opsi jawaban --}}
                    <div class="options-grid">
                        @foreach($skala as $idx => $s)
                        <label class="option-label">
                            <input type="radio"
                                   name="jawaban[{{ $i }}][{{ $j }}]"
                                   value="{{ $s['nilai'] }}"
                                   class="option-input"
                                   required>
                            <div class="option-box">
                                <div class="option-number">{{ $idx + 1 }}</div>
                                <div class="option-text">{{ $s['label'] }}</div>
                            </div>
                        </label>
                        @endforeach
                    </div>

                </div>

            @empty
                <div style="padding:12px;border-radius:8px;background:#fff3cd;color:#856404;font-size:13px;">
                    Belum ada pertanyaan pada kriteria ini.
                </div>
            @endforelse
        @endforeach

        {{-- TOMBOL NAVIGASI --}}
        <div style="margin-top:20px;display:flex;justify-content:space-between;align-items:center;gap:10px;">

            <button type="button" id="btn-prev"
                    class="btn btn-outline"
                    style="padding:10px 20px;font-size:13px;font-weight:600;display:none;">
                ← Sebelumnya
            </button>

            <div style="margin-left:auto;display:flex;gap:8px;">
                <button type="button" id="btn-next"
                        class="btn btn-primary"
                        style="padding:10px 22px;font-size:13px;font-weight:600;">
                    Berikutnya →
                </button>
                <button type="submit" id="btn-submit"
                        class="btn btn-gold"
                        style="padding:10px 22px;font-size:13px;font-weight:600;display:none;">
                    ✓ Submit
                </button>
            </div>

        </div>
    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cards      = Array.from(document.querySelectorAll('.question-card'));
    const progressTx = document.getElementById('wizard-progress');
    const progressBr = document.getElementById('progress-bar-fill');
    const btnPrev    = document.getElementById('btn-prev');
    const btnNext    = document.getElementById('btn-next');
    const btnSubmit  = document.getElementById('btn-submit');
    const total      = cards.length;
    const perPage    = 3;
    const totalPages = Math.ceil(total / perPage);
    let   currentPage = 0;

    function updateView() {
        const start = currentPage * perPage;
        const end   = start + perPage;

        cards.forEach((card, i) => {
            card.style.display = (i >= start && i < end) ? 'block' : 'none';
        });

        // Update teks progress
        const startNo = start + 1;
        const endNo   = Math.min(end, total);
        progressTx.textContent = `Pertanyaan ${startNo}–${endNo} dari ${total}`;

        // Update progress bar
        const pct = Math.round(((currentPage + 1) / totalPages) * 100);
        progressBr.style.width = pct + '%';

        // Tombol
        btnPrev.style.display   = currentPage === 0 ? 'none' : 'inline-flex';
        const isLast = currentPage === totalPages - 1;
        btnNext.style.display   = isLast ? 'none' : 'inline-flex';
        btnSubmit.style.display = isLast ? 'inline-flex' : 'none';
    }

    function isCurrentPageAnswered() {
        const start = currentPage * perPage;
        return cards.slice(start, start + perPage).every(card =>
            card.querySelector('input[type="radio"]:checked') !== null
        );
    }

    btnNext.addEventListener('click', function () {
        if (!isCurrentPageAnswered()) {
            alert('Harap isi semua pertanyaan pada halaman ini terlebih dahulu.');
            return;
        }
        if (currentPage < totalPages - 1) {
            currentPage++;
            updateView();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });

    btnPrev.addEventListener('click', function () {
        if (currentPage > 0) {
            currentPage--;
            updateView();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });

    btnSubmit.addEventListener('click', function (e) {
        const allAnswered = cards.every(c =>
            c.querySelector('input[type="radio"]:checked') !== null
        );
        if (!allAnswered) {
            e.preventDefault();
            alert('Masih ada pertanyaan yang belum dijawab.');
        }
    });

    updateView();
});
</script>

@endsection