<!-- This is the landing page for the app -->
<?php

require_once("resources/config.php");
require_once(TEMPLATES_PATH."pageElements.php");
require_once(TEMPLATES_PATH."header.php");

echo getHeader();
?>
<body>
	<div class="container start-page">
		<?php echo getStartPage() ?>
	</div>
</body>
</html>