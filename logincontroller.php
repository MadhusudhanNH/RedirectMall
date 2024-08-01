<?php
    require 'config.php';
    require 'lib.php';

    // Choosing available modules by using get method
    if ($_SERVER['REQUEST_METHOD'] == 'GET') 
    { 						
        $Module = isset($_GET['m']) ? $_GET['m'] : '';
        if($Module == 'lgin')
            $Module = 'Log In';
        elseif($Module == 'sp')
            $Module = 'Sign Up';
        elseif($Module == 'home')
            $Module = 'Home';
    }	
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
        <!-- included bootstrap cdn css link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
            <?php   
                // after successfull login or sign up user able view this module     
                if($Module == 'Home')
                {
            ?>
                    <h1 align = 'center'> <strong>Hello <?php echo $_SESSION['Person'];?>, Your successfully loged in.</strong></h1>	<br>
                    <form name="UserForm" id="UserForm" action="lib.php" method="post">
                        <table align="center"  class="table table-hover">
                            <thead>
                                <tr align="center">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>MobileNumber</th>
                                    <th>E-mail id</th>
                                    <th>City</th>
                                    <th>State</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $SQLEchoUsers = $RMPDO->prepare("SELECT * FROM tblusers");
                                    $SQLEchoUsers->execute();
                                    $EchoUsers = $SQLEchoUsers->fetchAll();
                                    if ($SQLEchoUsers-> rowCount() > 0) 
                                    {
                                        foreach($EchoUsers as $EchoUser)  
                                        {
                                    
                                ?>
                                            <tr align="center">
                                                <td><?php echo $EchoUser["Id"];?></td>
                                                <td><?php echo $EchoUser["Person"];?></td>
                                                <td><?php echo $EchoUser["EMailAddress"];?></td>
                                                <td><?php echo $EchoUser["MobileNumber"];?></td>
                                                <td><?php echo $EchoUser["City"];?></td>
                                                <td><?php echo $EchoUser["StateUT"];?></td>
                                            </tr>
                                <?php
                                        }
                                    } 
                                    else 
                                    {
                                ?>
                                        <tr align="center"><td colspan="6"><strong>Users data not found</strong></td></tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table><br><br>
                        <div align = 'center'>
                            <button type="submit" name="UserSubmitForm" id="UserSubmitForm" class="btn btn-info" value="LogOut User">Log Out</button>
                        </div>
                    </form>
            <?php
                }
                //Login Form collect the input data and validate the data
                elseif($Module == 'Log In')
                {
            ?>
                    <h1 align = 'center'> <strong>Login Form</strong></h1>	<br><br>	
                    <form name="UserForm" id="UserForm" action="lib.php" method="post">
                        <div class="mb-6" align="center"> 
                            <label align="left" class="col-sm-3 col-form-label" for="PersonID">E-Mail / Mobile Number <font color="red">*</font></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="PersonID" name="PersonID" placeholder="Enter EMail / Mobile Number" required>
                            </div>
                        </div><br>
                        <div class="mb-6" align="center"> 
                            <button type="submit" class="btn btn-info" name="UserSubmitForm" id="UserSubmitForm" value="Login User">Submit</button>		
                        </div>										
                    </form>			
            <?php 
                }
            ?>	
            <!-- included bootstrap cdn js link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
