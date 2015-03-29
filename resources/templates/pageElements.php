<?php

// Returns the start page jumbotron
function getStartPage()
{
    $startPage = '<div class="jumbotron start-page">

                    <h1>The Lost Caver</h1>

                    <p class="lead">
                      A Caver (someone that enjoys spelunking) has gotten lost in a cave. The Caver’s LED flash lights are all burned out.
                      Thankfully the Caver still has limited radio communication with their caving partner on the surface. Their partner knows,
                      through the magic of specialized GPS, the current coordinates of the lost Caver. The person on the surface also knows
                      the location of the exit out of the cave and will send specialized instructions down to help the lost caver navigate to
                      safety
                    </p>
          
                    <a class="btn btn-lg btn-success" href="game.php" role="button">PLAY</a>
          
                  </div>';
    return $startPage;
}

// Returns the controls for the user to control the player
function getControlPanel()
{

    $controlPanel = '<form action="game.php" method="POST"> 
                      <div class="btn-group move-controls" role="group" aria-label="...">
                        <button type="submit" class="btn btn-default" name="action" value="L" >Turn Left</button>
                        <button type="submit" class="btn btn-default" name="action" value="M" >Move Forward</button>
                        <button type="submit" class="btn btn-default" name="action" value="R" >Turn Right</button>
                      </div>
                    </form>';

    return $controlPanel;
}

?>