<?php
    require_once 'config.php';
    require_once 'lib.php';
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
            <!-- Registration Form -->
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
                        <input type="email" class="form-control" id="EMailAddress" name="EMailAddress" required placeholder="i.e abc@gmail.com">
                    </div>
                </div>
                <div class="mb-6" align="center"> 
                    <label align="left" class="col-sm-3 col-form-label" for="MobileNumber">Phone Number <font color="red">*</font></label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="MobileNumber" name="MobileNumber" required placeholder="i.e 1324567894">
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
                    <button type="submit" name="UserSubmitForm" id="UserSubmitForm" class="btn btn-primary" value="Create User"><strong>Sign Up</strong></button>
                    <a href="logincontroller.php?m=lgin" class="btn btn-info"><strong>Login</strong></a>
                </div>
            </form>	
            <br><br>

            <!-- Fetching data from tblusers table -->
            <h1 align = 'center'> <strong>Table Data</strong></h1>	<br>
            <table align="center"  class="table table-bordered">
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
                        $rmmysqli = $RMMySQLi;
                        $query = "SELECT * FROM tblusers";
                        $EchoUsers = fetchData($rmmysqli, $query);
                        if ($EchoUsers > 0) 
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
            </table>

        <!-- included bootstrap cdn js link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
