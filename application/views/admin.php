<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

        <title>Control panel</title>
        <link rel="stylesheet" href="/css/style.css" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css"/>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="/js/jquery.datetimepicker.full.js"></script>
        <!--[if lte IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
        <script>
            $(document).ready(function () {
                $(function () {
                    $('#dateend').datetimepicker({
                        mask: '9999-19-39 29:59',
                        formatTime: 'H:i',
                        formatDate: 'Y-m-d'
                    });
                });
            });
        </script>

    </head>

    <body>
        <script>
            function show_stats() {
                var date1 = $('#date1').val();
                var date2 = $('#date2').val();
                var url = "/index.php/admin/lunit/showdate/";
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
            }
            ;

            function ajx(url) {
                var team1 = $('#team1').val();
                var team2 = $('#team2').val();
                var price = $('#price').val();
                var timeend = $('#dateend').val()
                var show = $('#show').is(':checked');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: 'team1=' + team1 + "&team2=" + team2 + "&price=" + price + "&show=" + show + "&timeend=" + timeend,
                    beforeSend: function () {
                        $('#results_match').html("<img src='/css/images/loader.GIF' />");
                    },
                    success: function (data) {
                        $('.match').load('/index.php/admin/lunit/ .match', function () {
                            $('#dateend').datetimepicker({
                                mask: '9999-19-39 29:59',
                                formatTime: 'H:i',
                                formatDate: 'Y-m-d'
                            });
                        });

                        $('#results_match').html(data);
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText + '|\n' + status + '|\n' + error);
                    }

                });
            }
            ;
            function save() {
                var url = "/index.php/admin/lunit/save/";
                ajx(url);
            }
            function newGame() {
                var сon1 = confirm("Вы уверены что хотите создать новую игру?");
                if (сon1 == true) {
                    var url = "/index.php/admin/lunit/newGame/";
                    ajx(url);
                }
            }

            function saveVideo(){
                var video1 = $('#video1').val();
                var video2 = $('#video2').val();
                var video3 = $('#video3').val();
                var video4 = $('#video4').val();

                 $.ajax({
                    type: 'POST',
                    url: '/index.php/admin/lunit/savevideo/',
                    data: 'video1=' + video1 + '&video2=' + video2 + '&video3=' + video3 + '&video4=' + video4,
                    beforeSend: function () {
                        $('#results_match').html("<img src='/css/images/loader.GIF' />");
                    },
                    success: function (data) {
$('#results_match').html(data);
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText + '|\n' + status + '|\n' + error);
                    }

                });
            }

        </script>
        <div class="content_control">
            <div class = 'match'>
                <h1>Control Panel</h1>
                <div>Game of the day: <input type="text" id="team1" value="<?php echo $team1 ?>" size="15"> vs <input type="text" id="team2" value="<?php echo $team2 ?>" size="15"></div>
                <div>Срок действия ссылки <input type="text" id="dateend"  value="<?php echo $timeend ?>"/>  </div>
                <div>Time: <input type="text" value="<?php echo $hours ?>" size="2" maxlength="2">:<input type="text" value="<?php echo $minutes ?>" size="2" maxlength="2"></div>
                <div>Price:  <input type="text" id="price" value="<?php echo $price ?>" size="15"> </div>
                <div><input type="checkbox" id='show' value="Show" <?php echo $show ?>/> Show</div>

                <div><button id="newGame" onClick="newGame();">New Game</button></div>
                <div> <a href="/admin/newletter/" ><button>New letter</button></a></div>
                <div class="videoContent">
                    <textarea id="video1" class="videosAdm"><?php echo $video1; ?></textarea>
                    <textarea id="video2" class="videosAdm"><?php echo $video2; ?></textarea>
                    <textarea id="video3" class="videosAdm"><?php echo $video3; ?></textarea>
                    <textarea id="video4" class="videosAdm"><?php echo $video4; ?></textarea>
                    <div id="saveVideo"><button onClick="saveVideo();">Save Video</button></div>
                </div>

            </div>
            <div id="results_match"></div>

            <input type="date" id="date1"> <input type="date" id="date2"> <button id="show_all" onClick="show_stats();">Отобразить подписку</button>
            <div id="results"></div>
            <div id="saveButton"><button id="save" onClick="save();">Save</button></div>
        </div>

    </body>
</html>