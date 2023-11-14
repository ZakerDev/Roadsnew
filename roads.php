
<!DOCTYPE html>
<html>
<head>
    <title>Дороги районов Курской области</title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
    <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=7fd78b29-a85d-4699-8094-5cf73625e847&lang=ru_RU" type="text/javascript"></script>
    <style>
        html, body, #map {
            width: 100%; height: 98%; padding: 0; margin: 0;
        }
        
        .my-balloon {
            display: inline-block;
            padding: 4px 10px;
            height: 120px;
            position: relative;
            bottom: 80px;
            left: -10px;
            width: 158px;
            font-size: 11px;
            line-height: 15px;
            color: #333333;
            text-align: left;
            vertical-align: middle;
            background-color: #FFFFF6;
            border: 1px solid #CDB7B5;
            border-radius: 6px;
            font-family: Arial;
        }
        .dropdown-container {
            display: inline-block;
            padding: 4px 10px;
            height: auto;
            width: auto;
            font-size: 11px;
            line-height: 15px;
            color: #333333;
            text-align: left;
            vertical-align: middle;
            background-color: #FFFFF6;
            border: 1px solid #CDB7B5;
            border-radius: 6px;
            font-family: Arial;
        }
        .open-dropdown {
            background-color: #FFFFF6;
        border: 1px solid #CDB7B5;
        border-radius: 6px;
        font-family: Arial;
        padding: 8px 20px; /* Меньший отступ сверху и снизу, более широкая кнопка */
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px; /* Уменьшенный размер шрифта */
        color: #333333;
        cursor: pointer;
            }
       
        
        .open-dropdown:hover {
            background-color: #3498db;
            color: white;
        }
        .close {
            margin-top: -3px;
        }              
    </style>
</head>
<body>
    <form method="get" name="refresh" action="roads.php">
    <input id="set_points" name="set_points" type="checkbox" <?php if ((isset($_GET['kml'])) && ($_GET['set_points'] != "")) { print "checked"; }  ?>>Расставлять пункты (нажмите "Показать" для активации возможности) 
    <br><input id="csv" name="csv" type="checkbox" <?php if ((isset($_GET['csv'])) && ($_GET['csv'] != "")) { print "checked"; }  ?>>Подгружать csv
    <input id="kml" name="kml" type="checkbox" <?php if ((isset($_GET['kml'])) && ($_GET['kml'] != "")) { print "checked"; }  ?>>Подгружать kml
    <input id="coords"></input>
    <br>Выберите район:
    <select name="district" id="district">
        <?php
        $districts = array(
            
            "prist" => 'Пристенский', 
            "gold" => 'Золотухинский', 
            "soviet" => 'Советский',
            "root" => 'Кореневский',
            "kurch" => 'Курчатовский',
            "gorsh" => 'Горшеченский',
            "oboyan" => 'Обоянский',
            "medved" => 'Медвенский',
            "bigsoldier" => 'Большесолдатский',
            "ponir" => 'Поныровский',
            "kursk" => 'Курский'   ,  
            "kurskaya_oblast" =>'Курская область'    
        );

        foreach ($districts as $key => $value) {
            $sel = "";
            
            if ($key == $_GET['district']) {
                $sel = ' selected';
            }
            
            print '<option value='.$key.$sel.'>'.$value.'</option>';
        }
        
        ?>
    </select>
    <input type="submit" value="Показать">
    
    </form>    
<div id="map"></div>
    <script src="roads.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>


</body>
</html>
