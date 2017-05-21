<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/13 0013
 * Time: 上午 11:59
 */

//支持跨域访问
header('Access-Control-Allow-Origin: *');

$name = $_POST["name"];
$password = $_POST["password"];

class Res{
    public  $status;
    public  $msg;
}
/*
1.创建数据库
$conn = new  mysqli("127.0.0.1","root","" ,"booksdb") or die("连接失败：".$conn ->connect_error);

//创建数据库的sql语句
$sql = "create database wjwdb";
if($conn -> query($sql) === true ){
    echo  "创建数据库成功！";
}else{
    echo "创建数据库失败:".$conn->error;
}
$conn ->close() ;// 关闭数据库
*/

/*
 2.创建表
$conn = new mysqli("127.0.0.1","root","","wjwdb") or die("连接失败：".$conn ->connect_error);
$sql = "create table if not exists menbers(id  int auto_increment  PRIMARY KEY,name varchar(255),password varchar(255) )";
if($conn ->query($sql) === true  ){
    echo "创建表成功或者表已存在！";
}else{
    echo "创建表失败：".$conn ->error;
}
$conn ->close() ;
*/

//3.查找表格中是否有相同的用户名
$conn = new mysqli("127.0.0.1","root","","WJWdb") or die("连接失败:".$conn -> connect_error  );
$sql = "select * from menbers";
$result = $conn ->query($sql);
$isExist = false;
if($result ->num_rows >0  ){
    while ($row = $result->fetch_assoc()){
        if($row["name"]==$name){
            $isExist = true;
        }
    }
    if($isExist){
        //用户已存在
        $res = new Res();
        $res ->status=0;
        $res ->msg = "该手机号/邮箱已注册过";
        echo json_encode($res);
    }else{
        //用户不存在

    }
}else{
    //用户不存在
}

if(!$isExist){
    $conn1 = new mysqli("127.0.0.1","root","","WJWdb") or die("连接失败：".$conn->connect_error);
    $sql1 = "insert into menbers(name,password) values('$name','$password')";
    if($conn1->query($sql1)){
        $res = new Res();
        $res->status=1;
        $res ->msg = "注册成功！";
        echo json_encode($res  );
    }else{
        $res = new  Res();
        $res ->status = 2;
        $res->msg = "注册失败！  ";
        echo json_encode($res  );

    }
    $conn1->close() ;

}