<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar sesión · Baloncesto</title>
  <link rel="stylesheet" href="views/style.css">
</head>
<body class="tema-<?= $temaActual ?? 'default' ?>" style="display:flex; align-items:center; justify-content:center; min-height:100vh;">

<div class="page-narrow" style="padding: 2rem; width: 100%;">
  <div class="auth-header">
    <div class="logo">Basket<span>.</span></div>
    <p style="color:var(--ink-soft); font-size:.875rem;">Bienvenido de nuevo</p>
  </div>

  <div class="card">
    <?php if (isset($error)): ?>
      <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

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
                 placeholder="••••••••" autocomplete="current-password" required>
        </div>
        <div>
          <label class="check-label">
            <input type="checkbox" name="recordarme">
            Recordarme en este dispositivo
          </label>
        </div>
        <button type="submit" class="btn btn-accent" style="width:100%; justify-content:center;">
          Entrar
        </button>
      </div>
    </form>
  </div>

  <div class="auth-footer">
    ¿No tienes cuenta? <a href="index.php?accion=alta">Regístrate aquí</a>
    &nbsp;·&nbsp;
    <a href="index.php">Volver al inicio</a>
  </div>
</div>
</body>
</html>
