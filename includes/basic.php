<?php
	//===============================
	//           basic.php
	//      最後更新 2015/08/08
	//===============================
	
	global $glb;
	
	//回傳Client端的IP
	function getClientIP()
	{
		$ip = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ip = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ip = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ip = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ip = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ip = getenv('REMOTE_ADDR');
		else
			$ip = 'unknown';
			
		return $ip;
	}
	
	//取得現在網址
	function getCurrentUrl()
	{
		$url = 'http://'.getenv('HTTP_HOST').getenv('REQUEST_URI');
		return $url;
	}
	
	//加密
	function Encrypt($data = "")
	{
		return base64_encode($data);
	}
	
	//反加密
	function UnEncrypt($data = "")
	{
		return base64_decode($data);
	}
	
	//陣列加密
	function ArrEncrypt($arr = array())
	{
		foreach($arr as $key => $var)
		{
			$data[$key] = Encrypt($var);
		}
		return $data;
	}
	
	//陣列反加密
	function ArrUnEncrypt($arr = array())
	{
		if(is_array($arr))
		{
			foreach($arr as $key => $var)
			{
				$data[$key] = UnEncrypt($var);
			}
			return $data;
		}
	}
	
	//取亂數數字
	function getRandNum($len = 8, $min = 0, $max = 9)
	{
		$str = "";
		for($i = 0; $i < $len; $i++)
		{
			$str .= rand($min, $max);
		}
		return $str;
	}
	
	//取亂數英文+數字
	function getRandEngNum($len = 8)
	{
		$ranges = array(
			1 => array(97, 122), // a-z
			2 => array(65, 90),  // A-Z
			3 => array(48, 57)   // 0-9
		);
		$str = "";
		for($i = 0; $i < $len; $i++)
		{
			$r = mt_rand(1, count($ranges));
			$str .= chr(mt_rand($ranges[$r][0], $ranges[$r][1]));
		}
		return $str;
	}
