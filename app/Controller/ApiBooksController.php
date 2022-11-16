<?php
require_once "./Model/BooksModel.php";
require_once "./View/ApiView.php";

class ApiBooksController{

    private $model;
    private $view;

    function __construct(){
        $this->model = new BooksModel();
        $this->view = new ApiView();
    }

    function obtenerLibros(){
        $libros = $this->model->getBooksFromDB();
        if ($libros){
            return $this->view->response($libros, 200);
        } else {
            return $this->view->response(null, 404);
        }
    }

    function obtenerTarea($params = null){
        $idTarea = $params[":ID"];
        $tarea = $this->model->getTask($idTarea);
        if ($tarea){
            return $this->view->response($tarea, 200);
        } else {
            return $this->view->response(null, 404);
        }
    }

    function eliminarTarea($params = null){
        $idTarea = $params[":ID"];
        $tarea = $this->model->getTask($idTarea);
        if ($tarea){
            $this->model->deleteTaskFromDB($idTarea);
            return $this->view->response("La tarea nro $idTarea fue eliminada", 200);
        } else {
            return $this->view->response("La tarea nro $idTarea no existe", 404);
        }
    }

    function insertarTarea($params = null){
        // obtengo el body del request (json)
        $body = $this->getBody();

        // falta hacer validaciones

        $id = $this->model->insertTask($body->titulo, $body->descripcion, $body->prioridad, 0);
        if ($id != 0){
            $this->view->response("La tarea se insertó con el id $id", 200);
        } else {
            $this->view->response("La tarea no se pudo insertar", 500);
        }
    }

    function actualizarTarea($params = null){
        $idTarea = $params[":ID"];
        $body = $this->getBody();
        // validaciones

        $tarea = $this->model->getTask($idTarea);
        if ($tarea){
            $this->model->updateFromDB($idTarea, $body->titulo, $body->descripcion, $body->prioridad, $body->finalizada);
            $this->view->response("La tarea con el id=$idTarea se modificó con exito", 200);
        } else {
            return $this->view->response("La tarea nro $idTarea no existe", 404);
        }
    }



    // devuelve el body del request

    private function getBody(){
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }
}