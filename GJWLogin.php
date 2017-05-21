<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/13 0013
 * Time: 上午 11:58
 */

//支持跨域访问
header('Access-Control-Allow-Origin: *');



$name = $_POST["name"];
$password = $_POST["password"];


class Res{
    public $status;
    public $msg;
}

//连接数据库
$conn = new mysqli("127.0.0.1","root","","WJWdb") or  die("数据库连接失败：".$conn->connect_error);
$sql = "select * from menbers";
$result = $conn->query($sql);
$isSuccess = false;
if($result->num_rows >0 ){
    while ($row = $result->fetch_assoc()){
        if($row["name"]==$name && $row["password"]==$password) {
            $isSuccess = true;
        }
    }
    if($isSuccess){
        $res = new Res();
        $res ->status = 1;
        $res -> msg = "登录成功！";
        echo json_encode($res);
    }else{
        $res = new Res();
        $res ->status = 0;
        $res->msg = "不存在该用户！";
        echo json_encode($res);

    }

}else{
    //不存在该账号
    $res = new Res();
    $res ->status = 0;
    $res->msg = "不存在该用户！";
    echo json_encode($res);

}



