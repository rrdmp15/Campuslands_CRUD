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

        //Staff

        $directoriesStaff = array();
        $directorioStaff = dirname(__DIR__) . '/scripts/staff';
        $elementosStaff = scandir($directorioStaff);
        foreach ($elementosStaff as $elemento) {
            $rutaElemento = $directorioStaff . '/' . $elemento . '/';
            if (is_dir($rutaElemento) && $elemento !== '.' && $elemento !== '..') {
                $directoriesStaff[] = $rutaElemento;
            }
        }
        
        $classFile = str_replace('\\', '/', $class) . '.php';
    
        foreach ($directoriesStaff as $directory) {
            $file = $directory.$classFile;
            if (file_exists($file)) {
                require $file;
                break;
            }
        }

        // areas

        $directoriesAreas = array();
        $directorioArea = dirname(__DIR__) . '/scripts/staff';
        $elementosArea = scandir($directorioArea);
        foreach ($elementosArea as $elemento) {
            $rutaElemento = $directorioArea . '/' . $elemento . '/';
            if (is_dir($rutaElemento) && $elemento !== '.' && $elemento !== '..') {
                $directoriesAreas[] = $rutaElemento;
            }
        }
        
        $classFile = str_replace('\\', '/', $class) . '.php';
    
        foreach ($directoriesAreas as $directory) {
            $file = $directory.$classFile;
            if (file_exists($file)) {
                require $file;
                break;
            }
        }

        // academic areas

        $directoriesAcademicAreas = array();
        $directorioAcademicAreas = dirname(__DIR__) . '/scripts/staff';
        $elementosAcademicAreas = scandir($directorioAcademicAreas);
        foreach ($elementosAcademicAreas as $elemento) {
            $rutaElemento = $directorioAcademicAreas . '/' . $elemento . '/';
            if (is_dir($rutaElemento) && $elemento !== '.' && $elemento !== '..') {
                $directoriesAcademicAreas[] = $rutaElemento;
            }
        }
        
        $classFile = str_replace('\\', '/', $class) . '.php';
    
        foreach ($directoriesAcademicAreas as $directory) {
            $file = $directory.$classFile;
            if (file_exists($file)) {
                require $file;
                break;
            }
        }

        //team educators 

        $directoriesTeamEducators = array();
        $directorioTeamEducators = dirname(__DIR__) . '/scripts/staff';
        $elementosTeamEducators = scandir($directorioTeamEducators);
        foreach ($elementosTeamEducators as $elemento) {
            $rutaElemento = $directorioTeamEducators . '/' . $elemento . '/';
            if (is_dir($rutaElemento) && $elemento !== '.' && $elemento !== '..') {
                $directoriesTeamEducators[] = $rutaElemento;
            }
        }
        
        $classFile = str_replace('\\', '/', $class) . '.php';
    
        foreach ($directoriesTeamEducators as $directory) {
            $file = $directory.$classFile;
            if (file_exists($file)) {
                require $file;
                break;
            }
        }

        //trainers
        $directoriesTrainers = array();
        $directorioTrainers = dirname(__DIR__) . '/scripts/staff';
        $elementosTrainers = scandir($directorioTrainers);
        foreach ($elementosTrainers as $elemento) {
            $rutaElemento = $directorioTrainers . '/' . $elemento . '/';
            if (is_dir($rutaElemento) && $elemento !== '.' && $elemento !== '..') {
                $directoriesTrainers[] = $rutaElemento;
            }
        }
        
        $classFile = str_replace('\\', '/', $class) . '.php';
    
        foreach ($directoriesTrainers as $directory) {
            $file = $directory.$classFile;
            if (file_exists($file)) {
                require $file;
                break;
            }
        }

        //journey

        $directoriesJourney = array();
        $directorioJourney = dirname(__DIR__) . '/scripts/staff';
        $elementosJourney = scandir($directorioJourney);
        foreach ($elementosJourney as $elemento) {
            $rutaElemento = $directorioJourney . '/' . $elemento . '/';
            if (is_dir($rutaElemento) && $elemento !== '.' && $elemento !== '..') {
                $directoriesJourney[] = $rutaElemento;
            }
        }
        
        $classFile = str_replace('\\', '/', $class) . '.php';
    
        foreach ($directoriesJourney as $directory) {
            $file = $directory.$classFile;
            if (file_exists($file)) {
                require $file;
                break;
            }
        }

        //location

        $directoriesLocation = array();
        $directorioLocation = dirname(__DIR__) . '/scripts/staff';
        $elementosLocation = scandir($directorioLocation);
        foreach ($elementosLocation as $elemento) {
            $rutaElemento = $directorioLocation . '/' . $elemento . '/';
            if (is_dir($rutaElemento) && $elemento !== '.' && $elemento !== '..') {
                $directoriesLocation[] = $rutaElemento;
            }
        }
        
        $classFile = str_replace('\\', '/', $class) . '.php';
    
        foreach ($directoriesLocation as $directory) {
            $file = $directory.$classFile;
            if (file_exists($file)) {
                require $file;
                break;
            }
        }

        //working info

        $directoriesWorkingInfo = array();
        $directorioWorkingInfo = dirname(__DIR__) . '/scripts/staff';
        $elementosWorkingInfo = scandir($directorioWorkingInfo);
        foreach ($elementosWorkingInfo as $elemento) {
            $rutaElemento = $directorioWorkingInfo . '/' . $elemento . '/';
            if (is_dir($rutaElemento) && $elemento !== '.' && $elemento !== '..') {
                $directoriesWorkingInfo[] = $rutaElemento;
            }
        }
        
        $classFile = str_replace('\\', '/', $class) . '.php';
    
        foreach ($directoriesWorkingInfo as $directory) {
            $file = $directory.$classFile;
            if (file_exists($file)) {
                require $file;
                break;
            }
        }
    }
?>