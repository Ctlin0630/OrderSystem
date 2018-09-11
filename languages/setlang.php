<?php

class MutiLanguage{
	
	private $lang;
	
	public function __construct(){
		$this->init2();
	}
	
	private function getLang() {
		preg_match("/^([a-z\-]+)/i", $_SERVER["HTTP_ACCEPT_LANGUAGE"], $matches); //分析 HTTP_ACCEPT_LANGUAGE 的屬性
	
		$lang = $matches[1]; //取第一語言設置
		
		//默認語言 & 類型
		//putenv("LANG=en_US");
		//setlocale(LC_ALL, $lang);
		
		$lang = isset($_SESSION["language"]) ? $_SESSION["language"] : $lang;
		//$lang = isset($_GET["lang"]) ? $_GET["lang"] : $lang;
		$lang = strtolower($lang); //轉換為小寫
		
		$this->lang = str_replace("-","_", $lang );
		
	}
	
	// open gettext in php.ini
	public function init(){
		
		$this->getLang();
		
		if ($this->lang == "en-us" || $this->lang == "en_us") { //English
			$this->setDomain( $lang );
		}
		if ($this->lang == "zh-tw" || $this->lang == "zh_tw") { //正體中文 (台灣)
			$this->setDomain( "zh_tw" );
		}
		if ($this->lang == "zh-cn" || $this->lang == "zh_cn") { //简体中文 (中国)
			$this->setDomain( $this->lang );
		}
	}
	
	//use gettext.inc package
	public function init2(){
		
		$this->getLang();
		
		require_once('gettext\gettext.inc');

		T_setlocale(LC_MESSAGES, $this->lang);
		// Set the text domain as 'messages'
		$domain = 'language';
		bindtextdomain($domain, __DIR__);
		textdomain($domain);
		
	}
	
	private function setDomain( $package = 'demo' ){
		bindtextdomain( $package, __DIR__.'/../languages'); // or $your_path/languages, ex: /var/www/test/languages
		textdomain( $package );
		bind_textdomain_codeset( $package, "utf-8" );
	}
	
	public function translate()
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
}

$MutiLanguage = new MutiLanguage();

function translate(){
	$MutiLanguage = new MutiLanguage();
	return call_user_func_array(array($MutiLanguage, 'translate'), func_get_args());
}

?>
