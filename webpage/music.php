<?php 
function customFileSize($file) {
    $text = "";
    $size = filesize($file);
    if (0 < $size && $size < 1024) {
        $text = $size." b";
    } else if (1023 < $size && $size < 1048575) {
        $text = round($size/1024, 2)." kb";
    } else if (1048575 < $size) {
        $text = round($size/1048576, 2)." mb";
    }
    return $text;
}; 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>

		<div id="listarea">
            <? $playlist = $_REQUEST['playlist']; ?>
            <? if (isset($playlist)) { ?>

                <ul id="musiclist">
                <? foreach (file(join(['songs', $playlist], DIRECTORY_SEPARATOR)) as $filename) { ?>
                    <li class="mp3item">
                        <? $filename = trim("songs".DIRECTORY_SEPARATOR.$filename); ?>
                        <a href="<?= $filename ?>"><?= basename($filename) ?></a>
                        (<?= customFileSize($filename) ?>)
                    </li>
                <? }; ?>
                </ul>

            <? } else { ?>

                <ul id="musiclist">
                <? foreach (glob('songs/*.mp3') as $file) { ?>
                    <li class="mp3item">
                        <a href="<?= $file ?>"><?= basename($file) ?></a>
                        (<?= customFileSize($file) ?>)
                    </li>
                <? }; ?>

                <? foreach (glob('songs/*.txt') as $file) { ?>
                    <li class="playlistitem">
                        <a href="?playlist=<?= basename($file) ?>"><?= basename($file) ?></a>
                    </li>
                <? }; ?>
                </ul>

            <? }; ?>
		</div>
	</body>
</html> 
