const emailInput = document.querySelector('input[name="email"]');
const passwordRepeatInput = document.querySelector('input[name="passwordRepeat"]');

function isEmail(email) {
    return /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/.test(email);
}

function arePasswordsSame(password, passwordRepeat) {
    return password === passwordRepeat;
}

function markInvalidInput(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

function validateEmail() {
    setTimeout(function() {
            markInvalidInput(emailInput, isEmail(emailInput.value));
        },
        1000
    );
}

function validatePasswords() {
    setTimeout(function () {
            const condition = arePasswordsSame(passwordRepeatInput.previousElementSibling.value,
                passwordRepeatInput.value);
            markInvalidInput(passwordRepeatInput, condition);
        },
        1000
    );
}

emailInput.addEventListener('keyup', validateEmail);
passwordRepeatInput.addEventListener('keyup', validatePasswords);