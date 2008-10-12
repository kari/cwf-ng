<h1>Games</h1>
<p><?php echo $html->link('Add Game', '/blogs/add'); ?></p>
<table>
	<tr>
		<th>Title</th>
    <th>Actions</th>
	</tr>

<!-- Here's where we loop through our $games array, printing out blog info -->

	<?php foreach ($games as $game): ?>
	<tr>
		<td>
		<?php echo $html->link($game['Game']['game_name'], '/games/view/'.$game['Game']['game_id']);?>
		</td>
		<td>
		<?php echo $html->link('Delete', "/games/delete/{$game['Game']['game_id']}", null, 'Are you sure?' )?>
		<?php echo $html->link('Edit', '/games/edit/'.$game['Game']['game_id']);?>
		</td>
	</tr>
	<?php endforeach; ?>

</table>

<?=$paginator->prev('« Previous ', null, null, array('class' => 'disabled'));?>&nbsp;
<!-- Shows the page numbers -->
<?php echo $paginator->numbers(); ?>&nbsp;
<!-- Shows the next and previous links -->
<?php	
	echo $paginator->next(' Next »', null, null, array('class' => 'disabled'));
?> 
<!-- prints X of Y, where X is current page and Y is number of pages -->
&nbsp;<?php echo $paginator->counter(); ?>