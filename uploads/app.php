<?php
    trait getInstance{
        public static $instance;
        public static function getInstance() {
            $arg = func_get_args();
            $arg = array_pop($arg);
            return (!(self::$instance instanceof self) || !empty($arg)) ? self::$instance = new static(...(array) $arg) : self::$instance;
        }
        function __set($name, $value){
            $this->$name = $value;
        }
    }

    function autoload($class) {
        // cambiar nombres de directories   
        $directories = [
            dirname(__DIR__).'/scripts/bill/',
            dirname(__DIR__).'/scripts/client/',
            dirname(__DIR__).'/scripts/product/',
            dirname(__DIR__).'/scripts/seller/',
            dirname(__DIR__).'/scripts/db/'
        ];
        
        $classFile = str_replace('\\', '/', $class) . '.php';
    
        foreach ($directories as $directory) {
            $file = $directory.$classFile;
            if (file_exists($file)) {
                require $file;
                break;
            }
        }
    }
?>