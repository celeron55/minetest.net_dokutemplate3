<?php

if (!defined('DOKU_INC')) die();

if (!defined('H6E_CSS')) {
  if (file_exists(dirname(__FILE__) . '/css')) {
    define('H6E_CSS', DOKU_URL . 'lib/tpl/minetest3');
  } else {
    //define('H6E_CSS', 'http://h6e.net/css');
	die("Stylesheets missing");
  }
}

if (empty($_REQUEST['do']) || in_array($_REQUEST['do'], array('revisions', 'show', 'edit'))) {
    $page_type = 'content-page';
} else {
    $page_type = 'do-page';
}

$logged_in = !empty($_SERVER['REMOTE_USER']);

$htmltitle = strip_tags($conf['title']);
if ($ID != "start"){$htmltitle = ucfirst($ID) . " - " . $htmltitle;}
    $htmltitle = str_replace("_", " ", $htmltitle); 

//allow HTML for some pages
if ($ID == 'support') {$conf['htmlok'] = true;} // Old donate page
if ($ID == 'donate') {$conf['htmlok'] = true;}
if ($ID == 'servers') {$conf['htmlok'] = true;}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>"
 lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction']?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo $htmltitle; ?></title>

  <link rel="stylesheet" media="screen" href="<?php echo H6E_CSS ?>/css/h6e-minimal.css" />

  <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
  <?php tpl_metaheaders() ?>
  
  <style type="text/css">
  <?php if (tpl_getConf('width') != 'auto') : ?>
  .h6e-main-content {
      width:<?php echo tpl_getConf('width') ?>;
      padding-left:2.5em;
      padding-right:2.5em;
  }
  <?php endif ?>
  .h6e-post-content {
      font-size:<?php echo tpl_getConf('font-size') ?>;
  }
  .h6e-entry-title, .h6e-entry-title a, .h6e-entry-title a:visited, .do-page h1, .content-page h2 {
      color:<?php echo tpl_getConf('title-color') ?>;
  }
  </style>

</head>

<body>

<div class="dokuwiki">

	<?php include dirname(__FILE__) . '/top.php' ?>
	<div class="h6e-main-wrapper"<?php if($logged_in) {echo "style=\"position:relative; z-index:2;\"";}?>>
		<?php
			$nav_pre = "./doku.php?id=";
			if ($conf['userewrite'] == 1)
				$nav_pre = "./";
		?>
		<div id='menu'>
			<ul>
				<li style="float:left; margin-left:16px; background:none;"><a href="./" style="background:none; margin:0; padding:0; border:0;"><img src="<?php echo H6E_CSS ?>/images/minetest-icon-60.png" /></a></li>
				<li><a href='./'>Home</a></li>
				<li>
					<a href='<?php echo $nav_pre; ?>download'>Download</a>
					<ul>
					<li><a href='<?php echo $nav_pre; ?>screenshots' class='sub'>Screenshots</a></li>
					</ul>
				</li>
				<li>
					<a href='<?php echo $nav_pre; ?>customize'>Customize</a>
					<ul>
					<li><a href='<?php echo $nav_pre; ?>subgames' class='sub'>Subgames</a></li>
					<li><a href='<?php echo $nav_pre; ?>mods' class='sub'>Mods</a></li>
					<li><a href='<?php echo $nav_pre; ?>texturepacks' class='sub'>Texture Packs</a></li>
					<li><a href='http://forum.minetest.net/viewforum.php?f=48' class='sub_ex'>Forum: Subgames</a></li>
					<li><a href='http://forum.minetest.net/viewforum.php?f=46' class='sub_ex'>Forum: Mods</a></li>
					<li><a href='http://forum.minetest.net/viewforum.php?f=4' class='sub_ex'>Forum: Texture Packs</a></li>
					</ul>
				</li>
				<li>
					<a href='<?php echo $nav_pre; ?>community'>Community</a>
					<ul>
					<li><a href='<?php echo $nav_pre; ?>community' class='sub'>Overview</a></li>
					<li><a href='http://forum.minetest.net/' class='sub_ex'>Forum</a></li>
					<li><a href='http://wiki.minetest.net/' class='sub_ex'>Wiki</a></li>
					<li><a href='<?php echo $nav_pre; ?>irc' class='sub'>IRC</a></li>
					<li><a href='<?php echo $nav_pre; ?>contributors' class='sub'>Contributors</a></li>
					<li><a href='<?php echo $nav_pre; ?>servers' class='sub'>Servers</a></li>
					</ul>
				</li>
				<li>
					<a href='<?php echo $nav_pre; ?>development'>Development</a>
					<ul>
					<li><a href='<?php echo $nav_pre; ?>development' class='sub'>Overview</a></li>
					<li><a href='<?php echo $nav_pre; ?>reporting_issues' class='sub'>Reporting issues</a></li>
					<li><a href='<?php echo $nav_pre; ?>donate' class='sub'>Donate</a></li>
					<li><a href='https://github.com/minetest/' class='sub_ex'>Github</a></li>
					<li><a href='http://dev.minetest.net/Main_Page' class='sub_ex'>Developer Wiki</a></li>
					<li><a href='http://dev.minetest.net/Intro' class='sub_ex'>API</a></li>
					<li><a href='http://c55.me/blog' class='sub_ex'>Blog</a></li>
					</ul>
				</li>
				<!--<li>
					<a href='<?php echo $nav_pre; ?>screenshots'>Screenshots</a>
				</li>-->
			</ul>
		</div>
		<div class="<?php echo $page_type ?> h6e-main-content">

		<?php if($ID === "start"){ ?>
			<div style="width:100%; height:342px; background-image:url(<?php echo H6E_CSS ?>/images/main_screenshot.jpg); margin-left:-2.5em;padding-right:5em; margin-bottom:2.5em;">
			</div>
		<?php } ?>	

		<?php if(0/*$ID !== "start"*/){ ?>
			<h1 class="h6e-page-title small">
				<?php tpl_link(wl(),$conf['title'],'name="dokuwiki__top" id="dokuwiki__top" accesskey="h" title="[ALT+H]"') ?>
				<img src="<?php echo H6E_CSS ?>/images/minetest-icon-60.png" class="small_logo" />
			</h1>
		<?php } ?>

		<?php if (!tpl_getConf('hide-entry-title')){?>
			<h2 class="h6e-entry-title">
			<?php
				$tab_title = ucfirst(hsc($ID));
				$tab_title = str_replace("_", " ", $tab_title); 
				if ($ID == 'start') {$tab_title = "Minetest";}
				if ($ID == 'irc') {$tab_title = strtoupper($ID);}
				if ($ID == 'texturepacks') {$tab_title = "Texture Packs";}
				tpl_pagetitle($tab_title)
				?>
		    </h2>
		<?php }?>

		<?php if($conf['breadcrumbs']){?>
		<div class="breadcrumbs">
		<?php tpl_breadcrumbs() ?>
		</div>
    </div>
    <?php }?>

    <?php if($conf['youarehere']){?>
    <div class="breadcrumbs">
      <?php tpl_youarehere() ?>
    </div>
    <?php }?>

    <div id="wikipage" class="h6e-post-content">
        <?php tpl_content()?>
    </div>

<?php
if($logged_in){
?>
    <div class="pageinfo">
        <?php tpl_pageinfo()?>
    </div>

    <div class="actions actions-page">
        <?php tpl_button('edit')?>
        <?php tpl_button('history')?>
        <?php tpl_button('revert')?>
        <?php tpl_button('backlink')?>
    </div>
<?php
} // $logged_in
?>

    <div class="h6e-simple-footer">

<?php
if($logged_in){
?>
      <div class="actions actions-site">
          <div class="a">
              <?php tpl_button('recent')?>
              <?php tpl_button('index')?>
          </div>
          <div class="b">
              <?php tpl_searchform() ?>
          </div>
      </div>
<?php
} // $logged_in
?>
      <p class="loginlink"><?php tpl_actionlink('login'); ?></p>
      <p><?php echo tpl_getConf('footer-text') ?></p>

    </div>

  </div>

</div>

<div class="no"><?php /* provide DokuWiki housekeeping, required in all templates */ tpl_indexerWebBug()?></div>

</body>
</html>
