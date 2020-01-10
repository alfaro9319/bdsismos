<?php

class Paginator1{
	var $items_per_page;
	var $items_total;
	var $current_page;
	var $num_pages;
	var $mid_range;
	var $low;
	var $high;
	var $limit;
	var $return;
	var $default_ipp = 25;
	var $querystring;

	function Paginator()
	{
		$this->current_page = 1;
		$this->mid_range = 7;
		$this->items_per_page = (!empty($ipp)) ? $ipp:$this->default_ipp;
	}

	function paginateAuthor($ipp,$page,$function,$divAutor)
	{

        $this->items_per_page = (!empty($ipp)) ? $ipp:$this->default_ipp;

		if($ipp == 'All')
		{
			$this->num_pages = ceil($this->items_total/$this->default_ipp);
			$this->items_per_page = $this->default_ipp;
		}
		else
		{
			if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
			$this->num_pages = ceil($this->items_total/$this->items_per_page);
		}
		$this->current_page = (int) $page; // must be numeric > 0
		if($this->current_page < 1 Or !is_numeric($this->current_page)) $this->current_page = 1;
		if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
		$prev_page = $this->current_page-1;
		$next_page = $this->current_page+1;
/*
		if($_GET)
		{
			$args = explode("&",$_SERVER['QUERY_STRING']);
			foreach($args as $arg)
			{
				$keyval = explode("=",$arg);
				if($keyval[0] != "page" And $keyval[0] != "ipp") $this->querystring .= "&" . $arg;
			}
		}

		if($_POST)
		{
			foreach($_POST as $key=>$val)
			{
				if($key != "page" And $key != "ipp") $this->querystring .= "&$key=$val";
			}
		}
*/
		if($this->num_pages > 10)
		{
			$this->return = ($this->current_page != 1 And $this->items_total >= 10) ? "<a class=\"paginate\" href=#search_author onclick=\"$function($this->items_per_page,$prev_page,xajax.getFormValues('$divAutor'))\">&laquo; Previous</a> ":"<span class=\"inactive\" href=\"#search_authorSEC\">&laquo; Previous</span> ";

			$this->start_range = $this->current_page - floor($this->mid_range/2);
			$this->end_range = $this->current_page + floor($this->mid_range/2);

			if($this->start_range <= 0)
			{
				$this->end_range += abs($this->start_range)+1;
				$this->start_range = 1;
			}
			if($this->end_range > $this->num_pages)
			{
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}
			$this->range = range($this->start_range,$this->end_range);

			for($i=1;$i<=$this->num_pages;$i++)
			{
				if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " ... ";
				// loop through all pages. if first, last, or in range, display
				if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
				{
					$this->return .= ($i == $this->current_page And $page != 'All') ? "<span class=\"current\">$i</span> ":"<a class=\"paginate\" title=\"Go to page $i of $this->num_pages\" href=#search_author onclick=\"$function($this->items_per_page,$i,xajax.getFormValues('$divAutor'))\">$i</a> ";
				}
				if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= " ... ";
			}
			$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= 10) And ($page != 'All')) ? "<a class=\"paginate\" href=#search_author onclick=\"$function($this->items_per_page,$next_page,xajax.getFormValues('$divAutor'))\">Next &raquo;</a>\n":"<span class=\"inactive\" href=\"#search_author\">&raquo; Next</span>\n";
			//$this->return .= ($page == 'All') ? "<a class=\"current\" style=\"margin-left:10px\" href=\"#\">All</a> \n":"<a class=\"paginate\" style=\"margin-left:10px\" href=# onclick=\"$function('All',1)\">All</a> \n";
		}
		else
		{
			for($i=1;$i<=$this->num_pages;$i++)
			{
				$this->return .= ($i == $this->current_page) ? "<span class=\"current\">$i</span>":"<a class=\"paginate\" href=#search_author onclick=\"$function($this->items_per_page,$i,xajax.getFormValues('$divAutor'))\">$i</a>";
			}
			//$this->return .= "<a class=\"paginate\" href=# onclick=\"$function('All',1) \">All</a> \n";
		}
		$this->low = ($this->current_page-1) * $this->items_per_page;
		$this->high = ($ipp == 'All') ? $this->items_total:($this->current_page * $this->items_per_page)-1;
		$this->limit = ($ipp == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
	}


	function paginate($ipp,$page,$function,$idarea)
	{

        $this->items_per_page = (!empty($ipp)) ? $ipp:$this->default_ipp;

		if($ipp == 'All')
		{
			$this->num_pages = ceil($this->items_total/$this->default_ipp);
			$this->items_per_page = $this->default_ipp;
		}
		else
		{
			if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
			$this->num_pages = ceil($this->items_total/$this->items_per_page);
		}
		$this->current_page = (int) $page; // must be numeric > 0
		if($this->current_page < 1 Or !is_numeric($this->current_page)) $this->current_page = 1;
		if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
		$prev_page = $this->current_page-1;
		$next_page = $this->current_page+1;
/*
		if($_GET)
		{
			$args = explode("&",$_SERVER['QUERY_STRING']);
			foreach($args as $arg)
			{
				$keyval = explode("=",$arg);
				if($keyval[0] != "page" And $keyval[0] != "ipp") $this->querystring .= "&" . $arg;
			}
		}

		if($_POST)
		{
			foreach($_POST as $key=>$val)
			{
				if($key != "page" And $key != "ipp") $this->querystring .= "&$key=$val";
			}
		}
*/
		if($this->num_pages > 10)
		{
			$this->return = ($this->current_page != 1 And $this->items_total >= 10) ? "<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$prev_page,'','',$idarea)\">&laquo; Previous</a> ":"<span class=\"inactive\" href=\"#\">&laquo; Previous</span> ";

			$this->start_range = $this->current_page - floor($this->mid_range/2);
			$this->end_range = $this->current_page + floor($this->mid_range/2);

			if($this->start_range <= 0)
			{
				$this->end_range += abs($this->start_range)+1;
				$this->start_range = 1;
			}
			if($this->end_range > $this->num_pages)
			{
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}
			$this->range = range($this->start_range,$this->end_range);

			for($i=1;$i<=$this->num_pages;$i++)
			{
				if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " ... ";
				// loop through all pages. if first, last, or in range, display
				if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
				{
					$this->return .= ($i == $this->current_page And $page != 'All') ? "<span class=\"current\">$i</span> ":"<a class=\"paginate\" title=\"Go to page $i of $this->num_pages\" href=# onclick=\"$function($this->items_per_page,$i,'','',$idarea)\">$i</a> ";
				}
				if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= " ... ";
			}
			$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= 10) And ($page != 'All')) ? "<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$next_page,'','',$idarea)\">Next &raquo;</a>\n":"<span class=\"inactive\" href=\"#\">&raquo; Next</span>\n";
			//$this->return .= ($page == 'All') ? "<a class=\"current\" style=\"margin-left:10px\" href=\"#\">All</a> \n":"<a class=\"paginate\" style=\"margin-left:10px\" href=# onclick=\"$function('All',1)\">All</a> \n";
		}
		else
		{
			for($i=1;$i<=$this->num_pages;$i++)
			{
				$this->return .= ($i == $this->current_page) ? "<span class=\"current\">$i</span>":"<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$i,'','',$idarea)\">$i</a>";
			}
			//$this->return .= "<a class=\"paginate\" href=# onclick=\"$function('All',1) \">All</a> \n";
		}
		$this->low = ($this->current_page-1) * $this->items_per_page;
		$this->high = ($ipp == 'All') ? $this->items_total:($this->current_page * $this->items_per_page)-1;
		$this->limit = ($ipp == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
	}


	function paginateSearch($ipp,$page,$form,$function,$idarea)
	{

        $this->items_per_page = (!empty($ipp)) ? $ipp:$this->default_ipp;

		if($ipp == 'All')
		{
			$this->num_pages = ceil($this->items_total/$this->default_ipp);
			$this->items_per_page = $this->default_ipp;
		}
		else
		{
			if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
			$this->num_pages = ceil($this->items_total/$this->items_per_page);
		}
		$this->current_page = (int) $page; // must be numeric > 0
		if($this->current_page < 1 Or !is_numeric($this->current_page)) $this->current_page = 1;
		if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
		$prev_page = $this->current_page-1;
		$next_page = $this->current_page+1;

		if($this->num_pages > 10)
		{
			$this->return = ($this->current_page != 1 And $this->items_total >= 10) ? "<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$prev_page,$form,'',$idarea)\">&laquo; Previous</a> ":"<span class=\"inactive\" href=\"#\">&laquo; Previous</span> ";

			$this->start_range = $this->current_page - floor($this->mid_range/2);
			$this->end_range = $this->current_page + floor($this->mid_range/2);

			if($this->start_range <= 0)
			{
				$this->end_range += abs($this->start_range)+1;
				$this->start_range = 1;
			}
			if($this->end_range > $this->num_pages)
			{
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}
			$this->range = range($this->start_range,$this->end_range);

			for($i=1;$i<=$this->num_pages;$i++)
			{
				if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " ... ";
				// loop through all pages. if first, last, or in range, display
				if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
				{
					$this->return .= ($i == $this->current_page And $page != 'All') ? "<span class=\"current\">$i</span> ":"<a class=\"paginate\" title=\"Go to page $i of $this->num_pages\" href=# onclick=\"$function($this->items_per_page,$i,$form,'',$idarea)\">$i</a> ";
				}
				if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= " ... ";
			}
			$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= 10) And ($page != 'All')) ? "<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$next_page,$form,'',$idarea)\">Next &raquo;</a>\n":"<span class=\"inactive\" href=\"#\">&raquo; Next</span>\n";
			
		}
		else
		{
			for($i=1;$i<=$this->num_pages;$i++)
			{
				$this->return .= ($i == $this->current_page) ? "<span class=\"current\">$i</span>":"<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$i,$form,'',$idarea)\">$i</a>";
			}

		}
		$this->low = ($this->current_page-1) * $this->items_per_page;
		$this->high = ($ipp == 'All') ? $this->items_total:($this->current_page * $this->items_per_page)-1;
		$this->limit = ($ipp == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
	}




	function display_items_per_page($function)
	{
		$items = '';
		//$ipp_array = array(10,25,50,100,'All');
        $ipp_array = array(5,10,25,50,100);
		foreach($ipp_array as $ipp_opt)	$items .= ($ipp_opt == $this->items_per_page) ? "<option selected value=\"$ipp_opt\">$ipp_opt</option>\n":"<option value=\"$ipp_opt\">$ipp_opt</option>\n";
		return "<span class=\"paginate\">Resultados por página:</span><select class=\"paginate\" onchange=\"$function(this[this.selectedIndex].value,1,xajax.getFormValues(autorPRI)); return false\">$items</select>\n";
	}

	function display_jump_menu($function)
	{
	$option="";
		for($i=1;$i<=$this->num_pages;$i++)
		{
			$option .= ($i==$this->current_page) ? "<option value=\"$i\" selected>$i</option>\n":"<option value=\"$i\">$i</option>\n";
		}
		return "<span class=\"paginate\">Página:</span><select class=\"paginate\" onchange=\"$function($this->items_per_page,this[this.selectedIndex].value,xajax.getFormValues(autorPRI)); return false\">$option</select>\n";

	}

	function display_pages()
	{
		return $this->return;
	}


	function paginateResoluciones($ipp,$page,$function,$idTipoDocumento,$year)
	{

        $this->items_per_page = (!empty($ipp)) ? $ipp:$this->default_ipp;

		if($ipp == 'All')
		{
			$this->num_pages = ceil($this->items_total/$this->default_ipp);
			$this->items_per_page = $this->default_ipp;
		}
		else
		{
			if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
			$this->num_pages = ceil($this->items_total/$this->items_per_page);
		}
		$this->current_page = (int) $page; // must be numeric > 0
		if($this->current_page < 1 Or !is_numeric($this->current_page)) $this->current_page = 1;
		if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
		$prev_page = $this->current_page-1;
		$next_page = $this->current_page+1;
/*
		if($_GET)
		{
			$args = explode("&",$_SERVER['QUERY_STRING']);
			foreach($args as $arg)
			{
				$keyval = explode("=",$arg);
				if($keyval[0] != "page" And $keyval[0] != "ipp") $this->querystring .= "&" . $arg;
			}
		}

		if($_POST)
		{
			foreach($_POST as $key=>$val)
			{
				if($key != "page" And $key != "ipp") $this->querystring .= "&$key=$val";
			}
		}
*/
		if($this->num_pages > 10)
		{
			$this->return = ($this->current_page != 1 And $this->items_total >= 10) ? "<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$prev_page,$idTipoDocumento,$year)\">&laquo; Previous</a> ":"<span class=\"inactive\" href=\"#\">&laquo; Previous</span> ";

			$this->start_range = $this->current_page - floor($this->mid_range/2);
			$this->end_range = $this->current_page + floor($this->mid_range/2);

			if($this->start_range <= 0)
			{
				$this->end_range += abs($this->start_range)+1;
				$this->start_range = 1;
			}
			if($this->end_range > $this->num_pages)
			{
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}
			$this->range = range($this->start_range,$this->end_range);

			for($i=1;$i<=$this->num_pages;$i++)
			{
				if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " ... ";
				// loop through all pages. if first, last, or in range, display
				if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
				{
					$this->return .= ($i == $this->current_page And $page != 'All') ? "<span class=\"current\">$i</span> ":"<a class=\"paginate\" title=\"Go to page $i of $this->num_pages\" href=# onclick=\"$function($this->items_per_page,$i,$idTipoDocumento,$year)\">$i</a> ";
				}
				if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= " ... ";
			}
			$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= 10) And ($page != 'All')) ? "<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$next_page,$idTipoDocumento,$year)\">Next &raquo;</a>\n":"<span class=\"inactive\" href=\"#\">&raquo; Next</span>\n";
			//$this->return .= ($page == 'All') ? "<a class=\"current\" style=\"margin-left:10px\" href=\"#\">All</a> \n":"<a class=\"paginate\" style=\"margin-left:10px\" href=# onclick=\"$function('All',1)\">All</a> \n";
		}
		else
		{
			for($i=1;$i<=$this->num_pages;$i++)
			{
				$this->return .= ($i == $this->current_page) ? "<span class=\"current\">$i</span>":"<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$i,$idTipoDocumento,$year)\">$i</a>";
			}
			//$this->return .= "<a class=\"paginate\" href=# onclick=\"$function('All',1) \">All</a> \n";
		}
		$this->low = ($this->current_page-1) * $this->items_per_page;
		$this->high = ($ipp == 'All') ? $this->items_total:($this->current_page * $this->items_per_page)-1;
		$this->limit = ($ipp == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
	}




	function simplePaginate($ipp,$page,$function)
	{

        $this->items_per_page = (!empty($ipp)) ? $ipp:$this->default_ipp;


		if($ipp == 'All')
		{
			$this->num_pages = ceil($this->items_total/$this->default_ipp);
			$this->items_per_page = $this->default_ipp;
		}
		else
		{
			if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
			$this->num_pages = ceil($this->items_total/$this->items_per_page);
		}
		$this->current_page = (int) $page; // must be numeric > 0
		if($this->current_page < 1 Or !is_numeric($this->current_page)) $this->current_page = 1;
		if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
		$prev_page = $this->current_page-1;
		$next_page = $this->current_page+1;

		if($this->num_pages > 10)
		{
			$this->return = ($this->current_page != 1 And $this->items_total >= 10) ? "<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$prev_page,'','',$idarea)\">&laquo; Previous</a> ":"<span class=\"inactive\" href=\"#\">&laquo; Previous</span> ";

			$this->start_range = $this->current_page - floor($this->mid_range/2);
			$this->end_range = $this->current_page + floor($this->mid_range/2);

			if($this->start_range <= 0)
			{
				$this->end_range += abs($this->start_range)+1;
				$this->start_range = 1;
			}
			if($this->end_range > $this->num_pages)
			{
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}
			$this->range = range($this->start_range,$this->end_range);

			for($i=1;$i<=$this->num_pages;$i++)
			{
				if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " ... ";
				// loop through all pages. if first, last, or in range, display
				if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
				{
					$this->return .= ($i == $this->current_page And $page != 'All') ? "<span class=\"current\">$i</span> ":"<a class=\"paginate\" title=\"Go to page $i of $this->num_pages\" href=# onclick=\"$function($this->items_per_page,$i)\">$i</a> ";
				}
				if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= " ... ";
			}
			$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= 10) And ($page != 'All')) ? "<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$next_page)\">Next &raquo;</a>\n":"<span class=\"inactive\" href=\"#\">&raquo; Next</span>\n";
			//$this->return .= ($page == 'All') ? "<a class=\"current\" style=\"margin-left:10px\" href=\"#\">All</a> \n":"<a class=\"paginate\" style=\"margin-left:10px\" href=# onclick=\"$function('All',1)\">All</a> \n";
		}
		else
		{
			for($i=1;$i<=$this->num_pages;$i++)
			{
				$this->return .= ($i == $this->current_page) ? "<span class=\"current\">$i</span>":"<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$i)\">$i</a>";
			}
			//$this->return .= "<a class=\"paginate\" href=# onclick=\"$function('All',1) \">All</a> \n";
		}
		$this->low = ($this->current_page-1) * $this->items_per_page;
		$this->high = ($ipp == 'All') ? $this->items_total:($this->current_page * $this->items_per_page)-1;
		$this->limit = ($ipp == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
	}



}
