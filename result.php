<?php require 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="result.css">

    <title>Parsing result</title>
</head>
<body id="body">

<div>
    <table>
        <?php
        global $connect;
        $result = $connect->query("SELECT * FROM xls");
        $i = 1;
        foreach ($result as $row):
            ?>
            <tr>
                <td> <?php echo $i++; ?> </td>
                <td> <?php echo $row['frt_column']; ?> </td>
                <td> <?php echo $row['snd_column']; ?> </td>
                <td> <?php echo $row['trd_column']; ?> </td>
                <td> <?php echo $row['frs_column']; ?> </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<a href="index.php">Back</a>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.dots.min.js"></script>
<script>
    VANTA.DOTS({
        el: "#body",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 200.00,
        minWidth: 200.00,
        scale: 1.00,
        scaleMobile: 1.00,
        showLines: false
    })
</script>
</body>
</html>
