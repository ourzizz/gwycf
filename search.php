<html>

<head>
<title> 查询结果 </title>

<style type="text/css" >
@import "./table.css"
</style>
</head>


<body>
<div>

<?php

if(isset($_POST['name']))
{
    //[>--------------------------mysql------------------<]
    $db = new mysqli('localhost','root','123123','gwycf');
    //$query = 'select name,kaohao,epost,ecode,zongfen,rank from info where epost in (select epost from info where name=? and kaohao=?) 
        //and ecode in(select ecode from info where name=? and kaohao=?)';
    $query = 'select name,kaohao,epost,ecode,zongfen,rank from info where kaohao in 
        (select kaohao from info where epost in (select epost from info where name=? and kaohao=?) and ecode in(select ecode from info where name=? and kaohao=?)) order by rank';
    $stmt = $db->stmt_init();
    $stmt->prepare($query);
    $stmt->bind_param('ssss',$_POST['name'],$_POST['haoma'],$_POST['name'],$_POST['haoma']);
    $stmt->execute();
    $stmt->store_result();
    echo $stmt->num_rows;
    /*--------------------------mysql------------------*/
    if($stmt->num_rows > 0)
    {
        $stmt->bind_result($name,$haoma,$epost,$ecode,$zongfen,$rank);
        echo '<table>';
        echo '<tr> 
            <td class="title">排名</td>
            <td class="title">姓名</td>
            <td class="title">考号</td>
            <td class="title">单位</td>
            <td class="title">职位</td>
            <td class="title">总分</td>
            </tr>';
        while($stmt->fetch())
        {
            printf ('<tr> 
                 <td>%s</td>
                 <td>%s</td>
                 <td>%s</td>
                 <td>%s</td>
                 <td>%s</td>
                 <td>%s</td>
                </tr>',$rank,$name,$haoma,$epost,$ecode,$zongfen);
        }
        echo '</table>';
    }
    else
    {
        echo "没有结果";
    }
    $stmt->close();
    $db->close();
}
else {
    echo "BAD";
}
?>

</div>
</body>
</html>
