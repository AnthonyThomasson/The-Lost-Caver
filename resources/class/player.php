<?php

// This class holds the player's data, and performs movement 
// actions on the player.


class Player
{

    // Player data
    private $xPlayer;		// location on the x coordinate
    private $yPlayer;		// location on the y coordinate
    private $direction;		// direction the player is facing (N,E,S,W)
    private $state;			// this is the current state of the player (Dead, Alive, Escaped)


    // Constructor for class that sets default values for all global variables
    public function __construct($direction, $x, $y, $state)
    {
		$this->direction = $direction;
		$this->xPlayer = $x;
		$this->yPlayer = $y;
		$this->state = $state;
    }

    // This method will process a move or turn action
	public function processAction($action)
	{
		// Process move
		if(strtoupper($action) == 'M')
		{
			$this->movePlayer();
			echo "moved";
		}

		// Process turn
		else if (strtoupper($action) == 'L' || strtoupper($action) == 'R')
		{
			$this->turnPlayer($action);
			echo "turned";
		}

		// Invalid action
		else
			print_r("action Invalid: ".$action);

		// Save world
		$this->saveWorld();

		// Return the state of the user
		return $this->state;
	}

	// This method turns the player
	public function turnPlayer($direction)
	{
		// Process turn left
		if (strtoupper($direction) == 'L')
		{
			if($this->direction == 'N')
				$this->direction = 'W';

			else if($this->direction == 'E')
				$this->direction = 'N';

			else if($this->direction == 'S')
				$this->direction = 'E';

			else if($this->direction == 'W')
				$this->direction = 'S';
		}

		// Process turn right
		else if (strtoupper($direction) == 'R')
		{
			if($this->direction == 'N')
				$this->direction = 'E';

			else if($this->direction == 'E')
				$this->direction = 'S';

			else if($this->direction == 'S')
				$this->direction = 'W';

			else if($this->direction == 'W')
				$this->direction = 'N';
		}
	}

	// This method will move the player forward one point in
	// the direction they currently face
	public function movePlayer()
	{
		// Move north
		if($this->direction == 'N')
			$this->yPlayer++;

		// Move south
		if($this->direction == 'S')
			$this->yPlayer--;

		// Move east
		if($this->direction == 'E')
			$this->xPlayer++;

		// Move west
		if($this->direction == 'W')
			$this->xPlayer--;
	}

	public function setXPlayer($value) { $this->xPlayer = $value; }
	public function getXPlayer() { return $this->xPlayer; }

	public function setYPlayer($value) { $this->yPlayer = $value; }
	public function getYPlayer() { return $this->yPlayer; }

	public function setXExit($value) { $this->xExit = $value; }
	public function getXExit() { return $this->xExit; }

	public function setYExit($value) { $this->yExit = $value; }
	public function getYExit() { return $this->yExit; }

	public function setDirection($value) { $this->direction = $value; }
	public function getDirection() { return $this->direction; }

	public function setState($value) { $this->state = $value; }
	public function getState() { return $this->state; }
}
?>