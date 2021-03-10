<?php 
        session_start();
        main();
        function main(){
            if(isset($_POST["submitLogin"])){
                Login();
            }
        }
        function checkCharater($username,$password){
            $regex = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
            if(preg_match($regex,$username)||preg_match($regex,$password)){
                // có kí tự đặc biệt 
                return true;
            }
            if(empty($username) || empty($password)){
                // chuỗi rỗng
                return true;
            }
            return false;
        }
        function checkUser($username,$password){
            if(checkCharater($username,$password)){
                return 0;
            }
            $connect=new mysqli("localhost","root","","studentapplication");
            $sqlInsert="select * from studentaccount where StudentCode='$username' AND Password='$password'";
            $result=mysqli_query($connect,$sqlInsert);
            $row=mysqli_num_rows($result);
            mysqli_close($connect);
            return $row;
        }
        function GetSession($username){
            $_SESSION['name']=$username;
        }
        function Login(){
            $username=isset($_POST["username"])?$_POST["username"]:" ";
            $password=isset($_POST["password"])?$_POST["password"]:" ";
            if(checkUser($username,$password)==0){
                echo("<script>
                    alert('Tài khoản hoặc mật khẩu không chính xác !');
                    window.location.replace('Login.html');
                </script>");
            }
            else{
                GetSession($username,$password);
                echo("<script>window.location.replace('../MasterPage/Main/Home.php');</script>");
            }
        }    
?>