<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            text-align: center;
            margin-top: 200px;
        }

        img {
            width: 466px;
            height: 302px;
            border-radius: 50%;
            margin: 0 auto;
            display: block;
            animation: rotation 2s infinite linear;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="./gifs/animation3.gif" alt="gif">
    </div>

    <?php
    header("Refresh: 4; URL=simon.php");
    ?>
</body>

</html>