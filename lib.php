<?php
    require_once 'config.php';
    // here data is received using post request method & form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
        //according to specified Submitted values it will performs Create User , Login User, Logout user.
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
                header('Location: index.php');
                die;	
            }
            else
            {
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
                        header('Location: logincontroller.php?m=home');
				        die;	
                    }
                    else
                    {
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

    //Function to display data in index.php
    function fetchData($rmmysqli, $query)
    {
        $tblusersResult = mysqli_query($rmmysqli, $query);
        $tblusersData = array();
        while ($row = mysqli_fetch_assoc($tblusersResult))
        {
            $tblusersData [] = $row;
        }
        return $tblusersData;
    }
?>
