<? # View initialization
  $html->css("jquery.fancybox","stylesheet",array("media"=>"screen"),false);
  $javascript->link("/js/jquery.fancybox-1.2.1.js",false);
?>
<? # Page-specific jQuery code: 
  echo $javascript->codeBlock("$(document).ready(function() {
    $('a#ss').fancybox({
      'hideOnContentClick': true,
      'overlayShow': true,
      'overlayOpacity': 0,
      });
    });")
?>
<div class="yui-ge">
  <div class="yui-u first">
<h1>Edit Screenshot for <?=$html->link($this->data["Game"]["game_name"],array("controller"=>"games","action"=>"edit",$this->data["Game"]["game_id"]))?></h1>
<?
echo $form->create('Screenshot');
echo $html->link($site->image($this->data["Screenshot"]["image_link"],array("width"=>150,"height"=>150,"title"=>"Screenshot")),$site->image_url($this->data["Screenshot"]["image_link"]),array("title"=>$this->data["Game"]["game_name"],"id"=>"ss"),false,false);
# echo $form->input('image_link');
echo $form->input("game_id");
echo $form->input("screenshot_submitter_id",array("options"=>$screenshot_submitters,"label"=>"Submitter"));
echo $form->end('Save');
echo $html->link("Delete",array("action"=>"delete",$this->data["Screenshot"]["screenshot_id"]),array("class"=>"delete button"),"Proceed with delete?");
?>
 </div>
  <div class="yui-u">
    <!-- right bar -->
    <?=$this->element("spotlight",array("game_id"=>$this->data["Game"]["game_id"],"cache"=>array("key"=>$this->data["Game"]["game_id"],"time"=>"+1 day")));?> 
  </div>
</div>