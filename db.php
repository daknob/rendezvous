<?php

include ("txtDB/txt-db-api.php");

// create_db() creates the database if it does not exist, and initializes it
// with the Rendezvous schema. It returns true upon success, or false if there
// was an error. Please note that it prints HTML to the page when called.
function create_db()
{
  echo '<br>Please wait...<br> Creating Database:<br>';
  if (!file_exists(DB_DIR)) 		// No database directory found. Create it.
  {
    $rc=mkdir(realpath('.').'/'.DB_DIR , 0700);
    if(!$rc)
    {
      print_error_msg("Cannot create Database " . DB_DIR);
      return false;
    }
  }

  $db = new Database(ROOT_DATABASE);
  $db->executeQuery("CREATE DATABASE mydb;");
  $db = new Database("mydb");
  echo 'Creating Tables...<br>';
  $db->executeQuery("CREATE TABLE ren_sessions (ren_ses_id inc, title str, deadline int, active str);");
  $db->executeQuery("CREATE TABLE ren_periods (ren_per_id inc, ren_ses_id int, ren_start int, ren_end int, ren_length int, ren_slots int);");
  $db->executeQuery("CREATE TABLE rendezvous (ren_ses_id int, ren_per_id int, login str, ren_time int, ren_slot int, book_time int);");
  echo '&nbsp;&nbsp;&nbsp;&nbsp;  ren_sessions, ren_periods, rendezvous<br>';
  echo '<br> DONE!';

  return true;
}

// check_db() checks whether the database exists and has the appropriate file
// permissions set. If the database does not exist, it is created. If the
// permissions are wrong, an error is printed in the HTML. It returns true if
// everything is okay, or false if a problem occurred.
function check_db()
{
  if (!file_exists(DB_DIR . "mydb"))        // No database file found. Create the database.
  {
    if (!create_db())
    {
      print_error_msg("Failed to create Database " . DB_DIR);
    }
    $delay = "3"; // 3 second delay
    $url = "index.php"; // target of the redirect
    echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';
    echo '</body>';
    echo '</html>';
    return false;
  }
  if(substr(sprintf('%o', fileperms(API_HOME_DIR)), -4) != '0700')
  {         // check permissions of txtDB directory
    echo '<br> Please set permissions of database directory ';
    echo '"'.API_HOME_DIR.'" to 0700 and refresh this page!<br><br>';
    echo 'To change the permissions please execute:';
    echo '<pre>chmod 0700 '.API_HOME_DIR.'</pre>';
    echo '</body>';
    echo '</html>';
    return false;
  }
  return true;
}

// reset_db() deletes all data and removes all files from the configured
// txtDB database. It returns true upon success of the operation.
function reset_db()
{

  if (file_exists(DB_DIR . "mydb"))
  {
    echo 'Deleting Database...<br>';
    $db = new Database(ROOT_DATABASE);
    $db->executeQuery("DROP DATABASE mydb");
  }

  if (file_exists(DB_DIR . "lock.txt"))
  {
    unlink(DB_DIR . "lock.txt");
  }

  if (file_exists(DB_DIR . "log.txt"))
  {
    echo 'Deleting Log file...<br>';
    unlink(DB_DIR . "log.txt");
  }

  foreach (glob(DB_DIR.'*') as $filename)
  {
    echo 'Deleting Session Data...<br>';
    unlink($filename);
  }

  if (file_exists(DB_DIR)) {
    echo 'Deleting Database directory...<br>';
    unlink(DB_DIR);
  }

  return true;
}

?>
