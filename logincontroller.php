<?php
    require 'config.php';
    require 'lib.php';

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
            <?php        
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
                elseif($Module == 'Sign Up')
                {
            ?>
                    <h1 align = 'center'> <strong>Registration Form</strong></h1>	<br>	
                    <form name="UserForm" id="UserForm" action="lib.php" method="post">
                        <div class="mb-6" align="center"> 
                            <label align="left" class="col-sm-3 col-form-label" for="UserName">Name <font color="red">*</font></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="UserName" name="UserName" required placeholder="Enter User Name">
                            </div>
                        </div>
                        <div class="mb-6" align="center"> 
                            <label align="left" class="col-sm-3 col-form-label" for="EMailAddress">E-Mail <font color="red">*</font></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="EMailAddress" name="EMailAddress" required placeholder="Enter mail id">
                            </div>
                        </div>
                        <div class="mb-6" align="center"> 
                            <label align="left" class="col-sm-3 col-form-label" for="MobileNumber">Phone Number <font color="red">*</font></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="MobileNumber" name="MobileNumber" required placeholder="Mobile number">
                            </div>
                        </div>
                        <div class="mb-6" align="center"> 
                            <label align="left" class="col-sm-3 col-form-label" for="City">City <font color="red">*</font></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="City" name="City" required placeholder="Enter City name">
                            </div>
                        </div>
                        <div class="mb-6" align="center"> 
                            <label align="left" class="col-sm-3 col-form-label" for="StateUT">State <font color="red">*</font></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="StateUT" name="StateUT" required placeholder="Enter State name">
                            </div>
                        </div><br>
                        <div class="mb-6" align="center"> 
                            <button type="submit" name="UserSubmitForm" id="UserSubmitForm" class="btn btn-primary" value="Create User">Submit</button>
                        </div>
                    </form>			
            <?php 
                }
            ?>	
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>