<?php

require_once 'GospoSQL.php';

class GospoAPI {

    function deleteCentro() {
        if (isset($_GET['action']) && isset($_GET['id'])) {

            $db = new GospoDB();
            $db->borrarCentro($_GET['id']);
            $this->response(204);
        }
    }

    function updateCentro() {
        if (isset($_GET['action']) && isset($_GET['id'])) {

            $obj = json_decode(file_get_contents('php://input'));
            $objArr = (array) $obj;
            if (empty($objArr)) {
                $this->response(422, "error", "Nothing to add. Check json");
            } else if (isset($obj->nombre)) {
                $db = new GospoDB();
                $db->updateCentro($_GET['id'], $obj->nombre, $obj->telefono, $obj->email, $obj->direccion, $obj->municipio, $obj->provincia, $obj->pais, $obj->coordenada_x, $obj->coordenada_y, $obj->url_img);
                $this->response(200, "success", "Record updated");
            } else {
                $this->response(422, "error", "The property is not defined");
            }
        }
    }

    function saveCentro() {

        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array) $obj;
        if (empty($objArr)) {
            $this->response(422, "error", "Nothing to add. Check json");
        } else if (isset($obj->nombre)) {
            $Centro = new GospoDB();
            $Centro->insertCentro($obj->nombre, $obj->telefono, $obj->email, $obj->direccion, $obj->municipio, $obj->provincia, $obj->pais, $obj->coordenada_x, $obj->coordenada_y, $obj->url_img);
            $this->response(200, "success", "new record added");
        } else {
            $this->response(422, "error", "The property is not defined");
        }
    }

    function response($code = 200, $status = "", $message = "") {

        http_response_code($code);
        if (!empty($status) && !empty($message)) {
            $response = array("status" => $status, "message" => $message);
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }

    function getCentros() {

        $db = new GospoDB();
        if (isset($_GET['id'])) {
            $response = $db->getCentro($_GET['id']);
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response = $db->getCentros();
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }

    function getPistas() {

        $db = new GospoDB();
        if (isset($_GET['id'])) {
            $response = $db->getPistasCentro($_GET['id']);
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response = $db->getAllPistas();
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }

    function savePista() {

        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array) $obj;
        if (empty($objArr)) {
            $this->response(422, "error", "Nothing to add. Check json");
        } else if (isset($obj->id_deporte)) {
            $pista = new GospoDB();
            $pista->insertPista($obj->id_deporte, $obj->id_centro, $obj->numero_pista, $obj->precio_hora, $obj->hora_apertura, $obj->hora_cierre);
            $this->response(200, "success", "new pista added");
        } else {
            $this->response(422, "error", "The property is not defined");
        }
    }

    function deletePista() {

        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array) $obj;
        if (empty($objArr)) {
            $this->response(422, "error", "Nothing to delete. Check json");
        } else if (isset($obj->id_deporte)) {
            $pista = new GospoDB();
            $pista->borrarPista($obj->id_deporte, $obj->id_centro, $obj->numero_pista);
            $this->response(200, "success", "pista borrada");
        } else {
            $this->response(422, "error", "The property is not defined");
        }
    }

    function updatePista() {

        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array) $obj;
        if (empty($objArr)) {
            $this->response(422, "error", "Nothing to add. Check json");
        } else if (isset($obj->id_centro)) {
            $db = new GospoDB();
            $db->updatePista($obj->id_deporte, $obj->id_centro, $obj->numero_pista, $obj->precio_hora, $obj->hora_apertura, $obj->hora_cierre, $obj->url_img);
            $this->response(200, "success", "Pista updated");
        } else {
            $this->response(422, "error", "The property is not defined");
        }
    }

    function saveDeporte() {

        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array) $obj;
        if (empty($objArr)) {
            $this->response(422, "error", "Nothing to add. Check json");
        } else if (isset($obj->nombre)) {
            $deporte = new GospoDB();
            $deporte->insertDeporte($obj->nombre, $obj->descripcion, $obj->tags, $obj->icono_full, $obj->icono_empty, $obj->imagen, $obj->color);
            $this->response(200, "success", "new Sport added");
        } else {
            $this->response(422, "error", "The property is not defined");
        }
    }

    function updateDeporte() {

        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array) $obj;
        if (empty($objArr)) {
            $this->response(422, "error", "Nothing to add. Check json");
        } else if (isset($obj->id_deporte)) {
            $db = new GospoDB();
            $db->updateDeporte($obj->id_deporte, $obj->descripcion, $obj->tags, $obj->icono_full, $obj->icono_empty, $obj->imagen, $obj->color);
            $this->response(200, "success", "Deporte updated");
        } else {
            $this->response(422, "error", "The property is not defined");
        }
    }

    function getDeportes() {

        $db = new GospoDB();
        $response = $db->getAllDeportes();
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    function getTotalDeportes() {
        $db = new GospoDB();
        $response = $db->getTotalDeportes();
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    function getTotalCentros() {
        $db = new GospoDB();
        $response = $db->getTotalCentros();
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    function getTotalUsuarios() {
        $db = new GospoDB();
        $response = $db->getTotalUsuarios();
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    function getTotalEventos() {
        $db = new GospoDB();
        $response = $db->getTotalEventos();
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    function getUsuarios() {
        $db = new GospoDB();
        $response = $db->getUsuarios();
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    function saveUsuario() {

        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array) $obj;
        if (empty($objArr)) {
            $this->response(422, "error", "Nothing to add. Check json");
        } else if (isset($obj->email)) {
            $deporte = new GospoDB();
            $deporte->insertUsuario($obj->dni, $obj->nombre, $obj->apellido1, $obj->apellido2, $obj->nick, $obj->password, $obj->email);
            $this->response(200, "success", "Usuario added");
        } else {
            $this->response(422, "error", "The property is not defined");
        }
    }

    function deleteUsuario() {
        if (isset($_GET['id'])) {

            $db = new GospoDB();
            $db->deleteUsuario($_GET['id']);
            $this->response(204);
        }
    }

    function updateUsuario() {
        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array) $obj;
        if (empty($objArr)) {
            $this->response(422, "error", "Nothing to add. Check json");
        } else if (isset($obj->id_usuario)) {
            $db = new GospoDB();
            $db->updateUsuario($obj->id_usuario, $obj->dni, $obj->nombre, $obj->apellido1, $obj->apellido2, $obj->nick, $obj->password, $obj->email, $obj->tipo_usuario, $obj->id_centro_administrado);
            $this->response(200, "success", "Usuario updated");
        } else {
            $this->response(422, "error", "The property is not defined");
        }
    }

    function getReservasDeporte() {
        $db = new GospoDB();
        $response = $db->getReservasDeporte();
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    function setUltimaVisita() {
        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array) $obj;
        if (empty($objArr)) {
            $this->response(422, "error", "Nothing to add. Check json");
        } else if (isset($obj->id_usuario)) {
            $db = new GospoDB();
            $db->setUltimaVisita($obj->id_usuario);
            $this->response(200, "success", "Fecha ultima visita updated");
        } else {
            $this->response(422, "error", "The property is not defined");
        }
    }

    function getGerentes() {
        $db = new GospoDB();
        $response = $db->getGerentes();
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function API() {
        header('Content-Type: application/JSON');
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case 'GET':
                if ($_GET['action'] == 'centros') {
                    $this->getCentros();
                } else if ($_GET['action'] == 'pistas') {
                    $this->getPistas();
                } else if ($_GET['action'] == 'deportes') {
                    $this->getDeportes();
                } else if ($_GET['action'] == 'usuarios') {
                    $this->getUsuarios();
                } else if ($_GET['action'] == 'totaldeportes') {
                    $this->getTotalDeportes();
                } else if ($_GET['action'] == 'totalcentros') {
                    $this->getTotalCentros();
                } else if ($_GET['action'] == 'totalusuarios') {
                    $this->getTotalUsuarios();
                } else if ($_GET['action'] == 'totaleventos') {
                    $this->getTotalEventos();
                } else if ($_GET['action'] == 'chart') {
                    $this->getReservasDeporte();
                } else if ($_GET['action'] == 'gerentes') {
                    $this->getGerentes();
                } else {
                    $this->response(400);
                }
                break;
            case 'POST':
                if ($_GET['action'] == 'centros') {
                    $this->saveCentro();
                } else if ($_GET['action'] == 'pistas') {
                    $this->savePista();
                } else if ($_GET['action'] == 'deportes') {
                    $this->saveDeporte();
                } else if ($_GET['action'] == 'usuarios') {
                    $this->saveUsuario();
                } else {
                    $this->response(400);
                }
                break;
            case 'PUT':
                if ($_GET['action'] == 'centros') {
                    $this->updateCentro();
                } else if ($_GET['action'] == 'pistas') {
                    $this->updatePista();
                } else if ($_GET['action'] == 'deportes') {
                    $this->updateDeporte();
                } else if ($_GET['action'] == 'usuarios') {
                    $this->updateUsuario();
                } else if ($_GET['action'] == 'ultimaVisita') {
                    $this->setUltimaVisita();
                } else {
                    $this->response(400);
                }
                break;
            case 'DELETE':
                if ($_GET['action'] == 'centros') {
                    $this->deleteCentro();
                } else if ($_GET['action'] == 'pistas') {
                    $this->deletePista();
                } else if ($_GET['action'] == 'usuarios') {
                    $this->deleteUsuario();
                } else {
                    $this->response(400);
                }
                break;
            default:
                $this->response(405);
                break;
        }
    }

}
