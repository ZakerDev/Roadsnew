<?php

try{
$district = $_GET['district'];

$roadName = str_replace('–', '-',$_GET['roadName']);
$roadNumber = $_GET['roadNumber'];



function directory_check($district, $roadName,$roadNumber){
    $directory = 'data/'.$district.'/';
    $files = scandir($directory);
    try{
        
    foreach ($files as $file) {
        $path=$directory . '/' . $file;
        if (strpos(' '.$file, $roadName) !== 0 || strpos(' '.$file, $roadNumber) !== 0) {
            
            return getTableNames($district,$path);
        }
        else{
            echo json_encode(['success' => false, 'data'=>[]]);
        }
    }
    }
    catch (Exception $e) {
        // обработка исключения
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}


function directory_check1($district, $roadName, $roadNumber) {
    $directory = 'data/' . $district . '/';
    $files = scandir($directory);
    try {
        ///echo json_encode(['success' => 'test', 'roadNumber' => $roadNumber]);
        
        foreach ($files as $file) {
            $path = $directory . '/' . $file;
            if (strpos($file, $roadName) !== false || strpos(' '.$file, $roadNumber) !== false) {
                ///echo json_encode(['success' => false, 'error' => $path]);
                return getTableNames($district, $file);
            }
        }
        ///echo json_encode(['success' => false, 'data' => []]);
    } catch (Exception $e) {
        // обработка исключения
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

function getTableNames($district,$name) {
    try{
    $folderPath = 'data/'.$district.'/'.$name;
    ///$folderPath = $name;
        $tableNames = [];
        $files = scandir($folderPath);
               
        foreach ($files as $file) {
            if (is_file($folderPath . '/' . $file)) {
                $tableNames[] = $file;
            }
        }
        return json_encode($tableNames);
        ///return json_encode($folderPath);
    if (is_dir($folderPath)) {
    } else {
        return json_encode([$folderPath, scandir($folderPath) ]);
    }
    }
    catch (Exception $e) {
        // обработка исключения
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}


$tableNames = directory_check1($district, $roadName,$roadNumber);
echo $tableNames;
}
catch (Exception $e) {
    // обработка исключения
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>