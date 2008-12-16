<h1>Add Publisher</h1>
<?
echo $form->create('Publisher');
echo $form->input('name');
echo $form->input("site");
echo $form->input("email");
echo $form->end('Save');
?>