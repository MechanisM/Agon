<?php
	include '../config.php';
	if($_POST) {
		if(!$_POST['username'])
			$err[] = "You need to enter a username";
		if(!$_POST['password'])
			$err[] = "You need to enter an admin password";
		if(!$_POST['sname'])
			$err[] = "You need to enter a site name";
		if(!$_POST['sdesc'])
			$err[] = "You need to enter a site description";
			
		if(count($err) == 0){
			$redis->set('slight.config.name',$_POST['sname']);
			$redis->set('slight.config.desc',$_POST['sdesc']);
			
			$redis->rpush('slight.config.user',$_POST['username']);
			$redis->rpush('slight.config.user',md5($_POST['password']));
			
			$redis->set('slight.config.list',$_POST['ppp']);
			die("Installed, unless you see errors");
		} else
			echo "Errors";
			
	}
?>
<form id="form1" name="form1" method="post" action=""><table width="300" border="0">
  <tr>
    <td>Admin User</td>
    <td><label for="username"></label>
      <input type="text" name="username" id="username" /></td>
  </tr>
  <tr>
    <td>Admin Password</td>
    <td><label for="password"></label>
      <input type="text" name="password" id="password" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Site Name</td>
    <td><label for="sname"></label>
      <input type="text" name="sname" id="sname" /></td>
  </tr>
  <tr>
    <td>Site Description</td>
    <td><label for="sdesc"></label>
      <input type="text" name="sdesc" id="sdesc" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Posts per page</td>
    <td><label for="ppp"></label>
      <select name="ppp" id="ppp">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4" selected="selected">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
      </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="Submit" /></td>
  </tr>
</table>

</form>