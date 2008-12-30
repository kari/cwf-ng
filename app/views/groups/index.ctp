<h1>Groups</h1>
<ul>
<? 
foreach($groups as $group) {
  echo "<li>".$html->link($group["Group"]["group_name"],array("action"=>"edit",$group["Group"]["group_id"]))."<br>".$group["Group"]["group_description"]."</li>";
}
?>
</ul>