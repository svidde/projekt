<?php
if ( hasAdmRole() )
{
?>
<h1>Administrative</h1>

<a href="remove">Ta bort användare</a> <br />
<a href="editNews">Editera page</a> <br />
<a href="createPage">Lägg till page</a> <br />
<?php
}
else
{
	?>
	<h1>Ej tillträde</h1>
	<p>Du måste vara inloggad och admin för att få vara här.<p>
	<?php
}
?>
