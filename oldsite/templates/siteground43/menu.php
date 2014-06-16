	<div class="menuc">
		<div id="topnavi">
			<ul id="mainlevel-nav">
			<?php
				$item_id = mysql_escape_string( $_GET['Itemid'] );
				$qry = "SELECT id, name, link FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering";
				$database->setQuery($qry);
				$rows = $database->loadObjectList();
				foreach($rows as $row) {
					echo "<li><a href='$row->link&Itemid=$row->id' ".( $row->id == $item_id ? "class='current'" : "" )." ><span>$row->name</span></a></li>";
				}
			?>
			</ul>
		</div>		
	</div>