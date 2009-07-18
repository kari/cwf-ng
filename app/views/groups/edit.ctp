<h1><?=($group["Group"]["group_id"]==1) ? "All users" : $group["Group"]["group_name"]?></h1>
<div class="yui-gc">
  <div class="yui-u first">
<h2>Group access rights</h2>
<?=$form->create("Action",array("url"=>array("controller"=>"groups","action"=>"edit",$group["Group"]["group_id"])))?>
<table> <tr><th>Object</th><th>create</th><th>read</th><th>update</th><th>delete</th><th>admin</th></tr>
<?
$ops = array("create","read","update","delete","admin");
sort($ACTIONS);
foreach ($ACTIONS as $key => $action) {
  echo "<tr><th>".$action."</th>";
  echo $form->hidden("Action.".$key.".action_id",array("value"=>$action));
  echo $form->hidden("Action.".$key.".group_id",array("value"=>$group["Group"]["group_id"]));
  if (Set::matches("/Action[action_id=".$action."]",$group)) {
    $access = Set::extract("/Action[action_id=".$action."]",$group);
    $access = $access[0]["Action"];
    echo $form->hidden("Action.".$key.".id",array("value"=>$access["id"]));
    foreach ($ops as $op) {
      if ($access[$op] == 1) {
        $checked = true;
      } else {
        $checked = false;
      }
      echo "<td>";
      echo $form->checkbox("Action.".$key.".".$op,array("label"=>"","checked"=>$checked));
      # echo "<td>".$access[$op]."</td>";
      echo "</td>";
    }
  } else {
    foreach ($ops as $op) {
      # echo "<td>no rights</td>";
      echo "<td>".$form->checkbox("Action.".$key.".".$op,array("label"=>"","checked"=>false))."</td>";
    }
  }
  echo "</tr>";
}
?>
</table>
<?=$form->end("Save")?>
</div>
<div class="yui-u">
<? if ($group["Group"]["group_id"]>1) { ?>
<p><em><?=$group["Group"]["group_description"]?></em></p><p>Moderator: <?=$html->link($group["Moderator"]["username"],array("controller"=>"users","action"=>"view",$group["Moderator"]["user_id"]))?><br>Members:
<ul>
<? 
foreach($group["User"] as $user) {
  echo "<li>".$html->link($user["username"],array("controller"=>"users","action"=>"view",$user["user_id"]))."</li>";
}
?>
</ul>
<em>Please use phpBB control panel to add/edit group memberships.</em>
</p>
<? } else { ?>
<p><em>These rights apply to all registered users.</em></p>
<? } ?>
</div>
</div>