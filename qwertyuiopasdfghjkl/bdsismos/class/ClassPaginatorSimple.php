<?php

class Paginator{
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
	var $function;
	
	function Paginator()
	{
		$this->current_page = 1;
		$this->mid_range = 7;
		$this->items_per_page = (!empty($ipp)) ? $ipp:$this->default_ipp;
	}

	function display_pages()
	{
		return $this->return;
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
		$Siguiente_page = $this->current_page+1;
		if($this->num_pages > 10)
		{
			$this->return = ($this->current_page != 1 And $this->items_total >= 10) ? "<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$prev_page)\">&laquo; Anterior</a> ":"<span class=\"inactive\" href=\"#\">&laquo; Anterior</span> ";

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
			$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= 10) And ($page != 'All')) ? "<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$Siguiente_page,'','')\">Siguiente &raquo;</a>\n":"<span class=\"inactive\" href=\"#\">&raquo; Siguiente</span>\n";
			
		}
		else
		{
			for($i=1;$i<=$this->num_pages;$i++)
			{
				$this->return .= ($i == $this->current_page) ? "<span class=\"current\">$i</span>":"<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$i)\">$i</a>";
			}
			
		}
		$this->low = ($this->current_page-1) * $this->items_per_page;
		$this->high = ($ipp == 'All') ? $this->items_total:($this->current_page * $this->items_per_page)-1;
		$this->limit = ($ipp == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
	}
	
	
	function paginatePlus($ipp,$page,$function,$valFunction)
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
		$Siguiente_page = $this->current_page+1;
		if($this->num_pages > 10)
		{
			$this->return = ($this->current_page != 1 And $this->items_total >= 10) ? "<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$prev_page,$valFunction)\">&laquo; Anterior</a> ":"<span class=\"inactive\" href=\"#\">&laquo; Anterior</span> ";
	
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
			$this->return .= ($i == $this->current_page And $page != 'All') ? "<span class=\"current\">$i</span> ":"<a class=\"paginate\" title=\"Go to page $i of $this->num_pages\" href=# onclick=\"$function($this->items_per_page,$i,$valFunction)\">$i</a> ";
			}
			if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= " ... ";
			}
			$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= 10) And ($page != 'All')) ? "<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$Siguiente_page,$valFunction)\">Siguiente &raquo;</a>\n":"<span class=\"inactive\" href=\"#\">&raquo; Siguiente</span>\n";
				
		}
		else
			{
			for($i=1;$i<=$this->num_pages;$i++)
			{
			$this->return .= ($i == $this->current_page) ? "<span class=\"current\">$i</span>":"<a class=\"paginate\" href=# onclick=\"$function($this->items_per_page,$i,$valFunction)\">$i</a>";
			}
				
			}
			$this->low = ($this->current_page-1) * $this->items_per_page;
			$this->high = ($ipp == 'All') ? $this->items_total:($this->current_page * $this->items_per_page)-1;
			$this->limit = ($ipp == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
	}

}
