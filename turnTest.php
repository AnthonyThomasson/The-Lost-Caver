<?php
// This is a test to check player turning

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
	$world->saveWorld();

	echo getHeader();

	echo 	'<body>
				<form action="turnTest.php" method="POST"> 
					<div class="btn-group move-controls" role="group" aria-label="...">
		                <button type="submit" class="btn btn-default" name="action" value="L" >Turn Left</button>
		                <button type="submit" class="btn btn-default" name="action" value="R" >Turn Right</button>
		            </div>
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

	if($_POST["action"] == 'L' && $world->getPlayer()->getDirection() == "W")
	{
		echo '<h2> The test was successful! </h2>
				<p> The player turned left from N to '.$world->getPlayer()->getDirection();
	}
	else if($_POST["action"] == 'R' && $world->getPlayer()->getDirection() == "E")
	{
		echo '<h2> The test was successful! </h2>
				<p> The player turned right from N to '.$world->getPlayer()->getDirection();
	}
	else
	{
		echo '<h2> The test failed! </h2>';

		if($_POST["action"] == 'R')
			echo '<p> The player turned right from N to '.$world->getPlayer()->getDirection();

		else if ($_POST["action"] == 'L')
			echo '<p> The player turned left from N to '.$world->getPlayer()->getDirection();
	}
}
?>