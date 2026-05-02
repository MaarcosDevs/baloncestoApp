<?php
class EquipoNBA extends EquipoDeBaloncesto {
    private $conferencia;
    private $anillosGanados;

    public function __construct($nombre, $ciudad, $pais, $presupuestoAnual, $conferencia, $anillosGanados, $id = 0) {
        parent::__construct($id, $nombre, $ciudad, $pais, $presupuestoAnual);
        $this->conferencia = $conferencia;
        $this->anillosGanados = $anillosGanados;
    }

    public function calcularCosteTemporada($temporadas) {
        $costeBase = parent::calcularCosteTemporada($temporadas);
        if ($this->anillosGanados > 5) {
            return $costeBase * 1.10;
        }
        return $costeBase;
    }

    public function getConferencia() { return $this->conferencia; }
    public function setConferencia($conferencia): self { $this->conferencia = $conferencia; return $this; }

    public function getAnillosGanados() { return $this->anillosGanados; }
    public function setAnillosGanados($anillosGanados): self { $this->anillosGanados = $anillosGanados; return $this; }
}
?>
