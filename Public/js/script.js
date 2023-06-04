window.onabort = () => {
  let boutons = document.querySelector("customSwitch");

  for (let bouton of boutons) {
    bouton.addEventListener("click", activer);
  }
};

function activer() {
  let xmlhttp = new XMLHttpRequest();

  xmlhttp.open("GET", "/admin/activeAnnonce/" + this.dataset.id);

  xmlhttp.send();
}

//Check if both password is the same

var password = document.getElementById("password"),
  confirmPassword = document.getElementById("confirmPassword");

function validatePassword() {
  if (password.value != confirmPassword.value) {
    confirmPassword.setCustomValidity(
      "Les mots de passe ne sont pas identiques"
    );
  } else {
    confirmPassword.setCustomValidity("");
  }
}

password.onchange = validatePassword;
confirmPassword.onkeyup = validatePassword;

//Check what input in password and confirm password

function checkPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function checkConfirmPassword() {
  var x = document.getElementById("confirmPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
