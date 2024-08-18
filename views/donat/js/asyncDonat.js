document.querySelector('.send-form').addEventListener('submit', async (event) => {
    event.preventDefault();

    let name = document.getElementById('name').value.trim();
    let email = document.getElementById('email').value.trim();
    let card_number = document.getElementById('card_number').value.trim();
    let date = document.getElementById('date').value.trim();
    let cvv = document.getElementById('cvv').value.trim();

    let responseMessage = document.getElementById('message');
    if (!name || !card_number || !email || !date || !cvv) {
        responseMessage.innerText = 'Всі поля повинні бути заповнені';
        document.querySelector('.error-p').style.display = 'block';
        return;
    }
    if (!validateEmail(email)) {
        responseMessage.innerText = 'Введіть коректну електронну пошту';
        document.querySelector('.error-p').style.display = 'block';
        return;
    }
    if (card_number.length !== 16) {
        responseMessage.innerText = 'Введіть лише 16 цифр';
        document.querySelector('.error-p').style.display = 'block';
        return;
    }
    if (cvv.length !== 3) {
        responseMessage.innerText = 'CVV повинен містити 3 цифри';
        document.querySelector('.error-p').style.display = 'block';
        return;
    }
    if (!validateExpiryDate(date)) {
        responseMessage.innerText = 'Невірний формат терміну дії. Використовуйте MM/YY';
        document.querySelector('.error-p').style.display = 'block';
        return;
    }

    await sendDonat({name,email,card_number,date,cvv});
});
function validateEmail(email) {
    let regExp = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regExp.test(email.toLowerCase());
}

function validateExpiryDate(date) {
    let regExp = /^(0[1-9]|1[0-2])\/\d{2}$/;
    return regExp.test(date);
}

// async function sendDonat(data) {
//     try {
//         let response = await fetch('http://test/donat/send', {
//             method: 'POST',
//             headers: {'Content-Type': 'application/json'},
//             body: JSON.stringify(data)
//         });
//         let result = await response.json();
//         let responseMessage = document.getElementById('message');
//         if (!result.success) {
//             responseMessage.innerText = result.message;
//         } else {
//             window.location.href = '/donat/thank';
//         }
//     } catch (error) {
//         console.error(error);
//         document.getElementById('message').innerText = 'try again.';
//         document.querySelector('.error-p').style.display = 'block';
//     }
// }
async function sendDonat(data) {
    try {
        let response = await fetch('http://test/donat/send', {
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

