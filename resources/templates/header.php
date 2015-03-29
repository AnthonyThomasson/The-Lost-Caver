<?php

// This is the template for the default header

function getHeader()
{
    $header = '<!DOCTYPE html>
				<html lang="en">
  				<head>
    				<meta charset="utf-8">
    				<meta http-equiv="X-UA-Compatible" content="IE=edge">
    				<meta name="viewport" content="width=device-width, initial-scale=1">
    
    				<title>The Lost Caver</title>

				    <!-- Bootstrap - compiled and minified CSS-->
				    <link rel="stylesheet" href="'.BOOTSTRAP.'">

				    <!-- Custom CSS -->
				    <link rel="stylesheet" href="'.CSS_PATH.'custom.css">

  				</head>';
    return $header;
}
?>