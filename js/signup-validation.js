/**
 * Variable declarations
 */
const emailInput = document.getElementById('email'); // Email input field
const firstNameInput = document.getElementById('firstname'); // First name input field
const lastNameInput = document.getElementById('lastname'); // Last name input field
const userNameInput = document.getElementById('login'); // Username input field
const passwordInput = document.getElementById('pass'); // Password input field
const password2Input = document.getElementById('pass2'); // Password confirmation input field

/**
 * Event listeners
 */
document.forms['signup'].addEventListener('reset', clearErrorMessages); // Clears error messages on form reset
emailInput.addEventListener('blur', validateEmail); // Validates email on blur (focus out)
userNameInput.addEventListener('blur', validateLogin); // Validates username on blur
firstNameInput.addEventListener('blur', validateFirstName); // Validates firstname on blur
lastNameInput.addEventListener('blur', validateLastName); // Validates lastname on blur
passwordInput.addEventListener('blur', validatePassword); // Validates password on blur
password2Input.addEventListener('blur', validatePasswordsMatch); // Validates password confirmation on blur

/**
 * Validate function
 */
function validate() {
    const emailValid = validateEmail(); // Check if email is valid
    const loginValid = validateLogin(); // Check if username is valid
    const firstNameValid = validateFirstName(); // Check if firstName is valid
    const lastNameValid = validateLastName(); // Check if lastName is valid
    const passwordValid = validatePassword(); // Check if password is valid
    const passwordsMatch = validatePasswordsMatch(); // Check if passwords match

    const isValid = emailValid && loginValid && passwordValid && passwordsMatch && firstNameValid && lastNameValid;

    if (isValid) {
        userNameInput.value = userNameInput.value.trim();
    }

    return isValid; // Return overall validation result
}

/**
 * Individual validation functions
 */
function validateEmail() {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regular expression for email format

    let isValid = emailPattern.test(emailInput.value); // Check if email matches the pattern
    updateError(emailInput, isValid, "Email must have the shape of 'abcd@efg.com'."); // Update error message if invalid

    return isValid; // Return validation result
}

function validateLogin() {
    const userNameValue = userNameInput.value.trim(); // Trim leading/trailing spaces from username

    let isValid = userNameValue.length > 0 && userNameValue.length < 30; // Username must be non-empty and less than 30 characters

    updateError(userNameInput, isValid, "Must be between 1 and 30 characters."); // Update error message if invalid

    return isValid; // Return validation result
}

function validateFirstName() {
    const firstNameValue = firstNameInput.value.trim(); // Trim leading/trailing spaces

    let isValid = firstNameValue.length > 0 && firstNameValue.length < 30; // must be non-empty and less than 30 characters

    updateError(firstNameInput, isValid, "Must be between 1 and 30 characters."); // Update error message if invalid

    return isValid; // Return validation result
}

function validateLastName() {
    const lastNameValue = lastNameInput.value.trim(); // Trim leading/trailing spaces

    let isValid = lastNameValue.length > 0 && lastNameValue.length < 30; // must be non-empty and less than 30 characters

    updateError(lastNameInput, isValid, "Must be between 1 and 30 characters."); // Update error message if invalid

    return isValid; // Return validation result
}

function validatePassword() {
    const passwordValue = passwordInput.value; // Get password value

    let isValid = passwordValue !== null && passwordValue.length >= 8; // Password must be at least 8 characters long

    updateError(passwordInput, isValid, "Password must be at least 8 characters long."); // Update error message if invalid

    return isValid; // Return validation result
}

function validatePasswordsMatch() {
    const password2Value = password2Input.value; // Get confirmation password value
    const passwordValue = passwordInput.value; // Get original password value

    let isValid = password2Value === passwordValue; // Check if both passwords match

    updateError(password2Input, isValid, "Passwords must match."); // Update error message if they don't match

    return isValid; // Return validation result
}

/**
 * Update Error function
 */
function updateError(inputElement, isValid, errorMessage = "Invalid input.") {
    const errorElement = inputElement.nextElementSibling; // Find the error message element
    if (isValid) {
        inputElement.parentElement.classList.remove('error-on'); // Remove error class if input is valid
        errorElement.textContent = ""; // Clear error message
    } else {
        inputElement.parentElement.classList.add('error-on'); // Add error class if input is invalid
        errorElement.textContent = errorMessage; // Display error message
    }
}

/**
 * Removes the 'error-on' class on all elements that have it.
 */
function clearErrorMessages() {
    const errorElements = document.querySelectorAll('.error-on'); // Find all elements with error class
    errorElements.forEach(element => element.classList.remove('error-on')); // Remove error class from each element
}
