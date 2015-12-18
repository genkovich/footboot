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
            function cont(){
                $('#contacts').toggle();
            }
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
        <div id="heading">

            <div class="shell">

                <div id="heading-cnt">

                    <!-- Sub nav -->
                    <div id="side-nav">
                        <div class="grey-box">
                            <h3><a href="#"><?php echo $video['titles'][0] ?></a></h3>
                            <a href="#"><?php echo '<iframe src="' . $video['links'][0] . '" type="text/html" width="200" height="130" frameborder="0"></iframe>'; ?></a>

                        </div>
                        <div class="grey-box">
                            <h3><a href="#"><?php echo $video['titles'][1] ?></a></h3>
                            <a href="#"><?php echo '<iframe src="' . $video['links'][1] . '" type="text/html" width="200" height="130" frameborder="0"></iframe>'; ?></a>

                        </div>
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

                               <div class='gameinf'> <span> <h3>$team1 - $team2 </h3></span><br/> <span>$time_match (UK)</span> </div>
                                <a href='/main/pay/'> <div class=\"button\" id=\"podp\"onclick=\"\">Подписаться</div></a>
                                ";
                                } else {
                                    echo ' <a href="' . $news[0]['link'] . '" ><img src="' . $news[0]['pic'] . '" alt="" style="margin-top: 45px; width:438px;"/></a>
                                <div class="featured-main-details">
                                    <div class="featured-main-details-cnt">
                                        <h4><a href="' . $news[0]['link'] . '">' . $news[0]['title'] . '</a></h4>
                                        <p>' . $news[0]['desc'] . '</p>

                                </div>';
                                }
                                echo '</div>';
                                ?>



                            </div>
                            <!-- End Main Slide Item -->

                            <div class="featured-side">

                                <?php
                                for ($i = 1; $i <= 3; $i++) {


                                    echo'    <div class="featured-side-item">
                                    <div class="cl">&nbsp;</div>
                                    <h4><a href="' . $news[$i]['link'] . '">' . $news[$i]['title'] . '</a></h4>';
                                    if (isset($news[$i]['pic'])) {
                                        echo '<a href="' . $news[$i]['link'] . '" class="left"><img src="' . $news[$i]['pic'] . '" alt="" style="width: 120px; float: left;"/></a>';
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
                        for ($i = 4; $i <= 8; $i++) {
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
                    <!--                    <div class="grey-box">
                                            <h3><a href="#"><?php //echo $video['titles'][0]  ?></a></h3>
                                            <a href="#"><?php //echo '<iframe src="' . $video['links'][0] . '" type="text/html" width="210" height="160" frameborder="0"></iframe>';  ?></a>
                                            <a href="#" class="button">Далее...</a>
                                        </div>
                                        <div class="grey-box">
                                            <h3><a href="#"><?php //echo// $video['titles'][1]  ?></a></h3>
                                            <a href="#"><?php //echo '<iframe src="' . $video['links'][1] . '" type="text/html" width="210" height="160" frameborder="0"></iframe>';  ?></a>
                                            <a href="#" class="button">Далее...</a>
                                        </div>-->
                    <!--                    <div class="grey-box last">
                                            <h3><a href="#"><?php //echo //$video['titles'][2]  ?></a></h3>
                                            <a href="#"><?php //echo '<iframe src="' . $video['links'][2] . '" type="text/html" width="210" height="160" frameborder="0" ></iframe>';  ?></a>
                                            <a href="#" class="button">Далее...</a>
                                        </div>-->
                    <div class="cl">&nbsp;</div>
                    <?php
                    $z = 0;
 foreach ($vid as $vide){
    if (!empty($vide)) {
        $z++;
    }
 }
 if ($z == 0){
     $display = 'display: none;';
 }
 if ($z == 1 or $z == 2){
     $height = 'height: 250px;';
 }
 ?>
                    <div class="video-box" style='<?php echo $display; echo $height?>'>
                        <div class="cl">&nbsp;</div>
                        <h2 class="left">video spot</h2>
                        <div class="cl">&nbsp;</div>
                        <div class="video-item-box">

                            <div class="videos">    <?php echo $vid[1] ?></div>

                        </div>
                        <div class="video-item-box second">
                            <div class="videos">  <?php echo $vid[2] ?>  </div>

                        </div>
                        <div class="video-item-box">
                            <div class="videos">  <?php echo $vid[3] ?>  </div>

                        </div>
                        <div class="video-item-box second">
                            <div class="videos">  <?php echo $vid[4] ?>  </div>

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
                <p  class="left" onClick="cont()" id="cont">Контакты:</p>
                <div class="cl">&nbsp;</div>
                <p class="left" id="contacts">
                    Малышева Ольга<br/>
                    Телефон: +79520979732<br/>
                    E-mail: footbootorg@gmail.com<br/>
                    Skype: footboot_org<br/>
                </p>

                <div class="cl">&nbsp;</div>
                <p class="right">&copy;  by <a href="#">genkovich</a></p>
                <div class="cl">&nbsp;</div>
            </div>
        </div>




        <!-- End Footer -->
    </body>
</html>