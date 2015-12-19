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
        <script src="http://code.jquery.com/jquery-latest.js"></script>
    </head>
    <body>

        <div id="header">
            <div class="shell">

            </div>
        </div>

        <div id="heading" >

            <div class="shell">

                <div id="heading-cnt">


                    <!-- Widget -->
                    <div id="heading-box" style="left: 150px;">
                        <div id="heading-box-cnt">
                            <div class="cl">&nbsp;</div>
                            <div style="text-align: center; height: 100%; margin-top: 100px;">
                            <h1><?=$status ?></h1>
                            <!-- Main Slide Item -->

                                <?php
//var_dump($news);
                                if (isset($message)) {
                                echo $message;
                                }
                                ?>
                            <a href='/'><button class="button">На главную</button></a>
                            </div>


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
                <p class="right">&copy;  by <a href="#">genkovich</a></p>
                <div class="cl">&nbsp;</div>
            </div>
        </div>




        <!-- End Footer -->
    </body>
</html>