<?
$enabled = Configure::read("Site.ads");
$code = false;
switch ($style) {
  case "pw-banner":
    $width = 468;
    $height = 60;
    # FIXME: probably the ad code would be nice here too.
    break;
  case "pw-square":
    $width = 125;
    $height = 125;
    break;
  case "pw-skyscraper":
    $code = '<!-- Beginning of Project Wonderful ad code: -->
    <!-- Ad box ID: 1926 -->
    <script type="text/javascript">
    <!--
    var pw_d=document;
    pw_d.projectwonderful_adbox_id = "1926";
    pw_d.projectwonderful_adbox_type = "3";
    pw_d.projectwonderful_foreground_color = "";
    pw_d.projectwonderful_background_color = "";
    //-->
    </script>
    <script type="text/javascript" src="http://www.projectwonderful.com/ad_display.js"></script>
    <noscript><map name="admap1926" id="admap1926"><area href="http://www.projectwonderful.com/out_nojs.php?r=0&amp;c=0&amp;id=1926&amp;type=3" shape="rect" coords="0,0,160,600" title="" alt="" target="_blank" /></map>
    <table cellpadding="0" border="0" cellspacing="0" width="160" bgcolor="#ffffff"><tr><td><img src="http://www.projectwonderful.com/nojs.php?id=1926&amp;type=3" width="160" height="600" usemap="#admap1926" border="0" alt="" /></td></tr><tr><td bgcolor="#ffffff" colspan="1"><center><a style="font-size:10px;color:#0000ff;text-decoration:none;line-height:1.2;font-weight:bold;font-family:Tahoma, verdana,arial,helvetica,sans-serif;text-transform: none;letter-spacing:normal;text-shadow:none;white-space:normal;word-spacing:normal;" href="http://www.projectwonderful.com/advertisehere.php?id=1926&amp;type=3" target="_blank">Ads by Project Wonderful!  Your ad here, right now: $0.06</a></center></td></tr><tr><td colspan=1 valign="top" width=160 bgcolor="#000000" style="height:3px;font-size:1px;padding:0px;max-height:3px;"></td></tr></table>
    </noscript>
    <!-- End of Project Wonderful ad code. -->';
    break;
  case "pw-leaderboard":
    $code = '<!-- Beginning of Project Wonderful ad code: -->
    <!-- Ad box ID: 38375 -->
    <script type="text/javascript">
    <!--
    var pw_d=document;
    pw_d.projectwonderful_adbox_id = "38375";
    pw_d.projectwonderful_adbox_type = "5";
    pw_d.projectwonderful_foreground_color = "";
    pw_d.projectwonderful_background_color = "";
    //-->
    </script>
    <script type="text/javascript" src="http://www.projectwonderful.com/ad_display.js"></script>
    <noscript><map name="admap38375" id="admap38375"><area href="http://www.projectwonderful.com/out_nojs.php?r=0&amp;c=0&amp;id=38375&amp;type=5" shape="rect" coords="0,0,728,90" title="" alt="" target="_blank" /></map>
    <table cellpadding="0" border="0" cellspacing="0" width="728" bgcolor="#ffffff"><tr><td><img src="http://www.projectwonderful.com/nojs.php?id=38375&amp;type=5" width="728" height="90" usemap="#admap38375" border="0" alt="" /></td></tr><tr><td bgcolor="#ffffff" colspan="1"><center><a style="font-size:10px;color:#0000ff;text-decoration:none;line-height:1.2;font-weight:bold;font-family:Tahoma, verdana,arial,helvetica,sans-serif;text-transform: none;letter-spacing:normal;text-shadow:none;white-space:normal;word-spacing:normal;" href="http://www.projectwonderful.com/advertisehere.php?id=38375&amp;type=5" target="_blank">Ads by Project Wonderful!  Your ad here, right now: $0</a></center></td></tr><tr><td colspan=1 valign="top" width=728 bgcolor="#000000" style="height:3px;font-size:1px;padding:0px;max-height:3px;"></td></tr></table>
    </noscript>
    <!-- End of Project Wonderful ad code. -->';
    break;
  case "pw-footer":
    $code = '<!-- Beginning of Project Wonderful ad code: -->
    <!-- Ad box ID: 11427 -->
    <script type="text/javascript">
    <!--
    var pw_d=document;
    pw_d.projectwonderful_adbox_id = "11427";
    pw_d.projectwonderful_adbox_type = "4";
    pw_d.projectwonderful_foreground_color = "";
    pw_d.projectwonderful_background_color = "";
    //-->
    </script>
    <script type="text/javascript" src="http://www.projectwonderful.com/ad_display.js"></script>
    <noscript><map name="admap11427" id="admap11427"><area href="http://www.projectwonderful.com/out_nojs.php?r=0&amp;c=0&amp;id=11427&amp;type=4" shape="rect" coords="0,0,125,125" title="" alt="" target="_blank" /><area href="http://www.projectwonderful.com/out_nojs.php?r=0&amp;c=1&amp;id=11427&amp;type=4" shape="rect" coords="125,0,250,125" title="" alt="" target="_blank" /><area href="http://www.projectwonderful.com/out_nojs.php?r=0&amp;c=2&amp;id=11427&amp;type=4" shape="rect" coords="250,0,375,125" title="" alt="" target="_blank" /></map>
    <table cellpadding="0" border="0" cellspacing="0" width="375" bgcolor="#ffffff"><tr><td><img src="http://www.projectwonderful.com/nojs.php?id=11427&amp;type=4" width="375" height="125" usemap="#admap11427" border="0" alt="" /></td></tr><tr><td bgcolor="#ffffff" colspan="3"><center><a style="font-size:10px;color:#0000ff;text-decoration:none;line-height:1.2;font-weight:bold;font-family:Tahoma, verdana,arial,helvetica,sans-serif;text-transform: none;letter-spacing:normal;text-shadow:none;white-space:normal;word-spacing:normal;" href="http://www.projectwonderful.com/advertisehere.php?id=11427&amp;type=4" target="_blank">Ads by Project Wonderful!  Your ad here, right now: $0.03</a></center></td></tr><tr><td colspan=3 valign="top" width=375 bgcolor="#000000" style="height:3px;font-size:1px;padding:0px;max-height:3px;"></td></tr></table>
    </noscript>
    <!-- End of Project Wonderful ad code. -->';
    break;
  case "pw-halfbanner":
    $width = 234;
    $height = 60;
    break;
  case "pw-square":
    $width = $height = 125;
    break;
  case "pw-button":
    $width = 117;
    $height = 30;
    break;
  case "pw-rectangle":
    $width = 300;
    $height = 250;
    break;
  default:
  # FIXME: if unknown style, we could take the dimensions and other options from the array...
    $width = 125;
    $height = 125;
    break;
}
if (!$code or $enabled == false) {
  if(!isset($width)) { $width = 100; }
  if(!isset($height)) { $height = 100; }
  echo "<div style=\"width: $width px;height: $height px;border:1px solid black;background-color:#C3D7FF;color:#001937;\">
  <p style=\"margin-left:auto;margin-right:auto;width: $width px\"><strong>I'm an advertisement. Fear me!<br>Seriously, there's something wrong with me. Either my code is missing or advertisements are disabled.</strong></p></div>";
} else {
  echo $code;
}
?>