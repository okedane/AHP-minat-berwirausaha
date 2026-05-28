/**
 * public/js/kuesioner.js
 * Logika navigasi & submit kuesioner AHP
 * window.KRITERIA dan window.SKALA diinjeksi dari blade via @json()
 */

let currentKriteria = 0;
let jawaban = [];

// ── INIT ──────────────────────────────────────────────────
function initKuesioner() {
    // Inisialisasi array jawaban kosong sesuai jumlah kriteria & pertanyaan
    jawaban = window.KRITERIA.map(k => Array(k.pertanyaan.length).fill(null));
    renderProgressSteps();
    renderQuestions();
    updateNav();
}

// ── PROGRESS STEPS ────────────────────────────────────────
function renderProgressSteps() {
    const el = document.getElementById('progress-steps');
    if (!el) return;

    el.innerHTML = window.KRITERIA.map((k, i) => {
        const cls  = i < currentKriteria ? 'done' : i === currentKriteria ? 'current' : 'upcoming';
        const icon = i < currentKriteria ? '✓' : k.emoji;
        return `<div class="step-dot ${cls}">${icon} ${k.nama}</div>`;
    }).join('');

    // Update progress bar
    const pct  = ((currentKriteria + 1) / window.KRITERIA.length) * 100;
    const fill = document.getElementById('progress-fill');
    const txt  = document.getElementById('progress-text');
    if (fill) fill.style.width = pct + '%';
    if (txt)  txt.textContent  = `Kriteria ${currentKriteria + 1} dari ${window.KRITERIA.length}`;
}

// ── RENDER PERTANYAAN ─────────────────────────────────────
function renderQuestions() {
    const area = document.getElementById('questions-area');
    if (!area) return;

    const k         = window.KRITERIA[currentKriteria];
    const totalQ    = window.KRITERIA.reduce((s, kr) => s + kr.pertanyaan.length, 0);
    const offsetNo  = window.KRITERIA
        .slice(0, currentKriteria)
        .reduce((s, kr) => s + kr.pertanyaan.length, 0);

    area.innerHTML = `
        <div class="kriteria-badge">
            ${k.emoji} ${k.nama}
            <span style="opacity:.7; font-weight:500; margin-left:4px;">
                — Bobot ${(k.bobot * 100).toFixed(1)}%
            </span>
        </div>
        ${k.pertanyaan.map((q, qi) => `
            <div class="question-card ${jawaban[currentKriteria][qi] !== null ? 'answered' : ''}"
                 id="card-${qi}">
                <div class="q-number">
                    Pertanyaan ${offsetNo + qi + 1} dari ${totalQ}
                </div>
                <div class="q-text">${q}</div>
                <div class="options-grid">
                    ${window.SKALA.map(s => `
                        <label class="option-label ${jawaban[currentKriteria][qi] === s.nilai ? 'selected' : ''}"
                               onclick="pilihJawaban(${qi}, ${s.nilai}, this)">
                            <input type="radio"
                                   name="q_${currentKriteria}_${qi}"
                                   value="${s.nilai}"
                                   ${jawaban[currentKriteria][qi] === s.nilai ? 'checked' : ''}>
                            <div class="radio-dot"></div>
                            ${s.label}
                            <span class="option-score">${s.nilai}</span>
                        </label>
                    `).join('')}
                </div>
            </div>
        `).join('')}
    `;
}

// ── PILIH JAWABAN ─────────────────────────────────────────
function pilihJawaban(qi, nilai, labelEl) {
    jawaban[currentKriteria][qi] = nilai;

    // Update tampilan visual
    const card = document.getElementById('card-' + qi);
    card.querySelectorAll('.option-label').forEach(l => l.classList.remove('selected'));
    labelEl.classList.add('selected');
    card.classList.add('answered');
}

// ── NAVIGASI ──────────────────────────────────────────────
function updateNav() {
    const btnPrev   = document.getElementById('btn-prev');
    const btnNext   = document.getElementById('btn-next');
    const btnSubmit = document.getElementById('btn-submit');
    const isLast    = currentKriteria === window.KRITERIA.length - 1;

    if (btnPrev)   btnPrev.style.display   = currentKriteria === 0 ? 'none' : '';
    if (btnNext)   btnNext.style.display   = isLast ? 'none' : '';
    if (btnSubmit) btnSubmit.style.display = isLast ? '' : 'none';
}

function prevKriteria() {
    if (currentKriteria > 0) {
        currentKriteria--;
        renderProgressSteps();
        renderQuestions();
        updateNav();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

function nextKriteria() {
    if (currentKriteria < window.KRITERIA.length - 1) {
        currentKriteria++;
        renderProgressSteps();
        renderQuestions();
        updateNav();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

// ── SUBMIT → POST ke Laravel Controller ──────────────────
function submitKuesioner() {
    // Validasi: pastikan semua pertanyaan sudah dijawab
    let adaBelumIsi = false;
    let krisBelumIsi = -1;

    jawaban.forEach((kJawaban, ki) => {
        kJawaban.forEach(val => {
            if (val === null) {
                adaBelumIsi = true;
                if (krisBelumIsi === -1) krisBelumIsi = ki;
            }
        });
    });

    if (adaBelumIsi) {
        // Arahkan ke kriteria yang belum diisi
        currentKriteria = krisBelumIsi;
        renderProgressSteps();
        renderQuestions();
        updateNav();
        alert(`Harap isi semua pertanyaan pada kriteria "${window.KRITERIA[krisBelumIsi].nama}" terlebih dahulu.`);
        return;
    }

    // Buat form POST ke controller
    const form  = document.createElement('form');
    form.method = 'POST';
    form.action = document.getElementById('form-action').value;

    // CSRF Token (wajib di Laravel)
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        alert('CSRF token tidak ditemukan. Pastikan layout Anda punya <meta name="csrf-token">');
        return;
    }
    const csrf   = document.createElement('input');
    csrf.type    = 'hidden';
    csrf.name    = '_token';
    csrf.value   = csrfMeta.content;
    form.appendChild(csrf);

    // Kirim jawaban: jawaban[kriteria_index][pertanyaan_index] = nilai
    jawaban.forEach((kJawaban, ki) => {
        kJawaban.forEach((val, qi) => {
            const input = document.createElement('input');
            input.type  = 'hidden';
            input.name  = `jawaban[${ki}][${qi}]`;
            input.value = val;
            form.appendChild(input);
        });
    });

    // Tampilkan loading state
    const btnSubmit = document.getElementById('btn-submit');
    if (btnSubmit) {
        btnSubmit.disabled   = true;
        btnSubmit.textContent = '⏳ Memproses...';
    }

    document.body.appendChild(form);
    form.submit();
}