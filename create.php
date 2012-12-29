<?php
if(isset($_GET['album'])){
$dir = opendir("music/");
while(($file = readdir($dir)) != false){
	$search = $_GET['album'];
	if(($file != ".")&&($file != "..")&&is_dir('music/'.$file.'/')&&$file==$search)
	{
		$str= '';
		$temp = opendir('music/'.$file.'/');
		while(($t = readdir($temp)) != false){
			if($str==''){$str = 'var myPlaylist = [';}
			if(($t != ".")&&($t != "..")){
				
				if(!strchr($t,'.jpg')){
				$detail =explode('^^',$t);
				$duration = strstr(str_replace('_',':',$detail[2]),'.mp3',true);
				$name = str_replace('\'','\\\'',$t);
				$title = str_replace('\'','\\\'',$detail[0]);
				
				$artist = str_replace('\'','\\\'',$detail[1]);
			  $str .= "{mp3:'music/$file/$name',        title:'$title',artist:'$artist',duration:'$duration',cover:'music/$file/$file.jpg'},";
				}
				}
			}
			$str.= '];'; ?>
            <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="plugin/css/style.css">
       <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="plugin/jquery-jplayer/jquery.jplayer.js"></script>
    <script type="text/javascript" src="plugin/ttw-music-player-min.js"></script>

<?php	echo '<script type="text/javascript">'.$str.'</script>';
?>
<script type="text/javascript">
        $(document).ready(function(){
            $('body').ttwMusicPlayer(myPlaylist, {
                autoPlay:false, 
                jPlayer:{
swfPath:'plugin/jquery-jplayer'}
            });
        });
    </script>
</head>
<body>
<div id="title"></div>
</body>
</html>
<?php	}
}}
else
die('something went wrong');
?>