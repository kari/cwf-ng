<?
switch ($style) {
  case "pw-banner":
    $width = 468;
    $height = 60;
    # probably code would be nice too.
    break;
  case "pw-square":
    $width = 125;
    $height = 125;
    break;
  case "pw-skyscraper":
    $width = 160;
    $height = 600;
    break;
  case "pw-leaderboard":
    $width = 728;
    $height = 90;
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
  # if unknown style, we could take the dimensions and other options from the array...
    $width = 125;
    $height = 125;
    break;
}
?>
<div style="width:<?=$width?>px;height:<?=$height?>px;border:1px solid black;background-color:#C3D7FF;color:#001937;">
<p style="margin-left:auto;margin-right:auto;width:<?=$width?>px"><strong>I'm an advertisement. Fear me. I'm <?=$style?>.</strong></p>
</div>