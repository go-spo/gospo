<?php

class GospoDB {

    protected $mysqli;

    const LOCALHOST = '127.0.0.1';
    const USER = 'root';
    const PASSWORD = 'root';
    const DATABASE = 'gosport';

    public function __construct() {
        try {
            $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE);
        } catch (mysqli_sql_exception $e) {

            http_response_code(500);     //se conecta a la base de datos
            exit;
        }
    }

    public function getCentro($id = 0) {
        $stmt = $this->mysqli->prepare("SELECT * FROM Centros WHERE id_centro=? ; "); //realiza una consulta pasando un id por medio de un prepare statement
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $centros = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $centros;
    }

    public function getcentros() {                  // busca todas las perdsonas de la tabla Centro
        $result = $this->mysqli->query('SELECT * FROM centros');
        $centros = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $centros;
        // return json_encode($centros);
    }

    public function insertCentro($nombre, $telefono, $email, $direccion, $municipio, $provincia, $pais, $coordenada_X, $coordenada_Y, $url_img) {
        $stmt = $this->mysqli->prepare("INSERT INTO Centros VALUES (null,?,?,?,?,?,?,?,?,?,?,null); ");   //inserta en la tabla personas una persona de nombre "name"
        $stmt->bind_param('ssssssssss', $nombre, $telefono, $email, $direccion, $municipio, $provincia, $pais, $coordenada_X, $coordenada_Y, $url_img);
        $r = $stmt->execute();
        $stmt->close();
        return $r;
    }

    public function borrarCentro($id = 0) {             //borra de la tabla personas el usuario con id = id
        $stmt = $this->mysqli->prepare("DELETE FROM Centros WHERE id_centro =?;");
        $stmt->bind_param('i', $id);
        $r = $stmt->execute();
        $stmt->close();
        return $r;
    }

    public function updateCentro($id, $nombre, $telefono, $email, $direccion, $municipio, $provincia, $pais, $coordenada_X, $coordenada_Y, $url_img) {            // cambia el nombre de un usuario con id X por otro nombre insertado
        if ($this->checkIDCentro($id)) {
            $stmt = $this->mysqli->prepare("UPDATE Centros SET nombre=?,telefono=?,email=?,direccion=?,municipio=?,provincia=?,pais=?,coordenada_x=?,coordenada_y=?,url_img =? WHERE id_centro = ? ; ");
            $stmt->bind_param('sssssssssss', $nombre, $telefono, $email, $direccion, $municipio, $provincia, $pais, $coordenada_X, $coordenada_Y, $url_img, $id);
            $r = $stmt->execute();
            $stmt->close();
            return $r;
        }
        return false;
    }

    public function checkIDCentro($id) {              // busca a alguien con el id insertado, y si existe devuelve true
        $stmt = $this->mysqli->prepare("SELECT * FROM Centros WHERE id_centro=?");
        $stmt->bind_param('s', $id);
        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                return true;
            }
        }
        return false;
    }

    public function getPistasCentro($id = 0) {
        $stmt = $this->mysqli->prepare("select p.*,d.nombre from pistas_deporte_centro p inner join deportes d
        on p.id_deporte = d.id_deporte
        where id_centro = ? ; "); //realiza una consulta pasando un id por medio de un prepare statement
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $pistas = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $pistas;
    }

    public function getAllPistas() {                  // busca todas las pistas de la tabla pistas_deporte_centro
        $result = $this->mysqli->query('select p.*,d.nombre from pistas_deporte_centro p inner join deportes d
        on p.id_deporte = d.id_deporte;');
        $pistas = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $pistas;
    }

    public function insertPista($id_deporte, $id_centro, $numero_pista, $precio_hora, $hora_apertura, $hora_cierre) {
        $stmt = $this->mysqli->prepare("INSERT INTO pistas_deporte_centro VALUES (?,?,?,?,?,?,null,null,null); ");   //inserta en la tabla pistas una nueva pista
        $stmt->bind_param('iiidss', $id_deporte, $id_centro, $numero_pista, $precio_hora, $hora_apertura, $hora_cierre);
        $r = $stmt->execute();
        $stmt->close();
        return $r;
    }

    public function borrarPista($id_deporte, $id_centro, $numero_pista) {             //borra de la tabla personas el usuario con id = id
        $stmt = $this->mysqli->prepare("DELETE FROM pistas_deporte_centro WHERE id_deporte =? and id_centro=? and numero_pista=?;");
        $stmt->bind_param('iii', $id_deporte, $id_centro, $numero_pista);
        $r = $stmt->execute();
        $stmt->close();
        return $r;
    }

    public function updatePista($id_deporte, $id_centro, $numero_pista, $precio_hora, $hora_apertura, $hora_cierre, $url_img) {            // cambia datos de una pista
        $stmt = $this->mysqli->prepare("UPDATE pistas_deporte_centro SET precio_hora=?,hora_apertura=?,hora_cierre=?,url_img=? WHERE id_deporte=? and id_centro = ? and numero_pista=?; ");
        $stmt->bind_param('dsssiii', $precio_hora, $hora_apertura, $hora_cierre, $url_img, $id_deporte, $id_centro, $numero_pista);
        $r = $stmt->execute();
        $stmt->close();
        return $r;
    }

    public function insertDeporte($nombre, $descripcion, $tags, $icono_full, $icono_empty, $imagen, $color) {
        $stmt = $this->mysqli->prepare("INSERT INTO deportes VALUES (null,?,?,?,?,?,?,?); ");   //inserta en la tabla deportes uno nuevo
        $stmt->bind_param('sssssss', $nombre, $descripcion, $tags, $icono_full, $icono_empty, $imagen, $color);
        $r = $stmt->execute();
        $stmt->close();
        return $r;
    }

    public function updateDeporte($id_deporte, $descripcion, $tags, $icono_full, $icono_empty, $imagen, $color) {            // cambia datos de una pista
        $stmt = $this->mysqli->prepare("UPDATE deportes SET descripcion=?,tags=?,icono_full=?,icono_empty=?,imagen=?,color=? WHERE id_deporte=?; ");
        $stmt->bind_param('sssssss', $descripcion, $tags, $icono_full, $icono_empty, $imagen, $color, $id_deporte);
        $r = $stmt->execute();
        $stmt->close();
        return $r;
    }

    public function getAllDeportes() {                  // busca todas las pistas de la tabla pistas_deporte_centro
        $result = $this->mysqli->query('select * from deportes;');
        $pistas = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $pistas;
    }

    public function getTotalDeportes() {
        $result = $this->mysqli->query('select count(*) as "totalDeportes" from deportes;');
        $totalPistas = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $totalPistas;
    }

    public function getTotalCentros() {
        $result = $this->mysqli->query('select count(*) as "totalCentros" from centros;');
        $totalPistas = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $totalPistas;
    }

    public function getTotalUsuarios() {
        $result = $this->mysqli->query('select count(*) as "totalUsuarios" from usuarios;');
        $totalPistas = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $totalPistas;
    }

    public function getTotalEventos() {
        $result = $this->mysqli->query('select count(*) as "totalEventos" from eventos;');
        $totalPistas = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $totalPistas;
    }

    public function getUsuarios() {                  // busca todas las perdsonas de la tabla Centro
        $result = $this->mysqli->query('SELECT * FROM usuarios');
        $users = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $users;
    }

    public function insertUsuario($dni, $nombre, $apellido1, $apellido2, $nick, $password, $email) {
        $stmt = $this->mysqli->prepare("INSERT INTO Usuarios (dni,nombre,apellido1,apellido2,fechaAlta,nick,password,email,tipo_usuario)VALUES (?,?,?,?,current_date(),?,?,?,'deportista'); ");   //inserta en la tabla personas una persona de nombre "name"
        $stmt->bind_param('sssssss', $dni, $nombre, $apellido1, $apellido2, $nick, $password, $email);
        $r = $stmt->execute();
        $stmt->close();
        return $r;
    }

    public function deleteUsuario($id) {
        $stmt = $this->mysqli->prepare("delete from Usuarios where id_usuario=?");   //inserta en la tabla personas una persona de nombre "name"
        $stmt->bind_param('i', $id);
        $r = $stmt->execute();
        $stmt->close();
        return $r;
    }

    public function updateUsuario($id_usuario, $dni, $nombre, $apellido1, $apellido2, $nick, $password, $email, $tipo_usuario, $id_centro_administrado) {
        $stmt = $this->mysqli->prepare("UPDATE usuarios SET dni=?,nombre=?,apellido1=?,apellido2=?,nick=?,password=?,email=?,tipo_usuario=?,id_centro_administrado=? WHERE id_usuario=?; ");
        $stmt->bind_param('sssssssssi', $dni, $nombre, $apellido1, $apellido2, $nick, $password, $email, $tipo_usuario, $id_centro_administrado, $id_usuario);
        $r = $stmt->execute();
        $stmt->close();
        return $r;
    }

    public function getReservasDeporte() {
        $result = $this->mysqli->query("SELECT (select nombre from deportes d where d.id_deporte=r.id_deporte) 
            as 'deporte',count(r.id_deporte) as 'cantidad_reservas'
                  FROM reservas r group by r.id_deporte;");
        $resDeportes = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $resDeportes;
    }

    public function setUltimaVisita($id_usuario) {
        $stmt = $this->mysqli->prepare("UPDATE usuarios SET ultima_visita=current_date() WHERE id_usuario=?; ");
        $stmt->bind_param('i', $id_usuario);
        $r = $stmt->execute();
        $stmt->close();
        return $r;
    }

    public function getGerentes() {
        $result = $this->mysqli->query("SELECT * FROM usuarios where tipo_usuario = 'gerente'");
        $users = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $users;
    }

}
