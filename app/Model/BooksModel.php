<?php

class BooksModel{

    private $db;
    
    function __construct(){
        // me conecto a la base de datos, abro conexión
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_biblioteca;charset=utf8', 'root', '');
    }

    function getBooksFromDB() {
         
        // preparo la sentencia para devolver el resultado
        $query = $this->db->prepare("SELECT books.*, authors.namename FROM books INNER JOIN authors ON books.id_author = authors.id_author");
        
        $query->execute();
        $books = $query->fetchAll(PDO::FETCH_OBJ);
    
        // devuelvo todo el array
        return $books;
    
    }

    function getBookFromDB($id_book){

        // preparo la sentencia para devolver el resultado
        // el resultado es un solo objeto que busqué con el id
        $query = $this->db->prepare("SELECT books.*, authors.namename FROM books INNER JOIN authors ON books.id_author = authors.id_author WHERE books.id_book = ?");
        
        // lo ejecuto y capturo
        $query->execute(array($id_book));
        $book = $query->fetch(PDO::FETCH_OBJ);
    
        // devuelvo todo el array
        return $book;
    
    }

    function createBookFromDB($title, $genre, $descrip, $id_author) {

        // preparo la sentencia para devolver el resultado
        $query = $this->db->prepare("select * from books");
            
        // capturo todos los items para posterior manipulación
        $query->execute();
        $books = $query->fetchAll(PDO::FETCH_OBJ);
    
        // busco el ID mas grande, habria que optimizar con lastInsertID()
        $max = 0;
        foreach($books as $book){
            if($book->id_book > $max){
                $max = $book->id_book;
            }
        }
        $proxId = $max + 1;
    
        // preparo la sentencia para insertar
        $query = $this->db->prepare("INSERT INTO books(id_book, title, genre, descrip, id_author) VALUES(?, ?, ?, ?, ?) ");
    
        // ejecuto la sentencia, le paso un arreglo que va a tomar esos signos de pregunta
        $query->execute(array($proxId, $title, $genre, $descrip, $id_author));
    
    }

    function deleteBookFromDB($id_book){

        // preparo la sentencia para borrar
        $query = $this->db->prepare("DELETE FROM books WHERE id_book=?");
        
        // ejecuto la sentencia
        $query->execute(array($id_book));
    }

    function updateBookFromDB($id_book, $title, $genre, $descrip, $id_author){
        // preparo la sentencia para actualizar
        $query = $this->db->prepare("UPDATE books SET title=?, genre=?, descrip=?, id_author=? WHERE id_book=?");
    
        // ejecuto la sentencia
        $query->execute(array($title, $genre, $descrip, $id_author, $id_book));
    }

}