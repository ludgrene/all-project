function validateEmail() {
    var email = document.getElementById('email').value;
    var pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (email.match(pattern)) {
        return true;
    } else {
        alert("Adresse e-mail non valide.");
        return false;
    }
}

window.onload = function() {
    const errorMessage = document.getElementById('error-message');
    if (errorMessage) {
        setTimeout(() => {
            errorMessage.style.display = 'none';
        }, 1000); 

        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                errorMessage.style.display = 'none';
            });
        });
    }
}




