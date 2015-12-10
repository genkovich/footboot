<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

        <title>Control panel</title>
        <link rel="stylesheet" href="/css/style.css" type="text/css" media="all" />
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <!--[if lte IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->

    </head>

    <body>
        <script>
            function show_stats() {
            var date1 = $('#date1').val();
            var date2 = $('#date2').val();
            var url =  "/index.php/admin/lunit/showdate/";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: 'date1=' + date1 + "&date2=" + date2,
                    beforeSend: function () {
                        $('#results').html("<img src='/css/images/loader.GIF' />");
                    },
                    success: function (data) {
                        $('#results').html(data);
                                            },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText + '|\n' + status + '|\n' + error);
                    }

                });
        };
        </script>
        <div class="content_control">
        <h1>Control Panel</h1>
        <div>Game of the day: <input type="text" value="<?php echo $team1?>" size="15"> vs <input type="text" value="<?php echo $team2?>" size="15"></div>
        <div>Time: <input type="text" value="<?php echo $hours?>" size="2" maxlength="2">:<input type="text" value="<?php echo $minutes?>" size="2" maxlength="2"></div>
        <div>Price:  <input type="text" value="<?php echo $price?>" size="15"> </div>

        <input type="date" id="date1"> <input type="date" id="date2"> <button id="show_all" onClick="show_stats();">Show</button>
        <div id="results">dasda</div>
        </div>
    </body>
</html>