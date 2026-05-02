<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Equipos · Baloncesto</title>
  <link rel="stylesheet" href="views/style.css">
</head>

<body class="tema-<?= $temaActual ?? 'default' ?>">
  <?php include "views/_nav.php"; ?>

  <div class="page">
    <?php
    $totalNBA    = count(array_filter($equipos, fn($e) => $e instanceof EquipoNBA));
    $totalEuropa = count(array_filter($equipos, fn($e) => $e instanceof EquipoEuropa));
    $total       = count($equipos);
    ?>

    <div class="page-header">
      <div>
        <h1>Todos los <em>equipos</em></h1>
        <p class="subtitle"><?= $total ?> equipo<?= $total !== 1 ? 's' : '' ?> registrado<?= $total !== 1 ? 's' : '' ?></p>
      </div>
      <?php if (isset($_SESSION['usuario_id'])): ?>
        <a href="index.php?accion=crear" class="btn btn-accent">+ Agregar equipo</a>
      <?php endif; ?>
    </div>

    <div class="stats-strip">
      <div class="stat-box">
        <div class="stat-num"><?= $total ?></div>
        <div class="stat-label">Total equipos</div>
      </div>
      <div class="stat-box">
        <div class="stat-num"><?= $totalNBA ?></div>
        <div class="stat-label">Equipos NBA</div>
      </div>
      <div class="stat-box">
        <div class="stat-num"><?= $totalEuropa ?></div>
        <div class="stat-label">Equipos Europa</div>
      </div>
    </div>

    <div class="card" style="padding:0; overflow:hidden;">
      <?php if (empty($equipos)): ?>
        <div class="empty">
          <div class="empty-icon">🏀</div>
          <p>No hay equipos registrados aún.</p>
          <?php if (isset($_SESSION['usuario_id'])): ?>
            <a href="index.php?accion=crear" class="btn btn-ghost" style="margin-top:1rem">Agregar el primero</a>
          <?php endif; ?>
        </div>
      <?php else: ?>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Ciudad</th>
                <th>País</th>
                <th>Presupuesto / año</th>
                <th>Conf.</th>
                <th>Anillos</th>
                <th>Liga</th>
                <th>Pabellón</th>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                  <th></th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($equipos as $e): ?>
                <tr>
                  <td style="color:var(--ink-ghost); font-size:.75rem;"><?= $e->getId() ?></td>
                  <td>
                    <?php if ($e instanceof EquipoNBA): ?>
                      <span class="badge badge-nba">NBA</span>
                    <?php else: ?>
                      <span class="badge badge-eu">Europa</span>
                    <?php endif; ?>
                  </td>
                  <td class="td-name"><?= htmlspecialchars($e->getNombre()) ?></td>
                  <td><?= htmlspecialchars($e->getCiudad()) ?></td>
                  <td style="color:var(--ink-soft)"><?= htmlspecialchars($e->getPais()) ?></td>
                  <td class="td-mono"><?= number_format($e->getPresupuestoAnual(), 0, ',', '.') ?> €</td>
                  <td>
                    <?php if ($e instanceof EquipoNBA): ?>
                      <span class="badge <?= $e->getConferencia() === 'Este' ? 'badge-east' : 'badge-west' ?>">
                        <?= htmlspecialchars($e->getConferencia()) ?>
                      </span>
                    <?php else: ?>
                      <span style="color:var(--ink-ghost)">—</span>
                    <?php endif; ?>
                  </td>
                  <td class="td-mono">
                    <?= ($e instanceof EquipoNBA)
                      ? $e->getAnillosGanados()
                      : '<span style="color:var(--ink-ghost)">—</span>' ?>
                  </td>
                  <td>
                    <?= ($e instanceof EquipoEuropa)
                      ? htmlspecialchars($e->getLiga())
                      : '<span style="color:var(--ink-ghost)">—</span>' ?>
                  </td>
                  <td>
                    <?php if ($e instanceof EquipoEuropa): ?>
                      <span style="font-size:.8rem; color:var(--ink-soft)">
                        <?= $e->getTienePabellonPropio() ? '✓ Sí' : '✗ No' ?>
                      </span>
                    <?php else: ?>
                      <span style="color:var(--ink-ghost)">—</span>
                    <?php endif; ?>
                  </td>
                  <?php if (isset($_SESSION['usuario_id'])): ?>
                    <td>
                      <div style="display:flex; gap:.4rem;">
                        <a href="index.php?accion=editar&id=<?= $e->getId() ?>" class="btn btn-ghost btn-sm">Editar</a>
                        <a href="index.php?accion=eliminar&id=<?= $e->getId() ?>"
                          class="btn btn-danger btn-sm"
                          onclick="return confirm('¿Eliminar «<?= htmlspecialchars($e->getNombre()) ?>»?')">Eliminar</a>
                      </div>
                    </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>