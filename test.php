<?php
//mysql_query('SET NAMES utf-8');
/*--------------------------mysql------------------*/
$db = new mysqli('localhost','root','123123','gwycf');

mysqli_set_charset($db,"utf8");

//if (!$db->set_charset("utf8")) {
    //printf("Error loading character set utf8: %s\n", $db->error)
//} else {
    //printf("Current character set: %s\n", $db->character_set_name())
//}

$query = 'select name,kaohao,epost,zongfen,rank from info order by epost,ecode,rank';
$stmt = $db->stmt_init();
$stmt->prepare($query);
$stmt->execute();
$stmt->store_result();
//[>--------------------------mysql------------------<]
$rank=1;
if($stmt->num_rows > 0)
{
    $stmt->bind_result($name,$kaohao,$epost,$zongfen,$rank);
    echo '<table>';
    echo '<tr> <td class="title">姓名</td><td class="title">职位</td><td class="title">职位</td><td class="title">排名</td> </tr>';
    while($stmt->fetch())
    {   
    //¦   printf ("<tr> <td>%s</td> <td>%s</td> <td>%s</td> </tr>",$name,$epost,$zongfen);
        echo $name."_".$kaohao."_".$zongfen."_".$rank;
        echo "<br />";
    }   
    echo '</table>';
}
else
{
    echo "hhh";
}

$stmt->close();
$db->close();
?>
        
