<?php
class EquipoEuropa extends EquipoDeBaloncesto {
    private $liga;
    private $tienePabellonPropio;

    public function __construct($nombre, $ciudad, $pais, $presupuestoAnual, $liga, $tienePabellonPropio, $id = 0) {
        parent::__construct($id, $nombre, $ciudad, $pais, $presupuestoAnual);
        $this->liga = $liga;
        $this->tienePabellonPropio = $tienePabellonPropio;
    }

    public function calcularCosteTemporada($temporadas) {
        $costeBase = parent::calcularCosteTemporada($temporadas);
        if ($this->tienePabellonPropio) {
            return $costeBase + 50000;
        }
        return $costeBase;
    }

    public function getLiga() { return $this->liga; }
    public function setLiga($liga): self { $this->liga = $liga; return $this; }

    public function getTienePabellonPropio() { return $this->tienePabellonPropio; }
    public function setTienePabellonPropio($tienePabellonPropio): self { $this->tienePabellonPropio = $tienePabellonPropio; return $this; }
}
?>
