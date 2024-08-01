<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('sneat/assets/css/styles.css') }}">
</head>
<body>
    <div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasEndLabel" class="offcanvas-title">Register</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                <div class="app-brand justify-content-center" style="margin-bottom: 50px;">
                    <span class="app-brand-text demo text-body fw-bolder">
                        <img src="{{ asset('sneat/assets/img/sima/sima.png') }}" style="width: 250px; height: auto;" alt="logo" />
                    </span>
                </div>
                <h4 class="mb-2">
                    Welcome to Sima Perkasya!
                    <i class="bx bx-bus bx-tada" style="color:#54de1c; color:#009a44; font-size: 1.5em;"></i>
                </h4>
                <p class="mb-4">PT. Jagad Sima Perkasya Group</p>

                <form id="formRegistration" class="mb-3" action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required autofocus />
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
                    </div>
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role ID</label>
                        <input type="text" id="role_id" class="form-control" name="role_id" placeholder="Masukkan role ID" required />
                    </div>
                    <button class="btn btn-custom d-grid w-100" style="color:white" type="submit" id="registerButton">
                        Register
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript to enable the submit button when the form is valid -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('formRegistration');
            const registerButton = document.getElementById('registerButton');

            form.addEventListener('input', function () {
                registerButton.disabled = !form.checkValidity();
            });
        });
    </script>
</body>
</html>
