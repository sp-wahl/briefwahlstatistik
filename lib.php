<?php

function load_stats()
{
    return json_decode(file_get_contents(dirname(__FILE__) . "/stats.json"), true);
}

function save_stats($post)
{
    $stats = load_stats();

    $stats['last_update'] = time();
    $stats['eligible_voters'] = intval($post['eligible_voters']);
    foreach ($stats['days'] as $day => $count) {
        $stats['days'][$day] = $post[$day];
    }


    file_put_contents(dirname(__FILE__) . "/stats.json", json_encode($stats, JSON_PRETTY_PRINT));
}

function format_day_de($day)
{
    $date = date_create($day);
    return date_format($date, "d.m.Y");
}

function format_day($day)
{
    $date = date_create($day);
    return date_format($date, "Y-m-d");
}

function format_int_de($number)
{
    return number_format($number, 0, ',', '.');
}

function format_int($number)
{
    return number_format($number);
}

function format_count_de($number)
{
    if (intval($number) === 0) {
        if ($number === "Sat") {
            return "Samstag";
        }
        if ($number === "Sun") {
            return "Sonntag";
        }
        return $number;
    }
    return format_int_de($number);
}

function format_count($number)
{
    if (intval($number) === 0) {
        if ($number === "Sat") {
            return "Saturday";
        }
        if ($number === "Sun") {
            return "Sunday";
        }
        return $number;
    }
    return format_int($number);
}

function print_eligible_voters_de($stats)
{
    echo format_int_de($stats['eligible_voters']);
}

function print_eligible_voters($stats)
{
    echo format_int($stats['eligible_voters']);
}


function print_turnout_de($stats)
{
    $turnout = get_number_of_letters_so_far($stats) / $stats['eligible_voters'] * 100;
    echo number_format($turnout, 2, ',', '.') . '&#x202F;%';
}

function print_turnout($stats)
{
    $turnout = get_number_of_letters_so_far($stats) / $stats['eligible_voters'] * 100;
    echo number_format($turnout, 2, '.', ',') . '&#x202F;%';
}

function print_number_of_letters_so_far_de($stats)
{
    echo format_int_de(get_number_of_letters_so_far($stats));
}

function print_number_of_letters_so_far($stats)
{
    echo format_int(get_number_of_letters_so_far($stats));
}


function print_row_de($day, $count, $maxCount)
{
    $formatted_day = format_day_de($day);
    $formatted_count = format_count_de($count);
    $countclass = '';
    if ($count <> '-' and intval($count) === 0) {
        $countclass = ' muted';
    }
    $bar = get_bar($count, $maxCount);
    echo "<tr>
              <td class='date'>$formatted_day</td>
              <td class='number$countclass'>$formatted_count</td>
              <td class='bar'>$bar</td>
           </tr>";
}

function print_row($day, $count, $maxCount)
{
    $formatted_day = format_day($day);
    $formatted_count = format_count($count);
    $countclass = '';
    if ($count <> '-' and intval($count) === 0) {
        $countclass = ' muted';
    }
    $bar = get_bar($count, $maxCount);
    echo "<tr>
              <td class='date'>$formatted_day</td>
              <td class='number$countclass'>$formatted_count</td>
              <td class='bar'>$bar</td>
          </tr>";
}

function get_number_of_letters_so_far($stats)
{
    $sum = 0;
    foreach ($stats['days'] as $count) {
        $sum += intval($count);
    }
    return $sum;
}

function get_bar($count, $maxCount)
{
    $countValue = intval($count);
    if ($countValue <= 0) {
        return '';
    }
    $width = number_format($countValue / $maxCount * 100, 2);
    return "<div class='colourbar' style='width:$width%;'></div>";
}
