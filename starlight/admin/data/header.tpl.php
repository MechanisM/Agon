<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us" dir="ltr">
<head>
  <meta http-equiv="content-type" content="text/html; charset=us-ascii" />
  <meta name="robots" content="noindex, nofollow" />

  <title><?php echo $title; ?></title>
  <link href="master.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
/*<![CDATA[*/
  td.c1 {text-align: right; vertical-align: middle;}
  /*]]>*/
  </style>
</head>

<body id="page-logout" class="content">
  <table id="pagetop" cellpadding="0" cellspacing="0">
    <tr id="branding">
      <td>
        <h1 id="masthead"></h1>
      </td>

      <td id="navpop"></td>
    </tr>
    <tr id="nav-primary">
      <td align="center" class="tabs" colspan="2">
        <table cellpadding="0" cellspacing="0" align="center">
          <tr>
            <td id="messagepane"><?php echo $message; ?></td>
			<?php
				if(isset($_SESSION['ld'])):
			?>
			<td class="tabup"><a href="?do=managet" class="plain">Content</a></td>
			<!--<td class="tabdown"><a href="?do=" class="plain">Presentation</a></td>-->
			<td class="tabdown"><a href="?do=settings" class="plain">Admin</a></td>
			<?php
				endif;
			?>
            <td id="view-site" class="tabdown"><a href="<?php echo $url; ?>" class="plain" target="_blank">View Site</a></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>