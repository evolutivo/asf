<?php
/**
* @version		$Id: szaki_gallery.php 2012. 12. 15.
* @package		Szaki Table
* @copyright	Copyright (C) 2012 szathmari.hu All rights reserved.
* @license		GNU/GPL, see license on http://szathmari.hu
*/
defined( '_JEXEC' ) or die;
jimport('joomla.plugin.plugin');

class plgContentSzaki_Table extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.5
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}
	
	public function onContentPrepare($context, &$article, &$params, $limitstart)
	{
		$app = JFactory::getApplication();
    	if (strpos($article->text, 'szakitable') === false) {
			return true;
		} 
	
		define('SZAKI_TABLE_URI', JURI::root().'plugins/content/szaki_table/assets/');
		

		$regex_one		= '|{szakitable\s*(.[^}]*)}(.*?){/szakitable}|si';
		$regex_all		= '|{szakitable\s*.*?{/szakitable}|si';
	    $matches 		= array();
	    $count_matches	= preg_match_all($regex_all,$article->text, $matches, PREG_OFFSET_CAPTURE | PREG_PATTERN_ORDER);
		

		if ($count_matches != 0) {
		
			if ($this->params->get('jQuery', 1)) {
				if (!JFactory::getApplication()->get('jquery')) {
					JFactory::getApplication()->set('jquery', true);
					JFactory::getDocument()->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js');
					JFactory::getDocument()->addScriptDeclaration("
						jQuery.noConflict();");
				}
			}
			
			JHTML::script( 'jquery.csvtotable.js', SZAKI_TABLE_URI );
			JHTML::script( 'jquery.tablesorter.js', SZAKI_TABLE_URI );
			JHTML::script( 'jquery.tablesorter.pager.js', SZAKI_TABLE_URI );
			JHTML::stylesheet('szaki_table.css', SZAKI_TABLE_URI);
			
			
			for($i = 0; $i < $count_matches; $i++) {
            	$parts = array();
				$szaki = $matches[0][$i][0];

				preg_match($regex_one, $szaki, $parts);
				$rid = '_'.rand(100000,999999);
				$divclass = 'table';
				$tableclass = '';
	
				preg_match ( "#width\s*=\s*\"\s*(.*?)\s*\"#s", $parts[1], $width );
				if ($width[1]){
					$resizeJsDec = " $('#$rid').resize('$width[1]');";
					$divclass = 'resize';
					$tableclass = ", tableClass:'wide'";
				}
				else
					$resizeJsDec = '';
				
				
				$CSVseparator = '';
				preg_match ( "#csvseparator\s*=\s*\"\s*(.*?)\s*\"#s", $parts[1], $mcs );
				if ($mcs[1])
					$CSVseparator = 'separator: \''.$mcs[1].'\', ';
				
				
				$CSVToTableJs = '';
				$tableSorterJsDec = '';
				preg_match ( "#csv\s*=\s*\"\s*(.*?)\s*\"#s", $parts[1], $mc );
				if ($mc[1])
					$CSVToTableJs = "$('#$rid .$divclass').CSVToTable('$mc[1]', { $CSVseparator loadingImage: '"
					.SZAKI_TABLE_URI."loader.gif' $tableclass}).bind('loadComplete', function() {csvComplete();});;";
				else 
					$tableSorterJsDec = "csvComplete();";
				
				
				$thtml = '';
				preg_match ( "#sql\s*=\s*\"\s*(.*?)\s*\"#s", $parts[1], $mt );
				if ($mt[1]) {
					$db =& JFactory::getDBO();
					$query = $mt[1];
					$db->setQuery($query);
					$result= $db->loadAssocList();
					
					
					if (count($result)) {
						
						$thtml = '<table><thead><tr>';
						foreach($result[0] as  $key=>$value) {
							$thtml .= "<th>{$key}</th>";
						}
						$thtml .= "</tr></thead>\n";
					
						$thtml .= "<tbody>\n";
						foreach($result as  $arr) {
							$thtml .= "<tr>";
							foreach($arr as  $key=>$value)
								$thtml .= "<td>{$value}</td>";
							$thtml .= "</tr>\n";
						}
						$thtml .= "</tbody>\n</table>\n";
					} else 
						$error = "SQL: N / A";
				}
				
				$livefJs = '';
				$livef = '';
				preg_match ( "#filter\s*=\s*\"\s*(.*?)\s*\"#s", $parts[1], $mf );
				if ($mf[1]) {
					$livefJs = "$('#$rid').liveFilter('$mf[1]');";
					$livef = "<div class='filter'>"
						. "<input class='szakitable $rid' name='livef' type='text' value='".JText::_( 'PLG_CONTENT_SZAKI_TABLE_FILTER' )."' onblur='if(this.value==\"\") this.value=\"".JText::_( 'PLG_CONTENT_SZAKI_TABLE_FILTER' )."\";' onfocus='if(this.value==\"".JText::_( 'PLG_CONTENT_SZAKI_TABLE_FILTER' )."\") this.value=\"\";'/> </div>";
				}
				
				
				preg_match ( "#zebra\s*=\s*\"\s*(.*?)\s*\"#s", $parts[1], $mz );
				$zebra = '';
				if ($mz[1]) { 
					$zebra = "widgets: ['zebra']";
					JFactory::getDocument()->addStyleDeclaration("div#$rid.szakitable .odd {background-color: $mz[1] }");
				}
				
				
				$captionJs = '';
				preg_match ( "#caption\s*=\s*\"\s*(.*?)\s*\"#s", $parts[1], $mcap );
				if ($mcap[1]) { 
					$captionJs = "$('#$rid table').append('<caption>$mcap[1]</caption>');";
				}
				
				preg_match ( "#headers\s*=\s*\"\s*(.*?)\s*\"#s", $parts[1], $mh );
				$headers = '';
				if ($mh[1]) { 
					$mh[1] = preg_replace('/(\d+:)([^, ]*)/', '\1 {sorter:"\2"}', $mh[1]);
					$headers = "headers: { $mh[1] } ";
				}
				$close = '</div>';
				
				/* pager */
				preg_match ( "#pager\s*=\s*\"\s*(.*?)\s*\"#s", $parts[1], $mp );
				$pager = '';
				if ($mp[1]) { 
					$pager .=
					'<div id="pager" class="pager">
							<a class="first">'.JText::_( 'PLG_CONTENT_SZAKI_TABLE_FIRST' ).'</a>
							<a class="prev">'.JText::_( 'PLG_CONTENT_SZAKI_TABLE_PREV' ).'</a>
							<input type="text" class="pagedisplay"/>
							<a class="next">'.JText::_( 'PLG_CONTENT_SZAKI_TABLE_NEXT' ).'</a>
							<a class="last">'.JText::_( 'PLG_CONTENT_SZAKI_TABLE_LAST' ).'</a>
							<select class="pagesize">
								<option selected="selected"  value="10">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option  value="100">100</option>
							</select>
					</div>';
					$pagerJS = "$('#$rid table').tablesorterPager({container: $('#pager')});";
				}

				$output = "<div class='szakitable' id='$rid'>$pager$livef\n";
				if ($resizeJsDec or $CSVToTableJs or $thtml) {
					$output .= "<div class='$divclass'>$thtml";
					$close .= '</div>';
					}
				$output .= $parts[2].$close;
				
				if ($zebra && $headers)
					$zebra .= ',';
				
				if (!$error)
					JFactory::getDocument()->addScriptDeclaration("
					(function($) {
						$(window).load(function(){
							$tableSorterJsDec
							$CSVToTableJs
							$livefJs
							$captionJs
							$resizeJsDec
						});
							function csvComplete(){
								$('#$rid table').tablesorter({ $zebra $headers });
								$pagerJS
							}
						})(jQuery);
					");
				else
					$output = $error;
				$article->text = preg_replace($regex_all, $output, $article->text, 1);
			} 
		}
	}
}
?>