<html>

<head>
<title> 查询结果 </title>
<script type="text/javascript">
function hight_light_target()
{
    var x=document.getElementById('mytable').insertCell(6)
        x.innerHTML="我在这里"
}
</script>
<style type="text/css" >
@import "./table.css"
</style>
</head>
<body>
<input type="button" onclick="hight_light_target()" value="高亮"> </input>
<div>
<?php
//header("Content-Type: text/htmlcharset=utf-8");
if(isset($_POST['name']))
{
    //[>--------------------------mysql------------------<]
    $db = new mysqli('localhost','root','123123','gwycf');
    mysqli_set_charset($db,"utf8");
    echo "hello";
    //$mysqli->query("SET NAMES gb2312");
    echo "hello";
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
            if ( $zongfen!="-1.0" ) {
                if ($name==$_POST['name']) {
                    printf ('<tr id="mytable"> 
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        </tr>',$rank,$name,$haoma,$epost,$ecode,$zongfen);
                }
                else{
                    printf ('<tr> 
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        </tr>',$rank,$name,$haoma,$epost,$ecode,$zongfen);
                }
            }
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
