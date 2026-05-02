<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nuevo equipo · Baloncesto</title>
  <link rel="stylesheet" href="views/style.css">
  <style>
    .fields-nba, .fields-eu { display: none; }
    .fields-nba.active, .fields-eu.active { display: contents; }
    .type-toggle {
      display: flex; gap: .5rem; margin-bottom: .25rem;
    }
    .type-btn {
      flex: 1; padding: .65rem; border-radius: var(--radius);
      border: 1px solid var(--border); background: var(--bg);
      font-family: 'DM Sans', sans-serif; font-size: .8125rem;
      font-weight: 500; letter-spacing: .03em;
      color: var(--ink-soft); cursor: pointer;
      transition: all .18s; text-align: center;
    }
    .type-btn.active {
      background: var(--ink); color: #fff; border-color: var(--ink);
    }
  </style>
</head>
<body class="tema-<?= $temaActual ?? 'default' ?>">
<?php include "views/_nav.php"; ?>

<div class="page" style="max-width: 640px;">
  <h1>Nuevo <em>equipo</em></h1>
  <p class="subtitle">Rellena los datos del equipo que quieres añadir.</p>

  <div class="card">
    <form method="POST">
      <input type="hidden" name="tipo" id="tipoInput" value="EquipoNBA">

      <div class="form-grid">

        <!-- Selector de tipo -->
        <div class="field">
          <label>Tipo de equipo</label>
          <div class="type-toggle">
            <button type="button" class="type-btn active" onclick="setTipo('EquipoNBA', this)">🏀 NBA</button>
            <button type="button" class="type-btn" onclick="setTipo('EquipoEuropa', this)">🌍 Europa</button>
          </div>
        </div>

        <hr class="divider" style="margin:.25rem 0">
        <p class="section-title">Datos generales</p>

        <div class="form-row-2">
          <div class="field">
            <label for="nombre">Nombre del equipo</label>
            <input type="text" name="nombre" id="nombre" placeholder="Los Angeles Lakers" required>
          </div>
          <div class="field">
            <label for="ciudad">Ciudad</label>
            <input type="text" name="ciudad" id="ciudad" placeholder="Los Angeles" required>
          </div>
        </div>

        <div class="form-row-2">
          <div class="field">
            <label for="pais">País</label>
            <input type="text" name="pais" id="pais" placeholder="Estados Unidos" required>
          </div>
          <div class="field">
            <label for="presupuestoAnual">Presupuesto anual (€)</label>
            <input type="number" name="presupuestoAnual" id="presupuestoAnual"
                   step="0.01" min="0" placeholder="150000000" required>
          </div>
        </div>

        <!-- Campos NBA -->
        <div id="seccionNBA">
          <hr class="divider" style="margin:.25rem 0">
          <p class="section-title">Datos NBA</p>
          <div class="form-row-2">
            <div class="field">
              <label for="conferencia">Conferencia</label>
              <div class="select-wrap">
                <select name="conferencia" id="conferencia">
                  <option value="">— Seleccionar —</option>
                  <option value="Este">Este</option>
                  <option value="Oeste">Oeste</option>
                </select>
              </div>
            </div>
            <div class="field">
              <label for="anillosGanados">Anillos ganados</label>
              <input type="number" name="anillosGanados" id="anillosGanados"
                     min="0" placeholder="0">
            </div>
          </div>
        </div>

        <!-- Campos Europa -->
        <div id="seccionEuropa" style="display:none;">
          <hr class="divider" style="margin:.25rem 0">
          <p class="section-title">Datos Europa</p>
          <div class="form-row-2">
            <div class="field">
              <label for="liga">Liga</label>
              <input type="text" name="liga" id="liga" placeholder="EuroLeague, ACB…">
            </div>
            <div class="field">
              <label for="tienePabellonPropio">Pabellón propio</label>
              <div class="select-wrap">
                <select name="tienePabellonPropio" id="tienePabellonPropio">
                  <option value="NULL">— Seleccionar —</option>
                  <option value="1">Sí</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="form-footer">
          <a href="index.php" class="btn btn-ghost">Cancelar</a>
          <button type="submit" class="btn btn-accent">Guardar equipo</button>
        </div>

      </div>
    </form>
  </div>
</div>

<script>
function setTipo(tipo, btn) {
  document.getElementById('tipoInput').value = tipo;
  document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('seccionNBA').style.display    = tipo === 'EquipoNBA'    ? '' : 'none';
  document.getElementById('seccionEuropa').style.display = tipo === 'EquipoEuropa' ? '' : 'none';
}
</script>
</body>
</html>
