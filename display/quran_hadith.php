<div class="weather_row" >
    <div class="weather_left">
        <div class="heading" style="text-align: center">
            Quran
        </div>
        <!-- qrotd-widget -->
        <div id="rodApp" style="width: 100%; padding: 0 40px"></div>
        
        <script>
        var rodServerUrl = "https://cdb.bitsegment.com";
        var rodAppDivId = "rodApp";
        </script>
        <script type="application/javascript" src="https://cdb.bitsegment.com/static/rod-widget/app.min.js"></script>
        <!--/ qrotd-widget -->
    </div>
</div>

<div class="weather_row" >
    <div class="weather_left">
        <?php
        if ($result = $db->query("SELECT * FROM hadith_of_the_day where id=mod((SELECT DATEDIFF(now(),'2015-01-01')), (select count(*) from hadith_of_the_day))")) {
            if ($count = $result->num_rows) {
                $todayHadith = $result->fetch_object();
            }
        }

        if (isset($todayHadith)) {
            ?>
            <div class="heading" style="text-align: center">
                Hadith
            </div>
            <blockquote class="descriptionText big_text">
                <?= $todayHadith->hadith_text ?>
                <footer><?= $todayHadith->source_reference ?></footer>
            </blockquote>
            <?php
        }
        ?>
    </div>
</div>

