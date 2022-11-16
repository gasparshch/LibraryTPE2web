<?php
require_once "./app/Model/BooksModel.php";
require_once "./app/View/ApiView.php";

class ApiBooksController{

    private $model;
    private $view;

    function __construct(){
        $this->model = new BooksModel();
        $this->view = new ApiView();
    }

    function obtenerLibros(){

        if (isset($_GET['sort']) && isset($_GET['order'])){
            $libros = $this->model->getBooksFromDB($_GET['sort'], $_GET['order']);
            if ($libros) {
                $this->view->response($libros, 200);
            } else {
                $this->view->response("No existen libros con esas características", 404);
            }
        } else {
            $libros = $this->model->getBooksFromDB();
            if ($libros){
                return $this->view->response($libros, 200);
            } else {
                return $this->view->response(null, 404);
            }
        }

    }

    function obtenerLibro($params = null){
        $idLibro = $params[":ID"];
        $libro = $this->model->getBookFromDB($idLibro);
        if ($libro){
            return $this->view->response($libro, 200);
        } else {
            return $this->view->response(null, 404);
        }
    }

    function eliminarLibro($params = null){
        $idLibro = $params[":ID"];
        $libro = $this->model->getBookFromDB($idLibro);
        if ($libro){
            $this->model->deleteBookFromDB($idLibro);
            return $this->view->response("El libro nro $idLibro fue eliminado", 200);
        } else {
            return $this->view->response("El libro nro $idLibro no existe", 404);
        }
    }

    function insertarLibro($params = null){
        // obtengo el body del request (json)
        $body = $this->getBody();

        if ( ($body->title != null) && ($body->genre != null) && ($body->descrip != null) && ($body->id_author != null) ){
            $id = $this->model->createBookFromDB($body->title, $body->genre, $body->descrip, $body->id_author);
            if ($id != 0){
                $this->view->response("La tarea se insertó con el id $id", 200);
            } else {
                $this->view->response("La tarea no se pudo insertar", 500);
            }
        } else {
            $this->view->response("Error por faltar datos necesarios para poder crear ítem", 400);
        }
    }

    function actualizarLibro($params = null){
        $idLibro = $params[":ID"];
        $body = $this->getBody();
        // validaciones
        if ( ($body->title != null) && ($body->genre != null) && ($body->descrip != null) && ($body->id_author != null) ){
            $libro = $this->model->getBookFromDB($idLibro);
            if ($libro){
                $this->model->updateBookFromDB($idLibro, $body->title, $body->genre, $body->descrip, $body->id_author);
                $this->view->response("El libro con el id=$idLibro se modificó con exito", 200);
            } else {
                return $this->view->response("El libro nro $idLibro no existe", 404);
            }
        } else {
            $this->view->response("Error por faltar datos necesarios para poder crear ítem", 400);
        }
    }

    // devuelve el body del request

    private function getBody(){
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }
}