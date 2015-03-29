<?php
// This is a test to check player movement

require_once("resources/config.php");
require_once(CLASS_PATH."world.php");
require_once(TEMPLATES_PATH."pageElements.php");
require_once(TEMPLATES_PATH."header.php");

// Create world object
$world = new World();

// If the user has started a new game 
if(!isset($_POST["action"]))
{
	// Set bool to new game
	$newGame = true;

	// load worlds starting data from config
	$world->loadWorldFromConfig();

	// reset player positions
	$world->getPlayer()->setDirection("N");
	$world->getPlayer()->setXPlayer(1);
	$world->getPlayer()->setYPlayer(1);
	$world->saveWorld();

	echo getHeader();

	echo 	'<body>
				<form action="moveTest.php" method="POST"> 
					<button type="submit" class="btn btn-default" name="action" value="M" >Move Forward</button>
				</form>
			</body>';
}

// If the user has made an action
else
{
	// load worlds state from session
	$world->loadWorldFromSession();

	// move player forward
	$world->processAction($_POST["action"]);

	echo getHeader();

	if($world->getPlayer()->getYPlayer() == 2)
	{
		echo '<h2> The test was successful! </h2>
				<p> The player moved from (1,1) to ('.$world->getPlayer()->getXPlayer().','.$world->getPlayer()->getYPlayer().')';
	}
	else
	{
		echo '<h2> The test failed! </h2>
				<p> The player moved from (1,1) to ('.$world->getPlayer()->getXPlayer().','.$world->getPlayer()->getYPlayer().')';
	}
}
?>