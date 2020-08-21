function login() {
  var userName = document.getElementById('loginuserName').value;
  var password = document.getElementById('loginpassword').value;
  document.getElementById('msg').className = "msg";

  if (userName == '' || password == '') {
    msg.className = "alert alert-danger";
    msg.innerHTML = 'Please fill out all credentials';
    return false;
  }
}

function validation() {
  var username = document.getElementById('userName').value;
  var firstname = document.getElementById('firstName').value;
  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;
  var confirmPassword = document.getElementById('confirmPassword').value;

  if (username == ''){
    document.getElementById('userNameError').innerHTML = '** Please fill the userName credential';
    return false;
  }
  if (firstname == '') {
    document.getElementById('firstNameError').innerHTML = '** Please fill the firstName credential';
    return false;
  }
  if (email == '') {
    document.getElementById('emailError').innerHTML = '** Please fill the email credential';
    return false;
  }

  if(password == ''){
    document.getElementById('passwordError').innerHTML = '** Please fill the password credential';
    return false;
  }
  if(confirmPassword == '') {
    document.getElementById('confirmPasswordError').innerHTML = '** Please fill the confirmPassword credential';
    return false;
  }

  if ((username.length <= 3) || (username.length >= 20)) {
    document.getElementById('userNameError').innerHTML = '** userName must be between 3 and 20';
    username.color.value = "1px solid red";
    return false;
  }

  if (!isNaN(username)) {
    document.getElementById('userNameError').innerHTML = '** only characters allowed';
    return false;
  }

  if ((firstname.length <= 3) || (firstname.length >= 20)) {
    document.getElementById('firstNameError').innerHTML = '** firstName must be between 3 and 20';
    return false;
  }

  if (!isNaN(firstname)) {
    document.getElementById('firstNameError').innerHTML = '** only characters allowed';
    return false;
  }

  if (email.indexOf('@') <= 0) {
    document.getElementById('emailError').innerHTML = '** @ in invalid position';
    return false;
  }
  if ((email.charAt(email.length - 4)) != '.' && (email.charAt(email.length - 3) != '.')) {
    document.getElementById('emailError').innerHTML = '** . in invalid position';
    return false;
  }

  if ((password.length <= 5) || (password.length >= 20)) {
    document.getElementById('passwordError').innerHTML = '** password must be between 5 and 20';
    return false;
  }

  if (password != confirmPassword) {
    document.getElementById('confirmPasswordError').innerHTML = '** password not matched';
    return false;
  }



}
