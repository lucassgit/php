<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class TipoProducto {
    private $idtipoproducto;
    private $nombre;

    public function __construct(){

    }

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
        return $this;
    }


    public function cargarFormulario($request){
        $this->idtipoproducto = isset($request["id"])? $request["id"] : "";
        $this->nombre = isset($request["txtNombre"])? $request["txtNombre"] : "";
    }

    public function insertar(){
        //Instancia la clase mysqli con el constructor parametrizado..
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        //Se arma la query.
        $sql = "INSERT INTO tipo_productos (
                    nombre
                ) VALUES (
                    '$this->nombre'
                );";
        //Se ejecuta la query..
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        //Obtiene el id generado por inserción..
        $this->idtipoproducto = $mysqli->insert_id;
        //Cierra la conexión..
        $mysqli->close();
    }

    public function actualizar(){

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "UPDATE tipo_productos SET
                nombre = '$this->nombre'
                WHERE idtipoproducto = " . $this->idtipoproducto;
          
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function eliminar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "DELETE FROM tipo_productos WHERE idtipoproducto = " . $this->idtipoproducto;
        //Se ejecuta la query..
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function obtenerPorId(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT idtipoproducto, 
                        nombre
                FROM tipo_productos 
                WHERE idtipoproducto = " . $this->idtipoproducto;
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        //El resultado se convierte en un array asociativo..
        if($fila = $resultado->fetch_assoc()){
            $this->nombre = $fila["nombre"];
        }
        $mysqli->close();

    }

    public function obtenerTodos(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT 
                    idtipoproducto, 
                    nombre 
                FROM tipo_productos";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $aResultado = array();
        if($resultado){
            //El resultado se convierte en un array asociativo..
            while($fila = $resultado->fetch_assoc()){
                $entidadAux = new TipoProducto();
                $entidadAux->idtipoproducto = $fila["idtipoproducto"];
                $entidadAux->nombre = $fila["nombre"];
                $aResultado[] = $entidadAux;
            }
        }
        return $aResultado;
    }

}


?>