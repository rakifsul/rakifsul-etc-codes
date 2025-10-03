function showAuthModal(modalID) {
    let authModal = new bootstrap.Modal(document.getElementById(modalID), { backdrop: "static", keyboard: false });
    authModal.show();
}