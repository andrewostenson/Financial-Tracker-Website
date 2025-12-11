document.getElementById('registerForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const message = document.getElementById('registerMessage');

    try {
        const response = await fetch('/PBT/account_managment/insert.php', {
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
    else {
        message.style.color = 'red';
    }
    } 
    
    catch (error) {
        message.textContent = 'An error occurred. Please try again later.';
        message.style.color = 'red';
    }

});
