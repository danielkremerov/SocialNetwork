<?php
include("functions/user_verification.php");
include("functions/friends_functions.php");

// Database defaults - has to be set for the instance of MySQL
$host = "localhost";
$username = "root";
$password = "root";
$table = "collab";

// Find the this script's name and it is used to POST to itself
$filename = $_SERVER['PHP_SELF'];

$firstName  = $_SESSION['loggedInFirstName'];
$lastName   = $_SESSION['loggedInLastName'];
$email 		= $_SESSION['loggedInEmail'];

$thisuserid = 0;

// Find userID for this user in the session
	$link0 = mysqli_connect($host,$username,$password,$table) or die ("Connection failed");

	if ($link0->connect_error) {
	    die("connection failed:" . $link0->connect_error);
	    echo "Connection failed for localhost link1";
	}

/*

// Start from new - delete all text from 'matching' table
   	//$sql = "SELECT * FROM user WHERE user.userID='$profileuserID'";
		$sql = "SELECT * FROM user WHERE user.userID='$profileuserID'";
		//$sql = "select userID from user where emailAddress = '$email' or (firstName = '$firstName' and lastName='$lastName')";
	$result = mysqli_query($link0,$sql);

	if ($result->num_rows > 0 ) {
	    while ($row = $result->fetch_assoc()) {
	    	$thisuserid = $row["userID"];
	    }
    } else {
	    echo "<BR>Error " . $sql . " : " . $link0->error;
	}

	$link0->close();
	*/

	$thisuserid = $_SESSION['loggedInUserID'];
	//echo $thisuserid;
//echo $thisuserid;

// Get the arguments from the link, this is the form of linked pairs
$fx=$_GET['func'];
// $res_html is the result HTML variable which is printed within the HTML below - this will be a formatted
// HTML text with tags etc
$res_html = "";

// Establish what function is required by the argument 'func' embedded in the link

// func=creategroups so we want to creategroups
if ($fx == "creategroups") {
   //	echo "Found creategroups<BR>";
// Connect to MySQL
	$link1 = mysqli_connect($host,$username,$password,$table) or die ("Connection failed");

// Is connection valid?
	if ($link1->connect_error) {
	    die("connection failed:" . $link1->connect_error);
	    echo "Connection failed for localhost link1";
	}

// Start from new - delete all text from 'matching' table
   	$sql = "delete from matching";
	if ($link1->query($sql) === TRUE) {
   //	    echo "Matching table cleared<BR>";
	} else {
	    echo "<BR>Error " . $sqlinsert . " : " . $link1->error;
	}

   	$link2 = mysqli_connect($host,$username,$password,$table) or die ("Connection failed");
	if ($link2->connect_error) {
	    die("connection failed:" . $link2->connect_error);
	    echo "Connection failed for localhost link2";
	}

// get all the message data associated with every user (we can use the blogpost too with a UNION)
	$sql = "SELECT userid,messagecontent FROM messages";
	$result = mysqli_query($link2,$sql);
	$sqlinsert = "";
	$userid = 0;

    $counter = 1;

// go through every message (or blog) and split sentences into words, then add each word as a row
// into a table
    if ($result->num_rows > 0 ) {
	    while ($row = $result->fetch_assoc()) {

// split the message by space, \n or \t into an array with 'strok'
	        $tok = strtok($row["messagecontent"], " \n\t");

// retain the userid to identify who wrote this text
	        $userid = $row["userid"];

// go through each array member, finished when false
	        while ($tok !== false) {
// clean up the word, and remove 's, ' . etc....
	            $tok = str_replace("'s","",$tok);
	            $tok = str_replace("'","",$tok);
   	            $tok = str_replace(".","",$tok);
   	            $tok = str_replace(",","",$tok);

// form the SQL to insert into the matching table
	            $sqlinsert = "insert into matching (userid, word) values (" .$userid.",'".$tok."')\r\n;" ;

// and process the SQL, so the row is inserted with the userid and word
	            if ($link2->query($sqlinsert) === TRUE) {
//              echo "New records created successfully";
	            } else {
	                echo "Error: " . $sqlinsert . "<br>" . $link->error;
	            }
// go to the next array member
	            $tok = strtok(" \n\t");
	        }
		}
	} else {
	    echo "No results found!";
	}
// Close these links
    $link2->close();
   	$link1->close();


// Create the Group Name
// Formed by four SQL statements which build up in the order of 1) 2) 3) 4)
// 4) Create a single string from three rows with GROUP_CONCAT
    $sql = "select group_concat(word) as groupname from (";
	$sql .=   "select distinct word from (";
// 3) Take these three occurances and find out who used them
	$sql .=   "SELECT m.userid,m.word,count(*) as samplecount";
	$sql .=   " from matching m ";
	$sql .=   " inner join messages ms on ms.userid=m.userid ";
	$sql .=   " inner join (";
// 2) Take the top three occurances of the words
	$sql .=   " select word as wordusage from (";
// 1) Lists each word, the number of times they were used and who used it
	$sql .=   "   SELECT m.userid, count(m.userid) as usagecount,";
	$sql .=   "   replace(replace(replace(replace(word,',',''),'\"','') ,'.',''),'(','') as word";
	$sql .=   "   from matching m";
	$sql .=   "	  inner join messages ms on ms.userid=m.userid";
	$sql .=   "	  where not left(m.word,1) REGEXP '^[0-9]+$' and length(m.word)>4";
	$sql .=   "	  and word not in (select preposition from prepositions)";
	$sql .=   "	  group by replace(replace(replace(replace(word,',',''),'\"','') ,'.',''),'(',''),m.userid";
	$sql .=   "	  order by replace(replace(replace(replace(word,',',''),'\"','') ,'.',''),'(','')";
	$sql .=   "	) t";
// eof 1)
	$sql .=   "	group by t.word having count(usagecount) > 1";
	$sql .=   "	order by count(usagecount) desc limit 3"; // NB limit 3 - this can be changed - the higher the amount the fewer matches
// eof 2)
	$sql .=   ") x on x.wordusage = m.word and ms.messageContent";
	$sql .=   " like concat('%',replace(replace(replace(replace(x.wordusage,',',''),'\"','') ,'.',''),'(',''),'%')";
	$sql .=   " group by m.userid,m.word";
// eof 3)
	$sql .=   " ) p";
// eof 4)
	$sql .=   " ) w";

   	$link3 = mysqli_connect($host,$username,$password,$table) or die ("Connection failed");
	$result = mysqli_query($link3,$sql);

    $groupname = "";

// Got the groupname now - i.e. 'Mozart, city, Salzburg'
	if ($result->num_rows > 0 ) {
//    	echo $result->num_rows . "<BR>";
	    while ($row = $result->fetch_assoc() ) {
	    	$groupname = $row["groupname"];
    	}
	} else {
	    $res_html = "<BR>No groups found!";  // if this happens then we should know
	}

// But we may be asking for a repeat collaborative group - so check if one of this name already exists
    $sql = "select groupID from groups where description='" . $groupname . "'";
    $result = mysqli_query($link3,$sql);

// So does this group already exists? If so delete it and the userids associated with it
  	if ($result->num_rows > 0 ) {
	    while ($row = $result->fetch_assoc() ) {
	    	$groupID = $row["groupID"];
	   	}
    	$sql = "delete from groups where description='" . $groupname . "'";
		$link3->query($sql);
       	$sql = "delete from groupheader where groupID=" . $groupID .";";
		$link3->query($sql);
	}

// SO this will form a new collaborative group using the description before (if it was used)
// and/or create a new one from scratch

// Create the group by inserting the new groupname into 'groups'
    $sql = "insert into groups (ownerID,description) values ($thisuserid,'" . $groupname . "')";
	$link3->query($sql);

// We need the groupID of this new group so we can insert the userID + groupID into
// groupheader table as the groupID is an autoincrement field
	$sql = "select groupID from groups where description = '" . $groupname . "'";

	$result = mysqli_query($link3,$sql);

// get the groupID and keep it safe
	while ($row = $result->fetch_assoc() ) {
	 $groupID = $row["groupID"];
 	}

// Very similar to the SQL that creates the groupname, but will give the list of userids
// that use the words of interest

    $sql = "select distinct userid from (";
	$sql .=   "SELECT m.userid,m.word,count(*) as samplecount";
	$sql .=   " from matching m";
	$sql .=   " inner join messages ms on ms.userid=m.userid";
	$sql .=   " inner join (";
	$sql .=   " select word as wordusage from (";
	$sql .=   "     SELECT m.userid, count(m.userid) as usagecount,";
	$sql .=   " 	replace(replace(replace(replace(word,',',''),'\"','') ,'.',''),'(','') as word";
	$sql .=   "     from matching m";
	$sql .=   "     inner join messages ms on ms.userid=m.userid";
	$sql .=   "     where not left(m.word,1) REGEXP '^[0-9]+$' and length(m.word)>4";
	$sql .=   " 	and word not in (select preposition from prepositions)";
	$sql .=   "     group by replace(replace(replace(replace(word,',',''),'\"','') ,'.',''),'(',''),m.userid";
	$sql .=   "     order by replace(replace(replace(replace(word,',',''),'\"','') ,'.',''),'(','')";
	$sql .=   "      ) t";
	$sql .=   "   	group by t.word having count(usagecount) > 1";
	$sql .=   "    	order by count(usagecount) desc limit 3";
	$sql .=   " ) x on x.wordusage = m.word and ms.messageContent";
	$sql .=   "	like concat('%',replace(replace(replace(replace(x.wordusage,',',''),'\"','') ,'.',''),'(',''),'%')";
	$sql .=   "group by m.userid,m.word";
	$sql .=   ") y";

	$result = mysqli_query($link3,$sql);

  	if ($result->num_rows > 0 ) {
//    	There should always be rows returned
	    while ($row = $result->fetch_assoc() ) {

  	    //	create the SQL that will insert into the groupheader, thereby creating the group of linked userids
			$sql = "insert into groupheader (userID,groupID) values (".$row["userid"].",".$groupID.")";

// Insert the row and fetch the next SQL row until there are no more
	        if ($link3->query($sql) === TRUE) {
 //	            echo "Insert into groupheader $sql<BR>";
	        } else {
	            echo "<BR>Error " . $sql . " : " . $link3->error;
	        }

       }
    } else {
	        echo "<BR>No userids found!";
	}

// Now display all members, all groups as default
// Using SQL to link groups, groupheader and users
	$link = mysqli_connect($host,$username,$password,$table) or die ("Connection failed");


	$sql = "SELECT concat(firstName,' ' ,lastName) as member,g.description,gh.groupID,
	case when g.ownerID=$thisuserid then 'Collaborative' else 'Friends' end as stuff
	from user u
	inner join groupheader gh on gh.userID=u.userID
	inner join groups g on g.groupID=gh.groupID
	where gh.userID=$thisuserid";

	$result = mysqli_query($link,$sql);

	if ($link->connect_error) {
	    die("connection failed:" . $conn->connect_error);
	}

    // create the table in HTML - shows the groups created, type of people in the group, and the user
	if ($result->num_rows > 0 ) {
	    $res_html .= "<TABLE>";
	    $res_html .= "<tr><th>Collaborative Interest Recommendation</th><th>Type</th><th>Member</th></tr>";

	    while ($row = $result->fetch_assoc()) {
	//      echo $row["member"] . "<TAB> GroupType: " . $row["stuff"] . " Name:" . $row["description"]."<BR>";
	        $res_html .= "<tr><td><a href='$filename?func=getgroup&groupid=".$row["groupID"]."'>".$row["description"]."</a>";
	        $res_html .= "</td><td>".$row["stuff"]."</td><td>".$row["member"]."</td></tr>";
	    }
	    $res_html .= "</table>";
	//  echo $res_html;
	} else {
	    $res_html .= "No results found!";
	}

	$link->close();

}
// EOF ($fx == "creategroups")

// Display members of group selected by href link groupid
if ($fx == "getgroup") {
	$gx=$_GET['groupid'];

   	$link1 = mysqli_connect($host,$username,$password,$table) or die ("Connection failed");

	$sql = "SELECT concat(firstName,' ' ,lastName) as member,g.description,gh.groupID,
	case when g.ownerID=$thisuserid then 'Collaborative' else 'Friends' end as stuff,u.userID,
	case when gh.userID=$thisuserid then '**' else '' end as caption
	from user u
	inner join groupheader gh on gh.userID=u.userID
	inner join groups g on g.groupID=gh.groupID
	where g.groupID=$gx
	order by lastName";

	$result = mysqli_query($link1,$sql);
    if ($link->connect_error) {
	die("connection failed:" . $conn->connect_error);
	}

    $header=1;

    $res_html .= "<TABLE>";

	if ($result->num_rows > 0 ) {
	    while ($row = $result->fetch_assoc()) {
	    	if ($header==1) {
	    	// Only display the group name once!
	   	        $res_html .= "<tr><th colspan='2'>Add these members to " . $row["description"]." (" . $row["stuff"] .")</th></tr>";
                $header=0;
            }

            if ($row["caption"] == "**") {
				$res_html .= "<tr><td><a href='".$filename."?func=listmember&userID=".$row["userID"]."''>".$row["member"]." ".$row["caption"]."</a></td><td>&nbsp;</td></tr>";

            } else {

				$res_html .= "<tr><td><a href='".$filename."?func=listmember&userID=".$row["userID"]."''>".$row["member"]." ".$row["caption"]."</a></td><td><a href='".$filename."?func=removemember&userID=".$row["userID"]."&groupID=$gx'>Add Friend</a></td></tr>";
			}
	    }
		$res_html .= "</TABLE>";

 //	  echo $res_html;
	} else {
	        $res_html .= "No members found";

	}

	$link1->close();

}
// EOF ($fx == "groupID")

if ($fx == "listgroups") {

	$link = mysqli_connect($host,$username,$password,$table) or die ("Connection failed");

// NB if the ownerID is 99 then it is system created
	$sql = "select g.description,g.groupID,
	case when g.ownerID=$thisuserid then 'Collaborative' else 'Friends' end as stuff
	from groups g
	inner join groupheader gh on g.groupID=gh.groupID
	where gh.userID=$thisuserid";

	$result = mysqli_query($link,$sql);

	if ($link->connect_error) {
	    die("connection failed:" . $conn->connect_error);
	}

	if ($result->num_rows > 0 ) {
	    $res_html .= "<TABLE>";
	    $res_html .= "<tr><th>Group</th><th>Group type</th></tr>";
	    while ($row = $result->fetch_assoc()) {
	        $res_html .= "<tr><td><a href='$filename?func=getgroup&groupid=".$row["groupID"]."'>".$row["description"]."</a>";
	        $res_html .= "</td><td>".$row["stuff"]."</td></tr>";
	    }
	    $res_html .= "</table>";
	//  echo $res_html;
	} else {
	    $res_html .= "No results found!";
	}

	$link->close();
}


if ($fx == "removemember") {

	$ruserid  = $_GET['userID'];
	$rgroupid = $_GET['groupID'];

	$link = mysqli_connect($host,$username,$password,$table) or die ("Connection failed");

	$sql = "delete from groupheader where userID=$ruserid and groupID=$rgroupid";

	if ($link->query($sql) === TRUE) {
//	    echo "groupheader user deleted<BR>";
	} else {
	    $res_html .="Error " . $sql . " : " . $link->error;
	}


	$sql = "SELECT concat(firstName,' ' ,lastName) as member,g.description,gh.groupID,
	case when g.ownerID=$thisuserid then 'Collaborative' else 'Friends' end as stuff,u.userID,
	case when gh.userID=$thisuserid then '**' else '' end as caption
	from user u
	inner join groupheader gh on gh.userID=u.userID
	inner join groups g on g.groupID=gh.groupID
	where g.groupID=$rgroupid
	order by lastName";

	$result = mysqli_query($link,$sql);
    if ($link->connect_error) {
	die("connection failed:" . $conn->connect_error);
	}

    $header=1;

    $res_html .= "<TABLE>";

	if ($result->num_rows > 0 ) {
	    while ($row = $result->fetch_assoc()) {
	    	if ($header==1) {
	    	// Only display the group name once!
	   	        $res_html .= "<tr><th colspan='2'>Add these members to " . $row["description"]." (" . $row["stuff"] .")</th></tr>";
                $header=0;
            }

            if ($row["caption"] == "**") {
				$res_html .= "<tr><td><a href='".$filename."?func=listmember&userID=".$row["userID"]."''>".$row["member"]." ".$row["caption"]."</a></td><td>&nbsp;</td></tr>";

            } else {

				$res_html .= "<tr><td><a href='".$filename."?func=listmember&userID=".$row["userID"]."''>".$row["member"]." ".$row["caption"]."</a></td><td><a href='".$filename."?func=removemember&userID=".$row["userID"]."&groupID=$rgroupid'>Remove</a></td></tr>";
			}
	    }
		$res_html .= "</TABLE>";

 //	  echo $res_html;
	} else {
	        $res_html .= "<H3>No members found</H3>";

	}

	$link->close();

}


if ($fx == "listmember") {

	$ruserid  = $_GET['userID'];

	$link = mysqli_connect($host,$username,$password,$table) or die ("Connection failed");

	$sql = "select * from user where userID=$ruserid";

	$result = mysqli_query($link,$sql);
    if ($link->connect_error) {
	die("connection failed:" . $conn->connect_error);
	}

    $res_html .= "<TABLE>";

	if ($result->num_rows > 0 ) {
	    while ($row = $result->fetch_assoc()) {
			$res_html .= "<tr><th colspan='2'>".$row["firstName"]."  ".$row["lastName"]."</th><td>
						<tr><td>DOB</td><td>".$row["DOB"]."</td><td>
						<tr><td>About Me</td><td>".$row["aboutMe"]."</td><td>
						<tr><td>Education</td><td>".$row["education"]."</td><td>
						<tr><td>Work</td><td>".$row["work"]."</td><td>
						<tr><td>Location</td><td>".$row["location"]."</td><td>
						<tr><td>email</td><td>".$row["emailAddress"]."</td><td>";
	    }?>


		<?php
		$res_html .= "</TABLE>";

 //	  echo $res_html;
	} else {
	        $res_html .= "No member found";

	}

	$link->close();

}


?>
