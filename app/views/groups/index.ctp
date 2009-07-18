<h1>Groups</h1>
<ul>
  <li><?=$html->link("All users",array("action"=>"edit",1))?><br>
    All registered users.</li>
<? 
foreach($groups as $group) {
  echo "<li>".$html->link($group["Group"]["group_name"],array("action"=>"edit",$group["Group"]["group_id"]))."<br>".$group["Group"]["group_description"]."</li>";
}
?>
</ul>