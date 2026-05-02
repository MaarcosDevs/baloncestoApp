<?php
class EquipoDeBaloncesto {
    protected $id;
    protected $nombre;
    protected $ciudad;
    protected $pais;
    protected $presupuestoAnual;

    public function __construct($id, $nombre, $ciudad, $pais, $presupuestoAnual) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ciudad = $ciudad;
        $this->pais = $pais;
        $this->presupuestoAnual = $presupuestoAnual;
    }

    public function calcularCosteTemporada($temporadas) {
        return $this->presupuestoAnual * $temporadas;
    }

    public function getId() { return $this->id; }
    public function setId($id): self { $this->id = $id; return $this; }

    public function getNombre() { return $this->nombre; }
    public function setNombre($nombre): self { $this->nombre = $nombre; return $this; }

    public function getCiudad() { return $this->ciudad; }
    public function setCiudad($ciudad): self { $this->ciudad = $ciudad; return $this; }

    public function getPais() { return $this->pais; }
    public function setPais($pais): self { $this->pais = $pais; return $this; }

    public function getPresupuestoAnual() { return $this->presupuestoAnual; }
    public function setPresupuestoAnual($presupuestoAnual): self { $this->presupuestoAnual = $presupuestoAnual; return $this; }
}
?>
