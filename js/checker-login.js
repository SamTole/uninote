/* JavaScript functions to validate user input*/

function specialok_checker(input_string) {
  if (/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(input_string)) {
    return true;
  }
  else {
    document.getElementById("output_specialok").innerHTML = "Password must contain at least one special character.";
    return false;
  }
}

function email_checker(input_string) {
  var hasAt = false;
  for (var i = 0; i < input_string.length; i++) {
    if (input_string.charAt(i) == "@") {
      hasAt = true;
    }
    if (hasAt && input_string.charAt(i) == ".") {
      return true;
    }
  }
  document.getElementById("output_email").innerHTML = "Please enter a valid email address.";
  return false;
}

function empty_check(input_string) {
  if (input_string.length) {
    return true;
  }
  else {
    document.getElementById("output_empty").innerHTML = "Please fill in empty fields.";
    return false;
  }
}

function check_input() {
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;

  if (empty_check(email) && empty_check(password)) {
    document.getElementById("output_empty").innerHTML = "";
    var check_email = email_checker(email);
    if (check_email) {
      document.getElementById("output_email").innerHTML = "";
    }
    var check_pass = specialok_checker(password);
    if (check_pass) {
      document.getElementById("output_specialok").innerHTML = "";
    }

    if (check_email && check_pass) {
      return true;
    }
    else {
      return false;
    }
  }
  else {
    document.getElementById("output_email").innerHTML = "";
    document.getElementById("output_specialok").innerHTML = "";
    return false;
  }
}