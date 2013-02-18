<?php
	$ch = curl_init("http://freelance.ru/");
	curl_setopt($ch , CURLOPT_RETURNTRANSFER , 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.4) Gecko/2008102920 AdCentriaIM/1.7 Firefox/3.6");
	$html = curl_exec($ch);
	/*$html = iconv("windows-1251", "utf-8", $html);
	$html = stristr($html, 'id="s_projects"');
	if ($bpos = stripos($html, '<div class="proj public"')) {
		$html = substr($html, stripos('<div class="proj public"') + 24);
		echo $html;
	}*/
	$doc = new DOMDocument();
	$doc->loadHTML($html);
	$projectsDiv = $doc->getElementById('s_projects');
	$pcd = $projectsDiv->childNodes;
	$node = $pcd[1];
	$divs = $node->getElementsByTagName('div');
	$l = 0;
	foreach ($divs as $div) {
		$attributes = $div->attributes;
		for($i = 0; $i < $attributes->length; $i++) {
			if ($attributes->item($i)->name == 'class' && $attributes->item($i)->value == 'proj public') {
				$l++;
			}
		}
	}
	echo $l;
?>