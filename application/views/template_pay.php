<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Footboot.org</title>
        <link rel="stylesheet" href="/css/style.css" type="text/css" media="all" />
        <meta name="interkassa-verification" content="c9cc635ea9e52afba5cf2d2fbff3ccf9" />
        <script src="http://code.jquery.com/jquery-latest.js"></script><script>
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

            function send() {
                if (valid == 1) {
                    var msg = $('#email').val();
                    $.ajax({
                        type: 'POST',
                        url: '/index.php/payment/status/',
                        data: 'email=' + msg,
                        beforeSend: function () {

                            $('.subscr_wind').html("<img src='/css/images/loader.GIF' />");
                        },
                        success: function (data) {
                            $('.subscr_wind').html(data);



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

            function buy() {
                var msg = $('#email').val();
                if (valid == 1) {
                    $.ajax({
                        type: 'POST',
                        url: '/index.php/payment/buy/',
                        data: 'email=' + msg,
                        beforeSend: function () {

                            $('.subscr_wind').html("<img src='/css/images/loader.GIF' />");
                        },
                        success: function (data) {
                            $('.subscr_wind').html(data);
                            $('#buy').hide();
                            $('#payment').show();
                            //$('#idmail').val(msg);

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

        <div id="heading" >

            <div class="shell">

                <div id="heading-cnt">


                    <!-- Widget -->
                    <div id="heading-box" style="left: 150px;">
                        <div id="heading-box-cnt">
                            <div class="cl">&nbsp;</div>
                            <h1>Подписка</h1>
                            <!-- Main Slide Item -->

                                <?php
//var_dump($news);

                                    echo '<div class="subscr_wind">'
                                    . 'Введите email, на который будет отправлена ссылка для просмотра<br/><br/>'
                                    . '<input type="email" id="email" name="email" required><br/>'
                                    . '<div id="valid"></div>'
                                    . '<br/>';
                                    if ($cost > 0) {
                                    echo '<b>' . $cost . ' RUB</b> ';
                                    }
                                            echo '<div onClick="';
                                    echo $cost == 0 ? 'send()' : 'buy()';
                                    echo '" id="buy" class="button">Купить</div>'
                                    . '<div id="results"></div>'
                                    . '</div>';

                                   // echo '<input type="button" onclick="history.back(1)" value="Назад" style="float:right; margin-right: 55px; padding: 5px;">';
                                 echo '</div>';
                                ?>





                            <!-- End Main Slide Item -->


                            <div class="cl">&nbsp;</div>
                        </div>
                    </div>
                    <!-- End Widget -->

                </div>
            </div>
        </div>
        <!-- End Heading -->

        <!-- Main -->
        <!-- End Main -->

        <!-- Footer -->
        <div id="footer">
            <div class="shell">
                <div class="cl">&nbsp;</div>
                <div class="left">
                    <a href="http://payeer.com" target="_blank"><img src="/css/images/payeer-logo.png" alt="Payeer"></a>
                </div>
				<p class="right">&copy;  by <a href="#">genkovich</a></p>
                <div class="cl">&nbsp;</div>
            </div>
        </div>




        <!-- End Footer -->
    </body>
</html>