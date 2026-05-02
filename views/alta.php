<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Crear cuenta · Baloncesto</title>
  <link rel="stylesheet" href="views/style.css">
</head>

<body class="tema-<?= $temaActual ?? 'default' ?>" style="display:flex; align-items:center; justify-content:center; min-height:100vh;">

  <div class="page-narrow" style="padding: 2rem; width: 100%;">
    <div class="auth-header">
      <div class="logo">Basket<span>.</span></div>
      <p style="color:var(--ink-soft); font-size:.875rem;">Crea tu cuenta gratuita</p>
    </div>

    <div class="card">
      <form method="POST">
        <div class="form-grid">
          <div class="field">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email"
              placeholder="tu@email.com" autocomplete="email" required>
          </div>
          <div class="field">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password"
              placeholder="Mínimo 4 caracteres" minlength="4"
              autocomplete="new-password" required>
          </div>
          <button type="submit" class="btn btn-accent" style="width:100%; justify-content:center;">
            Crear cuenta
          </button>
        </div>
      </form>
    </div>

    <div class="auth-footer">
      ¿Ya tienes cuenta? <a href="index.php?accion=login">Inicia sesión aquí</a>
      &nbsp;·&nbsp;
      <a href="index.php">Volver al inicio</a>
    </div>
  </div>
</body>

</html>