<?php$nouveau_password = 'azerty';$user_id = 4489;$db['default']['hostname'] = 'mywittygames.cbcdvav5ui8j.eu-west-1.rds.amazonaws.com';$db['default']['username'] = 'mywittygames';$db['default']['password'] = 'mysql1105*';$db['default']['database'] = 'witty_dev';//Connexion à la base$connexion = mysql_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password']);if (!$connexion) die('Could not connect: ' . mysql_error());mysql_select_db($db['default']['database']);//Récupération des flux$requete = "select salt from user where id = ".$user_id;$resultat = mysql_query($requete);if($row = mysql_fetch_assoc($resultat)){echo 'Nouveau password: ';print_r($nouveau_password);echo "\n";echo 'Salt: ';print_r($row['salt']);echo "\n";		$new_password = crypt(md5($nouveau_password), '$2y$07$'.$row['salt'].'$');	echo 'Password encrypté: ';print_r($new_password);echo "\n";	$requete = "update user set password = '".$new_password."' where id = ".$user_id;	echo 'Requete: ';print_r($requete);echo "\n";	print_r(mysql_query($requete));echo "\n";		echo 'ok';}else	echo 'probleme';?>