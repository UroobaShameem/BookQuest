$(document).ready(function() {
    // Toggle between login and sign-up forms
    $('#signupToggle').click(function() {
      $('#loginForm').toggle();
      $('#signupForm').toggle();
      $('#loginModalLabel').text(function(i, text) {
        return text === 'Login / Sign up' ? 'Sign up' : 'Login / Sign up';
      });
    });
  });