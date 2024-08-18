document.querySelector('.register').addEventListener('submit', async (event) => {
    event.preventDefault();
    let name = document.getElementById('name').value.trim();
    let surname = document.getElementById('surname').value.trim();
    let email = document.getElementById('email').value.trim();
    let password = document.getElementById('password').value.trim();
    let password2 = document.getElementById('password2').value.trim();
    console.log({ name, surname, email, password, password2 });
    let responseMessage = document.getElementById('message');
    if (!name || !surname || !email || !password || !password2) {
        responseMessage.innerText = 'Всі поля повинні бути заповнені';
        document.querySelector('.error-p').style.display = 'block';
        return;
    }
    if (!validateEmail(email)) {
        responseMessage.innerText = 'Введіть коректну електронну пошту';
        document.querySelector('.error-p').style.display = 'block';
        return;
    }
    if (password !== password2) {
        responseMessage.innerText = 'Паролі не співпадають';
        document.querySelector('.error-p').style.display = 'block';
        return;
    }
    if (await emailExists(email)) {
        responseMessage.innerText = 'Користувач з такою поштою вже зареєстровано';
        document.querySelector('.error-p').style.display = 'block';
        return;
    }
    await registerUser({ name, surname, email, password, password2 });
});
function validateEmail(email) {
    let regExp = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regExp.test(email.toLowerCase());
}
async function emailExists(email) {
    try {
        let response = await fetch('http://test/client/add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email })
        });
        let result = await response.json();
        return result.exists;
    } catch (error) {
        console.error('error', error);
        return false;
    }
}
async function registerUser(data) {
    try {
        let response = await fetch('http://test/client/add', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        });
        let responseText = await response.text();
        console.log(responseText);
        let result = JSON.parse(responseText);
        let responseMessage = document.getElementById('message');

        if (responseMessage) {
            if (!result.success) {
                responseMessage.innerText = result.message;
            } else {
                window.location.href = '/';
            }
        } else {
            console.error('Element with id "responseMessage" not found.');

        }
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        let responseMessage = document.getElementById('message');
        if (responseMessage) {
            responseMessage.innerText = 'An error occurred. Please try again.';
            document.querySelector('.error-p').style.display = 'block';
        }
    }
}

