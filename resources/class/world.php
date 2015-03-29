<?php
require_once("player.php");

// This class loads and saves the state of the world. It is also
// able to proccess user actions to manipulate world data.


class World
{
    // World data
    private $width;			// width of the world
    private $height;		// height of the world
    private $xExit;			// location on the x coordinate
    private $yExit;			// location on the y coordinate

    private $player;		// class that holds all player functions


    // Constructor for class that sets default values for all global
    // variables
    public function __construct()
    {
    	$this->width = 0;
		$this->height = 0;

		$this->xExit = 0;
		$this->yExit = 0;

		$this->player = null;
    }

    // Initializes world data from information in the config.php
	public function loadWorldFromConfig()
	{

		$this->width = WIDTH;
		$this->height = HEIGHT;

		$this->xExit = X_EXIT;
		$this->yExit = Y_EXIT;

		$this->player = new Player(DIRECTION,X_PLAYER,Y_PLAYER,"Alive");

		$this->saveWorld();
	}

	// Loads world data saved in a session
	public function loadWorldFromSession()
	{
		session_start();

		$this->width = $_SESSION["width"];
		$this->height = $_SESSION["height"];

		$this->direction = strtoupper($_SESSION["direction"]); 
		$this->xPlayer = $_SESSION["xPlayer"];
		$this->yPlayer = $_SESSION["yPlayer"];
		$this->state = $_SESSION["state"];

		$this->xExit = $_SESSION["xExit"];
		$this->yExit = $_SESSION["yExit"];

		$this->player = new Player(strtoupper($_SESSION["direction"]), 
									$_SESSION["xPlayer"],
									$_SESSION["yPlayer"], 
									$_SESSION["state"]);
	}

	// Saves the current world data in a session
	public function saveWorld()
	{

		if(!isset($_SESSION))
			session_start();

		$_SESSION["width"] = $this->width;
		$_SESSION["height"] = $this->height;

		$_SESSION["direction"] = $this->player->getDirection();
		$_SESSION["xPlayer"] = $this->player->getXPlayer();
		$_SESSION["yPlayer"] = $this->player->getYPlayer();
		$_SESSION["state"] = $this->player->getState();

		$_SESSION["xExit"] = $this->xExit;
		$_SESSION["yExit"] = $this->yExit;

	}

	// This method will process actions from the user. 'M' is a 
	// move action. 'L' is a turn left action. 'R' is a turn right
	// action
	public function processAction($action)
	{
		// Process move
		if(strtoupper($action) == 'M')
		{
			// Move player
			$this->player->movePlayer();

			// Check to see if player is dead or has exited the cave
			$this->updateState();
		}

		// Process turn
		else if (strtoupper($action) == 'L' || strtoupper($action) == 'R')
			$this->player->turnPlayer($action);

		// Save world
		$this->saveWorld();

		// Return the state of the user
		return $this->player->getState();
	}

	// This method will look to see if there has been a change in the 
	// players state. It will compare the players coordinates with the 
	// exit and boundaries
	private function updateState()
	{
		// Check to see if the player is alive
		if($this->player->getYPlayer() > 0 
			&& $this->player->getYPlayer() < $this->height
			&& $this->player->getXPlayer() > 0 
			&& $this->player->getYPlayer() < $this->width)
		{
			$this->player->setState("Alive");
		}
		else
			$this->player->setState("Dead");

		// Check to see if the player found the exit
		if($this->player->getXPlayer() == $this->xExit 
			&& $this->player->getYPlayer() == $this->yExit)
		{
			$this->player->setState("Escaped");
		}
	}

	// This will be used to find and tell the user where the exit is based 
	// on their current coordinates. The instructions given to the player
	// simulate what their caving partner would be telling them on the radio
	public function getInstruction()
	{
		$instructions = "";

		// The cave is North of the player
		if($this->player->getYPlayer() < $this->yExit 
			&& $this->player->getXPlayer() == $this->xExit)
		{
			$instructions = "The cave exit is North of your position";
		}

		// The cave is North East of the player
		else if($this->player->getYPlayer() < $this->yExit 
				&& $this->player->getXPlayer() < $this->xExit)
		{
			$instructions = "The cave exit is Northeast of your position";
		}

		// The cave is East of the player
		else if($this->player->getYPlayer() == $this->yExit 
				&& $this->player->getXPlayer() < $this->xExit)
		{
			$instructions = "The cave exit is East of your position";
		}

		// The cave is South East of the player
		else if($this->player->getYPlayer() > $this->yExit 
				&& $this->player->getXPlayer() < $this->xExit)
		{
			$instructions = "The cave exit is Southeast of your position";
		}

		// The cave is South of the player
		else if($this->player->getYPlayer() > $this->yExit 
				&& $this->player->getXPlayer() == $this->xExit)
		{
			$instructions = "The cave exit is South of your position";
		}

		// The cave is South West of the player
		else if($this->player->getYPlayer() > $this->yExit 
				&& $this->player->getXPlayer() > $this->xExit)
		{
			$instructions = "The cave exit is Southwest of your position";
		}

		// The cave is West of the player
		else if($this->player->getYPlayer() == $this->yExit 
				&& $this->player->getXPlayer() > $this->xExit)
		{
			$instructions = "The cave exit is West of your position";
		}

		// The cave is North West of the player
		else if($this->player->getYPlayer() < $this->yExit 
				&& $this->player->getXPlayer() > $this->xExit)
		{
			$instructions = "The cave exit is Northwest of your position";
		}

		return $instructions;
	}

	public function setWidth($value) { $this->width = $value; }
	public function getWidth() { return $this->width; }

	public function setHeight($value) { $this->height = $value; }
	public function getHeight() { return $this->height; }

	public function setXExit($value) { $this->xExit = $value; }
	public function getXExit() { return $this->xExit; }

	public function setYExit($value) { $this->yExit = $value; }
	public function getYExit() { return $this->yExit; }

	public function getPlayer() { return $this->player; }
	public function setPlayer($value) { $this->player = $value; }

}
?>