<?php ?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

        <title>Footboot.org</title>
        <link rel="stylesheet" href="/css/style.css" type="text/css" media="all" />
        <meta name="interkassa-verification" content="c9cc635ea9e52afba5cf2d2fbff3ccf9" />
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <!--[if lte IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
        <script>
            var valid;
            $(document).ready(function () {
                $('#email').blur(function () {
                    if ($(this).val() != '') {
                        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
                        if (pattern.test($(this).val())) {
                            $(this).css({'border': '1px solid #569b44'});
                            $('#valid').text('email введен верно');
                            valid = 1;
                        } else {
                            $(this).css({'border': '1px solid #ff0000'});
                            $('#valid').text('email введен не верно');
                        }
                    } else {
                        $(this).css({'border': '1px solid #ff0000'});
                        $('#valid').text('Поле email не должно быть пустым');
                    }
                });
            });
            function subscr_wind() {
                $("#podp").hide();
                $(".subscr_wind").show();
            }
            ;
            function buy() {
                var msg = $('#email').val();
                if (valid == 1) {
                    $.ajax({
                        type: 'POST',
                        url: 'index.php/main/buy/',
                        data: 'email=' + msg,
                        beforeSend: function () {

                            $('.subscr_wind').html("<img src='/css/images/loader.GIF' />");
                        },
                        success: function (data) {
                            $('.subscr_wind').html(' ');
                            $('#buy').hide();
                            $('#payment').show();

                        },
                        error: function (xhr, status, error) {
                            alert(xhr.responseText + '|\n' + status + '|\n' + error);
                        }

                    });
                } else {
                    $('#email').css({'border': '1px solid #ff0000'});
                    $('#valid').text('Введите корректный email');
                }
            }
            ;
        </script>
    </head>
    <body>
        <!-- Header -->
        <div id="header">
            <div class="shell">
                <!-- Logo -->
                <!--                <h1 id="logo" class="notext"><a href="#">Лого</a></h1>-->
                <!-- End Logo -->
            </div>
        </div>
        <!-- End Header -->

        <!-- Navigation -->
        <div id="navigation">
            <div class="shell">
                <div class="cl">&nbsp;</div>
                <ul>
                    <li><a href="#">Новости</a></li>
                    <li><a href="#">Галерея</a></li>
                    <li><a href="#">О нас</a></li>
                    <li><a href="#">Форум</a></li>
                    <li><a href="#">Расписание</a></li>
                </ul>
                <div class="cl">&nbsp;</div>
            </div>
        </div>
        <!-- End Navigation -->

        <!-- Heading -->
        <div id="heading">
            <div class="shell">
                <div id="heading-cnt">

                    <!-- Sub nav -->
                    <div id="side-nav">
                        <ul>
                            <li class="active"><div class="link"><a href="#">Главная</a></div></li>
                            <li><div class="link"><a href="#">Рейтинг</a></div></li>
                            <li><div class="link"><a href="#">Результаты</a></div></li>
                            <li><div class="link"><a href="#">Расписание</a></div></li>
                            <li><div class="link"><a href="#">Галерея</a></div></li>
                        </ul>
                    </div>
                    <!-- End Sub nav -->

                    <!-- Widget -->
                    <div id="heading-box">
                        <div id="heading-box-cnt">
                            <div class="cl">&nbsp;</div>

                            <!-- Main Slide Item -->
                            <div class="featured-main">
                                <?php
//var_dump($news);
                                if ($show == '1') {
                                    echo "  <div class=\"game-day\">
                                <h2>Игра дня</h2>

                                 <h3>$team1 - $team2</h3>
                                 <div class=\"button\" id=\"podp\"onclick=\"subscr_wind()\">Подписаться</div>
                                ";
                                    echo '<div class="subscr_wind">'
                                    . 'Введите email, на который будет отправлена ссылка для просмотра<br/>'
                                    . '<input type="email" id="email" name="email" required><br/>'
                                    . '<div id="valid"></div>'
                                    . '<br/>'
                                    . '<b>' . $cost . ' RUB</b> <div onClick="buy()" id="buy" class="button">Купить</div>'
                                    . '<div id="results"></div>'
                                    . '</div>'                                    ;
                                    echo ' <form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
            <input type="hidden" name="ik_co_id" value="56698a273c1eaf250b8b4568" />
            <input type="hidden" name="ik_pm_no" value="ID_4233" />
            <input type="hidden" name="ik_am" value="'.$cost.'" />
            <input type="hidden" name="ik_cur" value="" />
            <input type="hidden" name="ik_desc" value="'.$team1.'vs'.$team2.'" />
            <input type="submit" value="Pay">
        </form>'. '</div>';
                                } else {
                                    echo ' <a href="#" ><img src="' . $news[0]['pic'] . '" alt="" style="margin-top: 45px; width:438px;"/></a>
                                <div class="featured-main-details">
                                    <div class="featured-main-details-cnt">
                                        <h4><a href="#">' . $news[0]['title'] . '</a></h4>
                                        <p>' . $news[0]['desc'] . '</p>
                                    </div>
                                </div>';
                                }
                                ?>



                            </div>
                            <!-- End Main Slide Item -->

                            <div class="featured-side">

                                <?php
                                for ($i = 1; $i <= 3; $i++) {


                                    echo'    <div class="featured-side-item">
                                    <div class="cl">&nbsp;</div>
                                    <h4><a href="#">' . $news[$i]['title'] . '</a></h4>';
                                    if (isset($news[$i]['pic'])) {
                                        echo '<a href="#" class="left"><img src="' . $news[$i]['pic'] . '" alt="" style="width: 120px; float: left;"/></a>';
                                    }

                                    echo'  <p>' . $news[$i]['desc'] . '</p>
                                    <div class="cl">&nbsp;</div>
                                </div>';
                                }
                                ?>


                            </div>
                            <div class="cl">&nbsp;</div>
                        </div>
                    </div>
                    <!-- End Widget -->

                </div>
            </div>
        </div>
        <!-- End Heading -->

        <!-- Main -->
        <div id="main">
            <div class="shell">
                <div class="cl">&nbsp;</div>
                <div id="sidebar">
                    <h2>Новости</h2>
                    <ul>

                        <?php
                        for ($i = 0; $i <= 4; $i++) {
                            echo '<li>
                            <small class="date">' . $news[$i]['pubDate'] . '</small>
                            <p>' . $news[$i]['title'] . '</p>
                        </li>';
                        }
                        ?>

                    </ul>
                    <a href="#" class="archives">Архив новостей</a>
                </div>
                <div id="content">
                    <div class="cl">&nbsp;</div>
                    <div class="grey-box">
                        <h3><a href="#"><?php echo $video['titles'][0] ?></a></h3>
                        <a href="#"><?php echo '<iframe src="' . $video['links'][0] . '" type="text/html" width="210" height="160" frameborder="0"></iframe>'; ?></a>
                        <a href="#" class="button">Далее...</a>
                    </div>
                    <div class="grey-box">
                        <h3><a href="#"><?php echo $video['titles'][1] ?></a></h3>
                        <a href="#"><?php echo '<iframe src="' . $video['links'][1] . '" type="text/html" width="210" height="160" frameborder="0"></iframe>'; ?></a>
                        <a href="#" class="button">Далее...</a>
                    </div>
                    <div class="grey-box last">
                        <h3><a href="#"><?php echo $video['titles'][2] ?></a></h3>
                        <a href="#"><?php echo '<iframe src="' . $video['links'][2] . '" type="text/html" width="210" height="160" frameborder="0" ></iframe>'; ?></a>
                        <a href="#" class="button">Далее...</a>
                    </div>
                    <div class="cl">&nbsp;</div>
                    <div class="video-box">
                        <div class="cl">&nbsp;</div>
                        <h2 class="left">video spot</h2>
                        <a href="#" class="button">All videos</a>
                        <div class="cl">&nbsp;</div>
                        <div class="video-item-box">
                            <a href="#" class="left"><img src="css/images/video-1.jpg" alt="" /></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                            <a href="#" class="watch-now">Watch now</a>
                        </div>
                        <div class="video-item-box second">
                            <a href="#" class="left"><img src="css/images/video-2.jpg" alt="" /></a>
                            <p>Curabitur consectetur tellus a diam tincidunt pellentesque</p>
                            <a href="#" class="watch-now">Watch now</a>
                        </div>
                        <div class="video-item-box">
                            <a href="#" class="left"><img src="css/images/video-3.jpg" alt="" /></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                            <a href="#" class="watch-now">Watch now</a>
                        </div>
                        <div class="video-item-box second">
                            <a href="#" class="left"><img src="css/images/video-4.jpg" alt="" /></a>
                            <p>Aliquam erat volutpat. Nam tortor justo, pretium eget iaculis et</p>
                            <a href="#" class="watch-now">Watch now</a>
                        </div>
                        <div class="cl">&nbsp;</div>
                    </div>
                </div>
                <div class="cl">&nbsp;</div>
            </div>
        </div>
        <!-- End Main -->

        <!-- Footer -->
        <div id="footer">
            <div class="shell">
                <div class="cl">&nbsp;</div>
                <p class="right">&copy;  by <a href="#">genkovich</a></p>
                <div class="cl">&nbsp;</div>
            </div>
        </div>




        <!-- End Footer -->
    </body>
</html>