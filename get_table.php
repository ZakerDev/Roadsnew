<?php



define('error', 'SomeValue');

$district = $_GET['district']; 
$val1 = $_GET['roadName']; 
$selectedOption = $_GET['selectedOption']; 


try{
if (!empty($district) && !empty($val1) && !empty($selectedOption)) {
    
    $filePath = 'C:\MAMP\htdocs\Roadsnew\\data\\' . $district . '\\' . str_replace('–', '-', $val1) . '\\' . $selectedOption; 
    try{
        if (file_exists($filePath)) {
            
            $fileContent = file_get_contents($filePath);
            
            
            $lines = explode("\n", $fileContent);
            error_log($lines[1]);
            
            $valuesList = array();
            
            $columnList_2 = array();
            $columnList_3 = array();
            $columnList_4 = array();
            $columnList_5 = array();
            $columnList_6 = array();
            $columnList_7 = array();
            
            for ($i = 1; $i < count($lines); $i++) {
                $line = $lines[$i];
                if (!empty(trim($line))){

                
                    $columns = explode("\t", $line); 
                    if (isset($columns[0]) && isset($columns[1])) {
                        $startLocation = trim($columns[0]); 
                        $endLocation = trim($columns[1]); 
                        $column2 = trim($columns[2]);
                        $column3 = trim($columns[3]);
                        $column4 = trim($columns[4]);
                        $column5 = trim($columns[5]);
                        if ($startLocation!=' ' && $endLocation!=' '){
                        $valuesList[] = $startLocation;
                        $valuesList[] = $endLocation;
                        $columnList_2[]=$column2;
                        $columnList_3[]=$column3;
                        $columnList_4[]=$column4;
                        $columnList_5[]=$column5;
                    }
                        
                    }
                }
            }
            $exit_list=[$valuesList,$columnList_2,$columnList_3,$columnList_4,$columnList_5];
            
            
            header('Content-Type: text/plain');
            echo implode("\n", $exit_list);
            exit;
    } else {
        echo 'Файл не найден.';
    }
    }
    catch (Exception $e) {
        $errorMessage = $e->getMessage();
        error_log('Произошла ошибка: ' . $errorMessage, 0); 

        
    }
} else {
    echo 'Некорректные параметры запроса.';
}

}
catch (Exception $e) {
    error_log($e->getMessage()); 
    echo 'Произошла ошибка: ' . $e->getMessage(); 
}

?>