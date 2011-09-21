<?php 
/* 
	Plugin Name: KC Tools
	Plugin URI: http://krumch.com/kctools.html
	Description: Brain surgery for WEB-sites (System info, DB access and SSH over HTTP)
	Author: Krum Cheshmedjiev
	Copyright: © 2011 Krum Cheshmedjiev
	Author URI: http://krumch.com
	Version: 20110601
*/  



function kctools() {
	$thepassword="put your md5-ed password here";
	print '<style> .kcthand { cursor:pointer } </style><form name="kct" action="'.str_replace( '%7E', '~', $_SERVER['REQUEST_URI']).'" method=POST>';
	if(get_option('kctools') != md5($thepassword.$_SERVER['REMOTE_ADDR']) and (!isset($_POST['kctpassword']) or $thepassword != md5($_POST['kctpassword']))) {
		print '<br>Password: <input type="password" name="kctpassword" value="">';
	} else {
		if(get_option('kctools') != md5($thepassword.$_SERVER['REMOTE_ADDR']) and isset($_POST['kctpassword']) and $thepassword == md5($_POST['kctpassword'])) update_option('kctools', md5($thepassword.$_SERVER['REMOTE_ADDR']));
		$tab=(!isset($_POST['tab']) or ($_POST['tab'] != 'db' and $_POST['tab'] != 'ssh'))?'':$_POST['tab'];
		print '<input type="hidden" name="tab" value="'.$tab.'">';
		if($tab != $_POST['oldtab']) $_POST['query']='';
		print '<input type="hidden" name="oldtab" value="'.$tab.'"><br><div style="width:100%"><ul>';
		print '<li style="float:left;position:relative;margin-top:12px;"><img src="'.plugins_url('kctools.gif', __FILE__).'"></li>';
		print '<li class=kcthand style="float:left;position:relative;margin:10px;background-color:';
		print ($tab == '' or $tab == 'env')?'#ccc':'#eee';
		print '" onclick="document.kct.tab.value=\'env\';document.kct.submit();">&nbsp;ENV&nbsp;</li>';
		print '<li class=kcthand style="float:left;position:relative;margin:10px;background-color:';
		print ($tab == 'db')?'#ccc':'#eee';
		print '" onclick="document.kct.tab.value=\'db\';document.kct.submit();">&nbsp;DB&nbsp;</li>';
		print '<li class=kcthand style="float:left;position:relative;margin:10px;background-color:';
		print ($tab == 'ssh')?'#ccc':'#eee';
		print '" onclick="document.kct.tab.value=\'ssh\';document.kct.submit();">&nbsp;SSH&nbsp;</li></ul></div><br><br><br><div style="width:100%;">';
		switch ($tab) {
			case 'db':
				global $wpdb;
				$wpdb->show_errors();
				$tables=$wpdb->get_results('show tables', ARRAY_N);
				print "<center>";
				$tbls="<div style=\"border: 1px solid #000;width:80%;display:table-cell;\">";
				foreach($tables as $tbl) {
# $t=~s/`//g;
					$tbls.="<div style=\"float:left;margin:2px;background-color:#eee;aling:center\"><span class=kcthand onclick=\"document.kct.query.value='select * from ".$tbl[0]."';document.kct.submit();\">".$tbl[0]."</span><br><span class=kcthand onclick=\"document.kct.query.value='show columns from ".$tbl[0]."';document.kct.submit();\">cols</span></div>";
				}
				$tbls.="</ul></div>\n";
				print "$tbls<br><br><div><input name=query size=60><input type=submit></div><br>\n";
				if(isset($_POST['query']) && $_POST['query'] !== "") {
					$_POST['query']=str_replace("\\'", "'", $_POST['query']);
					$temp=$_POST['query'];
					$temp=str_replace(array('<', '>'), array('&lt;', '&gt;'), $temp);
					print "<br>Query: ".$temp."<br><br><table style=\"border:1px solid #ccc\">\n";
					$q=$wpdb->get_results($_POST['query'], ARRAY_A);
					if(!$q) {
						print "<tr><td style=\"border:1px solid #ccc\">Done</td></tr>\n";
					} else {
						print "<tr>";
						foreach ($q[0] as $key => $val) {
							print "<th style=\"border:1px solid #ccc\">$key</th>";
						}
						print "</tr>\n";
  					foreach ($q as $row) {
							print "<tr>";
							foreach($row as $j) {
								$j=str_replace('<', '&lt;', $j);
								$j=str_replace('>', '&gt;', $j);
								print "<td style=\"border:1px solid #ccc\">$j</td>";
							}
							print "</tr>\n";
						}
					}
					print "</table><br><br>\n$tbls</center>";
				}
				break;
			case 'ssh':
				if(!isset($_POST['query'])) $_POST['query']="";
				print "<input name=query size=60><br>".$_POST['query']."<br><br></center>\n";
				$temp=preg_replace('/([$&@])/', '\\$1', $_POST['query']);
				$temp=exec("$temp 2>&1", $rez);
				$out="";
				foreach($rez as $row) {
					$out.=str_replace('<', '&lt;', $row)."\n";
				}
				print "<pre>$out</pre>";
				print "<script lang=JavaScript>\ndocument.kct.query.focus();\n</script>";
				break;
			default:
				ksort($_SERVER);
				foreach($_SERVER as $keys => $values) {
					print "!$keys! -> !$values!<br>\n";
				}
				print "<br><br><br>\n";
				phpinfo();			
				break;
		}
		print "</div>";
	}
	print "</form>";
	return;
}

function kctools_activate() {
}

register_activation_hook( __FILE__, 'kctools_activate' );

function kctools_deactivate() {
	delete_option('kctools');
}

register_deactivation_hook( __FILE__, 'kctools_deactivate' );

function kctools_admin_actions() {  
	add_options_page("kctools", "<img src=\"".plugins_url('kctools.gif', __FILE__)."\"> KC Tools", 1, "kctools", "kctools");
}  

add_action('admin_menu', 'kctools_admin_actions');

?>
