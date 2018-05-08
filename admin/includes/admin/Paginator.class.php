<?php
class Paginator {
 
    private $_limit;
    private $_page;
    private $_query;
    private $_total;

    public function __construct( $query ) {

	    $this->_query = $query;
		//out($query);
	 
	 	$requests = array();
	    $rs= mysql_query($query);
	    if(mysql_num_rows($rs) > 0){
		    while($row = mysql_fetch_assoc($rs))
			{
				$requests[] = $row;
				//out($row);
			}
		}
			//out($requests);
	    $this->_total = count($requests);
	     
	}	 
	public function getData( $limit = 20, $page = 1 ) {

	    $this->_limit   = $limit;
	    $this->_page    = $page;

	    //out($limit);
	 
	    if ( $this->_limit == 'all' ) {
	        $query      = $this->_query;
	        //out("is all");
	    } else {
	        $query      = $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", $this->_limit";
	    }
	    $rs = mysql_query( $query );
	    //out($query);

	    $results = array();	 
	    while ( $row = mysql_fetch_assoc($rs) ) {
	        $results[]  = $row;
	    }
	 
	    $result         = new stdClass();
	    $result->page   = $this->_page;
	    $result->limit  = $this->_limit;
	    $result->total  = $this->_total;
	    $result->data   = $results;
	 
	    return $result;
	}
	public function createLinks( $links, $list_class ) {
	    if ( $this->_limit == 'all' ) {
	    	$html       = '<div class="ui segment raised padded center no_margin"><div style="width: 100%; text-align: left;" class="ui segment' . $list_class . '">';
		    $html       .= '<a class="paginator_link ui button flexy" href="/admin/' . $_GET["mode"] . '/1/20">20 per page</a><a class="paginator_link ui button flexy" href="/admin/' . $_GET["mode"] . '/1/30">30 per page</a><a class="paginator_link ui button flexy" href="/admin/' . $_GET["mode"] . '/1/50">50 per page</a></div></div>';
	        return $html;
	    }

	    $active_all = "";
	    $active_10 = "";
	    $active_20 = "";
	    $active_30 = "";
	    $active_50 = "";

	    switch($_GET["cat2"]){
	    	case "all":
	    		$active_all = "active";
	    		break;
	    	case "20":
	    		$active_20 = "active";
	    		break;
	    	case "30":
	    		$active_30 = "active";
	    		break;
	    	case "50":
	    		$active_50 = "active";
	    		break;
	    	default:
       			$active_20 = "active";
	    }	 

	    $last       = ceil( $this->_total / $this->_limit );
	 
	    $start      = 1;
	    $end        = $last;
	 
	    $html       = '<div class="ui segment raised padded center no_margin"><div class="ui segment lazy pagination' . $list_class . '" style="width: 100%"><div style="width: 100%" class="ui pages labels rounded"><div style="text-align: left; width: 100%; padding-bottom: 20px;"><a class="paginator_link ui button flexy ' . $active_all . '" href="/admin/' . $_GET["mode"] . "/" . $this->_page . '/all">ALL</a><a class="paginator_link ui button flexy ' . $active_20 . '" href="/admin/' . $_GET["mode"] . '/1/20">20 per page</a><a class="paginator_link ui button flexy ' . $active_30 . '" href="/admin/' . $_GET["mode"] . '/1/30">30 per page</a><a class="paginator_link ui button flexy ' . $active_50 . '" href="/admin/' . $_GET["mode"] . '/1/50">50 per page</a></div>';
	 
	    $class      = ( $this->_page == 1 ) ? "disabled" : "";
	    if($this->_page > 1){
	    	$html       .= '<span class="ui label page item ' . $class . '"><a style="margin-top: 0px; border: none;" href="/admin/' . $_GET["mode"] . "/" . ($this->_page-1) . "/" . $this->_limit . '">&laquo;</a></span>';
	    }
	 
	    if ( $start > 1 ) {
	        $html   .= '<span class="ui label page item"><a style="margin-top: 0px; border: none;" href="/">1</a></span>';
	        $html   .= '<span class="disabled"><span>...</span></span>';
	    }
	 
	 	if((($this->_page * $this->_limit) < $this->_total) || ($last >= 2)){
		    for ( $i = $start ; $i <= $end; $i++ ) {
		        $class  = ( $this->_page == $i ) ? "active" : "";
		        $html   .= '<span class="ui label page item ' . $class . '"><a style="margin-top: 0px; border: none;" href="/admin/' . $_GET["mode"] . "/" . $i . '/' . $this->_limit . '">' . $i . '</a></span>';
		    }
	 	}
	 
	    /*if ( $this->_page < $last ) {
	        $html   .= '<span class="ui label page item disabled"><span>...</span></span>';
	        $html   .= '<li><a style="margin-top: 0px; border: none;" href="/admin/' . $_GET["mode"] . "/" . $this->_page . "/" . $this->_limit . '">' . $last . '</a></span>';
	    }*/
	 
	    $class      = ( $this->_page == $last ) ? "disabled" : "";
	    if ( $this->_page < $last ) {
	    	$html       .= '<span class="ui label page item ' . $class . '"><a style="margin-top: 0px; border: none;" href="/admin/' . $_GET["mode"] . "/" . ( $this->_page + 1 ) . '/' . $this->_limit . '">&raquo;</a></span>';
		}

	    $html       .= '</div></div>';
	 
	    return $html;
	}
}
?>