<?php
/*------------------------------------------------------------------------
# com_pager - Pager
# ------------------------------------------------------------------------
# Iacopo Guarneri
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.the-html-tool.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );  
	
	function limit_r($txt){
		$txt=str_replace("[LIMIT]","",$txt);
		return str_replace("[/LIMIT]","",$txt);
	}
	
	$app = JFactory::getApplication('site');
	$params =  & $app->getParams('com_pager');
	$page = $params->get( 'name_page', '');
	$val = $params->get( 'id_val', '');

	$database = JFactory::getDBO();

	//select page
    $database->setQuery('SELECT * FROM #__pager_list_article WHERE name="'.$page.'" LIMIT 0,1');
    $results = $database->loadAssocList();
	
	$select=str_replace("[value_menu]",$val,$results[0]['select_page']);
	$identifier=$results[0]['identifier'];
	$testo=stripslashes($results[0]['text_page']);

	$database->setQuery($select);
    $results = $database->loadAssocList();
	$limit=-1;
	foreach($results as $result){
		$tsplit=explode("[COL]",$testo);
		$new_txt="";
		foreach($tsplit as $split){

			if($limit==-1){$lascia_passare=1;}
			if(strstr($split,"[LIMIT]")){$limit=1;}
			if(strstr($split,"[/LIMIT]")){
				$limit=0; 
				if($lascia_passare==0){
					$split=explode("[/LIMIT]",$split); 
					$split=limit_r($split[1]); 
				}
				$lascia_passare=0;
			}

			if($limit!=1 || $lascia_passare==1){
				if(strstr($split,"[/COL]")){
					$col=explode("[/COL]",$split);
					$new_txt.=$result[$col[0]].limit_r($col[1]);
				}else{
					$new_txt.=limit_r($split);
				}
			}
		}
		echo $new_txt;
	}
?>
