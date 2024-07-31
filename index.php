<?php
    require 'config.php';
    require 'lib.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
		if (isset($_POST['PersonID']) && $_POST['PersonID'] != '') 
		{			
			$_SESSION['PersonID'] = $_POST['PersonID'];
			$SQLValidatePerson = $RMPDO->prepare("SELECT * FROM people WHERE (EMailAddress = '".$_SESSION['PersonID']."' OR MobileNumber = '".$_SESSION['PersonID']."') ");			
			$SQLValidatePerson->execute();					
			$ValidatePerson = $SQLValidatePerson->fetch(PDO::FETCH_ASSOC);			
			if (!isset($ValidatePerson['Slno']))
			{	
				$_SESSION['PersonID'] = '';				
				$_SESSION['Person'] = '';
				$_SESSION['EMailAddress'] = '';
				$_SESSION['MobileNumber'] = '';
				echo "Login ID - $_POST[PersonID] is not registered.\r\nPlease retry with your registered EMail Address or Mobile Number.";
				header('Location: index.php');
				die;	
			}
			elseif ($ValidatePerson['Slno'] != '')
			{				
				$_SESSION['PersonID'] = $ValidatePerson['Slno'];
				$_SESSION['Person'] = $ValidatePerson['Person'];
				$_SESSION['EMailAddress'] = $ValidatePerson['EMailAddress'];										
			}							
		}			
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Redirect Mall</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <h1 align="center">Welcome</h1>
        <?php
            if (isset($_SESSION['Messages']) && $_SESSION['Messages'] != '')
			{ 
        ?>								
                <div class="alert alert-danger" role="alert"><i class="icon-info-sign"></i><strong><?php echo nl2br($_SESSION['Messages']);?></strong></div>
        <?php 
                $_SESSION['Messages'] = '';
            }
            if(isset($_SESSION['Person']))
            {
                header('Location: logincontroller.php?m=home');
				die;	
            }	
            else
            {
        ?>		
                <div align = 'center'> <strong>Login / Sign Up</strong></div>	<br><br>			
                <form name="LoginForm" id="LoginForm" action="logincontroller.php" method="get">
                    <div align = 'center'> 
                       <a href="logincontroller.php?m=lgin" class="btn btn-info"><strong>Login</strong></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <a href="logincontroller.php?m=sp" class="btn btn-primary"><strong>Sign Up</strong></a>
                    </div>																			
                </form>			
         <?php 
            }
        ?>	
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
