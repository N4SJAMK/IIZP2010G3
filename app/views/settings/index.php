<table data-pseudo-content="Table of admins">
<thead>
<tr>
<td>Email</td><td>Actions</td>
</tr>
</thead>
<?php

foreach($data["userlist"] as $user){
	echo "<tr data-userid=\"".$user["_id"]."\" data-adminid=\"".$user["adminid"]."\">".
	"<td>".$user["email"]."</td>".
	"<td><a class=\"fa fa-key actionChangePassword\" title=\"Change password\"></a><a class=\"actionDeleteAdmin fa fa-trash-o\" data-id=\"".$user["adminid"]."\" title=\"Remove\"></a></td>".
	"</tr>";
}

?>
</table>

<div class="tableActions">
	<button class="actionAddAdmin">
		Add admin
	</button>
</div>

<h2>Database</h2>
<p>This will back up the database into the path defined in <span class="code">PATH_DB_BACKUP</span> in <span class="code">app/settings.php</span> which is now <span class="code"><?php echo $data["backuppath"]; ?></span>. Each back-up will have its own sub directory in this directory. Make sure permissions are set correctly.</p>
<button class="actionBackUpNow">
	Back-up now
</button>