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