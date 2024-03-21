<?php
    session_start();

    require 'db_connect.php';
    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    global $connect;

    $connect->query("DELETE FROM xls");

    $inputFileName = './parser.xls';
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
    $data = $spreadsheet->getActiveSheet()->toArray();
    $count = 0;

    function getError(){
        $_SESSION['message'] = "Check your input is correct";
        header('Location: index.php');
        exit(0);
    }

    $selects = [
        $_POST['codeSelect'],
        $_POST['nameSelect'],
        $_POST['priceSelect'],
        $_POST['leftoversSelect']
    ];

    if (!(count(array_unique($selects)) === count($selects))) {
        getError();
    }

    // Получение значения из input (количество строк для парсинга)
    $inputRowCount = $_POST['rowCount'] != null ?
        (is_numeric($_POST['rowCount']) ?
            intval($_POST['rowCount'])
            : getError() )
        : count($data) - 1;

    if (!is_numeric($inputRowCount) || $inputRowCount > count($data) - 1 || $inputRowCount < 0) {
        $inputRowCount = count($data) - 1;
    }

    $inputItemName = trim(preg_replace('/\s\s+/', ' ', $_POST['itemName']));
    $useNameFilter = isset($inputItemName);

    $inputStartPrice = $_POST['startPrice'] != null ?
        (is_numeric($_POST['startPrice']) ?
            intval($_POST['startPrice'])
            : getError() )
        : null;
    $inputFinishPrice = isset($_POST['finishPrice']) ? intval($_POST['finishPrice']) : null;

    $useStartPrice = $inputStartPrice != null;
    $useFinishPrice = $inputFinishPrice != null;

    $inputStartCode = $_POST['startCode'] ?? null;
    $inputFinishCode = $_POST['finishCode'] ?? null;

    $useStartCode = $inputStartCode != null;
    $useFinishCode = $inputFinishCode != null;
    if($useStartCode && $useFinishCode) {
        $pattern = '/([a-zA-z]*)?(\d+)(.*)/';
        preg_match($pattern, $inputStartCode, $matchesStart);
        preg_match($pattern, $inputFinishCode, $matchesFinish);

        if(count($matchesStart)==0||count($matchesFinish)==0)getError();
        if (($matchesStart[1] != $matchesFinish[1]) || ($matchesStart[3] != $matchesFinish[3])) getError();
    }
    

    foreach ($data as $row) {
        if ($count > 0) {
            $code = $row[$_POST['codeSelect']];
            if($code == "") continue;

            if ($useStartCode && $useFinishCode) {
                preg_match($pattern, $code, $matchesCode);
                if ($matchesStart[1] != $matchesCode[1] || $matchesStart[3] != $matchesCode[3]) {
                    continue;
                }
                if (!(((intval($matchesCode[2]) > intval($matchesStart[2])) && (intval($matchesCode[2]) < intval($matchesFinish[2]))))) {
                    continue;
                }
            }

            $name = $row[$_POST['nameSelect']];
            if ($useNameFilter) {
                if (!str_contains($name, $inputItemName)) {
                    continue;
                }
            }

            $price = $row[$_POST['priceSelect']] != null ? str_replace([',', '.', ' '], '', $row['2']) : $row['2'];
            if ($useStartPrice || $useFinishPrice) {
                if ($price === null) continue;
                if ($useStartPrice && $inputStartPrice > $price) continue;
                if ($useFinishPrice && $inputFinishPrice < $price) continue;
            }

            $leftovers = $row[$_POST['leftoversSelect']];

            $dataQuery = "INSERT INTO xls (frt_column, snd_column, trd_column, frs_column) VALUES ('$code', '$name', '$price', '$leftovers')";
            $result = mysqli_query($connect, $dataQuery);
            $msg = true;

            $inputRowCount--;

            if ($inputRowCount === 0) {
                break;
            } else {
                $count++;
            }
        } else {
            $count++;
        }
    }
    if (isset($msg)) {
        $_SESSION['message'] = "Successfully imported";
    } else {
        $_SESSION['message'] = "Not imported";
    }
    header('Location: result.php');
    exit(0);
