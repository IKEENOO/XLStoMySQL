<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

    <title>XML Parser</title>
</head>
<body id="body">

<div class="container">
    <h1>XLS to MySQL</h1>

    <?php
        if (isset($_SESSION['message'])){
            echo "<h3>".$_SESSION['message']."</h3>";
            unset($_SESSION['message']);
        }
    ?>

    <div class="parser__s">

        <form action="database.php" method="post">
            <div class="database__s">
                <h3>Define the database settings</h3>
                <div class="p__setting">
                    <div class="select">
                        <label for="codeSelect">Code</label>
                        <select name="codeSelect" id="codeSelect">
                            <option value="0" selected>1st column</option>
                            <option value="1">2nd column</option>
                            <option value="2">3rd column</option>
                            <option value="3">4th column</option>
                        </select>
                    </div>
                    <div class="select">
                        <label for="nameSelect">Name</label>
                        <select name="nameSelect" id="nameSelect">
                            <option value="0">1st column</option>
                            <option value="1" selected>2nd column</option>
                            <option value="2">3rd column</option>
                            <option value="3">4th column</option>
                        </select>
                    </div>
                    <div class="select">
                        <label for="priceSelect">Price</label>
                        <select name="priceSelect" id="priceSelect">
                            <option value="0">1st column</option>
                            <option value="1">2nd column</option>
                            <option value="2" selected>3rd column</option>
                            <option value="3">4th column</option>
                        </select>
                    </div>
                    <div class="select">
                        <label for="leftoversSelect">Leftovers</label>
                        <select name="leftoversSelect" id="leftoversSelect">
                            <option value="0">1st column</option>
                            <option value="1">2nd column</option>
                            <option value="2">3rd column</option>
                            <option value="3" selected>4th column</option>
                        </select>
                    </div>
                </div>
            </div>

            <!--
            <div class="p__setting">
                <input type="text" value="hostname" name="hostname" placeholder="Port">
                <input type="text" value="root" name="user" placeholder="User">
                <input type="text" value="passowrd" name="password" placeholder="Password">
                <input type="text" value="db" name="db_name" placeholder="DB Name">
            </div>
            -->

            <h3>Define the parsing settings</h3>
            <div class="p__setting">

                <div class="filter__s">
                    <label>Row count:</label>
                    <input type="text" value="" name="rowCount" placeholder="Row count">
                </div>

                <div class="filter__s">
                    <label>Start price:</label>
                    <input type="text" value="" name="startPrice" placeholder="Start Price">
                </div>

                <div class="filter__s">
                    <label>Finish price:</label>
                    <input type="text" value="" name="finishPrice" placeholder="Finish price">
                </div>

                <div class="filter__s">
                    <label>Item name:</label>
                    <input type="text" value="" name="itemName" placeholder="Item name">
                </div>

                <div class="filter__s">
                    <label>Code start:</label>
                    <input type="text" value="E" name="startCode" placeholder="Start code">
                </div>

                <div class="filter__s">
                    <label>Code finish:</label>
                    <input type="text" value="" name="finishCode" placeholder="Finish code">
                </div>

            </div>

            <button class="parse__btn" onsubmit="">PARSE</button>

        </form>

    </div>

    <a class="Btn" href="https://github.com/IKEENOO/XLStoMySQL" target="_blank">
        <svg class="svgIcon" viewBox="0 0 496 512" height="1.4em" xmlns="http://www.w3.org/2000/svg"><path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"></path></svg>
        <span class="text">Source</span>
    </a>
</div>

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

