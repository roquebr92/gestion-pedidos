<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- Bootstrap para animaciones y estilos base --}}
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  {{-- Estilos personalizados --}}
  <style>
    html { background-color: #56baed; }
    body { font-family: "Poppins", sans-serif; height: 100vh; }
    a { color: #92badd; display:inline-block; text-decoration: none; font-weight: 400; }
    h2 { text-align: center; font-size: 16px; font-weight: 600; text-transform: uppercase; display:inline-block; margin: 40px 8px 10px 8px; color: #cccccc; }
    .wrapper { display: flex; align-items: center; flex-direction: column; justify-content: center; width: 100%; min-height: 100%; padding: 20px; }
    #formContent { border-radius:10px; background: #fff; padding: 30px; width: 90%; max-width: 450px; position: relative; box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3); text-align: center; }
    #formFooter { background-color: #f6f6f6; border-top:1px solid #dce8f1; padding:25px; text-align:center; border-radius:0 0 10px 10px; }
    input[type=text], input[type=password] { background-color: #f6f6f6; border:none; color:#0d0d0d; padding:15px 32px; text-align:center; font-size:16px; margin:5px; width:85%; border:2px solid #f6f6f6; border-radius:5px; transition: all .5s ease-in-out; }
    input[type=text]:focus, input[type=password]:focus { background-color:#fff; border-bottom:2px solid #5fbae9; }
    input[type=submit] { background-color:#56baed; border:none; color:white; padding:15px 80px; text-transform:uppercase; font-size:13px; box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4); border-radius:5px; margin:5px 20px 40px 20px; transition: all .3s ease-in-out; }
    input[type=submit]:hover { background-color:#39ace7; }
    input[type=submit]:active { transform: scale(0.95); }
    .fadeInDown { animation: fadeInDown 1s both; }
    @keyframes fadeInDown { 0% { opacity:0; transform: translate3d(0,-100%,0); } 100% { opacity:1; transform:none; } }
    .fadeIn { opacity:0; animation: fadeIn ease-in 1 forwards; animation-duration:1s; }
    @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
    .fadeIn.first { animation-delay:0.4s; }
    .fadeIn.second { animation-delay:0.6s; }
    .fadeIn.third { animation-delay:0.8s; }
    .fadeIn.fourth { animation-delay:1s; }
    .underlineHover:after { display:block; left:0; bottom:-10px; width:0; height:2px; background-color:#56baed; content:""; transition: width .2s; }
    .underlineHover:hover:after { width:100%; }
    *:focus { outline:none; }
    #icon { width:60%; }
  </style>
</head>
<body>
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Icon -->
      <div class="fadeIn first">
        <img src="{{ asset($empresa->logo_url) }}" id="icon" alt="Logo {{ $empresa->nombre }}" />
      </div>

      <!-- Login Form -->
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">

        <input type="text" id="login" class="fadeIn second" name="email" placeholder="Correo electrónico" required>
        <input type="password" id="password" class="fadeIn third" name="password" placeholder="Contraseña" required>
        <input type="submit" class="fadeIn fourth" value="Iniciar sesión">
      </form>

      <!-- Remind Password -->
      <div id="formFooter">
        <label class="underlineHover"><input type="checkbox" name="remember"> Recuérdame</label>
        &nbsp;|&nbsp;
        <a class="underlineHover" href="#">¿Olvidaste tu contraseña?</a>
      </div>
    </div>
  </div>
</body>
</html>

