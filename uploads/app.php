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

        $directories = [
            dirname(__DIR__).'/scripts/staff/',
            dirname(__DIR__).'/scripts/staff/areas/',
            dirname(__DIR__).'/scripts/staff/areas/academic_area/',
            dirname(__DIR__).'/scripts/staff/areas/academic_area/team_educators/',
            dirname(__DIR__).'/scripts/staff/areas/academic_area/team_educators/trainers/',
            dirname(__DIR__).'/scripts/staff/journey/',
            dirname(__DIR__).'/scripts/staff/journey/locations',
            dirname(__DIR__).'/scripts/staff/working_info',
            dirname(__DIR__).'/scripts/staff/'
        ];

        $classFile = str_replace('\\', '/', $class) . '.php';

        foreach ($directories as $directory) {
            $file = $directory.$classFile;
            // Verificar si el archivo existe y cargarlo
            if (file_exists($file)) {
                require $file;
                break;
            }
        }
    }
    
    spl_autoload_register('autoload');
?>