<?php
class folder{

	var $__folder;
	var	$__arch;
	var $__filter;

	function archiveList($__folder){
		
		if (is_dir($__folder)){
			$__arch = scandir($__folder);	
		}

		if (isset($__arch)){
			return $__arch;
		}
		else{
			return "No existen archivos";
		}		
		
	}

	function archiveFilter($__folder, $ext){
		
		if (is_dir($__folder)){
			$__arch = scandir($__folder);
			for ($i=0; $i<=count($__arch)-1;$i++){
	
				if (substr($__arch[$i],-1*strlen($ext))==$ext){
					$fil[] = $__arch[$i];
				}
			}
		}
		
		if (isset($fil)){
			return $fil;
		}
		else{
			return "No existen archivos";
		}		
		
		
	}

	function folderList($__folder ){
		$__arch = scandir($__folder);

		for ($i=0; $i<=count($__arch)-1;$i++){
			
			if (is_dir($__folder."/".$__arch[$i]) and $__arch[$i]<>"." and $__arch[$i]<>".."){

				$__filter[] = $__arch[$i];
			}
		}
		
		if (isset($__filter)){
			return $__filter;
		}
		else{
			return "No existen carpetas";
		}
	}

	function folderFilter($__folder,$filter){
		$__arch = scandir($__folder);

		for ($i=0; $i<=count($__arch)-1;$i++){
			
			if (is_dir($__folder."/".$__arch[$i]) and $__arch[$i]<>"." and $__arch[$i]<>".." and substr($__arch[$i],0,strlen($filter))==$filter){

				$__filter[] = $__arch[$i];
			}
		}
		return $__filter;
	}
}

?>
