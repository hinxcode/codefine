<?php
	include_once("includes/basic.php");
	
	//header("Access-Control-Allow-Origin: http://codefine-daocloud.app");
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Cache-Control, X-Requested-With, Content-Type, Accept");
	header("Content-Type: charset=utf-8");
	
	$arr = array();
	if(isset($_FILES["javafiles"])) {		
		foreach($_FILES["javafiles"]["tmp_name"] as $index => $tmpName) {
			$exts = explode(".", $_FILES["javafiles"]["name"][$index]);
			$ext = $exts[sizeof($exts) - 1];
			if($ext != "java") {
				$arr[$index] = array("exterror" => true);
			} else {
				$newName = iconv("utf-8","big5","uploads/").date("YmdHis").getRandEngNum(4).".java");
				if(move_uploaded_file($tmpName, $newName) {
					//$result .= json_encode(array("success" => true));
					$arr[$index] = array("success" => true);
					//$arr["result"] = shell_exec("java $newName;
				} else {
					//$result .= json_encode(array("success" => false));
					$arr[$index] = array("success" => false);
				}
			}
		}
	}
	echo json_encode($arr);
?>