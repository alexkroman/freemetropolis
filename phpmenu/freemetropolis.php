<?php include('includes/conf.php');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title><?php echo $title; ?> - freemetropolis portland</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="description" content="<?php echo $mission; ?>" />
<meta name="keywords" content="portland, hawthorne, belmont, music, punk, blog, diary, events, listings, citysearch" />
<meta name="rating" content="General" />
<meta name="ROBOTS" content="All" />
<meta name="revisit-after" content="14 days" />

<?php echo drupal_get_html_head(); ?>

<link rel="stylesheet" type="text/css" href="css/text.css" />
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="StyleSheet" href="phpmenu/layersmenu-keramik.css" type="text/css"></link>

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>

<script language="JavaScript" type="text/javascript">
<!--
<?php include ($myDirPath . "libjs/layersmenu-browser_detection.js"); ?>
// -->
</script>
<script language="JavaScript" type="text/javascript" src="<?php print $myWwwPath; ?>libjs/layersmenu-library.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php print $myWwwPath; ?>libjs/layersmenu.js"></script>

<?php
include ($myDirPath . "lib/PHPLIB.php");
include ($myDirPath . "lib/layersmenu-common.inc.php");
include ($myDirPath . "lib/layersmenu.inc.php");

$mid = new LayersMenu(3, 8, 1, 1);	// Keramik-like

/* TO USE ABSOLUTE PATHS: */
$mid->setDirroot($myDirPath);
$mid->setLibjsdir($myDirPath . "libjs/");
$mid->setImgdir($myDirPath . "images/");
$mid->setImgwww($myWwwPath . "images/");
$mid->setTpldir($myDirPath . "templates/");
$mid->setHorizontalMenuTpl("layersmenu-horizontal_menu.ihtml");
$mid->setSubMenuTpl("layersmenu-sub_menu.ihtml");

$mid->setMenuStructureFile("$base_url/menu.php");

$mid->parseStructureForMenu("hormenu1");
$mid->newHorizontalMenu("hormenu1");

$mid->printHeader();
?>
<!-- End Preload Script -->
</head>

<body onload="MM_preloadImages('images/nav_search-over.gif','images/nav_home-over.gif','images/nav_bars-over.gif','images/nav_restaurants-over.gif','images/nav_events-over.gif','images/nav_add-listing-over.gif','images/nav_whats-new-over.gif','images/nav_forum-over.gif')">
<div id="main-container">
	<div id="layout-top">
		<img src="images/layout_top.gif" width="801" height="4" alt="" />
	</div>
	<div id="freemetrop-title">
		<a href="<?=$base_url;?>"><img src="images/freemetrop_title.gif" width="280" height="34" alt="" border="0" /></a>
	</div>
	<div id="title-rt">
		<img src="images/title_rt.gif" width="7" height="78" alt="" />
	</div>
	<div id="banner-ad-area" class="bodytext"><img src="images/freemet_ad.gif" alt="ad" border="0" /></div>
	<div id="dot-line-rt">
		<img src="images/dot-line-rt.gif" width="22" height="596" alt="" />
	</div>
	<div id="layout-far-rt-bar">
		<img src="images/layout_far_rt_bar.gif" width="22" height="596" alt="" />
	</div>
	<div id="city-name" class="city">Portland
	</div>
	<div id="primary-nav-blk-line-top">
		<img src="images/primary_nav_blk_line_top.gif" width="757" height="1" alt="" />
	</div>
<form method="post" action="<?=$base_url;?>/?q=search">
	<div id="search-box" style="background-image: url(images/search_box.gif);">
	<input type="text" id="keys" name="keys" value="<?php echo $_REQUEST[keys];?>" size="18" title="Type your search terms here." />
  </div>
	<div id="primary-nav">
		<input type="image" src="images/nav_search.gif" alt="" name="search" /><img src="images/primary_nav_spacer_lft.gif" width="6" height="31" alt="" /><?php
 $mid->printMenu("hormenu1");
?><img src="images/primary_nav_rt.gif" width="8" height="31" alt="" /> 
</div>
</form>
<?php
   //$mid->printFooter();
?>