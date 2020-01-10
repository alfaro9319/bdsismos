<?php

/**
 * Clase genérica para la descarga de archivos - v2011-03-16
 *
 * El propósito es abstraer el proceso lo máximo posible e incluir aquí todos apaños necesarios
 * para evitar bugs conocidos de navegadores
 *
 * @todo Detección de compresión transparente (para generar Content-Length o no) o al menos
 *       proporcionar un método para modificar el valor predeterminado
 * @todo Contemplar Content-Length cuando el tamaño del archivo es mayor que PHP_INT_MAX
 * @todo Ver si el RFC-5987 resulta útil para codificar el parámetro filename en Content-Disposition
 */
abstract class DescargaBase{
    private $nombre, $tipo_mime;
    private $hay_compresion_transparente = FALSE;


    /**
     * Constructor
     */
    public function __construct($nombre, $tipo_mime='application/octet-stream'){
        $this->nombre =  $this->nombreValido($nombre);
        $this->tipo_mime = $tipo_mime;
    }


    /**
     * Genera los encabezados HTTP necesarios, envía el archivo y finaliza la ejecución del script
     */
    public function descargar($inline=FALSE){
        /*
         * Evitamos que IE pierda el archivo al abrirlo directamente
         *
         * Nota: la solución idónea es session_cache_limiter('private') pero no es práctico ya que
         *     debe ir antes de session_start() y eso no lo controlamos en esta clase;
         *     como solución rápida generamos encabezados a mano, que tiene un efecto parecido
         */
        header('Pragma: private');
        header('Cache-Control: public, must-revalidate');


        /*
         * Datos del archivo
         */
        header('Content-Type: ' . $this->tipo_mime);
        if( $inline ){
            header('Content-Disposition: inline; filename="' . $this->nombre . '"');
        }else{
            header('Content-Disposition: attachment; filename="' . $this->nombre . '"');
        }
        header('Content-Transfer-Encoding: binary');


        /*
         * Sólo conocemos el tamaño del archivo cuando no va a ser comprimido después de enviarlo
         */
        if( !$this->hay_compresion_transparente ){
            header('Content-Length: ' . $this->obtenerTamano());
        }


        $this->volcar();
        exit;
    }


    /**
     * Devuelve el tamaño en bytes del archivo
     */
    abstract protected function obtenerTamano();


    /**
     * Vuelca el contenido del archivo por la salida estándar
     */
    abstract protected function volcar();


    /**
     * Adapta el nombre de archivo para que dé los menos problemas posibles al descargar
     */
    private function nombreValido($nombre){
        /*
         * Nos aseguramos de que el nombre de descarga sea un nombre válido para guardar en
         * disco según los criterios de Windows (el S.O. más restrictivo en cuanto a nombres)
         */
        return strtr($nombre, '\\/:*?"<>|', '---------');
    }

} // class DescargaBase


/**
 * Clase para descargar desde una variable
 */
class DescargaVariable extends DescargaBase{
    private $contenido;


    /**
     * Constructor
     */
    public function __construct(&$variable, $nombre, $tipo_mime='application/octet-stream'){
        if( is_scalar($variable) ){
            $this->contenido = &$variable;
            parent::__construct($nombre, $tipo_mime);
        }else{
            throw new Exception('La variable con el contenido del archivo no es un escalar: ' . gettype($variable));
        }
    }


    /**
     * Implementación de método abstracto, v. clase base para más detalles
     */
    protected function obtenerTamano(){
        // bytes (no caracteres)
        return strlen($this->contenido);
    }


    /**
     * Implementación de método abstracto, v. clase base para más detalles
     */
    protected function volcar(){
        echo $this->contenido;
    }
} // class DescargaVariable


/**
 * Clase para descargar a partir de un nombre de archivo
 */
class DescargaArchivo extends DescargaBase{
    private $archivo;

    /**
     * Constructor
     */
    public function __construct($archivo, $nombre, $tipo_mime='application/octet-stream'){
        if( is_readable($archivo) ){
            $this->archivo = $archivo;
            parent::__construct($nombre, $tipo_mime);
        }else{
            throw new Exception('El archivo no existe o no se puede leer: ' . $archivo);
        }
    }


    /**
     * Implementación de método abstracto, v. clase base para más detalles
     */
    protected function obtenerTamano(){
        return filesize($this->archivo);
    }


    /**
     * Implementación de método abstracto, v. clase base para más detalles
     */
    protected function volcar(){
        $fp = @fopen($this->archivo, 'rb');
        if($fp){
            while( !feof($fp) ){
                echo fread($fp, 8192);
            }
            fclose($fp);
        }else{
            throw new Exception('Se ha producido un error al abrir el archivo: ' . $this->archivo);
        }
    }
} // class DescargaArchivo


/**
 * Clase para descargar desde un puntero a un archivo generado por fopen()
 */
class DescargaPuntero extends DescargaBase{
    private $fp;

    /**
     * Constructor
     */
    public function __construct($fp, $nombre, $tipo_mime='application/octet-stream'){
        if( is_resource($fp) && (get_resource_type($fp)=='file' || get_resource_type($fp)=='stream') ){
            $this->fp = $fp;
            parent::__construct($nombre, $tipo_mime);
        }else{
            throw new Exception('El parámetro no es un puntero a un archivo: ' . gettype($fp));
        }
    }


    /**
     * Implementación de método abstracto, v. clase base para más detalles
     */
    protected function obtenerTamano(){
        $stat = fstat($this->fp);
        return $stat['size'];
    }


    /**
     * Implementación de método abstracto, v. clase base para más detalles
     */
    protected function volcar(){
        rewind($this->fp);
        while( !feof($this->fp) ){
            echo fread($this->fp, 8192);
        }
        fclose($this->fp);
    }
} // class DescargaPuntero

?>
