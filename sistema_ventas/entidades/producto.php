<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Producto
{
    private $idproducto;
    private $nombre;
    private $cantidad;
    private $precio;
    private $descripcion;
    private $fk_idtipoproducto;
    private $imagen;

    public function __construct()
    {
        $this->cantidad = 0;
        $this->precio = 0.0;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
        return $this;
    }


    public function cargarFormulario($request)
    {
        $this->idproducto = isset($request["id"]) ? $request["id"] : "";
        $this->nombre = isset($request["txtNombre"]) ? $request["txtNombre"] : "";
        $this->fk_idtipoproducto = isset($request["lstTipoProducto"]) ? $request["lstTipoProducto"] : "";
        $this->cantidad = isset($request["txtCantidad"]) ? $request["txtCantidad"] : 0;
        $this->precio = isset($request["txtPrecio"]) ? $request["txtPrecio"] : 0;
        $this->descripcion = isset($request["txtDescripcion"]) ? $request["txtDescripcion"] : "";
    }

    public function insertar()
    {
        //Instancia la clase mysqli con el constructor parametrizado..
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        //Se arma la query..
        $sql = "INSERT INTO productos (
                    nombre,
                    cantidad, 
                    precio, 
                    descripcion,
                    fk_idtipoproducto, 
                    imagen
                ) VALUES (
                    '$this->nombre', 
                    $this->cantidad,
                    $this->precio, 
                    '$this->descripcion',
                    $this->fk_idtipoproducto,
                    '$this->imagen'
                );";
        //Se ejecuta la query..
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        //Obtiene el id generado..
        $this->idproducto = $mysqli->insert_id;
        //Se cierra la conexión..
        $mysqli->close();
    }

    public function actualizar()
    {

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "UPDATE productos SET
                nombre = '$this->nombre',
                fk_idtipoproducto = $this->fk_idtipoproducto,
                cantidad = $this->cantidad,
                precio = $this->precio,
                descripcion = '$this->descripcion,
                imagen = '$this->imagen'
                WHERE idproducto = $this->idproducto";

        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function eliminar()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "DELETE FROM productos WHERE idproducto = " . $this->idproducto;
        //Ejecuta la query..
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function obtenerPorId()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT idproducto, 
                        nombre,
                        cantidad, 
                        precio, 
                        descripcion,
                        fk_idtipoproducto,
                        imagen
                FROM productos 
                WHERE idproducto = " . $this->idproducto;
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        //El resultado se convierte en un array asociativo..
        if ($fila = $resultado->fetch_assoc()) {
            $this->idproducto = $fila["idproducto"];
            $this->nombre = $fila["nombre"];
            $this->fk_idtipoproducto = $fila["fk_idtipoproducto"];
            $this->cantidad = $fila["cantidad"];
            $this->precio = $fila["precio"];
            $this->descripcion = $fila["descripcion"];
            $this->imagen = $fila["imagen"];
        }
        $mysqli->close();
        return $this;
    }

    public function obtenerTodos()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT 
                    idproducto,
                    nombre, 
                    cantidad, 
                    precio, 
                    descripcion,
                    fk_idtipoproducto, 
                    imagen 
                FROM productos ORDER BY idproducto DESC";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $aResultado = array();
        if ($resultado) {
            //El resultado se convierte en un array asociativo..
            while ($fila = $resultado->fetch_assoc()) {
                $entidadAux = new Producto();
                $entidadAux->idproducto = $fila["idproducto"];
                $entidadAux->nombre = $fila["nombre"];
                $entidadAux->cantidad = $fila["cantidad"];
                $entidadAux->precio = $fila["precio"];
                $entidadAux->descripcion = $fila["descripcion"];
                $entidadAux->fk_idtipoproducto = $fila["fk_idtipoproducto"];
                $entidadAux->imagen = $fila["imagen"];
                $aResultado[] = $entidadAux;
            }
        }
        $mysqli->close();
        return $aResultado;
    }
}
