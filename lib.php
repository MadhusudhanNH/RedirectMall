<?php
    require 'config.php';
    $_SESSION['Messages'] = null;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
        if ($_POST['UserSubmitForm'] == 'Create User')
		{
            $SQLEchoUsers = $RMPDO->prepare("SELECT * FROM tblusers");
            $SQLEchoUsers->execute();
            $EchoUsers = $SQLEchoUsers->fetchAll();
            if ($SQLEchoUsers-> rowCount() > 0) 
            {
                foreach($EchoUsers as $EchoUser)  
                {
                    if($EchoUser['EMailAddress'] != $_POST['EMailAddress'] && $EchoUser['MobileNumber'] != $_POST['MobileNumber'])
                    {
                        $SQLInsertUser = "INSERT INTO tblusers (Person, EMailAddress, MobileNumber, City, StateUT, CreatedOn) VALUES ('".$_POST['UserName']."', '".$_POST['EMailAddress']."', '".$_POST['MobileNumber']."', '".$_POST['City']."', '".$_POST['StateUT']."', now())";
                        $RMPDO->exec($SQLInsertUser);
                        $DBAID = $RMPDO->lastInsertId();
                    }
                    else
                    {
                        $_SESSION['Messages'] = "User already exists. please log in";
                        header('Location: index.php');
                        die;
                    }
                }
            }
            else
            {
                $SQLInsertUser = "INSERT INTO tblusers (Person, EMailAddress, MobileNumber, City, StateUT, CreatedOn) VALUES ('".$_POST['UserName']."', '".$_POST['EMailAddress']."', '".$_POST['MobileNumber']."', '".$_POST['City']."', '".$_POST['StateUT']."', now())";
                $RMPDO->exec($SQLInsertUser);
                $DBAID = $RMPDO->lastInsertId();
            }
            if($DBAID > 0)
            {
				$_SESSION['Person'] = $_POST['UserName'];
                header('Location: logincontroller.php?m=home');
                die;	
            }
            else
            {
                $_SESSION['Messages'] = "Error - While creating new user";
                header('Location: index.php');
                die;
            }   	
        }
        elseif($_POST['UserSubmitForm'] == 'Login User')
        {
            $SQLEchoUsers = $RMPDO->prepare("SELECT * FROM tblusers");
            $SQLEchoUsers->execute();
            $EchoUsers = $SQLEchoUsers->fetchAll();
            if ($SQLEchoUsers-> rowCount() > 0) 
            {
                foreach($EchoUsers as $EchoUser)  
                {
                    if($EchoUser['EMailAddress'] == $_POST['PersonID'] || $EchoUser['MobileNumber'] == $_POST['PersonID'])
                    {
                        $_SESSION['Person'] = $EchoUser['Person'];
                        header('Location: logincontroller.php?m=home');
				        die;	
                    }
                    else
                    {
                        $_SESSION['Messages'] = "This - ".$_POST['PersonID']." Email id / Mobile Number not registered. please retry";
                        header('Location: index.php');
                        die;
                    }
                }
            }
        }
        elseif($_POST['UserSubmitForm'] == 'LogOut User')
        {
                
            $_SESSION = array();
            if (ini_get("session.use_cookies")) 
            {
                $params = session_get_cookie_params();
                setcookie
                (
                    session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_unset(); 	
            session_destroy();	
            $RMPDO = null;		
            header('Location: index.php');
        }
    }
?>
