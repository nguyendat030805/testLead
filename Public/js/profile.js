function previewAvatar(event) { 
    var reader = new FileReader(); 
    reader.onload = function() { 
        var output = document.getElementById('avatarPreview'); 
        output.src = reader.result; 
    }; 
    reader.readAsDataURL(event.target.files[0]); 
}

document.querySelectorAll('.password-eye').forEach(eye => {
        eye.addEventListener('click', function() {
            const input = this.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                this.classList.add('fa-eye');
                this.classList.remove('fa-eye-slash');
            } else {
                input.type = 'password';
                this.classList.add('fa-eye-slash');
                this.classList.remove('fa-eye');
            }
        });
    });
    document.querySelector('.uploadImage').addEventListener('click', function() { 
        document.getElementById('chooseImage').click(); 
    });