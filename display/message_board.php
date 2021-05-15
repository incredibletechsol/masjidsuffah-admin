<?php
require_once "message_board_service.php";
if (!isset($messageBoardArray)) {
    $messageBoardArray = findTodaysMessageBoard();
}

$mbHeadingSize = defaultIt(getConfigValue($db, "mb_heading_size"), "35px");
$mbArabicSize = defaultIt(getConfigValue($db, "mb_arabic_size"), "45px");
$mbEnglishSize = defaultIt(getConfigValue($db, "mb_english_size"), "25px");
$mbFooterSize = defaultIt(getConfigValue($db, "mb_footer_size"), "15px");
?>
<style type="text/css">
    .message_board {
        text-align: center;
        width: 720px;
    }
    .mb_heading {
        white-space: nowrap;
        font-weight: bold;
        font-size: <?php pv($mbHeadingSize);?>;
        color: #B38934;
    }
    .mb_arabic {
        font-family: 'saleem';
        font-size: <?php pv($mbArabicSize);?>;
    }

    .mb_english {
        font-size: <?php pv($mbEnglishSize);?>;
    }

    .mb_footer {
        font-size: <?php pv($mbFooterSize);?>;
        color: gray;
    }
</style>
<div class="weather_row">
    <div class="weather_left message_board">
        <?php
        if (isset($messageBoardArray["heading"])) {
            ?>
            <div class="mb_heading">
                <?php pv($messageBoardArray["heading"]); ?>
            </div>
            <?php
        }
        ?>
        <?php
        if (isset($messageBoardArray["arabic"])) {
            ?>
            <div class="mb_arabic">
                <?php pv($messageBoardArray["arabic"]); ?>
            </div>
            <?php
        }
        ?>
        <?php
        if (isset($messageBoardArray["english"])) {
            ?>
            <div class="mb_english">
                <?php pv($messageBoardArray["english"]); ?>
            </div>
            <?php
        }
        ?>
        <?php
        if (isset($messageBoardArray["footer"])) {
            ?>
            <div class="mb_footer">
                <?php pv($messageBoardArray["footer"]); ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>