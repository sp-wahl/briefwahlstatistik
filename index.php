<?php
include_once "lib.php";
$stats = load_stats();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Briefwahlstatistik SP-Wahl 2022</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="content">
    <p class="language-navi"><a href="en.php">English Version</a></p>

    <h1>Briefwahl&shy;statistik<br><abbr title="Studierendenparlament">SP</abbr>-Wahl Bonn 2022</h1>

    <p>Die gesendeten Rückbriefe werden zunächst gesammelt, bevor sie am 20.&nbsp;Januar&nbsp;2022 ab 16&nbsp;Uhr
        öffentlich ausgezählt werden.</p>

    <p>Diese Übersichtsseite listet für jeden Tag bis dahin die Anzahl der Rückbriefe auf, die uns an jenem Tag von der
        Poststelle der Universität übergeben wurden.</p>

    <p class="lead">
        Bislang eingegangene Rückbriefe:<br>
        <span id="sum"><?php print_number_of_letters_so_far_de($stats); ?></span> <span id="tada">🎉</span>
    </p>

    <p class="lead">
        Bei <b><?php print_eligible_voters_de($stats); ?></b> Wahlberechtigten entspricht das bislang einer
        Wahlbeteiligung von <b id="turnout"><?php print_turnout_de($stats); ?></b>
    </p>

    <div id="details">

        <p>Hier sind die Zahlen im Detail:</p>

        <table>
            <tr>
                <th>Datum</th>
                <th># Briefe</th>
            </tr>
            <?php
            $maxCount = max($stats['days']);
            foreach ($stats['days'] as $day => $count) {
                print_row_de($day, $count, $maxCount);
            }
            ?>
        </table>
    </div>

</div>
</body>
</html>
