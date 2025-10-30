<div>
  <div
    class="offcanvas offcanvas-end"
    tabindex="-1"
    id="offcanvasEnd"
    aria-labelledby="offcanvasEndLabel"
  >
    <div class="offcanvas-header">
      <h5 id="offcanvasEndLabel" class="offcanvas-title">
        Login
      </h5>
      <button
        type="button"
        class="btn-close text-reset"
        data-bs-dismiss="offcanvas"
        aria-label="Close"
      ></button>
    </div>
    <div class="offcanvas-body my-auto mx-0 flex-grow-0">
      <div
        class="app-brand justify-content-center"
        style="margin-bottom: 50px;"
      >
        <span class="app-brand-text demo text-body fw-bolder">
          <img
            src="<?php echo e(asset('sneat/assets/img/sima/sima.png')); ?>"
            style="width: 250px; height: auto;"
            alt="logo"
          ></img>
        </span>
      </div>
      <h4 class="mb-2">
         
        Welcome to Sima Perkasya! 
        <i
          class="bx bx-bus bx-tada"
          style="color:#54de1c; font-size: 1.5em;"
        ></i>
      </h4>
      <p class="mb-4">PT. Jagad Sima Perkasya Group</p>

      <form
      
        id="formAuthentication"
        class="mb-3"
        action="<?php echo e(route('login')); ?>"
        method="POST"
      >
      <?php echo csrf_field(); ?>
        <div class="mb-3">
          <label for="username" class="form-label">
            username
          </label>
          <input
            type="text"
            class="form-control"
            id="username"
            name="username"
            placeholder="Masukkan username"
            autofocus
          />
        </div>
        <div class="mb-3 form-password-toggle">
          <div class="d-flex justify-content-between">
            <label class="form-label" for="password">
              Password
            </label>
          </div>
          <div class="input-group input-group-merge">
            <input
              type="password"
              id="password"
              class="form-control"
              name="password"
              placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
              aria-describedby="password"
            />
            <span class="input-group-text cursor-pointer" id="togglePassword">
              <i class="bx bx-hide"></i>
            </span>
          </div>
          
          <script>
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
          
            togglePassword.addEventListener('click', function (e) {
              // Toggle the type attribute
              const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
              password.setAttribute('type', type);
          
              // Toggle the eye icon
              this.querySelector('i').classList.toggle('bx-hide');
              this.querySelector('i').classList.toggle('bx-show');
            });
          </script>
          
        </div>
        
        
          <button
            class="btn btn-success d-grid w-100 btn-not-allowed "
            style="color:white"
            type="submit"
            id="loginButton"
            disabled
          >
            Login
          </button>
        
      </form>
    </div>
  </div>
</div><?php /**PATH C:\Users\Windows 10 Pro\Documents\work\simapush\SIMA\resources\views/login.blade.php ENDPATH**/ ?>