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
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
    
     /*
      gia controllato:le join vanno sia 1 a n che n a 1
      un campo può avere più join? non è necessario collegando a cascata le tabelle es: a.user_id = u.id && u.id = b.user_id --> quindi a.user_id è uguale a b.user_id

	  fare il tutorial
      testare inglese
	  mettere bottone join
     */
    
    $database = JFactory::getDBO();
	
	//lingua
	$no_error_txt=htmlentities(JText::_( 'COM_PAGER_NO_ERROR' ),ENT_QUOTES);
	$errore_salvataggio_txt=htmlentities(JText::_( 'COM_PAGER_ERRORE_SALVATAGGIO' ),ENT_QUOTES);
	$identificatore_txt=htmlentities(JText::_( 'COM_PAGER_IDENTIFICATORE' ),ENT_QUOTES);
	$identificatore_desc_txt=htmlentities(JText::_( 'COM_PAGER_IDENTIFICATORE_DESC' ),ENT_QUOTES);
	$query_txt=htmlentities(JText::_( 'COM_PAGER_QUERY' ),ENT_QUOTES);
	$query_desc_txt=htmlentities(JText::_( 'COM_PAGER_QUERY_DESC' ),ENT_QUOTES);
	$tabelle_txt=htmlentities(JText::_( 'COM_PAGER_TABELLE' ),ENT_QUOTES);
	$tabelle_desc_txt=htmlentities(JText::_( 'COM_PAGER_TABELLE_DESC' ),ENT_QUOTES);
	$operatore_txt=htmlentities(JText::_( 'COM_PAGER_OPERATORE' ),ENT_QUOTES);
	$operatore_desc_txt=htmlentities(JText::_( 'COM_PAGER_OPERATORE_DESC' ),ENT_QUOTES);
	$valore_txt=htmlentities(JText::_( 'COM_PAGER_VALORE' ),ENT_QUOTES);
	$valore_desc_txt=htmlentities(JText::_( 'COM_PAGER_VALORE_DESC' ),ENT_QUOTES);
	$andor_txt=htmlentities(JText::_( 'COM_PAGER_ANDOR' ),ENT_QUOTES);
	$andor_desc_txt=htmlentities(JText::_( 'COM_PAGER_ANDOR_DESC' ),ENT_QUOTES);
	$join_txt=htmlentities(JText::_( 'COM_PAGER_JOIN' ),ENT_QUOTES);
	$join_desc_txt=htmlentities(JText::_( 'COM_PAGER_JOIN_DESC' ),ENT_QUOTES);
	$order_txt=htmlentities(JText::_( 'COM_PAGER_ORDER' ),ENT_QUOTES);
	$order_desc_txt=htmlentities(JText::_( 'COM_PAGER_ORDER_DESC' ),ENT_QUOTES);
	$group_txt=htmlentities(JText::_( 'COM_PAGER_GROUP' ),ENT_QUOTES);
	$group_desc_txt=htmlentities(JText::_( 'COM_PAGER_GROUP_DESC' ),ENT_QUOTES);
	$alias_txt=htmlentities(JText::_( 'COM_PAGER_ALIAS' ),ENT_QUOTES);
	$alias_desc_txt=htmlentities(JText::_( 'COM_PAGER_ALIAS_DESC' ),ENT_QUOTES);
	$bottome_colonna_desc_txt=htmlentities(JText::_( 'COM_PAGER_BOTTONE_COLONNA_DESC' ),ENT_QUOTES);
	$titolo_txt=htmlentities(JText::_( 'COM_PAGER_TITOLO' ),ENT_QUOTES);
	
	if(JRequest::getVar('tabella','','post')!=""){
        $tabella=JRequest::getVar('tabella','','post');
        $database->setQuery('SHOW COLUMNS FROM '.$tabella);
        $results = $database->loadAssocList();
        $colonne="";
        foreach($results as $result){
            $colonne.=$result['Field']."[col]";
        }
        die($colonne);
    }
    
    if(JRequest::getVar('test_query_ex','','post')!=""){
        $database->setQuery(JRequest::getVar('test_query_ex','','post'));
        $results = $database->loadObjectList();
        if($database->getErrorMsg()!=""){
            die("<span style='color:#ff0000; font-weight:bold;'>".$database->getErrorMsg()."</span>");
        }else{
            die("<span style='color:#00c500; font-weight:bold;'>".$no_error_txt."</span>");
        }
    }
    
    //elimina una pagina
    function delete_page($id_del){
        
        $database = JFactory::getDBO();
        $database->setQuery('SELECT id_table_pager FROM #__pager_table_list WHERE id_article='.$id_del);
        $del_tabs = $database->loadAssocList();
        foreach($del_tabs as $del_tab){
            $database->setQuery('DELETE FROM #__pager_column_list WHERE id_table='.$del_tab['id_table_pager']);
            $database->query();
        }
        $database->setQuery('DELETE FROM #__pager_list_article WHERE id_pager='.$id_del);
        $database->query();
        $database->setQuery('DELETE FROM #__pager_table_list WHERE id_article='.$id_del);
        $database->query();
    
    }
    
    //elimina page
    if(JRequest::getVar('delete','','get')!=""){
        delete_page(JRequest::getVar('delete','','get'));
    }

    //inserisce/modifica i dati nel database
    if(JRequest::getVar('name_db','','post')!=""){
        $name_db=JRequest::getVar('name_db','','post');
        $text_db=JRequest::getVar('text_db','','post','',JREQUEST_ALLOWHTML);
        $select_db=JRequest::getVar('select_db','','post');
        $table_db=JRequest::getVar('table_db','','post');
        $id_mod=JRequest::getVar('id_mod','','post');
		$identificatore=JRequest::getVar('identificatore','','post');

        //se bisogna modificare la pagina prima elimina tutto poi inserisce tutto
		//si potrebbe fare l'update ma se uno aggiunge una nuova tabella bisognerebbe riuscire a combninare update e insert
        if($id_mod!=""){
            delete_page($id_mod);
        }
        
        $database->setQuery('INSERT INTO #__pager_list_article (name, text_page, select_page, identifier) VALUES ("'.$name_db.'", "'.addslashes($text_db).'", "'.$select_db.'", "'.$identificatore.'")');
        $database->query();
        $id_article=$database->insertid();
        
        $table_db=explode("[TAB]",$table_db);
        for($i=0;$i<count($table_db);$i++){
            if($table_db[$i]==""){continue;}
            $col=explode("[COL]",$table_db[$i]);
            
            $database->setQuery('INSERT INTO #__pager_table_list (name, id_article) VALUES ("'.$col[0].'", "'.$id_article.'")');
            $database->query();
            $id_table=$database->insertid();
            
            for($j=1;$j<count($col);$j++){
                if($col[$j]==""){continue;}
                $attr=explode("[ATTR]", $col[$j]);
                //A[ATTR]LIKE[ATTR]searc[ATTR]AND[ATTR]1[ATTR]ASC[ATTR]1[ATTR]alias
                //[0] name, [1] operator, [2] search, [3] and_or, [4] apici, [5] order, [6] group, [7] alias;
            
                $database->setQuery('INSERT INTO #__pager_column_list (name, alias_col, operator, search, and_or, order_col, group_col, id_table, apici) VALUES ("'.$attr[0].'", "'.$attr[7].'", "'.$attr[1].'", "'.$attr[2].'", "'.$attr[3].'", "'.$attr[5].'", "'.$attr[6].'", "'.$id_table.'", "'.$attr[4].'")');
                $database->query();
            }
        }
        die("".$id_article);
    }
    
    /**************************************installazione************************************/
    $database->setQuery("SHOW TABLES LIKE '%pager_list_article%'");
    $elenco_delle_tabelle = $database->loadAssocList();
    if(count($elenco_delle_tabelle)==0){
        
         $query = "CREATE TABLE `#__pager_list_article` (
         `id_pager` int(11) NOT NULL AUTO_INCREMENT,
         `name` varchar(255) NOT NULL,
         `text_page` text NOT NULL,
         `select_page` text NOT NULL,
		 `identifier` varchar(255) NOT NULL,
         PRIMARY KEY  (`id_pager`)
         ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";
         $database->setQuery($query);
         $database->query();
         
         $query = "CREATE TABLE `#__pager_table_list` (
         `id_table_pager` int(11) NOT NULL AUTO_INCREMENT,
         `name` varchar(255) NOT NULL,
         `id_article` int(11) NOT NULL,
         PRIMARY KEY  (`id_table_pager`)
         ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";
         $database->setQuery($query);
         $database->query();
         
         $query = "CREATE TABLE `#__pager_column_list` (
         `id_column_pager` int(11) NOT NULL AUTO_INCREMENT,
         `name` varchar(255) NOT NULL,
         `alias_col` varchar(255) NOT NULL,
         `operator` varchar(4) NOT NULL,
         `search` varchar(255) NOT NULL,
         `and_or` varchar(3) NOT NULL,
         `order_col` varchar(4) NOT NULL,
         `group_col` int(1) NOT NULL,
         `id_table` int(11) NOT NULL,
         `apici` int(1) NOT NULL,
         PRIMARY KEY  (`id_column_pager`)
         ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";
         $database->setQuery($query);
         $database->query();
    }
    /*********************************fine installazione************************************/
    
    //********************************toolbar***********************************************/
    JToolBarHelper::title("Pager");
    
    if(JRequest::getVar('view','','get')==""){
        $bar=JToolBar::getInstance( 'toolbar' )->appendButton( 'Link', 'new', 'New', 'index.php?option=com_pager&view=new', 300, 200 );
        
        /*JSubMenuHelper::addEntry(
         'salva',
         'index.php?option=com_freevotes&view=domande'
        );*/
    }
    if(JRequest::getVar('view','','get')=="new"){
        $bar=JToolBar::getInstance( 'toolbar' )->appendButton( 'Link', 'save', 'Save', '#" id="salva_page', 300, 200 );
        $bar=JToolBar::getInstance( 'toolbar' )->appendButton( 'Link', 'cancel', 'Close', 'index.php?option=com_pager', 300, 200 );
    }
    //********************************fine toolbar*****************************************/
    
echo"
<style>
.display_title_desc {
	margin:-25px 0 0 -240px;
	width: 200px; 
	height: auto; 
	padding:10px;
	position: absolute;
	-moz-border-radius: 10px; 
	-webkit-border-radius: 10px; 
	border-radius: 10px;
	color:#aaa;
	background:#000;
}
.display_title_desc:before {
	content:'';
	position: absolute;
	width: 0;
	height: 0;
	border-top: 8px solid transparent;
	border-left: 16px solid rgb(0,0,0);
	border-bottom: 8px solid transparent;
	right:-16px;
}
.sezione_grafica{
	border-radius: 10px;
	padding:10px;
	border:1px solid #555;
	margin:0 0 20px 0;
	background:#fff;
	overflow:hidden;
	clear:both;
}
input, textarea, input:focus{
	border-radius:10px;
	border:1px solid #999;
	padding:2px 10px;
	
	background-image: linear-gradient(bottom, rgb(214,214,214) 20%, rgb(255,255,255) 60%);
	background-image: -o-linear-gradient(bottom, rgb(214,214,214) 20%, rgb(255,255,255) 60%);
	background-image: -moz-linear-gradient(bottom, rgb(214,214,214) 20%, rgb(255,255,255) 60%);
	background-image: -webkit-linear-gradient(bottom, rgb(214,214,214) 20%, rgb(255,255,255) 60%);
	background-image: -ms-linear-gradient(bottom, rgb(214,214,214) 20%, rgb(255,255,255) 60%);

	background-image: -webkit-gradient(
		linear,
		left bottom,
		left top,
		color-stop(0.2, rgb(214,214,214)),
		color-stop(0.6, rgb(255,255,255))
	);
}
textarea{
	padding:2px 0px 2px 10px;
}
.colonna, button, button:hover{
	border-radius:10px;
	border:none;
	color:#fff;
	padding:2px 10px;
	float:right;
	text-align:center;
	cursor:pointer;
	
	background-image: linear-gradient(bottom, rgb(33,125,171) 0%, rgb(73,164,213) 100%);
	background-image: -o-linear-gradient(bottom, rgb(33,125,171) 0%, rgb(73,164,213) 100%);
	background-image: -moz-linear-gradient(bottom, rgb(33,125,171) 0%, rgb(73,164,213) 100%);
	background-image: -webkit-linear-gradient(bottom, rgb(33,125,171) 0%, rgb(73,164,213) 100%);
	background-image: -ms-linear-gradient(bottom, rgb(33,125,171) 0%, rgb(73,164,213) 100%);

	background-image: -webkit-gradient(
		linear,
		left bottom,
		left top,
		color-stop(0, rgb(33,125,171)),
		color-stop(1, rgb(73,164,213))
	);
}
button:hover{
	opacity:0.8;
}
.colonna{
	float:none;
}

#tabelle div{
	color:#fff;
	border-radius:10px;
	padding:1px 5px 1px 20px;
	margin:5px 0 0 0;
	word-wrap: break-word;
	position:relative;

	background-image: linear-gradient(bottom, rgb(116,116,116) 0%, rgb(110,110,110) 50%, rgb(127,127,127) 50%, rgb(132,132,132) 100%);
	background-image: -o-linear-gradient(bottom, rgb(116,116,116) 0%, rgb(110,110,110) 50%, rgb(127,127,127) 50%, rgb(132,132,132) 100%);
	background-image: -moz-linear-gradient(bottom, rgb(116,116,116) 0%, rgb(110,110,110) 50%, rgb(127,127,127) 50%, rgb(132,132,132) 100%);
	background-image: -webkit-linear-gradient(bottom, rgb(116,116,116) 0%, rgb(110,110,110) 50%, rgb(127,127,127) 50%, rgb(132,132,132) 100%);
	background-image: -ms-linear-gradient(bottom, rgb(116,116,116) 0%, rgb(110,110,110) 50%, rgb(127,127,127) 50%, rgb(132,132,132) 100%);

	background-image: -webkit-gradient(
		linear,
		left bottom,
		left top,
		color-stop(0, rgb(116,116,116)),
		color-stop(0.5, rgb(110,110,110)),
		color-stop(0.5, rgb(127,127,127)),
		color-stop(1, rgb(132,132,132))
	);
}
.vedi_col, .cancella_tab, .elimina_join{
	position:absolute;
	line-height:0;
	border-radius:10px;
	background:#fff;
	cursor:pointer;
	font-weight:bold;
	color:#333;
	text-align:center;
	padding:5px 0 0 0;
	width:12px;
	height:7px;
	font-size:11px;
	border:2px solid #444;
}
.vedi_col{
	left:0px;
	top:0px;
	background:#3dcf3d;
}
.cancella_tab{
	right:-6px;
	top:-7px;
	background:#f85741;
}
.elimina_join{
	background:#f85741;
	border-radius:10px !important;
	z-index:999999;
}
#tabelle, #view_join{
	width:49%; 
	float:left;
	margin:20px 0 0 0;
}
#view_join div{
	border-radius:0px;
	-webkit-border-top-right-radius: 5px;
	-webkit-border-bottom-right-radius: 5px;
	-moz-border-radius-topright: 5px;
	-moz-border-radius-bottomright: 5px;
	border-top-right-radius: 5px;
	border-bottom-right-radius: 5px;
}
#colonne{
	margin-top:15px;
}
</style>
";
    
if(JRequest::getVar('view','','get')==""){
    //mostra le pagine create
    $database->setQuery('SELECT id_pager, name FROM #__pager_list_article');
    $results = $database->loadAssocList();
    
    $app = JFactory::getApplication();
	$template_name = $app->getTemplate();
    
    echo "<table>";
    foreach($results as $result){
        echo "<tr><td><a href='index.php?option=com_pager&view=new&id=".$result['id_pager']."'>".$result['name']."</a></td><td><a href='index.php?option=com_pager&delete=".$result['id_pager']."'><div style='width:32px; height:32px; background-image:url(\"templates/".$template_name."/images/toolbar/icon-32-cancel.png\");'></div></a></td></tr>";
    }
    echo"</table>";
}
if(JRequest::getVar('view','','get')=="new"):
    //mostra la schermata di nuova pagina
    
    //setta la variabile js table se stiamo modificando una page
    if(JRequest::getVar('id','','get')!=""){
        $database->setQuery('SELECT name, text_page, identifier FROM #__pager_list_article WHERE id_pager='.JRequest::getVar('id','','get'));
        $nome_della_pagina = $database->loadAssocList();
        echo"<script>nome_della_pagina='".$nome_della_pagina[0]['name']."'; identificatore='".$nome_della_pagina[0]['identifier']."';</script>";
        $testo_della_pagina=$nome_della_pagina[0]['text_page'];
        
        
        $database->setQuery('SELECT * FROM #__pager_table_list WHERE id_article='.JRequest::getVar('id','','get').' ORDER BY name ASC');
        $tables = $database->loadAssocList();

        echo "<script>var table=new Array();
        ";
        for($i=0;$i<count($tables);$i++){
            echo "table[".$i."]={name:'".$tables[$i]['name']."', column:[";
            
            $database->setQuery('SELECT * FROM #__pager_column_list WHERE id_table='.$tables[$i]['id_table_pager'].' ORDER BY name ASC');
            $cols = $database->loadAssocList();
            
            for($j=0;$j<count($cols);$j++){
                echo"{name:'".$cols[$j]['name']."', attr:{operator:'".$cols[$j]['operator']."', search:'".$cols[$j]['search']."', and_or:'".$cols[$j]['and_or']."', apici:".$cols[$j]['apici'].", color_join:'', order:'".$cols[$j]['order_col']."', group:'".$cols[$j]['group_col']."', alias:'".$cols[$j]['alias_col']."'}},
                ";
            }
            
            echo "]};
            ";
        }
        echo"</script>";
    }else{echo "<script>var table=new Array(), nome_della_pagina='';</script>";}
    
    $editor = JFactory::getEditor("tinymce");
    //$editor = JFactory::getEditor("codemirror");

    echo "
    <div style='width:60%; float:left;'>".$titolo_txt." <input type='text' id='name_form'><br /><br />".$editor->display('codice', stripslashes(@$testo_della_pagina), '100%', '768', '40', '5',false)."</div>";
    echo JHTML::_( 'form.token' );

    echo"<div style='width:37%; float:left; overflow:hidden; padding:1%;'>";
    $database->setQuery('SHOW TABLES');
    $results = $database->loadAssocList();
    
    $app = JFactory::getApplication();
    $db_name=$app->getCfg('db');

    echo "<div class='sezione_grafica'>
	<span rel='descrizione' alt='".$query_desc_txt."'>".$query_txt."</span><br />
	<textarea type='text' id='select_txt' style='width:94%; height:150px;'></textarea><br />
	<button id='test_query'>test</button>
	<div id='query_error' class='sezione_grafica' style='display:none; margin:30px 0 0 0;'></div>
	</div>
	<div class='sezione_grafica'>
	<span rel='descrizione' alt='".$identificatore_desc_txt."'>".$identificatore_txt."</span>
	<input type='text' id='identificatore'><br /><br />
	<span rel='descrizione' alt='".$tabelle_desc_txt."'>".$tabelle_txt."</span>
	<select id='selezione_tabelle'><option></option>";
    foreach($results as $result){
        if($result['Tables_in_'.$db_name]!=""){echo "<option class='tabella' value='".$result['Tables_in_'.$db_name]."'>".$result['Tables_in_'.$db_name]."</option>";}
    }
    echo"</select>
    <div style='overflow:hidden'>
        <div id='tabelle'></div>
        <div id='view_join'></div>
    </div>
    <div id='colonne' class='sezione_grafica' style='display:none;'></div>
    ";
    echo"</div></div>";
?>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
$J=jQuery.noConflict();
$J(document).ready(function(){
                   
$J("#salva_page").click(function(){
    var content = <?php echo $editor->getContent('codice'); ?>;
    var name_db=$J('#name_form').val();
    var select_db=$J('#select_txt').val();
	var identificatore=$J('#identificatore').val();
         
	$J("#name_form, #selezione_tabelle").css("background","#fff"); errore_salva=0;
    if(name_db==""){$J("#name_form").css("background","#f00"); errore_salva=1;}
	if(table.length==0){$J("#selezione_tabelle").css("background","#f00"); errore_salva=1;}
	if(errore_salva==1){alert("<?php echo $errore_salvataggio_txt; ?>"); return(0);}

    tabQ="";
    n_tab=table.length;
    for(i=0;i<n_tab;i++){
        if(table[i]==""){continue;}
        tabQ=tabQ+"[TAB]"+table[i].name;
        n_col=table[i].column.length;
        for(j=0;j<n_col;j++){
            if(table[i].column[j]==""){continue;}
                tabQ=tabQ+"[COL]"+table[i].column[j].name+"[ATTR]"+table[i].column[j].attr.operator+"[ATTR]"+table[i].column[j].attr.search+"[ATTR]"+table[i].column[j].attr.and_or+"[ATTR]"+table[i].column[j].attr.apici+"[ATTR]"+table[i].column[j].attr.order+"[ATTR]"+table[i].column[j].attr.group+"[ATTR]"+table[i].column[j].attr.alias;
        }
    }
                        
    //location.href="<?php echo JURI::current(); ?>?option=com_pager&name_db="+name_db+"&text_db="+content+"&select_db="+select_db;
    $J.ajax({
		type: 'POST',
		url: "<?php echo JURI::current(); ?>?option=com_pager",
		data: "name_db="+name_db+"&text_db="+content+"&select_db="+select_db+"&identificatore="+identificatore+"&table_db="+tabQ+"&id_mod=<?php echo JRequest::getVar('id','','get'); ?>",
		success: function(e){
			location.href="<?php echo JURI::base(); ?>index.php?option=com_pager&view=new&id="+e;
		}
    });
});

function crea_select(){
    $J("#tabelle").html("");

    ent_where=0; ent_order=0; ent_group=0;
    list_table=""; list_column=""; list_where=""; list_order=""; list_group="";
    n_tab=table.length;
                   
    for(i=0;i<n_tab;i++){
        if(table[i]==""){continue;}
        list_table=list_table+table[i].name+", ";
		
		prefix='<?php $config = JFactory::getConfig(); echo $config->getValue('config.dbprefix');?>';
		numero_caratteri=10;
		
		nome_puntini=table[i].name;
		if(table[i].name.indexOf(prefix)!=-1){nome_puntini="#"+table[i].name.substr(prefix.length,table[i].name.length);}

		if(nome_puntini.length>(numero_caratteri*2)+1){
			nome_puntini=nome_puntini.substr(0,numero_caratteri)+".."+nome_puntini.substr(nome_puntini.length-numero_caratteri,nome_puntini.length);
		}
		
        $J("#tabelle").append("<div class='item_table_"+i+"' style='border:1px solid #555;'>"+nome_puntini+" <span class='vedi_col "+i+"'>v</span> <span class='cancella_tab "+i+"'>x</span></div>");
                   
        n_col=table[i].column.length;
        for(j=0;j<n_col;j++){
            list_column=list_column+table[i].name+"."+table[i].column[j].name;
            if(table[i].column[j].attr.alias!=""){list_column=list_column+" AS "+table[i].column[j].attr.alias;}
            list_column=list_column+", ";
                   
			if(ent_where==0){
				ent_where=1;
				
				dove="identifier='[value_menu]'";
				identificatore=$J("#identificatore").val();
				if(identificatore!=""){dove=identificatore+"='[value_menu]'";}
				
				list_where=list_where+"\nWHERE "+dove+" AND ";
			}
			if(table[i].column[j].attr.operator!="" && table[i].column[j].attr.search!=""){
                apici=""; if(table[i].column[j].attr.apici==1){apici="'";}
                   
                list_where=list_where+table[i].name+"."+table[i].column[j].name+" "+table[i].column[j].attr.operator+" "+apici+table[i].column[j].attr.search+apici+" "+table[i].column[j].attr.and_or+" ";
            }
            if(table[i].column[j].attr.order!=""){
                if(ent_order==0){ent_order=1; list_order="\nORDER BY ";}
                   list_order=list_order+table[i].name+"."+table[i].column[j].name+" "+table[i].column[j].attr.order+", ";
                   
            }
            if(table[i].column[j].attr.group==1){
                if(ent_group==0){ent_group=1; list_group="\nGROUP BY ";}
                list_group=list_group+table[i].name+"."+table[i].column[j].name+", ";
            }
        }
    }
    list_order=list_order.substr(0,list_order.length-2);
    list_group=list_group.substr(0,list_group.length-2);
    list_table=list_table.substr(0,list_table.length-2);
    list_column=list_column.substr(0,list_column.length-2);
    
    if(list_where.substr(list_where.length-4,list_where.length)=="AND "){
        list_where=list_where.substr(0,list_where.length-4);
    }
    if(list_where.substr(list_where.length-3,list_where.length)=="OR "){
        list_where=list_where.substr(0,list_where.length-3);
    }
                   
    $J("#select_txt").val("SELECT "+list_column+"\nFROM "+list_table+list_where+list_group+list_order);
}
      
//se stiamo modificando una pagina
if(table[0]!=undefined){
    $J("#name_form").val(nome_della_pagina);
	$J("#identificatore").val(identificatore);
    crea_select();
    crea_join_grafiche();
}
                   
function get_class(questo,point){
    cls=$J(questo).attr("class");
    cls=cls.split(" ");
    return cls[point];
}
                   
function random_range(inizio,fine){
    rand=Math.random();
    rand=Math.floor((rand*(fine-inizio))+inizio);
    if(rand>fine){rand=fine;}
    if(rand<inizio){rand=inizio;}
    return rand;
}
                   
function random_color(){
    R=random_range(0,255).toString(16);
    G=random_range(0,255).toString(16);
    B=random_range(0,255).toString(16);
    if(R.length==1){R=R+0;}
    if(G.length==1){G=G+0;}
    if(B.length==1){B=B+0;}
    return "#"+R+G+B;
}
                   
$J(".tabella").click(function(){
    tab_click=$J(this).val();
    $J.ajax({
        type: "POST",
        url: "<?php JURI::current(); ?>",
        data: { tabella: tab_click},
        success: function(e){
           n_tab=table.length;
           for(i=0;i<n_tab;i++){
                if(table[i].name==tab_click){
                    return false;
                }
           }
           
           puntatore_tab=table.length;
           table[puntatore_tab]={name:tab_click, column:[]};
           
           colonne=e.split("[col]");
            n_col=colonne.length;
            for(i=0;i<n_col;i++){
            if(colonne[i]!=""){table[puntatore_tab].column[table[puntatore_tab].column.length]={name:colonne[i], attr:{operator:'', search:'', and_or:'AND', apici:1, color_join:random_color(), order:'', group:'', alias:''}};}
            }
            crea_select();
        }
    });
});

$J("#test_query").click(function(){
    valoreQ=$J("#select_txt").val();
    $J.ajax({
        type: "POST",
        url: "<?php JURI::current(); ?>",
        data: { test_query_ex: valoreQ},
        success: function(e){
            $J("#query_error").html(e).css("display","");
        }
    });
});

function crea_option(cls1,cls2,ind,valore){
    try{eval("valore_attuale=table[id_tab].column[ind].attr."+cls1+";");}
    catch(qr){valore_attuale="";}
                   
    selected=""; if(valore==valore_attuale){selected="selected";}
    return "<option "+selected+" class='"+cls1+" "+cls2+" "+ind+"'>"+valore+"</option>";
}
                   
$J(document).delegate(".vedi_col","click",function(){
    id_tab=get_class(this,1);
                     
    $J("#colonne").html("").css("display","");
    n_col=table[id_tab].column.length;
    for(i=0;i<n_col;i++){
        group_check=""; if(table[id_tab].column[i].attr.group==1){group_check="checked='checked'";}
        $J("#colonne").append("<div class='sezione_grafica'>"
		+"<div class='colonna "+id_tab+" "+i+"' rel='descrizione' alt='<?php echo $bottome_colonna_desc_txt; ?>'>"+table[id_tab].column[i].name+"</div>"
		+"<span rel='descrizione' alt='<?php echo $operatore_desc_txt; ?>'><?php echo $operatore_txt; ?></span>"
        +" <select>"
            +crea_option('operator',id_tab,i,'')
            +crea_option('operator',id_tab,i,'LIKE')
            +crea_option('operator',id_tab,i,'!=')
            +crea_option('operator',id_tab,i,'>')
            +crea_option('operator',id_tab,i,'<')
            +crea_option('operator',id_tab,i,'>=')
            +crea_option('operator',id_tab,i,'<=')
        +"</select><br />"
		+"<span rel='descrizione' alt='<?php echo $valore_desc_txt; ?>'><?php echo $valore_txt; ?></span>"
        +" <input type='text' value='"+table[id_tab].column[i].attr.search+"' class='cerca_per "+id_tab+" "+i+"'><br />"
		+"<span rel='descrizione' alt='<?php echo $andor_desc_txt; ?>'><?php echo $andor_txt; ?></span>"
        +" <select>"
            +crea_option('and_or',id_tab,i,'AND')
            +crea_option('and_or',id_tab,i,'OR')
        +"</select><br />"
		+"<span rel='descrizione' alt='<?php echo $join_desc_txt; ?>'><?php echo $join_txt; ?></span>"
        +" <span class='join "+id_tab+" "+i+"'><img src='components/com_pager/join.png' style='cursor:pointer;' /></span><br />"
		+"<span rel='descrizione' alt='<?php echo $order_desc_txt; ?>'><?php echo $order_txt; ?></span>"
        +" <select>"
            +crea_option('order',id_tab,i,'')
            +crea_option('order',id_tab,i,'ASC')
            +crea_option('order',id_tab,i,'DESC')
        +"</select><br />"
		+"<span rel='descrizione' alt='<?php echo $group_desc_txt; ?>'><?php echo $group_txt; ?></span>"
        +" <input "+group_check+" type='checkbox' class='group "+id_tab+" "+i+"'><br />"
		+"<span rel='descrizione' alt='<?php echo $alias_desc_txt; ?>'><?php echo $alias_txt; ?></span>"
        +" <input value='"+table[id_tab].column[i].attr.alias+"' type='text' class='alias "+id_tab+" "+i+"'>"
		+"</div>"
        );
    }
	$J("span[rel='descrizione']").css("font-weight","bold");
});
            
$J(document).delegate(".cancella_tab","click",function(){
    id_tab=get_class(this,1);
    table[id_tab]="";
    crea_select();
    $J("#colonne").html("");
});

$J(document).delegate(".colonna","click",function(){
    id_tab=get_class(this,1);
    id_col=get_class(this,2);
    nome_col=table[id_tab].column[id_col].name;
    if(table[id_tab].column[id_col].attr.alias!=""){nome_col=table[id_tab].column[id_col].attr.alias;}
                      
    jInsertEditorText("[COL]"+nome_col+"[/COL]",'codice');
});
                   
$J(document).delegate(".operator","click",function(){
    id_tab=get_class(this,1);
    id_col=get_class(this,2);
    table[id_tab].column[id_col].attr.operator=$J(this).html();
    crea_select();
});

$J(document).delegate("#identificatore","keyup",function(){
    crea_select();
});
                   
$J(document).delegate(".cerca_per","keyup",function(){
    id_tab=get_class(this,1);
    id_col=get_class(this,2);
    table[id_tab].column[id_col].attr.search=$J(this).val();
    crea_select();
});

$J(document).delegate(".alias","keyup",function(){
    id_tab=get_class(this,1);
    id_col=get_class(this,2);
    table[id_tab].column[id_col].attr.alias=$J(this).val();
    crea_select();
});
                   
$J(document).delegate(".and_or","click",function(){
    id_tab=get_class(this,1);
    id_col=get_class(this,2);
    table[id_tab].column[id_col].attr.and_or=$J(this).html();
    crea_select();
});
                   
$J(document).delegate(".order","click",function(){
    id_tab=get_class(this,1);
    id_col=get_class(this,2);
    table[id_tab].column[id_col].attr.order=$J(this).html();
    crea_select();
});
                   
$J(document).delegate(".group","click",function(){
    id_tab=get_class(this,1);
    id_col=get_class(this,2);
                
    cek=""; if($J(this).attr('checked')){cek=1;}
    table[id_tab].column[id_col].attr.group=cek;
    crea_select();
});

function crea_join_grafiche(){

    n_tab=table.length; n_join=0;
    $J("#view_join").html("");
    for(i=0;i<n_tab;i++){
	if(table[i].column==undefined){continue;}
        n_col=table[i].column.length;
        for(j=0;j<n_col;j++){
            if(table[i].column[j].attr.apici==0){
                tab1=i; col1=j;
                   if(table[i].column[j].attr.color_join==""){table[i].column[j].attr.color_join=random_color();}
                color_join=table[i].column[j].attr.color_join;
                for(ii=0;ii<n_tab;ii++){
					if(table[ii].column==undefined){continue;}
					n_col1=table[ii].column.length;
					for(jj=0;jj<n_col1;jj++){
                   
                        if(table[ii].column[jj]!=undefined){
                            tab_p_col=table[ii].name+"."+table[ii].column[jj].name;
                   
                            if(table[i].column[j].attr.search==tab_p_col){
                                title_join=table[i].name+"."+table[i].column[j].name+"->"+table[ii].name+"."+table[ii].column[jj].name;
                                elimina_join=i+" "+j;
                                tab2=ii; ii=n_tab; col2=jj; break;
                            }
                        }
                   }
                }
                Jda=$J(".item_table_"+tab1).position();
                Ja=$J(".item_table_"+tab2).position();

                top_line=0; altezza_line=0;
                if(Jda.top>=Ja.top){top_line=Ja.top+($J(".item_table_"+tab2).height()/2); altezza_line=Jda.top-Ja.top;}
                if(Jda.top<Ja.top){top_line=Jda.top+($J(".item_table_"+tab1).height()/2); altezza_line=Ja.top-Jda.top;} 
                top_line=top_line-$J("#view_join").position().top-14;
                   
                n_join++; w_join=(n_join*30);
                $J("#view_join").append("<div style='position:absolute; border:2px solid "+color_join+"; border-left:0px solid #000; margin-top:"+top_line+"px; height:"+altezza_line+"px; width:"+w_join+"px;'><div style='position:absolute; margin:"+((altezza_line/2)-8)+"px 0 0 "+(parseInt(w_join)-7)+"px;' title='"+title_join+"' class='elimina_join "+elimina_join+"'>x</div></div>");
            }
        }
    }
}
                   
var memoria_join="";
$J(document).delegate(".join","click",function(){
    id_tab=get_class(this,1);
    id_col=get_class(this,2);
                      
    if(memoria_join==""){
        table[id_tab].column[id_col].attr.operator="=";
        table[id_tab].column[id_col].attr.apici=0;
        memoria_join=[id_tab,id_col];
    }else{
        table[memoria_join[0]].column[memoria_join[1]].attr.search=table[id_tab].name+"."+table[id_tab].column[id_col].name;
        crea_join_grafiche();
        memoria_join="";
        crea_select();
    }
});
                   
$J(document).delegate(".elimina_join","click",function(){
    id_tab=get_class(this,1);
    id_col=get_class(this,2);
    table[id_tab].column[id_col].attr.operator="";
    table[id_tab].column[id_col].attr.apici=1;
    table[id_tab].column[id_col].attr.search="";
    crea_select();
    crea_join_grafiche();
});

$J(document).delegate("*[rel='descrizione']","mouseover",function(){
	$J(this).append("<div class='display_title_desc' style='position:absolute;'>"+$J(this).attr("alt")+"</div>");
});
$J(document).delegate("*[rel='descrizione']","mouseleave",function(){
	$J(".display_title_desc").remove();
});

});
</script>
<?php endif; ?>
