<?php
    $file = isset($_GET['file']) ? $_GET['file'] : 'bars.json';
    $loadData = file_get_contents('data/' . $file);
    if($loadData === FALSE) {
        $loadData = file_get_contents('data/bars.json');
    }
    $jsonData = json_decode($loadData, true);
    $barLimit = isset($jsonData['limit']) ? $jsonData['limit'] : 100;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Front End Assignment - Progress Bars</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/progress-bar.min.css" rel="stylesheet">
        <!-- Custom JavaScript -->
        <script src="js/progress-bar.min.js"></script>
    </head>

    <body>
        <div class="container">
            <h1>JavaScript Progress Bar</h1>

            <?php 
                if (isset($jsonData['bars'])) {
                    foreach ($jsonData['bars'] as $key => $bar) {
                        $barWidth = floor($bar / $barLimit * 100);
                        $barTxt = $barWidth . '%';
                        $additionalClass = '';
                        if ($barWidth > 100) {
                            $barWidth = 100;
                            $additionalClass = ' red-bar';
                        }
                        echo '<h4>#progessBar' . ($key + 1) . '</h4>';
                        echo '<div class="bar"><div id="bar-' . ($key + 1) . '" class="my-bar' . $additionalClass . '" data-bar-value="' . $bar . '" data-bar-limit="' . $barLimit . '" style="width: ' . $barWidth. '%"></div><div id="progessTxt" class="center">' . floor($bar / $barLimit * 100) . '%</div></div>';
                    }
                }
            ?>

            <select id="select-bar">
                <?php 
                    foreach ($jsonData['bars'] as $key => $bar) {
                        echo '<option value="bar-' . ($key + 1) . '">#progessBar' . ($key + 1) . '</option>';
                    }
                ?>
            </select>

            <?php 
                if (isset($jsonData['buttons'])) {
                    foreach ($jsonData['buttons'] as $key => $btn) {
                        echo '<button onclick="addProgress(' . $btn . ')" class="btn" >' . $btn . '</button> ';
                    }
                }
            ?>
        </div>
    </body>
</html>
