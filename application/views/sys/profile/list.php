<?php echo HTML::anchor('SYS_Profile/add', 'Novo')?>
<table id="tbData">
	<tr>
		<td>Id</td>
		<td>Nome</td>
		<td>Descrição</td>
		<td>Editar</td>
		<td>Excluir</td>
	</tr>
<?php
foreach($arrData as $objItem) {
	echo '<tr>';
	echo '<td>' . $objItem->id . '</td>';
	echo '<td>' . $objItem->name . '</td>';
	echo '<td>' . $objItem->description . '</td>';
	echo '<td>' . HTML::anchor("SYS_Profile/merge/$objItem->id", 'Editar') . '</td>';
	echo '<td>' . HTML::anchor("SYS_Profile/del/$objItem->id", 'Excluir') . '</td>';
	echo '</tr>';
}
?>
</table>