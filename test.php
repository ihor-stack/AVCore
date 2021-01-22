<?php 

$command = "cd '/store/www/site/objects/' && php '/store/www/site/objects/getAllVideosAsync.php' 'viewable' '19' '' '[]' '' '' '1' '[]' '{\"redirectUri\":\"\",\"current\":1,\"rowCount\":10,\"sort\":{\"created\":\"DESC\"}}' '/store/www/site/videos/cache/getAllVideosAsync/ae74a6b331de5ea4e4e71d8078445ea3' 2>&1";
exec($command, $output, $return_val);
var_dump($return_val, $output);

// ImageMagick
// $cmd = "convert --version";
// exec($cmd . "  2>&1", $output, $return_val);
// var_dump($return_val, $output);


// mysql
// $cmd = "wget -O /tmp/123 https://privy.live";
// exec($cmd . "  2>&1", $output, $return_val);
// var_dump($return_val, $output);

// mysql
// $cmd = "mysql --version";
// exec($cmd . "  2>&1", $output, $return_val);
// var_dump($return_val, $output);

// git
// $cmd = "git log -1";
// exec($cmd . "  2>&1", $output, $return_val);
// var_dump($return_val, $output);

// php
// exec('php --version > /dev/null 2>&1 & echo $!;', $output, $return_val);
//var_dump($return_val, $output);

// dirsize
// $dir = '/store/www/storage/videos';

// $command = "du -s -k {$dir}";
// exec($command . ' 2> /dev/null', $output, $return_val);

// var_dump($return_val);
// var_dump($output);

// if (!empty($output[0])) {
//     preg_match("/^([0-9]+).*/", $output[0], $matches);
// }
// if (!empty($matches[1])) {
// 	var_dump(intval($matches[1]) * 1024);
// }
?>
