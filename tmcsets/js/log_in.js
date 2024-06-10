function syncVisiblePassword() {
    var passwordField = document.getElementById('password');
    var passwordVisibleField = document.getElementById('passwordVisible');
    passwordVisibleField.value = passwordField.value;
}

document.getElementById('show-password').addEventListener('click', function () {
    var passwordField = document.getElementById('password');
    var passwordVisibleField = document.getElementById('passwordVisible');
    // Toggle password field visibility
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordVisibleField.style.display = 'none';
    } else {
        passwordField.type = 'password';
        syncVisiblePassword(); // Sync visible password when toggling back to password type
        passwordVisibleField.style.display = 'none'; // Hide visible password field
    }
});

// Ensure password text field is positioned correctly when password visibility toggles
document.getElementById('password').addEventListener('focus', function () {
    var passwordContainer = document.getElementById('passwordContainer');
    passwordContainer.style.position = 'relative';
});