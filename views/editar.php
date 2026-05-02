<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar equipo · Baloncesto</title>
  <link rel="stylesheet" href="views/style.css">
</head>

<body class="tema-<?= $temaActual ?? 'default' ?>">
  <?php include "views/_nav.php"; ?>

  <div class="page" style="max-width: 640px;">
    <div style="display:flex; align-items:center; gap:.75rem; margin-bottom:.25rem;">
      <?php if ($equipo instanceof EquipoNBA): ?>
        <span class="badge badge-nba">NBA</span>
      <?php else: ?>
        <span class="badge badge-eu">Europa</span>
      <?php endif; ?>
      <h1 style="margin-bottom:0"><?= htmlspecialchars($equipo->getNombre()) ?></h1>
    </div>
    <p class="subtitle">Modifica los datos del equipo.</p>

    <div class="card">
      <form method="POST">
        <div class="form-grid">

          <hr class="divider" style="margin:.25rem 0">
          <p class="section-title">Datos generales</p>

          <div class="form-row-2">
            <div class="field">
              <label for="nombre">Nombre del equipo</label>
              <input type="text" name="nombre" id="nombre"
                value="<?= htmlspecialchars($equipo->getNombre()) ?>" required>
            </div>
            <div class="field">
              <label for="ciudad">Ciudad</label>
              <input type="text" name="ciudad" id="ciudad"
                value="<?= htmlspecialchars($equipo->getCiudad()) ?>" required>
            </div>
          </div>

          <div class="form-row-2">
            <div class="field">
              <label for="pais">País</label>
              <input type="text" name="pais" id="pais"
                value="<?= htmlspecialchars($equipo->getPais()) ?>" required>
            </div>
            <div class="field">
              <label for="presupuestoAnual">Presupuesto anual (€)</label>
              <input type="number" name="presupuestoAnual" id="presupuestoAnual"
                step="0.01" min="0"
                value="<?= $equipo->getPresupuestoAnual() ?>" required>
            </div>
          </div>

          <?php if ($equipo instanceof EquipoNBA): ?>
            <hr class="divider" style="margin:.25rem 0">
            <p class="section-title">Datos NBA</p>
            <div class="form-row-2">
              <div class="field">
                <label for="conferencia">Conferencia</label>
                <div class="select-wrap">
                  <select name="conferencia" id="conferencia" required>
                    <option value="Este" <?= $equipo->getConferencia() === 'Este'  ? 'selected' : '' ?>>Este</option>
                    <option value="Oeste" <?= $equipo->getConferencia() === 'Oeste' ? 'selected' : '' ?>>Oeste</option>
                  </select>
                </div>
              </div>
              <div class="field">
                <label for="anillosGanados">Anillos ganados</label>
                <input type="number" name="anillosGanados" id="anillosGanados"
                  min="0" value="<?= $equipo->getAnillosGanados() ?>" required>
              </div>
            </div>
          <?php endif; ?>

          <?php if ($equipo instanceof EquipoEuropa): ?>
            <hr class="divider" style="margin:.25rem 0">
            <p class="section-title">Datos Europa</p>
            <div class="form-row-2">
              <div class="field">
                <label for="liga">Liga</label>
                <input type="text" name="liga" id="liga"
                  value="<?= htmlspecialchars($equipo->getLiga()) ?>" required>
              </div>
              <div class="field">
                <label for="tienePabellonPropio">Pabellón propio</label>
                <div class="select-wrap">
                  <select name="tienePabellonPropio" id="tienePabellonPropio" required>
                    <option value="0" <?= $equipo->getTienePabellonPropio() == 0 ? 'selected' : '' ?>>No</option>
                    <option value="1" <?= $equipo->getTienePabellonPropio() == 1 ? 'selected' : '' ?>>Sí</option>
                  </select>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <div class="form-footer">
            <a href="index.php" class="btn btn-ghost">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar equipo</button>
          </div>

        </div>
      </form>
    </div>
  </div>
</body>

</html>