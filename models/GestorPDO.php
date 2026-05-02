<?php
class GestorPDO extends Connection {

    public function __construct() {
        $singleton = Connection::getInstance();
        $this->conn = $singleton->getConn();
    }

    public function listar() {
        $consulta = "SELECT * FROM equiposBaloncesto";
        $rtdo = $this->conn->query($consulta);
        $arrayEquipos = [];
        while ($value = $rtdo->fetch(PDO::FETCH_ASSOC)) {
            if ($value['tipoEquipo'] == "EquipoNBA") {
                $equipo = new EquipoNBA(
                    $value['nombre'],
                    $value['ciudad'],
                    $value['pais'],
                    $value['presupuestoAnual'],
                    $value['conferencia'],
                    $value['anillosGanados'],
                    $value['id']
                );
            } else {
                $equipo = new EquipoEuropa(
                    $value['nombre'],
                    $value['ciudad'],
                    $value['pais'],
                    $value['presupuestoAnual'],
                    $value['liga'],
                    $value['tienePabellonPropio'],
                    $value['id']
                );
            }
            $arrayEquipos[] = $equipo;
        }
        return $arrayEquipos;
    }

    public function agregar($equipo) {
        try {
            if ($equipo instanceof EquipoNBA) {
                $sql = "INSERT INTO equiposBaloncesto (tipoEquipo, nombre, ciudad, pais, presupuestoAnual, conferencia, anillosGanados)
                        VALUES (:tipoEquipo, :nombre, :ciudad, :pais, :presupuestoAnual, :conferencia, :anillosGanados)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':tipoEquipo', "EquipoNBA");
                $stmt->bindValue(':nombre', $equipo->getNombre());
                $stmt->bindValue(':ciudad', $equipo->getCiudad());
                $stmt->bindValue(':pais', $equipo->getPais());
                $stmt->bindValue(':presupuestoAnual', $equipo->getPresupuestoAnual());
                $stmt->bindValue(':conferencia', $equipo->getConferencia());
                $stmt->bindValue(':anillosGanados', $equipo->getAnillosGanados());
            } else {
                $sql = "INSERT INTO equiposBaloncesto (tipoEquipo, nombre, ciudad, pais, presupuestoAnual, liga, tienePabellonPropio)
                        VALUES (:tipoEquipo, :nombre, :ciudad, :pais, :presupuestoAnual, :liga, :tienePabellonPropio)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':tipoEquipo', "EquipoEuropa");
                $stmt->bindValue(':nombre', $equipo->getNombre());
                $stmt->bindValue(':ciudad', $equipo->getCiudad());
                $stmt->bindValue(':pais', $equipo->getPais());
                $stmt->bindValue(':presupuestoAnual', $equipo->getPresupuestoAnual());
                $stmt->bindValue(':liga', $equipo->getLiga());
                $stmt->bindValue(':tienePabellonPropio', $equipo->getTienePabellonPropio());
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function buscar($id) {
        $sql = "SELECT * FROM equiposBaloncesto WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($value = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($value['tipoEquipo'] == "EquipoNBA") {
                return new EquipoNBA(
                    $value['nombre'],
                    $value['ciudad'],
                    $value['pais'],
                    $value['presupuestoAnual'],
                    $value['conferencia'],
                    $value['anillosGanados'],
                    $value['id']
                );
            } else {
                return new EquipoEuropa(
                    $value['nombre'],
                    $value['ciudad'],
                    $value['pais'],
                    $value['presupuestoAnual'],
                    $value['liga'],
                    $value['tienePabellonPropio'],
                    $value['id']
                );
            }
        }
        return null;
    }

    public function actualizar($equipo) {
        try {
            if ($equipo instanceof EquipoNBA) {
                $sql = "UPDATE equiposBaloncesto SET tipoEquipo=:tipoEquipo, nombre=:nombre, ciudad=:ciudad, pais=:pais,
                        presupuestoAnual=:presupuestoAnual, conferencia=:conferencia, anillosGanados=:anillosGanados
                        WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':id', $equipo->getId());
                $stmt->bindValue(':tipoEquipo', "EquipoNBA");
                $stmt->bindValue(':nombre', $equipo->getNombre());
                $stmt->bindValue(':ciudad', $equipo->getCiudad());
                $stmt->bindValue(':pais', $equipo->getPais());
                $stmt->bindValue(':presupuestoAnual', $equipo->getPresupuestoAnual());
                $stmt->bindValue(':conferencia', $equipo->getConferencia());
                $stmt->bindValue(':anillosGanados', $equipo->getAnillosGanados());
            } else {
                $sql = "UPDATE equiposBaloncesto SET tipoEquipo=:tipoEquipo, nombre=:nombre, ciudad=:ciudad, pais=:pais,
                        presupuestoAnual=:presupuestoAnual, liga=:liga, tienePabellonPropio=:tienePabellonPropio
                        WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':id', $equipo->getId());
                $stmt->bindValue(':tipoEquipo', "EquipoEuropa");
                $stmt->bindValue(':nombre', $equipo->getNombre());
                $stmt->bindValue(':ciudad', $equipo->getCiudad());
                $stmt->bindValue(':pais', $equipo->getPais());
                $stmt->bindValue(':presupuestoAnual', $equipo->getPresupuestoAnual());
                $stmt->bindValue(':liga', $equipo->getLiga());
                $stmt->bindValue(':tienePabellonPropio', $equipo->getTienePabellonPropio());
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error de la base de datos al actualizar: " . $e->getMessage());
        }
    }

    public function eliminar($id) {
        $sql = "DELETE FROM equiposBaloncesto WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function registrarUsuario(Usuario $usuario) {
        try {
            $sql = "INSERT INTO Usuario (email, password) VALUES (:email, :password)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':password', $usuario->getPassword());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    public function buscarUsuarioPorEmail($email) {
        $sql = "SELECT * FROM Usuario WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $value = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($value) {
            return new Usuario($value['email'], $value['password'], $value['id']);
        }
        return false;
    }
}
