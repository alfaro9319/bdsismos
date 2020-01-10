<?php
class form{

	var $__options;
	var $__titles;
	var $__values;
	var $__type;			
	var $__script;
	var $__action;
	var $__text;
	var $__id;
	var $name;
	var $__ckVal;
	var $__varIn;
	var $__extra_tag; 


	function showForm($__options,$__titles,$__values="",$__type,$__id="",$__action="",$__script=""){

		if (count($__options)>0) {
			for ($i=0; $i<=count($__options)-1;$i++){
				$this->__text.="<label style='text-align:right;' for='$__titles[$i]'>$__titles[$i]</label>&nbsp;<input name='$__titles[$i]'  type=$__type ><br>";	
			}
			
		}
		$this->__text="<form id=$__id> $this->__text <input type=button value='Registrar' onclick='$__script'></form>";
		
		return $this->__text;
	}


	function showInputs($__options,$__titles,$__values="",$__type,$__id="",$__action="",$__script=""){

		if (count($__options)>0) {
			for ($i=0; $i<=count($__options)-1;$i++){
				$this->__text.="<label for='$__titles[$i]'>$__titles[$i]</label>&nbsp;<input name='$__titles[$i]'  type=$__type  value='$__values[$i]'><br>";	
			}
			
		}
		
		return $this->__text;
	}
	
	
	//=CREA UN CHECKBOX=, Si se le pasa una variable por $var_in y coincide con $ck_val, se selecciona
	function frm_check($name, $__ck_val, $__var_in='', $__extra_tag='', $titulo,$__action="",$__script=""){
		$ck='';
/*		if(strtolower($__ck_val)==strtolower($__var_in)) $ck=' checked';
		$checkbox= "<input type=checkbox name='$name' value='$__ck_val'$__extra_tag$ck> $titulo ";
	//	return $checkbox;
*/		
		
		if (count($__ck_val)>0) {
			for ($i=0; $i<=count($__ck_val)-1;$i++){
				$this->__text.="<tr><td><input type=checkbox name='$name'  id='$name' value='$__ck_val[$i]'$ck[$i] ".$__action."=".$__script.";> $titulo[$i]</td></tr>";	
			}
			
		}
		
		return $this->__text;
			
}
	



}

?>
