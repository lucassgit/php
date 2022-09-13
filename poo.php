<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Persona
{
     protected $dni;
     protected $nombre;
     protected $edad;
     protected $nacionalidad;

    public function __construct($dni="", $nombre="", $edad="", $nacionalidad=""){
        $this->dni = $dni;
    } 
    
    public function __destruct() {
        echo "Destruyendo el objeto " . $this->nombre . "<br>";
    }

    public function setDni($dni){$this->dni = $dni;}
    public function getDni(){return $this->dni; }

    public function setNombre($nombre){$this->nombre = $nombre;}
    public function getNombre(){return $this->nombre; }

    public function setEdad($edad){$this->edad = $edad;}
    public function getEdad(){return $this->edad; }

    public function setNacionalidad($nacionalidad){$this->nacionalidad = $nacionalidad;}
    public function getNacionalidad(){return $this->nacionalidad; }

    public function imprimir(){}

    
}

class Alumno extends Persona{
    private $legajo;
    private $notaPortfolio;
    private $notaPhp;
    private $notaProyecto;

   
    public function __construct()
    {
        $this->notaPortfolio = 0.0;
        $this->notaPhp = 0.0;
        $this->notaProyecto = 0.0;
    }

    public function __destruct() {
        echo "Destruyendo el objeto " . $this->nombre . "<br>";
    }

    public function __get($propiedad){
     return $this ->$propiedad;
    }

    public function __set($propiedad , $valor){
     $this-> $propiedad = $valor;
    }

    public function imprimir(){
        echo "DNI:  " . $this->dni . "<br>";
        echo "Nombre:  " . $this->nombre . "<br>";
        echo "Edad:  " . $this->edad . "<br>";
        echo "Nacionalidad:  " . $this->nacionalidad . "<br>";
        echo "Nota PHP:  " . $this->notaPhp . "<br><br>";
        echo "Nota Portfolio:  " . $this->notaPortfolio . "<br><br>";
        echo "Nota Proyecto:  " . $this->notaProyecto . "<br><br>";
        echo "Promedio:  " . number_format($this->calcularPromedio(), 2, ",", ".") . "<br><br>";
    }

     public function calcularPromedio(){
      return ($this->notaPhp + $this->notaPortfolio + $this->notaProyecto)/3;
    }

}

class Docente extends Persona{
    public $especialidad;
    const ESPECIALIDAD_WP = "Wordpress";
    const ESPECIALIDAD_ECO = "Economía aplicada";
    const ESPECIALIDAD_BBDD = "Base de datos";

    public function __destruct() {
        echo "Destruyendo el objeto " . $this->nombre . "<br>";
    }

    public function __get($propiedad){
        return $this ->$propiedad;
    }
   
    public function __set($propiedad , $valor){
        $this-> $propiedad = $valor;
    }

    public function imprimir(){}

     public function imprimirEspecialidadesHabilitadas(){
        echo "Un docente puede tener las siguientes especialidades:<br>";
        echo "Especialidad 1: " . self::ESPECIALIDAD_WP . "<br>";
        echo "Especialidad 2: " . self::ESPECIALIDAD_ECO . "<br>";
        echo "Especialidad 3: " . self::ESPECIALIDAD_BBDD . "<br>";

    }
}

//Programa...
$alumno1 = new Alumno();
$alumno1->setDni("36555501");
$alumno1->setNombre("Ana Valle");
$alumno1->notaPhp = 8;
$alumno1->notaPortfolio = 9;
$alumno1->notaProyecto = 10;
$alumno1->imprimir();

$alumno2 = new Alumno();
$alumno1->setDni("36555502");
$alumno1->setNombre("Bernabe Marquez");
$alumno1->notaPhp = 8;
$alumno1->notaPortfolio = 7;
$alumno1->notaProyecto = 8;
$alumno1->imprimir();

$docente = new Docente();
$docente->setNombre("Sergio Cantero");
$docente->especialidad = Docente::ESPECIALIDAD_ECO;
