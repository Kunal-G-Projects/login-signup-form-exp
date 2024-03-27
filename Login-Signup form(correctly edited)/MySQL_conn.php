<?php
    $connection = mysqli_connect('localhost:3310','root','','exp');
    //CHECKING THE CONNECTION OF DATABASE WITH PHP
    //returns bool value

    echo "Connection status: ";
    error_reporting(0);
    
    if(!$connection)
    /*
    mysqli_connect takes 4 parameters: localhost, 
    username of database, password of database, name of schema
    */
        die("Could Not Connect[".mysqli_connect_error()."]");
    else
        echo "connected with database";


    echo "<br><br>";
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        //storing the values put in input text box into php variables
        $name = $_POST['full_name'];
        $email = $_POST['your_email'];
        $pass = $_POST['password'];
        $conf_pass = $_POST['confirm_password'];

        $emailquery = "select * from table1 where email = '$email'";
        $query = mysqli_query($connection, $emailquery);

        $emailcount = mysqli_num_rows($query);

        $flag=0;
        if($emailcount>0)
        {
            echo "email already exists so please enter another email";
            $flag=1;
            if($pass === $conf_pass)
            {
                $insertquery = "INSERT INTO table1(name,email,pass,confirm_pass) VALUES('$name','$email','$pass','$conf_pass')";
            }
            else
            {
                echo "passwords are not matching";
            }
        }
        
        
        

        if(($name!="") && ($email!="") && ($pass!="") && ($conf_pass!=""))
        {
            //inserting values in php variables into database
            $sql_query = "INSERT INTO table1(name,email,pass,confirm_pass) VALUES('$name','$email','$pass','$conf_pass')";

            if(mysqli_query($connection, $sql_query)==true && $flag==0)//if data is inserted into database, display "insertion successfull else error.
            {
                echo "inserted form data successfully";
            }
            else if($flag==1)
            {
                //condition(if email typed is already present in database) already mentioned above
            }
            else
            {
                echo "error in inserting form data!";
            }
        }
        else
        {
            echo "<script>alert('Please fill all the fields of this form');</script>";
        }

        // mysqli_close($connection);
    }

?>