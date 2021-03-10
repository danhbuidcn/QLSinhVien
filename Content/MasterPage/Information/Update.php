
<style>
    #container{
        width: 100%;
        margin: 0 auto;
        padding:0 ;
        color:#404040;
    }
    /* phần đầu thông tin cá nhân */
    #contentHeader{
        padding: 20px;
        padding-top: 0;
        background-color: white;
    }
    #contentHeader img{
        border-radius: 50%;
    }
    .user-display{
        display:flex;
        align-items:flex-end;
        justify-content: left;
    }
    .user-display-infor{
        flex-grow: 1;
    }
    .infor-image{
        max-width: 120px;
    }
    .name{
        font-weight: 700;
        font-size: 18px;
    }
    .infor{
        font-size:18px;
    }
    /* thanh điều hướng thông tin */
    #contentNav{
        width: 100%;
        background-color: white;
        margin: 20px 0;
    }
    #contentNav .page-item{
        border:none;
        background-color: white;
        padding: 10px 20px ;
    }
    #contentNav a{
        font-size: 13px;
    }
    .active{
        border-bottom: 2px solid #4285f4 !important;
    }
</style>
<?php 
    $account=new Account();
    $student_code=$_SESSION['name'];
    $account->setStudentCode($student_code);
?>
<div id="container">
    <div id="contentHeader">
        <div class="user-display">
            <div class="user-display-infor infor-image">
                <?php echo "<img src='data:image;base64,".$account->getInforStudent()[1]."' width='100px' height='100px'>"; ?>
            </div>
            <div class="user-display-infor">
                <div class="title">Tên sinh viên</div>
                <div class="name"><?php echo $account->getInforStudent()[0]; ?></div>
            </div>
        </div>
        <div class="user-display">
            <div class="user-display-infor">
                <div class="title">Mã sinh viên</div>
                <div class="infor"><?php echo $student_code; ?></div>
            </div>
            <div class="user-display-infor">
                <div class="title">Khoa quản lý</div>
                <div class="infor"><?php ?>Tên khoa</div>
            </div>
            <div class="user-display-infor">
                <div class="title">Lớp</div>
                <div class="infor"><?php ?>Tên Lớp</div>
            </div>
        </div>
    </div>
    <div id="contentNav">
        <nav>
            <ul class="pagination pagination-md">
                <li class="page-item active" aria-current="page">
                    <a class="item-link" href="#">THÔNG TIN CÁ NHÂN</a>
                </li>
                <li class="page-item"><a class="item-link" href="#">THÔNG TIN GIA ĐÌNH</a></li>
                <li class="page-item"><a class="item-link" href="#">THÔNG TIN LIÊN HỆ</a></li>
            </ul>
        </nav>
    </div>
    <div id="contentBody">
        <script>
            $(".page-item").click(function(){
                $(".page-item").removeClass("active");
                $(this).addClass("active");
                var id=$(this).find("a").attr("href");
                if(id=="#personal"){
                    $(".personal").show();
                }
            });
        </script>
    </div>
    <?php 
    class Account{
        protected $student_code;
        protected $full_name;
        protected $image;
        function setStudentCode($student_code){
            $this->student_code=$student_code;
        }
        function getInforStudent(){
            $student_code=$this->student_code;
            $full_name=$this->full_name;
            $image=$this->image;
            $connect=mysqli_connect("localhost","root","","studentapplication");
            mysqli_query($connect,"SET NAMES 'UTF8'");
            $sql="select * from studentaccount where StudentCode='$student_code'";
            $result=mysqli_query($connect,$sql);
            $row=mysqli_fetch_assoc($result);
            $full_name=$row['FullName'];
            $image=$row['Img'];
            $arr=[$full_name,$image];
            return $arr;
        }
    }
    ?>
</div>