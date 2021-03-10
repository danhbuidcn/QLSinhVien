<?php
    $StudentCode=$_SESSION['name'];
    $connect=mysqli_connect("localhost","root","","studentapplication");
    mysqli_set_charset($connect, 'UTF8');
    $sql="select * from studentaccount where StudentCode='$StudentCode'";
    $result=mysqli_query($connect,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $Name=$row['FullName'];
    }
?>
<div class="head-float">   
                <a href="Home.php"><img src="/StudentApplication/Content/logo.png" height="50px"></a>
                <span>TRANG SINH VIÊN</span>
            </div>
            <div class="head-float dropdown" id="account">
                    <a class="nav-link dropdown-toggle" id="dropdownAccount" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $Name;?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownAccount">
                        <button class="dropdown-item active" type="button" ><?php echo $Name;?></button>
                        <a class="dropdown-item" href="../Main/Home.php?mnu=Account.php"><i style="padding-right: 10px" class="fa fa-user"></i>Account</a>
                        <a class="dropdown-item" href="../Main/Home.php?mnu=Account.php"><i style="padding-right: 10px" class="fa fa-cog"></i>Setting</a>
                        <a class="dropdown-item" href="../Logout.php"><i style="padding-right: 10px" class="fa fa-share"></i>Logout</a>
                    </div>
            </div>