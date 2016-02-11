<!DOCTYPE html>
<html>
<head>
    <title>Live</title>
    <head>
        <link rel="stylesheet" href="/js/flowplayer/skin/minimalist.css">
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="/js/flowplayer/flowplayer.min.js"></script>
        <style>
        html, body {
            height: 90%;
        }
        #player {
            position: absolute;
            top: 0;
            left: 0%;
        }
</style>
</head>

</head>
<body>

<script src="/js/jwplayer/jwplayer.js" type="text/javascript"></script>
  <script type="text/javascript">jwplayer.key="ZUU2lYg6L468mq/nJ2IUEFdxfUZ0zFhkJhbScg==";</script>
      
    <div id="player"></div>
    <script type="text/javascript" language="javascript">
    jwplayer("player").setup({
        file: "<?php echo $video; ?>",
        width :"100%",
        aspectratio: "16:9",
    });
    
    </script>
  </div>
</body>
</html>
