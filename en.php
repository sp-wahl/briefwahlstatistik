<?php
include_once "lib.php";
$stats = load_stats();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote by mail stats SP election 2022</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="content">
    <p class="language-navi"><a href="./">Deutsche Version</a></p>

    <h1>Vote by mail stats<br><abbr title="Student Parliament">SP</abbr> election Bonn 2022</h1>

    <p>The vote by mail letters that are sent back are being collected until the counting of votes on the
        20th&nbsp;January&nbsp;2022, which starts around 16:00 o'clock.</p>

    <p>This overview page lists the number of vote by mail letters that the university post office hands over to us
        each day until then.</p>

    <p class="lead">
        Currently received vote by mail letters:<br>
        <span id="sum"><?php print_number_of_letters_so_far($stats); ?></span> <span id="tada">🎉</span>
    </p>

    <p class="lead">
        At <b><?php print_eligible_voters($stats); ?></b> eligible voters, this corresponds to a turnout so far
        of <b id="turnout"><?php print_turnout($stats); ?></b>
    </p>

    <div id="details">

        <p>Here are the bare numbers:</p>

        <table>
            <tr>
                <th>Date</th>
                <th># Letters</th>
            </tr>
            <?php
            $maxCount = max($stats['days']);
            foreach ($stats['days'] as $day => $count) {
                print_row($day, $count, $maxCount);
            }
            ?>
        </table>
    </div>

</div>

</body>
</html>
