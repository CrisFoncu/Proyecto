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
            width: 500px;
            height: 500px;
            border-radius: 50%;
            margin: 0 auto;
            display: block;
            animation: rotation 2s infinite linear;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="./gifs/animation.gif" alt="gif">
    </div>

    <?php
    header("Refresh: 4; URL=misreservas.php");
    ?>
</body>

</html>