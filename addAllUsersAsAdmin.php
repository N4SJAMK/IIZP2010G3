<?php

if(isset($_POST["seriousAsFuck"])){
	# yhteys
	$mongo = new MongoClient("mongodb://localhost:27017/teamboard-dev");
	$database = $mongo->selectDB("teamboard-dev");

	# collectionit joita käytetään
	$admins = $database->admins;
	$users = $database->users;

	# poistaa admin merkinnät
	$admins->remove();

	# käyttäjälista
	$userlist = $users->find();

	# lisää käyttäjät admin listaan
	foreach($userlist as $user){
		$admins->insert(array(
			"userid"=>$user["_id"]
		));
	}

	echo "Well, we did it. You can now <a href=\"public/home\">login as admin</a>";
}else{
	echo "<form method=\"POST\">
	<p>This will empty the admins collection and re-add all currently created users as admins. You serious, matey?</p>
	<input type=\"submit\" name=\"seriousAsFuck\" value=\"Yeah, do it\">
	</form>";
}

?>