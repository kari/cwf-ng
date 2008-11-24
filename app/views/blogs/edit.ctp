<?
$html->css("http://ajax.googleapis.com/ajax/libs/yui/2.6.0/build/assets/skins/sam/skin.css","stylesheet",array("media"=>"screen"),false);
$javascript->link("http://yui.yahooapis.com/combo?2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&2.6.0/build/container/container_core-min.js&2.6.0/build/menu/menu-min.js&2.6.0/build/element/element-beta-min.js&2.6.0/build/button/button-min.js&2.6.0/build/editor/editor-min.js",false);
# $javascript->link("/js/yuiloader.js",false); # FIXME: Dynamic loading needs to be done in an order.
?>

<h1>Edit Post</h1>
<?php
	echo $form->create('Blog', array('action' => 'edit'));
	echo $form->input('title');
	echo $form->input('content', array("label"=>"",'rows' => '10',"div"=>"yui-skin-sam","value"=>$this->data["Blog"]["content"]));
  echo $form->input('id', array('type'=>'hidden'));
  echo $form->input('user_id', array('type'=>'hidden','value'=>'65'));
	echo $form->end('Save Post');
?>
<script type="text/javascript">
var myEditor = new YAHOO.widget.Editor('xBlogContent', {
    height: '300px',
    width: '550px',
    handleSubmit: true,
    toolbar: {
      titlebar: "Content",
      buttons: [
          { group: 'textstyle', label: 'Font Style',
              buttons: [
                  { type: 'push', label: 'Bold CTRL + SHIFT + B', value: 'bold' },
                  { type: 'push', label: 'Italic CTRL + SHIFT + I', value: 'italic' },
                  { type: 'push', label: 'Underline CTRL + SHIFT + U', value: 'underline' },
                  { type: 'separator' },
                  { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                  { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true }
              ]
          },
          { type: 'separator' },
          { group: 'indentlist', label: 'Lists',
              buttons: [
                  { type: 'push', label: 'Create an Unordered List', value: 'insertunorderedlist' },
                  { type: 'push', label: 'Create an Ordered List', value: 'insertorderedlist' }
              ]
          },
          { type: 'separator' },
          { group: 'insertitem', label: 'Insert Item',
              buttons: [
                  { type: 'push', label: 'HTML Link CTRL + SHIFT + L', value: 'createlink', disabled: true },
                  { type: 'push', label: 'Insert Image', value: 'insertimage' }
              ]
          }
        ]
    }
});
myEditor.on('cleanHTML', function(e) {
        var html = e.html;
        
        html = html.replace(/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/gi,"[url=$1]$2[/url]");
        html = html.replace(/<span style=\"color: ?(.*?);\">(.*?)<\/span>/gi,"[color=$1]$2[/color]");
        html = html.replace(/<font.*?color=\"(.*?)\".*?>(.*?)<\/font>/gi,"[color=$1]$2[/color]");
        html = html.replace(/<span style=\"font-size:(.*?);\">(.*?)<\/span>/gi,"[size=$1]$2[/size]");
        html = html.replace(/<span style=\"font-family:(.*?);\">(.*?)<\/span>/gi,"[font=$1]$2[/font]");
        html = html.replace(/<span  style=\"font-family:(.*?);\">(.*?)<\/span>/gi,"[font=$1]$2[/font]");
        html = html.replace(/<font>(.*?)<\/font>/gi,"$1");
        html = html.replace(/<img.*?src=\"(.*?)\".*?>/gi,"[img]$1[/img]");
        html = html.replace(/<img.*?src=\"(.*?)\".*?\/>/gi,"[img]$1[/img]");

        html = html.replace(/<\/li>/gi,"");
        html = html.replace(/<li>/gi,"[*]");
        html = html.replace(/<ul>/gi,"[list]");
        html = html.replace(/<\/ul>/gi,"[/list]");
        html = html.replace(/<ol>/gi,"[list type=A]");
        html = html.replace(/<\/ol>/gi,"[/list]");

        html = html.replace(/<\/(strong|b)>/gi,"[/b]");
        html = html.replace(/<(strong|b).*?>/gi,"[b]");
        html = html.replace(/<\/(em|i)>/gi,"[/i]");
        html = html.replace(/<(em|i).*?>/gi,"[i]");
        html = html.replace(/<\/u>/gi,"[/u]");
        html = html.replace(/<span style=\"text-decoration: ?underline;\">(.*?)<\/span>/gi,"[u]$1[/u]");
        html = html.replace(/<span style=\"font-weight: ?bold;\">(.*?)<\/span>/gi,"[b]$1[/b]");
        html = html.replace(/<u.*?>/gi,"[u]");
        html = html.replace(/<blockquote[^>]*>/gi,"[quote]");
        html = html.replace(/<\/blockquote>/gi,"[/quote]");

        html = html.replace(/<br \/>/gi,"\n");
        html = html.replace(/<br\/>/gi,"\n");
        html = html.replace(/<br>/gi,"\n");
        html = html.replace(/<p.*?>/gi,"");
        html = html.replace(/<\/p>/gi,"\n");
        html = html.replace(/&nbsp;/gi," ");
        html = html.replace(/&quot;/gi,"\"");
        html = html.replace(/&lt;/gi,"<");
        html = html.replace(/&gt;/gi,">");
        html = html.replace(/&amp;/gi,"&");

        // out.value = html;
        e.html = html;
},this,true);
myEditor.render();
</script>