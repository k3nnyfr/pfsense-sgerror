<?php
function get_error_page($er_code_id, $err_msg='') {
        global $err_code;
        global $cl;
        global $g;
        global $config;
        $str = Array();

        header("HTTP/1.1 " . $err_code[$er_code_id]);
			$str[] = '<html>';
			$str[] = '<head>';
			$str[] = '<meta charset="utf-8" />';
			$str[] = '<title>pfSense - Filtrage Internet College Saint-Jacques</title>';
			$str[] = '<link rel="stylesheet" href="style.css" type="text/css">';
			$str[] = '<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">';
			$str[] = '</head>';
			$str[] = '<body>';
			$str[] = '<div class="header">';
			$str[] = '		<h1>Accès Refusé</h1>';
			$str[] = '</div>';
			$str[] = '<div class="content">';
			$str[] = '<p class="pcontent">Le site que vous avez demandé est inaccessible depuis le réseau pédagogique de l&#039établissement.</p>';
			$str[] = '<img id="interdit" src="http://'. $_SERVER['HTTP_HOST'] .'/interdit.png" alt="Logo" width="250px" />';
			$str[] = '<p class="pcontent">Nous vous rappelons qu&#039au sein de l&#039établissement l&#039usage de l&#039accès internet est réservé à des activités pédagogiques.</p>';
			$str[] = '<div class="details">';

	if ($config['installedpackages']['squidguarddefault']['config'][0]['deniedmessage']) {
		$str[] = "<h3>{$config['installedpackages']['squidguarddefault']['config'][0]['deniedmessage']}: {$err_code[$er_code_id]}</h3>";
	} else {
		$str[] = "<h3>Requête rejetée par {$g['product_name']} : {$err_code[$er_code_id]}</h3>";
	}
			if ($cl['a'])        $str[] = "<p><span class=\"list\">Client address:  </span> {$cl['a']} </p>";
			if ($cl['n'])        $str[] = "<p><span class=\"list\">Client name:     </span> {$cl['n']} </p>";
			if ($cl['i'])        $str[] = "<p><span class=\"list\">Client user:     </span> {$cl['i']} </p>";
			if ($cl['u'])        $str[] = "<p><span class=\"list\"> URL:            </span> {$cl['u']} </p>";
			if ($cl['s'])        $str[] = "<p><span class=\"list\"> Client group:   </span> {$cl['s']} </p>";
			if ($cl['t'])        $str[] = "<p><span class=\"list\"> Target group:   </span> {$cl['t']} </p>";
			$str[] = '</div>';
			$str[] = '<img id="pf" src="pflogo.svg" alt="logo pfsense" width="150px" />';
			$str[] = '</div>';
			$str[] = '</body>';
		$str[] = '</html>';

        return implode("\n", $str);
}
?>