<?php

class BooksModel{

    private $db;
    
    function __construct(){
        // me conecto a la base de datos, abro conexión
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_biblioteca;charset=utf8', 'root', '');
    }

    function getBooksFromDB($sort = null, $order = null) {
         
        // preparo la sentencia para devolver el resultado
        if ($sort && $order) {
            $query = $this->db->prepare("SELECT books.*, authors.namename FROM books INNER JOIN authors ON books.id_author = authors.id_author ORDER BY $sort $order");
            $query->execute();
        } else {
            $query = $this->db->prepare("SELECT books.*, authors.namename FROM books INNER JOIN authors ON books.id_author = authors.id_author");
            $query->execute();
        }

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
    
        
    
        // preparo la sentencia para insertar
        $query = $this->db->prepare("INSERT INTO books(title, genre, descrip, id_author) VALUES(?, ?, ?, ?) ");
    
        // ejecuto la sentencia, le paso un arreglo que va a tomar esos signos de pregunta
        $query->execute(array($title, $genre, $descrip, $id_author));

        return $this->db->lastInsertId();
    
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