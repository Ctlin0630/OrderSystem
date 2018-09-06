<?php

include_once("languages/setlang.php"); //引入語言設定文件

function translate()
{
    $args = func_get_args();
    $num = func_num_args();
    $args[0] = gettext($args[0]);

    if($num <= 1)
      return $args[0];

    $str = $args[0];
	
	foreach( $args as $index => $arg ){
		if( $index == 0 )
			continue;
		
		$key[] = '%'.$index.'%';
		$replace[] = $arg;
	}
	
	return str_replace($key, $replace, $str);

}
$v1='rex';
$v2='eee';
$v3='ggg';
echo translate('%1% poked %2% %3%', $v1, $v2, $v3);


?>
<html>
<head>
	<title><?php echo _('Gettext Multi-language website demo'); ?></title>
</head>
<body>
	<h1><?php echo _('Gettext Multi-language website demo'); ?></h1>
	<hr><br>
	<p><font color="#ff0000"><?php echo _('Hello world'); ?></font></p>
	<p><font color="#ff0000"><?php echo _('Hello worldw'); ?></font></p>
	<h3><?php echo _('language selection'); ?></h3>
	<a href="?lang=zh_TW"><?php echo _('Traditional Chinese'); ?></a> <a href="?lang=zh_CN"><?php echo _('Simplified Chinese'); ?></a> <a href="?lang=en_US"><?php echo _('English'); ?></a>
    <br><br><br><hr>
    <a href="https://blog.reh.tw/gettext-multi-language-website/" target="_blank">https://blog.reh.tw/gettext-multi-language-website/</a>
</body>
</html>
