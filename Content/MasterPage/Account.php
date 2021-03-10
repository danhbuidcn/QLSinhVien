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
<?php 
    $account=new Account();
    $account->setStudentCode($_SESSION['name']);
    if(isset($_POST['submit'])){
        $account->setUpdateInfor();
        $account->getUpdateInfor();
    }
?>
        <div id="contentAccount">
            <h6>Thay đổi thông tin cá nhân</h6>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group display-flex">
                    <label class="flex-left" >Họ tên:</label>
                    <span class="flex-right"><?php echo $account->getInfor()[0];?></span>
                </div>
                <div class="form-group display-flex">
                    <label class="flex-left" >Mật khẩu:</label>
                    <span class="flex-right"><a href="../Main/Home.php?mnu=Information/ChangePass.php">Đổi mật khẩu</a></span>
                </div>
                <div class="form-group display-flex">
                    <label class="flex-left set-padding">Email:</label>
                    <input type="email" class="form-control flex-right" name="email" value="<?php echo $account->getInfor()[1];?>" require>
                </div>
                <div class="form-group display-flex">
                    <label class="flex-left set-padding">Điện thoại:</label>
                    <input type="number" class="form-control flex-right" name="phone" value="<?php echo "0".$account->getInfor()[2];?>" require>
                </div>
                <div class="form-group display-flex">
                    <label class="flex-left set-padding">Địa chỉ:</label>
                    <input type="text" class="form-control flex-right" name="address" value="<?php echo $account->getInfor()[3];?>" require>
                </div>
                <div class="form-group display-flex">
                    <label class="flex-left set-padding">Ảnh:</label>
                    <input type="file" name="image" >
                </div>
                <div class="form-group display-flex">
                    <label class="flex-left set-padding"></label>
                    <input type="submit" name="submit" class="btn btn-primary form-control flex-right" style="width:auto" value="Lưu thay đổi">
                </div>
            </form>
        </div>
<?php 
    class Account{
        private $student_code;
        private $email;
        private $phone;
        private $address;
        private $image; 
        function setStudentCode($student_code){
            $this->student_code=$student_code;
        }
        public function getInfor()
        {
            $student_code=$this->student_code;
            $connect=mysqli_connect("localhost","root","","studentapplication");
            mysqli_set_charset($connect, 'UTF8');
            $sql="select * from studentaccount where StudentCode='$student_code'";
            $result=mysqli_query($connect,$sql);
            $row=mysqli_fetch_assoc($result);
            $arr=[$row['FullName'],$row['Email'],$row['Phone'],$row['Address']];
            return $arr;
        }
        function setUpdateInfor(){
            $img=0;
            if(getimagesize($_FILES['image']['tmp_name']) == FALSE)
            {
                echo "Please select an image.";
            }
            else
            {
                $img= addslashes($_FILES['image']['tmp_name']);
                $img= file_get_contents($img);
                $img= base64_encode($img);
            }
            $this->email=isset($_POST['email'])?$_POST['email']:"";
            $this->phone=isset($_POST['phone'])?$_POST['phone']:"";
            $this->address=isset($_POST['address'])?$_POST['address']:"";
            $this->image=$img;
        }
        function getUpdateInfor(){
            $student_code=$this->student_code;
            $email=  $this->email;
            $phone=  $this->phone;
            $address=$this->address;
            $image=$this->image;
            $connect=mysqli_connect("localhost","root","","studentapplication");
            mysqli_query($connect,"SET NAMES 'UTF8'");
            if($image==0){
                $sql="update studentaccount set Email='$email',Phone='$phone',Address='$address' where StudentCode='$student_code' ";
            }
            else{
                $sql="update studentaccount set Email='$email',Phone='$phone',Address='$address',Img='$image' where StudentCode='$student_code' ";
            }
            
            $result=mysqli_query($connect,$sql);
            if($result)
            {
                echo("<script>
                alert('Cập nhật thông tin sinh viên thành công');
                window.location.replace('../Main/Home.php?mnu=Account.php');
                </script>");
            }
            else
            {
                echo("<script>alert('Cập nhật thông tin sinh viên thất bại');
        </script>");
            }
            mysqli_close($connect);
        }
    }        
?>   