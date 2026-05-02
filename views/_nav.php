<?php
// Este partial espera que $temaActual esté definido (viene de index.php)
$tema = $temaActual ?? 'default';
?>
<nav>
  <a class="nav-brand" href="index.php">Basket<span>.</span></a>
  <div style="display:flex; align-items:center; gap:1.5rem;">

    <!-- Selector de tema persistente (cookie 1 año) -->
    <div class="tema-selector">
      <span>Tema</span>
      <a href="index.php?tema=default" class="tema-dot dot-default <?= $tema==='default' ? 'activo' : '' ?>" title="Clásico"></a>
      <a href="index.php?tema=dark"    class="tema-dot dot-dark    <?= $tema==='dark'    ? 'activo' : '' ?>" title="Oscuro"></a>
      <a href="index.php?tema=forest"  class="tema-dot dot-forest  <?= $tema==='forest'  ? 'activo' : '' ?>" title="Bosque"></a>
      <a href="index.php?tema=ocean"   class="tema-dot dot-ocean   <?= $tema==='ocean'   ? 'activo' : '' ?>" title="Océano"></a>
    </div>

    <div class="nav-links">
      <?php if (isset($_SESSION['usuario_id'])): ?>
        <span class="nav-user"><?= htmlspecialchars($_SESSION['usuarioEmail']) ?></span>
        <a href="index.php?accion=logout">Salir</a>
      <?php else: ?>
        <a href="index.php?accion=login">Iniciar sesión</a>
        <a href="index.php?accion=alta">Registrarse</a>
      <?php endif; ?>
    </div>

  </div>
</nav>
