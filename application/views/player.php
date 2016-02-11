<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=620">
    <title>Title</title>
    <link rel="stylesheet" href="/css/simpleplayer.css" type="text/css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="/js/jquery.simpleplayer.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var settings = {
                progressbarWidth: '200px',
                progressbarHeight: '5px',
                progressbarColor: '#22ccff',
                progressbarBGColor: '#eeeeee',
                defaultVolume: 0.8
            };
            $(".player").player(settings);
        });
    </script>
</head>
<body>

    <div>
        <audio class="player" src="/media/PodcastStavki1.mp3">
          Your browser does not support the <code>audio</code> element.
        </audio>
    </div>


</body>
</html>
