<?php
print_r($_REQUEST);
echo "|" . $_REQUEST["genre"] . "|";
$host = "webdev.iyaserver.com";
$userid = "roed";
$userpw = "Iya2446607277";
$db = "roed_tabpro";

$mysql = new mysqli (
    $host,
    $userid,
    $userpw,
    $db
);

if($mysql->connect_errno) {
    echo "db connection error : " . $mysql->connect_error;
    exit();
}

$sql = 		"SELECT * FROM tabs_search_view WHERE 
song_name LIKE '%" .
    $_REQUEST['searchtabs'] . "%' 
OR 
username LIKE '%" .
    $_REQUEST['searchtabs'] . "%'    
OR 
artist LIKE '%" .
    $_REQUEST['searchtabs'] . "%'    
OR 
created_on LIKE '%" .
    $_REQUEST['searchtabs'] . "%'    
OR 
genre LIKE '%" .
    $_REQUEST['searchtabs'] . "%'  
OR 
category LIKE '%" .
    $_REQUEST['searchtabs'] . "%' 
OR 
capo LIKE '%" .
    $_REQUEST['searchtabs'] . "%' 


    ";

//$sql .=		" ORDER BY " . $_REQUEST['sortorder'];
//username = $_REQUEST["username"] AND

$results = $mysql->query($sql);

if(!$results) {
    echo "SQL error: ". $mysql->error;
    exit();
}


echo "Your results returned " .
    $results->num_rows .
    " results.<hr>";

?>

<html>
<head>
    <title>My Tabs: Search Page</title>
</head>
<body>
<div id="mytabs_searchbar">
    <div style="text-align: center">My Tabs Search</div>
    <hr>
    <form action="mytabs_results_page.php">
        <div class="label">SearchTabs:</div> <input type="text" name="searchtabs">
        <br style="clear:both;">
        <input type="submit" value="Submit_search_tabs" style="background-color: blueviolet; color: white; border: 0"></div>
</div>
</form>
<?php
while($currentrow = $results->fetch_assoc()) {
    echo "<strong>" .
        $currentrow['song_name'] .
        "</strong> <em>(user: " .
        $currentrow["username"] .
        "), ". $currentrow["artist"] . "  " .$currentrow["created_on"] . "   " . $currentrow["genre"] . "   " . $currentrow["category"] . "<strong>  Capo: " .
        $currentrow["capo"] . "</strong>   ".
        "</em><br><br>";
}


?>
</body>
</html>