//For account.php
// Select the password input field and the elements to display validation messages
const myInput = document.getElementById("registerPwd");
const letter = document.getElementById("letter");
const capital = document.getElementById("capital");
const number = document.getElementById("number");
const lengthEl = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.addEventListener("focus", () => {
  document.getElementById("message").style.display = "block";
});

// When the user clicks outside of the password field, hide the message box
myInput.addEventListener("blur", () => {
  document.getElementById("message").style.display = "none";
});

// When the user starts to type something inside the password field
myInput.addEventListener("input", () => {
  // Validate lowercase letters
  const lowerCaseLetters = /[a-z]/g;
  if (myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }

  // Validate capital letters
  const upperCaseLetters = /[A-Z]/g;
  if (myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  const numbers = /[0-9]/g;
  if (myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if (myInput.value.length >= 8) {
    lengthEl.classList.remove("invalid");
    lengthEl.classList.add("valid");
  } else {
    lengthEl.classList.remove("valid");
    lengthEl.classList.add("invalid");
  }
});