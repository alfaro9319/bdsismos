<?php
class DropDownList{

	var $__options;
	var $__values;		
	var $__script;
	var $__action;
	var $__text;
	var $__title;
	var $__id;
	var $__valtitle;
	var $__class;

	function ddl($__options,$__values,$__action="",$__script="",$__title="",$__valtitle="",$__id="",$__default="",$__class="combo"){

		if ($__default==""){
			$this->__text="<option selected value='".$__valtitle."'>".ucfirst($__title)."</option>\n";
		}
		else{
			$this->__text="<option value=".$__valtitle.">".ucfirst($__title)."</option>\n";
		}
		
		if (count($__options)>0) {
			for ($i=0; $i<=count($__options)-1;$i++){
				if ($i==$__default-1){
					$this->__text.="<option selected value='".$__values[$i]."'>".ucfirst($__options[$i])."</option>\n";		
				}
				else{
					$this->__text.="<option value='".$__values[$i]."'>".ucfirst($__options[$i])."</option>\n";	
				}
			}
		}

		if (strlen($__action)>0 and strlen($__script)>0) {
			$this->__text="<select class='$__class' id='".$__id."' name='".$__id."'  ".$__action."=".$__script.";>".ucfirst($this->__text)."</select>";
		}
		else{
			$this->__text="<select class='$__class' id='".$__id."' name='".$__id."' >".ucfirst($this->__text)."</select>";
		}

		return $this->__text;
	}

	function ddlSimple($__options,$__values,$__action="",$__script="",$__id="",$__default=""){

		if (count($__options)>0) {
			for ($i=0; $i<count($__options);$i++){
				if ($i==$__default){
					$this->__text.="<option selected value=".$__values[$i].">".$__options[$i]."</option>\n";		
				}
				else{
					$this->__text.="<option value=".$__values[$i].">".$__options[$i]."</option>\n";	
				}
			}
		}

		if (strlen($__action)>0 and strlen($__script)>0) {
			$this->__text="<select id='".$__id."'  ".$__action."=".$__script.";>".$this->__text."</select>";
		}
		else{
			$this->__text="<select id='".$__id."'>".$this->__text."</select>";
		}

		return $this->__text;
	}



	function ddlVoid($__action="",$__script="",$__title=""){
		$this->__text="<option default>".$__title."</option>";
		$this->__text="<select disabled>".$this->__text."</select>";
		return $this->__text;
	}


}

?>
