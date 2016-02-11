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
                <nav class="top-menu" id="navigation">
					<ul>
						<li><a href="/">Главная</a></li>
						<li><a href="/about">О нас</a></li>
						<li><a href="/rules">Правила</a></li>
						<li><a href="/faq">FAQ</a></li>
						<li><a href="/contacts">Контакты</a></li>
					</ul>
				</nav>
            </div>
        </div>
        <div id="heading">

            <div class="shell">

                <div id="heading-cnt">
				
                <!--<iframe src="http://www.tablesleague.com/iframe?width=250&height=465&font_name=Tahoma&position=1&font_size=12&team_link=1&link_color=404040&games=1&wins=1&draws=1&lost=1&goals=0&goals_against=0&gd=0&points=1&next=0&form=0&font_size=10&font_color=000000&bg_color=FFFFFF&header_font_color=FFFFFF&header_bg_color=1fb9e4&bg_col=1fb9e4&font_color_col=FFFFFF&highlight=e3e3e3&hover=fff6bf&league_header=0&league=l_145&team=&timezone=2&language=2&team_flags=0" width="250" height="465" frameborder="0" scrolling="no"></iframe>-->
                    
                
                    <!-- Sub nav -->
                    <div id="side-nav">
                    <iframe src="http://www.tablesleague.com/iframe?width=260&height=380&font_name=Arial&position=2&font_size=12&team_link=0&link_color=404040&games=1&wins=1&draws=1&lost=1&goals=0&goals_against=0&gd=0&points=1&next=0&form=0&font_size=10&font_color=000000&bg_color=FBFBFB&header_font_color=0C0C0C&header_bg_color=0C0C0C&bg_col=0C0C0C&font_color_col=FFFFFF&highlight=e3e3e3&hover=fff6bf&league_header=0&league=l_145&team=&timezone=2&language=2&team_flags=0" width="260" height="380" frameborder="1" scrolling="no"></iframe>
                        <!--<div class="grey-box">
                            <h3><a href="#"><?php echo $video['titles'][0] ?></a></h3>
                            <a href="#"><?php echo '<iframe src="' . $video['links'][0] . '" type="text/html" width="200" height="130" frameborder="0"></iframe>'; ?></a>

                        </div>
                        <div class="grey-box">
                            <h3><a href="#"><?php echo $video['titles'][1] ?></a></h3>
                            <a href="#"><?php echo '<iframe src="' . $video['links'][1] . '" type="text/html" width="200" height="130" frameborder="0"></iframe>'; ?></a>

                        </div>-->
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
                                    echo ' <a href="' . $news[0]['link'] . '" target="_blank"><img src="' . $news[0]['pic'] . '" alt="" style="margin-top: 45px; width:438px;"/></a>
                                <div class="featured-main-details">
                                    <div class="featured-main-details-cnt">
                                        <h4><a href="' . $news[0]['link'] . '" target="_blank">' . $news[0]['title'] . '</a></h4>
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
                                    <h4><a href="' . $news[$i]['link'] . '" target="_blank">' . $news[$i]['title'] . '</a></h4>';
                                    if (isset($news[$i]['pic'])) {
                                        echo '<a href="' . $news[$i]['link'] . '" class="left" target="_blank"><img src="' . $news[$i]['pic'] . '" alt="" style="width: 120px; float: left;"/></a>';
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
                            <p><a href="' . $news[$i]['link'] . '" target="_blank">' . $news[$i]['title'] . '</a></p>
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
 } else {
     $display = 'display: inline-block;';
 }
 if ($z == 1 or $z == 2){
     $height = 'height: 320px;';
     $block_display = 'display: none;';
 }
 ?>
                    <div class="video-box" style='margin-left: 70px;<?php  echo $display; if (isset($height)){ echo $height;}?>'>
                        <div class="cl">&nbsp;</div>
                        <h2 class="left">video spot</h2>
                        <div class="cl">&nbsp;</div>
                        <div class="video-item-box">

                            <div class="videos">    <?php echo $vid[1] ?></div>

                        </div>
                        <div class="video-item-box second">
                            <div class="videos">  <?php echo $vid[2] ?>  </div>

                        </div>
                        <div class="video-item-box " style='<?php if (isset($block_display)){ echo $block_display;}?>'>
                            <div class="videos">  <?php echo $vid[3] ?>  </div>

                        </div>
                        <div class="video-item-box second" style='<?php if (isset($block_display)){ echo $block_display;}?>'>
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
                <!--<p  class="left" onClick="cont()" id="cont">Контакты:</p>
                <div class="cl">&nbsp;</div>
                <p class="left" id="contacts">
                    Малышева Ольга<br/>
                    Телефон: +79520979732<br/>
                    E-mail: footbootorg@gmail.com<br/>
                    Skype: footboot_org<br/>
                </p>-->
				
				<div class="left">
                    <a href="http://payeer.com" target="_blank"><img src="/css/images/payeer-logo.png" alt="Payeer"></a>
                </div>

                <div class="cl">&nbsp;</div>
                <p class="right">&copy;  by <a href="#">genkovich</a></p>
                <div class="cl">&nbsp;</div>
            </div>
        </div>

        <!-- End Footer -->
    </body>
</html>