async function doRequest(email, password) {
    try {
        const response = await fetch('http://test/client/sign', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email, password })
        });

        const result = await response.json();
        console.log('Response:', result);

        if (result.success === false) {
            document.getElementById('email').classList.add('error');
            document.getElementById('password').classList.add('error');
            document.getElementById('responseMessage').innerText = result.message;
            document.querySelector('.error-p').style.display = 'block';
        } else {
            document.getElementById('email').classList.remove('error');
            document.getElementById('password').classList.remove('error');
            document.getElementById('responseMessage').innerText = result.message;
            document.querySelector('.error-p').style.display = 'none';
            window.location.href = '/';
        }
    } catch (error) {
        console.error('error:', error);
        document.getElementById('responseMessage').innerText = 'Please try again.';
        document.querySelector('.error-p').style.display = 'block';

    }
}
document.querySelector('.sign').addEventListener('submit', async (event) => {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    if (document.querySelector('#register')) {
        doRequest(email, password);
    }
});






