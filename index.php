<?php include_once "_config/config.php" ?>
<?php include_once "includes/index.inc.php"; ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Government Office Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Noto+Serif+Sinhala&display=swap" rel="stylesheet">

  <style>
    body { 
      font-family: 'Noto Serif', 'Noto Serif Sinhala', serif;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow-y: auto;        /* vertical scrollbar */
      overflow-x: hidden;      /* hide horizontal scrollbar */
    }

    .bg-shape {
      position: absolute;
      fill: rgba(255,255,255,0.08);
      pointer-events: none;
      animation: float 6s ease-in-out infinite alternate;
    }

    @keyframes float {
      0% { transform: translate(0px, 0px) rotate(0deg);}
      50% { transform: translate(0px, 10px) rotate(15deg);}
      100% { transform: translate(0px, -10px) rotate(-15deg);}
    }

    .login-card {
      padding: 3rem;
      border-radius: 5px;
      background-color: #ffffff;
      width: 100%;
      max-width: 450px;
      animation: fadeIn 1s ease-in-out;
      z-index: 1;
      position: relative;
    }

    @media (max-width: 576px) {
      .login-card {
        margin-left: 1rem;
        margin-right: 1rem;
      }
    }

    .login-card .logo {
      display: block;
      margin: 0 auto 2rem auto;
      max-width: 230px;
      border-radius: 0;
    }

    .form-floating {
      margin-bottom: 1.5rem;
      position: relative;
    }

    .form-control {
      height: 55px;
      font-size: 14px;           
      border: 2px solid #ddd;
      border-radius: 5px;
      padding-top: 1.5rem;
      padding-bottom: 0.5rem;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #6a11cb;
      box-shadow: none;
    }

    .input-feedback {
      font-size: 0.7rem;
      margin-top: 0.25rem;
      margin-bottom: 0.5rem;
      display: block;
    }

    .input-error { color: #dc3545; }
    .input-success { color: #28a745; }

    .btn-primary {
      height: 55px;
      font-size: 1.1rem;
      font-weight: 500;
      background: linear-gradient(90deg, #6a11cb, #2575fc);
      border: none;
      border-radius: 5px;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: linear-gradient(90deg, #2575fc, #6a11cb);
    }

    @keyframes fadeIn {
      0% {opacity: 0; transform: translateY(-20px);}
      100% {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>

<div id="bg-container"></div>

<div class="login-card">
  <img src="<?php echo baseUrl('assets/img/logo.png'); ?>" alt="Government Logo" class="logo">

  <?php if( $errMsg != "" ){ ?>
  <div class="alert alert-danger small alert-dismissible fade show" role="alert">
    <?php echo $errMsg; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php } ?>

  <?php if(Session::exists('success_msg')){ ?>
    <div class="alert alert-success small alert-dismissible fade show" role="alert">
      <?php echo Session::flash("success_msg"); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php } ?>

  <form method="POST" novalidate>
    <div class="form-floating">
      <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
      <label for="email">Email address</label>
      <?php echo frmMsgShow('email',$validateErr); ?>
    </div>

    <div class="form-floating position-relative">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
      <label for="password">Password</label>
      <?php echo frmMsgShow('password',$validateErr); ?>
    </div>


    <div class="form-floating">
      <?php
          echo Form::form_dropdown('acc_type', array("subject" => "Subject", "front-office" => "Front Office", "root" => "Admin"), Input::post('acc_type'), array('class' => 'form-select form-control', 'id' => 'acc_type'));
          echo Form::form_label('Account Type', 'acc_type', array('class' => ''));
        ?>
        <?php echo frmMsgShow('acc_type',$validateErr); ?>
    </div>


    <center><div class="g-recaptcha mb-3" data-sitekey="<?php echo $reCAPTCHA_siteKey; ?>"></div></center>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
  // Generate 400 animated circles
  const bgContainer = document.getElementById('bg-container');
  const width = window.innerWidth;
  const height = window.innerHeight;
  const fixedSize = 18; 
  const count = 400;

  for (let i = 0; i < count; i++) {
    const x = Math.random() * width;
    const y = Math.random() * height;
    const delay = (Math.random() * 5).toFixed(2);

    const svg = `<svg class="bg-shape" width="${fixedSize}" height="${fixedSize}" 
                   style="top:${y}px; left:${x}px; animation-delay:${delay}s;">
                   <circle cx="${fixedSize/2}" cy="${fixedSize/2}" r="${fixedSize/2}"/>
                 </svg>`;
    bgContainer.insertAdjacentHTML('beforeend', svg);
  }

  // Password toggle
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');
  const toggleIcon = document.getElementById('toggleIcon');

  togglePassword.addEventListener('click', () => {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    toggleIcon.src = type === 'password' ? '<?php echo base_url("assets/img/eye.svg"); ?>' : '<?php echo base_url("assets/img/eye-off.svg"); ?>';
  });

</script>

</body>
</html>
