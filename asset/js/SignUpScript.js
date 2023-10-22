document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('myForm');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const addressInput = document.getElementById('address');
    const nameError = document.getElementById('nameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const addressError = document.getElementById('addressError');

    const nameRegex = /^[A-Za-z]+(?: [A-Za-z]+)*$/;// Contain letters (UPPER and lower) no leading and trailing space
    const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/; //standard email
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/; // At least 8 characterslong, at least 1 upper case, 1 number, no special characeters

    form.addEventListener('submit', function (e) {
        let valid = true;

        if (!nameRegex.test(nameInput.value)) {
            nameError.textContent = 'Name should only contain letters and should not have leading or trailing spaces.';
            nameError.style.color = 'red'; // Set the error message color to red
            valid = false;
        } else {
            nameError.textContent = '';
        }

        if (!emailRegex.test(emailInput.value)) {
            emailError.textContent = 'Please enter a valid email address';
            emailError.style.color = 'red'; // Set the error message color to red
            valid = false;
        } else {
            emailError.textContent = '';
        }

        if (!passwordRegex.test(passwordInput.value)) {
            passwordError.textContent = 'Password must be at least 8 characters long and include at least 1 uppercase letter and 1 number. Special characters are not allowed';
            passwordError.style.color = 'red'; // Set the error message color to red
            valid = false;
        } else {
            passwordError.textContent = '';
        }

        if (addressInput.value.trim() === '') {
            addressError.textContent = 'Address is required';
            addressError.style.color = 'red'; // Set the error message color to red
            valid = false;
        } else {
            addressError.textContent = '';
        }

        if (!valid) {
            e.preventDefault(); // Prevent form submission if there are errors
        }
    });
});
