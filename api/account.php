<?php

require_once getcwd() . '/core/loader.php';

header('content-type: text/json');

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo json_encode(array(
        "message" => $lang['require_post_request'],
        "status" => false,
    ));
    exit;
}

if(isset($_SESSION['session'])){

    /* Update Password */
    if($_POST['action'] === "updatePassword"){
        $passwordOld = $helper->Strings->sanitizeOutput($_POST['passwordOld']);
        $passwordNew = $helper->Strings->sanitizeOutput($_POST['passwordNew']);
        $passwordNewAgain = $helper->Strings->sanitizeOutput($_POST['passwordNewAgain']);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        if(empty($passwordOld) || empty($passwordNew) || empty($passwordNewAgain)){
            echo json_encode(array(
                "message" => $lang['fill_blanks'],
                "status" => false,
            ));
            exit;
        }

        if(!password_verify($oldPassword, $member['password'])){
            echo json_encode(array(
                "message" => $lang['old_password_not_valid'],
                "status" => false,
            ));
            exit;
        }

        if($passwordNew !== $passwordNewAgain){
            echo json_encode(array(
                "message" => $lang['new_passwords_must_be_the_same'],
                "status" => false,
            ));
            exit;
        }

        $data = [
            'password' => $hashedPassword
        ];

        $db->where("mid", $member['id']);
        $updateMemberPassword = $db->update("members", $data);

        if($updateMemberPassword){
            if(!$user || !$password){
                echo json_encode(array(
                    "message" => $lang['password_updated'],
                    "status" => true,
                ));
                exit;
            }
        }else{
            if(!$user || !$password){
                echo json_encode(array(
                    "message" => $lang['password_not_updated'],
                    "status" => false,
                ));
                exit;
            }
        }

    }

}else{

    /* Sign In */
    if($_POST['action'] === "signIn"){

        $user = $helper->Strings->sanitizeOutput($_POST['user']);
        $password = $helper->Strings->sanitizeOutput($_POST['password']);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        if(!$user || !$password){
            echo json_encode(array(
                "message" => $lang['fill_blanks'],
                "status" => false,
            ));
            exit;
        }

        if(is_int($user) || is_numeric($user)){
            $db->where("mid", $user);
        }else if(filter_var($user, FILTER_VALIDATE_EMAIL)){
            $db->where("email", $user);
        }

        $account = $db->getOne("members");

        if(!$account){
            echo json_encode(array(
                "message" => $lang['member_not_found'],
                "status" => false,
            ));
            exit;
        }

        if(!password_verify($password, $account['password'])){
            echo json_encode(array(
                "message" => $lang['wrong_password'],
                "status" => false,
            ));
            exit;
        }

        $_SESSION['session'] = true;
        $_SESSION['mid'] = $account['id'];
        echo json_encode(array(
            "message" => $lang['login_successful'],
            "status" => false,
        ));
        exit;

    }

}
?>