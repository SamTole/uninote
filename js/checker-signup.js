/* JavaScript functions to validate user input*/

function number_checker(input_string) {
  for (var i = 0; i < input_string.length; i++) {
    if (input_string.charAt(i) >= '0' && input_string.charAt(i) <= '9') {
      document.getElementById("output_num").innerHTML = "First and last name must not contain numbers.";
      return false;
    }
  }
  return true;
}

function specialok_checker(input_string) {
  if (/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(input_string)) {
    return true;
  }
  else {
    document.getElementById("output_specialok").innerHTML = "Password must contain at least one special character.";
    return false;
  }
}

function specialbad_checker(input_string) {
  if (!/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(input_string)) {
    return true;
  }
  else {
    document.getElementById("output_specialbad").innerHTML = "First and last name must not contain special characters.";
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
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var college = document.getElementById("college").value;
  var major = document.getElementById("major").value;

  if (empty_check(email) && empty_check(password) && empty_check(fname) && empty_check(lname) && empty_check(college) & empty_check(major)) {
    document.getElementById("output_empty").innerHTML = "";
    var check_email = email_checker(email);
    if (check_email) {
      document.getElementById("output_email").innerHTML = "";
    }
    var check_pass = specialok_checker(password);
    if (check_pass) {
      document.getElementById("output_specialok").innerHTML = "";
    }
    var check_fnamenum = number_checker(fname);
    if (check_fnamenum) {
      document.getElementById("output_num").innerHTML = "";
      var check_lnamenum = number_checker(lname);
    }
    var check_fnamechar = specialbad_checker(fname);
    if (check_fnamechar) {
      document.getElementById("output_specialbad").innerHTML = "";
      var check_lnamechar = specialbad_checker(lname);
    }

    if (check_email && check_pass && check_fnamenum && check_fnamechar && check_lnamenum && check_lnamechar) {
      return true;
    }
    else {
      return false;
    }
  }
  else {
    document.getElementById("output_email").innerHTML = "";
    document.getElementById("output_specialok").innerHTML = "";
    document.getElementById("output_num").innerHTML = "";
    document.getElementById("output_specialbad").innerHTML = "";
    return false;
  }
}