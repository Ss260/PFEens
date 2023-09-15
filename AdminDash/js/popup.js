function showAlert(message, redirectUrl) {
    const confirmation = confirm(message);
    if (confirmation && redirectUrl) {
        window.location.href = redirectUrl;
    }
}
