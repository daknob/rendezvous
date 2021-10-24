<?php
session_start();
session_save_path(DB_DIR);

include("db.php");     // Include the database
include("conf.php");   // Settings

include("header.inc.php");
include("php/show_links.php");
include("https_check.inc.php");  // Use HTTPS exclusively

?>

<br/>
To get a copy or contribute to the development of the project visit
<a href="https://github.com/zakkak/rendezvous">
  it on GitHub
</a>.
<br/>
<br/>
To get a copy of the license click <a href="./LICENSE">here</a>.

<?php
/************* End of page *************/
echo '</div>';	// content end
include("footer.inc.html");
echo '</div>';	// container end
echo '</body></html>';
?>
