<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Codeigniter MongoDB Create Read Update Delete Example</title>
	<style>
		table.datatable {
			width:100%;
			border: none;
			background:#fff;
		}
		table.datatable td.table_foot {
			border: none;
			background: #fff;
			text-align: center;
		}
		table.datatable tr.odd_col {
			background: none;
		}
		table.datatable tr.even_col {
			background: #ddd;
		}
		table.datatable td {
			font-size:10pt;
			padding:5px 10px;
			border-bottom:1px solid #ddd;
			text-align: left;
		}
		table.datatable th {
			text-align: left;
			font-size: 8pt;
			padding: 10px 10px 7px;
			text-transform: uppercase;
			color: #fff;
			background:url('../img/table/head.gif') left -5px repeat-x;
			font-family: sans-serif;
		}
	</style>
</head>
<body>

<div>
	<h1>Codeigniter MongoDB Create Read Update Delete Example</h1>

	<div>
		<?php echo anchor('/usercontroller/create', 'Create User');?>
	</div>

	<div id="body">
		<?php
		if ($users) {
			?>
			<table class="datatable">
				<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Acions</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
				foreach ($users as $user) {
					$col_class = ($i % 2 == 0 ? 'odd_col' : 'even_col');
					$i++;
					?>
					<tr class="<?php echo $col_class; ?>">
						<td>
							<?php echo $user->name; ?>
						</td>
						<td>
							<?php echo $user->email; ?>
						</td>
						<td>
							<?php echo anchor('/usercontroller/update/' . $user->_id, 'Update'); ?>

							<?php echo anchor('/usercontroller/delete/' . $user->_id, 'Delete', array('onclick' => "return confirm('Do you want delete this record')")); ?>
						</td>
					</tr>
					<?php
				}
				?>
				</tbody>
			</table>
			<?php
		} else {
			echo '<div style="color:red;"><p>No Record Found!</p></div>';
		}
		?>
	</div>
</div>

</body>
</html>
