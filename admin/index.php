<?php
include_once "../lib.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    save_stats($_POST);
}

$stats = load_stats();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Briefwahlstatistik Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div id="content">
    <h1>Adminbereich</h1>
    <div style="text-align: center"><a href="../">de</a> · <a href="../en.php">en</a></div>
    <hr>
    <form method="post">
        <label for="eligible_voters">Anzahl Wahlberechtigte</label>
        <input id="eligible_voters" name="eligible_voters" type="number"
               value="<?php echo $stats['eligible_voters']; ?>"/>
        <h2>Anzahl Briefe pro Tag</h2>

        <p>Hier in die Felder eingeben: Die Anzahl der Briefe als Zahl,
            <code>Sat</code> oder <code>Sun</code> für Wochenende,
            oder <code>-</code> für Tage ohne Lieferung;
            Werktage, die noch in der Zukunft liegen, bleiben leer.</p>
        <?php
        foreach ($stats['days'] as $day => $count) {

            echo "<div class='row'>
                    <label for='days_$day'>$day</label>
                    <input id='days_$day' name='$day' type='text' value='$count'/>
                </div>";
        }
        ?>
        <hr>
        <button>Speichern</button>
    </form>
</div>
</body>
</html>
