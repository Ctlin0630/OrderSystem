<?php 
//example https://domain?lang=en-us
require_once(setlang.php);

echo _("Cloud");

$str = array("Hello %1%, I am %2%.", "Rex", "David");
echo call_user_func_array('translate', $str );


?>