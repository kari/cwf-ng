<h1><?=$blog['Blog']['title']?></h1>
<p>Created by <?=$blog['User']['username']?> at <?=$time->format("d.m.Y H:i",$blog['Blog']['created'])?></p>
<p><?=$bbcode->decode($blog['Blog']['content'])?></p>