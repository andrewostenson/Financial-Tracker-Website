document.getElementById('loginForm').addEventListener('submit', async function(event) {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(this);
    const message = document.getElementById('loginMessage');

    try {
        const response = await fetch('/PBT/account_managment/login.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        message.textContent = data.message;

        if (data.success) {
            message.style.color = 'green';
            setTimeout(() => {
                window.location.href = '../protected_pages/home.php';
            }, 2000);
        }

    }

    catch (error) {
        message.textContent = 'An error occurred. Please try again later.';
    }
});