<?php

// This is the game page. This page will act as the driver 
// for all game elements.

require_once("resources/config.php");
require_once(CLASS_PATH."world.php");
require_once(TEMPLATES_PATH."pageElements.php");
require_once(TEMPLATES_PATH."header.php");

// Create world object
$world = new World();

// Set the default players state
$state = "Alive";

// Set bool to tell if the request is for a new game?
$newGame = false;

// If the user has started a new game 
if(!isset($_POST["action"]))
{
	// Set bool to new game
	$newGame = true;

	// load worlds starting data from config
	$world->loadWorldFromConfig();
}

// If the user has made an action
else
{
	// load worlds state from session
	$world->loadWorldFromSession();

	// process action
	$state = $world->processAction($_POST["action"]);
}

// Begin printing page
echo getHeader();

echo '<div class="container game-page">
		<div class="jumbotron">';

// If the player is alive display this
if($state == "Alive")
{
	echo '<h2>Cave Navigator</h2>';

	// If it is a new game print directions on how to play
	if($newGame)
		echo "<p>Follow your partner's advice to get out of the cave! </p>";

	// Determine the direction the player is facing 
	$direction = "";
	if($world->getPlayer()->getDirection() == 'N')
		$direction = "North";

	else if($world->getPlayer()->getDirection() == 'E')
		$direction = "East";

	else if($world->getPlayer()->getDirection() == 'S')
		$direction = "South";

	else if($world->getPlayer()->getDirection() == 'W')
		$direction = "West";


	// Show the last action
	if(isset($_POST["action"]) && $_POST["action"] == 'M')
		echo '<p> Moved Forward! </p>';

	if(isset($_POST["action"]) && $_POST["action"] == 'L')
		echo '<p> Turned Left! </p>';

	if(isset($_POST["action"]) && $_POST["action"] == 'R')
		echo '<p> Turned Right! </p>';

	// Print the instructions for the players next move
	echo '<p> <strong>Radio: </strong>'
			.$world->getInstruction().'. You are currently facing '
			.$direction.'</p>';

	echo getControlPanel();
}

// If the player is dead display this
else if($state == "Dead")
{
	echo "<h2>You are lost in the cave forever</h2>";
	echo '<a class="btn btn-default btn-new-game" href="game.php">New Game</a>';
}

// If the player has escaped display this
else if($state == "Escaped")
{
	echo "<h2>You have found the exit</h2>";
	echo '<a class="btn btn-default btn-new-game" href="game.php">New Game</a>';
}

echo '</div>
		</div>
			</html>';
?>