<style>
    #contentAccount{
        background-color: white;
        padding:20px ;
        border-radius: 3px;
        border-top:3px solid #4285f4;
    }
    form{
        width:80%;
    }
    h6{
        border-bottom: 1px solid #d9d9d9;
        padding-bottom:20px ;
    }
    .display-flex{
        display: flex;
        padding:10px 0 ;
        
    }
    .flex-left{
        width: 30%;
        text-align: right;
        padding-right: 20px;
    }
    .flex-right{
        width:70%;
        font-size: 13px;
    }
    .set-padding{
        padding-top:5px; 
        padding-bottom:5px;
    }
    input{
        padding: 5px !important ;
    }
</style>
<div id="contentAccount">
    <h6>Đổi mật khẩu</h6>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group display-flex">
            <label class="flex-left set-padding" >Mật khẩu cũ</label>
            <input type="password" class="form-control flex-right" name="passOld" require>
        </div>
        <div class="form-group display-flex">
            <label class="flex-left set-padding" >Mật khẩu mới</label>
            <input type="password" class="form-control flex-right" name="passNew" require>
        </div>
        <div class="form-group display-flex">
            <label class="flex-left set-padding" >Xác nhận mật khẩu</label>
            <input type="password" class="form-control flex-right" name="passConfirm" require>
        </div>
        <div class="form-group display-flex">
            <label class="flex-left set-padding"></label>
            <input type="submit" name="submit" class="btn btn-primary form-control flex-right" style="width:auto" value="Xác nhận">
        </div>
    </form>
</div>
<?php 
    $account=new Account();
    $student_code=$_SESSION['name'];
    if(isset($_POST['submit'])){
        $account->setPassWord($student_code);
        if($account->getPassWord()){
            echo("<script>
                alert('Thay đổi mật khẩu thành công');
                window.location.replace('../Main/Home.php?mnu=Information/ChangePass.php');
                </script>");
        }
        else{
            echo("<script>
                alert('Thay đổi mật khẩu thất bại');
                window.location.replace('../Main/Home.php?mnu=Information/ChangePass.php');
                </script>");
        }
    }
    class Account{
        private $pass_old;
        private $pass_new;
        private $pass_confirm;
        private $student_code;
        function setPassWord($student_code){
            $this->student_code=$student_code;
            $this->pass_old=isset($_POST['passOld'])?$_POST['passOld']:"";
            $this->pass_new=isset($_POST['passNew'])?$_POST['passNew']:"";
            $this->pass_confirm=isset($_POST['passConfirm'])?$_POST['passConfirm']:"";
        }
        function getPassWord(){
            $pass_old=$this->pass_old;
            $pass_new=$this->pass_new;
            $pass_confirm=$this->pass_confirm;
            $student_code=$this->student_code;
            $connect=mysqli_connect("localhost","root","","studentapplication");
            mysqli_query($connect,"SET NAMES 'UTF8'");
            //kiểm tra mật khẩu
            $acc=new Account();
            if($pass_new!=$pass_confirm){
                return false;
            }
            $checkChar=$acc->checkCharater($pass_new,$pass_old);
            if($checkChar){
                return false;
            }
            $checkExit=$acc->checkExit($pass_old,$connect,$student_code);
            if($checkExit){
                return false;
            }
            // update mật khẩu
            $update=$acc->updatePass($pass_new,$connect,$student_code);
            if($update){
                return true;
            }
            return false;
        }
        function checkCharater($pass_new,$pass_old){
            $regex = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
            if(preg_match($regex,$pass_new)|| preg_match($regex,$pass_old)){
                // có kí tự đặc biệt 
                return true;
            }
            if(empty($pass_new)||empty($pass_old)){
                // chuỗi rỗng
                return true;
            }
            return false;
        }
        function checkExit($pass_old,$connect,$student_code){
            $sql="select * from studentaccount where Password='$pass_old' and StudentCode='$student_code' "; 
            $result=mysqli_query($connect,$sql);
            $row=mysqli_num_rows($result);
            if($row>0)
            {
                return false;
            }
            return true;
        }
        function updatePass($pass_new,$connect,$student_code){
            $sql="update studentaccount set Password='$pass_new' where StudentCode='$student_code' "; 
            $result=mysqli_query($connect,$sql);
            mysqli_close($connect);
            if($result)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
?>