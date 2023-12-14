<?php include "../connection.php";
    include "../models/Account.php";
 ?>
<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
    
    $data_request = json_decode(file_get_contents("php://input"), true);
//     if (empty($data_request['name']) || empty($data_request['password'])) {
//     // Tên người dùng hoặc mật khẩu không được trống
//     // echo json_encode(['status' => false, 'message' => 'Tên người dùng và mật khẩu không được trống'.' và request ');
//     echo json_encode(['status'=>false,'message'=>'chuỗi được gửi đi là:'.file_get_contents("php://input")]);
//     exit();
// }
    
    $acc = new Account($data_request['username'],$data_request['password']);
    $rs = mysqli_prepare($conn,"Select username,password from account where username=? and password=? limit 1");

    // Truyền giá trị cho các param
    mysqli_stmt_bind_param($rs,"ss",$data_request['username'], $data_request['password']); 
    mysqli_stmt_execute($rs);

    //Lấy kết quả
    $result = mysqli_stmt_get_result($rs);
    $data_response = array('status' => "none",'data' => [],'message' => "none");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            if($row['username'] == $acc->getUsername() && $row['password'] == $acc->getPassword()){
                $data_response['status'] = true;
                $data_response['data'][] = array("name" => $row['username'],"password" => $row['password']);
                $data_response['message'] = "Tài khoản mật khẩu chính xác";   
                break;
            }
        }
    }
    else{
        $data_response["status"] = false;
        $data_response['message'] = "Tài khoản hoặc mật khẩu ko chính xác";
    }
    echo json_encode($data_response);
?>
<?php mysqli_close($conn);
?>