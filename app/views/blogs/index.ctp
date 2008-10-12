<h1>Blog posts</h1>
<p><?php echo $html->link('Add Blog', '/blogs/add'); ?></p>
<table>
	<tr>
		<th>Id</th>
		<th>Title</th>
                <th>Actions</th>
		<th>Created</th>
	</tr>

<!-- Here's where we loop through our $blogs array, printing out blog info -->

	<?php foreach ($blogs as $blog): ?>
	<tr>
		<td><?php echo $blog['Blog']['entry_id']; ?></td>
		<td>
		<?php echo $html->link($blog['Blog']['title'], '/blogs/view/'.$blog['Blog']['entry_id']);?>
		</td>
		<td>
		<?php echo $html->link('Delete', "/blogs/delete/{$blog['Blog']['entry_id']}", null, 'Are you sure?' )?>
		<?php echo $html->link('Edit', '/blogs/edit/'.$blog['Blog']['entry_id']);?>
		</td>
		<td><?php echo $blog['Blog']['created']; ?></td>
	</tr>
	<?php endforeach; ?>

</table>