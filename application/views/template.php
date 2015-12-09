<?php


?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="interkassa-verification" content="157740b7c932f13ca3f37870284338d2" />
        <title>Footboot.org</title>
        <link rel="stylesheet" href="/css/style.css" type="text/css" media="all" />
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <!--[if lte IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
        <script>
  function subscr_wind() {
    $("#podp").hide();
    $(".subscr_wind").show();
  };
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
                                 <a href=\"#\" class=\"button\" id=\"podp\"onclick=\"subscr_wind()\">Подписаться</a>
                                ";
                                    echo '<div class="subscr_wind">'
                                    . 'Пожалуйста введите ниже свой e-mail<br/>'
                                            . '<input type="email" name="email" required><br/>'
                                            . '<a href="#" id="buy" class="button">Купить</a>'
                                    . '</div>'
                                    . '</div>';
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
                                   if (isset($news[$i]['pic']))  {
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
                        for ($i=0; $i<= 4; $i++) {
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
                        <a href="#"><?php echo '<iframe src="'.$video['links'][0].'" type="text/html" width="210" height="160" frameborder="0"></iframe>'; ?></a>
                        <a href="#" class="button">Далее...</a>
                    </div>
                    <div class="grey-box">
                        <h3><a href="#"><?php echo $video['titles'][1] ?></a></h3>
                        <a href="#"><?php echo '<iframe src="'.$video['links'][1].'" type="text/html" width="210" height="160" frameborder="0"></iframe>'; ?></a>
                        <a href="#" class="button">Далее...</a>
                    </div>
                    <div class="grey-box last">
                        <h3><a href="#"><?php echo $video['titles'][2] ?></a></h3>
                        <a href="#"><?php echo '<iframe src="'.$video['links'][2].'" type="text/html" width="210" height="160" frameborder="0" ></iframe>'; ?></a>
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