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
    if($_POST['action'] === "check"){

        $user = $helper->Strings->sanitizeOutput($_POST['user']);
        $password = $helper->Strings->sanitizeOutput($_POST['password']);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $mid = 0;

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

            $mid = $helper->Generators->generateSimpleId();

            $data = [
                'avatar' => $config['assets'].'images/avatar.jpg',
                'mid' => $mid,
                'email' => $user,
                'emailKey' => $helper->Generators->generateRandomString(30),
                'password' => $hashedPassword,
                'createdDateTime' => date("Y/m/d-H:i:s"),
                'createdAddress' => $helper->Gets->getCurrentIpAddress(),
                'loggedDateTime' => date("Y/m/d-H:i:s"),
                'loggedAddress' => $helper->Gets->getCurrentIpAddress(),
            ];

            $addMember = $db->insert("members", $data);
            if($addMember){
                echo json_encode(array(
                    "message" => $lang['registiration_successful'],
                    "status" => true,
                ));
            }


        }else{

            $mid = $account['mid'];

            if(!password_verify($password, $account['password'])){
                echo json_encode(array(
                    "message" => $lang['wrong_password'],
                    "status" => false,
                ));
                exit;
            }

            $data = [
                'loggedDateTime' => date("Y/m/d-H:i:s"),
                'loggedAddress' => $helper->Gets->getCurrentIpAddress(),
            ];
            $db->where("mid", $mid);
            $db->update("members", $data);
        }


        $_SESSION['session'] = true;
        $_SESSION['mid'] = $mid;
        echo json_encode(array(
            "message" => $lang['login_successful'],
            "status" => false,
        ));
        exit;

    }

}
?>