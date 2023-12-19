<?php include "../../config/connection.php"; ?>
<?php include "../../model/playlist.php"; ?>
<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json");

    if (empty($conn) == false) {
        $data_response = array('status' => false, 'data' => [], 'message' => "none");
        try {
            if (empty($_GET['username']) == false) {
                $str_id = $_GET['username'];
                $stmt = mysqli_prepare($conn, "SELECT 
                p.id AS playlist_id,
                p.name AS playlist_name,
                MAX(s.linkPicture) AS playlist_picture
                    FROM playlist p
                        INNER JOIN song_playlist sp ON p.id = sp.id_playlist
                            INNER JOIN song s ON s.id = sp.id_song
                        WHERE p.username = ? 
                    GROUP BY p.id, p.name;");
                mysqli_stmt_bind_param($stmt, "s", $str_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $data_response['status'] = true;
                        $data_response['data'][] = array("id" => $row['playlist_id'],
                                                        "name" => $row['playlist_name'],
                                                        "linkPicture" => $row['playlist_picture']);
                        $data_response['message'] = "Lấy danh sách phát thành công";
                    }
                }
                else {
                    $data_response['status'] = false;
                    $data_response['message'] = "Không có danh sách phát cần lấy";
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