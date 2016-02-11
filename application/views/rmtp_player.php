<!DOCTYPE html>
<html>
<head>
    <title>Live</title>
        <link rel="stylesheet" href="/js/flowplayer/skin/minimalist.css">
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="/js/flowplayer/flowplayer.min.js"></script>
	<style>
		html, body {
			height: 100%;
		}	
		body {
			height: 100%;
			display: table;
			width: 100%;
			margin: 0;
			background-color: gray;
		}
		.player-wrap {
			display: table-cell;
			vertical-align: middle;
		}
		#player {
			margin: 0 auto;
		}
	</style>	
</head>

<body>

    <script src="/js/jwplayer/jwplayer.js" type="text/javascript"></script>
	<script type="text/javascript">jwplayer.key="ZUU2lYg6L468mq/nJ2IUEFdxfUZ0zFhkJhbScg==";</script>
    <div class="player-wrap"><div id="player"></div><div id="player-2"></div></div>
    <script type="text/javascript" language="javascript">
    jwplayer("player").setup({
        file: "rtmp://austa751.pw/liveapp/stream1",
        primary: 'flash',
        width :"70%",
        aspectratio: "16:9",
    });
    jwplayer().onPlay(function () {
      VideoLength = jwplayer().getDuration() * 1000;
      jwplayer().seek(jwplayer().getDuration());
      jwplayer().getPosition() * 1000;
    });
    jwplayer().onPause(function () {
      jwplayer().getPosition() * 1000;
    });
    jwplayer().onBuffer(function () {
      jwplayer().getPosition() * 1000;
    });
    jwplayer().onComplete(function () {
      jwplayer().getPosition() * 1000;
    });
    </script>
	<script type="text/javascript">
	 $("player-2", "flowplayer-3.2.4.swf", {
		clip: {
			url: 'plainFileNameWithNoExtension',
			live: true,
			provider: 'rtmp'
		},
		plugins: {
			rtmp: {
				url: '/js/flowplayer/flowplayer.rtmp-3.2.13.swf',
				netConnectionUrl: 'rtmp://austa751.pw/liveapp/stream1',
				subscribe: true
			}
		}
	});
	</script>
</body>
</html>
