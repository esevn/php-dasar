<?php 
//pengulangan array 
//for, foreach
$angka = [3, 4, 5, 6, 7, 8];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .kotak 
        {
            width: 50px;
            height: 50px;
            line-height: 50px;
            float: left;
            text-align: center;
            margin: 3px;
            padding: 3px;
            background-color: salmon;
        }

        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    <?php  for( $i = 0; $i < count($angka); $i++) { ?>
    <div class="kotak"><?php echo $angka[$i]; ?></div>
    <?php } ?>

    <div class="clear"></div>

    <?php foreach($angka as $a) : ?>
        <div class="kotak"><?= $a ?></div>
    <?php endforeach; ?>
</body>
</html>