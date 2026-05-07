// Toast Trigger Function
function setupToast(triggerId, toastId) {
    const toastTrigger = document.getElementById(triggerId);
    const toastElement = document.getElementById(toastId);

    if (toastTrigger && toastElement) {
        toastTrigger.addEventListener("click", function () {
            new bootstrap.Toast(toastElement).show();
        });
    }
}

// Setup individual toasts
setupToast("liveToastBtn", "liveToast");
setupToast("borderedToast1Btn", "borderedToast1");
setupToast("borderedToast2Btn", "borderedToast2");
setupToast("borderedTost3Btn", "borderedTost3"); // Catatan: Apakah seharusnya `borderedToast3Btn`?
setupToast("borderedToast4Btn", "borderedToast4");

// Toast placement logic
const toastPlacement = document.getElementById("toastPlacement");
const selectPlacement = document.getElementById("selectToastPlacement");

if (toastPlacement && selectPlacement) {
    selectPlacement.addEventListener("change", function () {
        if (!toastPlacement.dataset.originalClass) {
            toastPlacement.dataset.originalClass = toastPlacement.className;
        }
        toastPlacement.className = `${toastPlacement.dataset.originalClass} ${this.value}`;
    });
}

// Show all example toasts manually with autohide disabled
document.querySelectorAll(".bd-example .toast").forEach(function (toastEl) {
    new bootstrap.Toast(toastEl, { autohide: false }).show();
});
