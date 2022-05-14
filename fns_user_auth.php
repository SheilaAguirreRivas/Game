<?php
require_once('fns_db.php');
//-------------------------------------------------------------------------
function login($username, $password)
{
  // connect to db
  $conn = db_connect();
  if (!$conn)
    return 0;

  // check if username is unique
  $result = mysqli_query($conn,"select * from ifts5_admin 
                         where username='$username'
                         and password = '$password'");
//                         and password = password('$password')");
/*
echo ("select * from ifts_admin 
                         where username='$username'
                         and password = '$password'");
*/
  if (!$result)
     return 0;
  
  if (mysqli_num_rows($result)>0)
     return 1;
  else 
     return 0;
}
//-------------------------------------------------------------------------
function check_admin_user()
// see if somebody is logged in and notify them if not
{
  global $HTTP_SESSION_VARS;
  if (isset($_SESSION['admin_user']))
    return true;
  else
    return false;
}
//-------------------------------------------------------------------------
function change_password($username, $old_password, $new_password)
// change password for username/old_password to new_password
// return true or false
{
  // if the old password is right 
  // change their password to new_password and return true
  // else return false
  if (login($username, $old_password))
  {
    if (!($conn = db_connect()))
      return false;
    $result = mysql_query( "update dbbook_admin 
                            set password = password('$new_password')
                            where username = '$username'");
    if (!$result)
      return false;  // not changed
    else
      return true;  // changed successfully
  }
  else
    return false; // old password was wrong
}

?>
