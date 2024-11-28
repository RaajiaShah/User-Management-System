function togglePasswordVisibility() {
    var passwordField = document.getElementById('password');
    passwordField.type = passwordField.type === 'password' ? 'text': 'password';
}