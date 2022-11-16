ENTREGA TPE 2 WEB

Para trabajar en este proyecto se utilizan diferentes endpoints, uno para listar todos los items, otro listar uno en particular, modificarlo, agregar uno nuevo, o listar mediante alguna característica en particular

(GET) http://localhost/LibraryTPE2web/api/books
(GET/:ID) http://localhost/LibraryTPE2web/api/books/:ID

Para (POST) se debe insertar en postman un objeto de formato JSON, utilizar el endpoint genérico como el GET, ya que no es necesario identificar este nuevo objeto a insertar de ninguna manera porque se le asignará un ID único automáticamente, el cuál enseñará una vez realizada la operación

(DELETE) http://localhost/LibraryTPE2web/api/books/:ID

(PUT) http://localhost/LibraryTPE2web/api/books/:ID

Para PUT se selecciona el respctivo ID del ítem a modificar y luego se ingresan los nuevos datos en postman, para su reemplazo

PARA LISTAR LOS ÍTEMS POR COLUMNA A ELECCIÓN Y ORDEN

http://localhost/LibraryTPE2web/api/books?sort=XXXX&ord=ASC/DESC