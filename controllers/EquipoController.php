<?php
class EquipoController {

    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function index() {
        $temaActual = $GLOBALS['temaActual'] ?? 'default';
        $equipos = $this->gestor->listar();
        include "views/listar.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['tipo'];
            $nombre = $_POST['nombre'];
            $ciudad = $_POST['ciudad'];
            $pais = $_POST['pais'];
            $presupuestoAnual = $_POST['presupuestoAnual'];
            if ($tipo == "EquipoNBA") {
                $conferencia = $_POST['conferencia'];
                $anillosGanados = $_POST['anillosGanados'];
                $equipo = new EquipoNBA($nombre, $ciudad, $pais, $presupuestoAnual, $conferencia, $anillosGanados);
            } else {
                $liga = $_POST['liga'];
                $tienePabellonPropio = $_POST['tienePabellonPropio'];
                $equipo = new EquipoEuropa($nombre, $ciudad, $pais, $presupuestoAnual, $liga, $tienePabellonPropio);
            }
            $this->gestor->agregar($equipo);
            header("Location: index.php");
            exit;
        }
        $temaActual = $GLOBALS['temaActual'] ?? 'default';
        include "views/crear.php";
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        $equipo = $this->gestor->buscar($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $equipo->setNombre($_POST['nombre']);
            $equipo->setCiudad($_POST['ciudad']);
            $equipo->setPais($_POST['pais']);
            $equipo->setPresupuestoAnual($_POST['presupuestoAnual']);
            if ($equipo instanceof EquipoNBA) {
                $equipo->setConferencia($_POST['conferencia']);
                $equipo->setAnillosGanados($_POST['anillosGanados']);
            } else {
                $equipo->setLiga($_POST['liga']);
                $equipo->setTienePabellonPropio($_POST['tienePabellonPropio']);
            }
            $this->gestor->actualizar($equipo);
            header("Location: index.php");
            exit;
        }
        $temaActual = $GLOBALS['temaActual'] ?? 'default';
        include "views/editar.php";
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        $this->gestor->eliminar($id);
        header("Location: index.php");
        exit;
    }
}
