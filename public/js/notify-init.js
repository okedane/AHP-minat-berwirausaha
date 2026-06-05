// ...existing code...
(function () {
    if (typeof $ === 'undefined') return;
    var n = window.__notify || {};
    if (n.success) $.notify(n.success, { className: "success", autoHideDelay: 4000 });
    if (n.error)   $.notify(n.error,   { className: "error",   autoHideDelay: 6000 });
    if (n.info)    $.notify(n.info,    { className: "info",    autoHideDelay: 4000 });
    if (n.warnings && n.warnings.length) {
        n.warnings.forEach(function (msg) {
            $.notify(msg, { className: "warn", autoHideDelay: 5000 });
        });
    }
})();