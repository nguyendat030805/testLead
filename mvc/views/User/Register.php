

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Testfreshlead/public/css/register.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container_register">
        
        <form action="./Register" method="POST">
            <h2>Sign Up</h2>
            <?php if (!empty($data['error'])): ?>
                <p style="color: red;"><?php echo $data['error']; ?></p>
            <?php endif; ?>
            <div class="input_register">
                <input type="text" name="username" placeholder="User name" required>
            </div>
            <div class="input_register">
                <input type="text"  name="phone" placeholder="Phone" required>
            </div>
            <div class="input_register">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input_register">
                <input type="text" name="address" placeholder="Address" required>
            </div>
            <div class="input_register">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="bi bi-eye-slash" id="close-password"></i> 
                <i class="bi bi-eye hidden" id="open-password"></i>
            </div>
            <div class="input_register">
                <input type="text" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
                <i class="bi bi-eye-slash" id="close-confirmpassword"></i> 
                <i class="bi bi-eye hidden" id="open-confirmpassword"></i>
            </div>
            <button class="btt_signin" type="submit">Sign Up</button>
            <div class="footer_register">
                Already have an account? <a href="/Testfreshlead/user/login">Log in</a>
            </div>
        </form>
    </div>
    <script>
        const closePassword = document.getElementById('close-password'); 
        const openPassword = document.getElementById('open-password'); 
        const passwordInput = document.querySelector('input[name="password"]'); 

        closePassword.addEventListener('click', function() { 
            passwordInput.setAttribute('type', 'text'); 
            closePassword.classList.add('hidden'); 
            openPassword.classList.remove('hidden'); 
        }); 
        openPassword.addEventListener('click', function() { 
            passwordInput.setAttribute('type', 'password'); 
            closePassword.classList.remove('hidden'); 
            openPassword.classList.add('hidden'); 
        }); 
        const closeConfirmPassword = document.getElementById('close-confirmpassword'); 
        const openConfirmPassword = document.getElementById('open-confirmpassword'); 
        const confirmPasswordInput = document.querySelector('input[name="confirmpassword"]'); 
        closeConfirmPassword.addEventListener('click', function() { 
            confirmPasswordInput.setAttribute('type', 'text'); 
            closeConfirmPassword.classList.add('hidden'); 
            openConfirmPassword.classList.remove('hidden'); 
        }); 
        openConfirmPassword.addEventListener('click', function() { 
            confirmPasswordInput.setAttribute('type', 'password'); 
            closeConfirmPassword.classList.remove('hidden'); 
            openConfirmPassword.classList.add('hidden'); 
        }); 
    </script>
</body>
</html>