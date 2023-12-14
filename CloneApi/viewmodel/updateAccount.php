<?php include "../models/Account.php"; ?>
<?php include "../connection.php"; ?>
<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

    if (empty($conn) == false) {
        $data_response = array('status' => false, 'data' => [], 'message' => "none");
        try {
            $data_request = json_decode(file_get_contents("php://input"));    
            $stmt = mysqli_prepare($conn, "SELECT username FROM account WHERE username=? LIMIT 1");
            mysqli_stmt_bind_param($stmt, "s", $data_request->username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 0) {
                $data_response['status'] = false;
                $data_response['message'] = "Tài khoản không tồn tại";
            }
            else {
                $stmt = mysqli_prepare($conn, "UPDATE account SET password=? WHERE username=?");
                // Truyền giá trị cho các param
                mysqli_stmt_bind_param($stmt, "ss", $data_request->password, $data_request->username);
                // Thực thi
                if (mysqli_stmt_execute($stmt)) {
                    $data_response['status'] = true;
                    $data_response['data'][] = array("username" => $data_request->username);
                    $data_response['message'] = "Đổi mật khẩu thành công";
                }
                else {
                    $data_response['status'] = false;
                    $data_response['message'] = "Đổi mật khẩu thất bại";
                }
            }
        }
        catch (Exception $ex) {
            $data_response['status'] = false;
            $data_response['message'] = "PHP: EXCEPTION code: ". $ex->getCode().". EXCEPTION message: ". $ex->getMessage().". File: ". $ex->getFile().". Line: ". $ex->getLine();
        }
        catch (Error $er) {
            $data_response['status'] = false;
            $data_response['message'] = "PHP: ERROR code: ". $er->getCode().". ERROR message: ". $er->getMessage().". File: ". $er->getFile().". Line: ". $er->getLine();
        }
        finally {
            // close prepare statement
            if (empty($stmt) == false) {
                try {
                    mysqli_stmt_close($stmt);
                }
                catch (Exception $ex) {
                    $data_response['status'] = false;
                    $data_response['message'] = "PHP: EXCEPTION code: ". $ex->getCode().". EXCEPTION message: ". $ex->getMessage().". File: ". $ex->getFile().". Line: ". $ex->getLine();
                }
                catch (Error $er) {
                    $data_response['status'] = false;
                    $data_response['message'] = "PHP: ERROR code: ". $er->getCode().". ERROR message: ". $er->getMessage().". File: ". $er->getFile().". Line: ". $er->getLine();
                }
            }
            // close connection
            if (empty($conn) == false) {
                try {
                    mysqli_close($conn);
                }
                catch (Exception $ex) {
                    $data_response['status'] = false;
                    $data_response['message'] = "PHP: EXCEPTION code: ". $ex->getCode().". EXCEPTION message: ". $ex->getMessage().". File: ". $ex->getFile().". Line: ". $ex->getLine();
                }
                catch (Error $er) {
                    $data_response['status'] = false;
                    $data_response['message'] = "PHP: ERROR code: ". $er->getCode().". ERROR message: ". $er->getMessage().". File: ". $er->getFile().". Line: ". $er->getLine();
                }
            }
        }
    }
    echo json_encode($data_response);
?>