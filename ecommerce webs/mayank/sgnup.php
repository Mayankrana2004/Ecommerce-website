<?php
    $error  = "";
    $conn = mysqli_connect("localhost","root","","myproject");
    
    if($conn==False){
        die("Error");
    }
    else{
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            if(substr($name,0,1)<='9' and substr($name,0,1)>='0'){
                $error = "Name is not Valid";
            }
            else{
                if(strlen($pass)<4){
                    $error = "Inavlid Password";
                }
                else{
                    try{
                    $stmt = $conn->prepare("INSERT INTO details VALUES(?,?,?)");
                    $stmt->bind_param("sidss", $name, $email ,$pass);
                    $res = $stmt ->execute();
                    }
                    catch(Exception $e){
                        $error = "Email Exists";
                    }
                    $stmt->close();
                }
            }
            
        }
    }
    $conn->close();
    
?>