<!-- @import jquery & sweet alert  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php 
    $connection = new mysqli("localhost","root","","db");
    function get_website_logo($status){
        global $connection;
        $sql = "SELECT * FROM `t_logo` WHERE `status`='$status' ORDER BY `id` DESC LIMIT 1 ";
        $result=$connection->query($sql);
        $row=mysqli_fetch_assoc($result);
        return $row['thumnail'];
    }
    function feedback(){
        global $connection;
        if(isset($_POST['btn_message'])){
            $name   =$_POST['name'];
            $email  =$_POST['email'];
            $address=$_POST['address'];
            $phone  =$_POST['phone'];
            $message=$_POST['message'];
            if(!empty($name) && !empty($email) && !empty($phone) &&!empty($address) &&!empty($message)){
                $sql="INSERT INTO `t_feedback` (`id`,`name`,`phone`,`email`,`address`,`message`) VALUES(null,'$name','$phone','$email','$address','$message')";
                $result=$connection->query($sql);
            }
        }
            
    }
    feedback();
    function view_follow_us(){
        global $connection;
        $sql="SELECT * FROM `t_follow_us` WHERE 1 ORDER BY `id` DESC LIMIT 7";
        $result=$connection->query($sql);
       while( $row=mysqli_fetch_assoc($result)){
        echo '
             <li>
                <a id="btn" href="'.$row['url'].'" > <img id="btn_img" src="../admin/assets/image/'.$row['thumnail'].'" width="40px" ></a>
                <a id="btn" href="'.$row['url'].'" >'.$row['label'].'</a>
            </li> 
        ';
       }
    }
    function get_follow_us_footer(){
        global $connection;
        $sql="SELECT * FROM `t_follow_us` WHERE 1 ORDER BY `id` DESC LIMIT 3";
        $result=$connection->query($sql);
        while($row=mysqli_fetch_assoc($result)){
            echo '
                <li>
                   <a href="'.$row['url'].'"><img width="40px" height="40px" src="../admin/assets/image/'.$row['thumnail'].'" alt=""></a>
                </li>
            ';
        }
    }
    function get_about_us(){
        global $connection;
        $sql="SELECT * FROM `t_about_us` WHERE 1 ORDER BY `id` DESC LIMIT 1";
        $result=$connection->query($sql);
        $row=mysqli_fetch_assoc($result);
       
        echo '
            <div class="description">
             '.$row['description'].'
            </div>   
        ';
    }
    function get_news_type($status){
        global $connection;
        $sql="SELECT * FROM `t_news` WHERE `new_type`='$status' ORDER BY `id` DESC LIMIT 3";
        $result=$connection->query($sql);
        while($row=mysqli_fetch_assoc($result)){
            echo '
                <div class="col-4">
                    <figure>
                        <a href="news-detail.php?id='.$row['id'].'">
                            <div class="thumbnail">
                                <img src="../admin/assets/image/'.$row['thumnail'].'" alt="">
                            <div class="title">
                                    '.$row['title'].'
                            </div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';
        }
    }
    function get_view($id){
        global $connection;
        $sql="UPDATE `t_news` SET `view`=view+1 WHERE  `id`='$id'";
        $result=$connection->query($sql);
    }
    function get_trending_new(){
        global $connection;
        $sql="SELECT * FROM `t_news` WHERE 1 ORDER BY `view` DESC LIMIT 2";
        $result=$connection->query($sql);
        while($row=mysqli_fetch_assoc($result)){
            echo '
                <i class="fas fa-angle-double-right"></i>
                <a href="news-detail.php?id='.$row['id'].'">'.$row['title'].'</a> &ensp;
            ';
        }
    }
    function get_trend_new(){
        global $connection;
        $sql=" SELECT * FROM `t_news` WHERE 1 ORDER BY `view` DESC LIMIT 1";
        $result=$connection->query($sql);
        $row=mysqli_fetch_assoc($result);
        echo '
            <div class="col-8 content-left">
                <figure>
                    <a href="news-detail.php?id='.$row['id'].'">
                        <div class="thumbnail">
                            <img src="../admin/assets/image/'.$row['banner'].'" alt="">
                            <div class="title">
                                '.$row['title'].'
                            </div>
                        </div>
                    </a>
                </figure>
            </div> 
        ';
    }
    function get_latest_news(){
        global $connection;
        $sql_trending="SELECT `id` FROM `t_news`  WHERE 1  ORDER BY `view` DESC LIMIT 1";
        $result_trending=$connection->query($sql_trending);
        $row=mysqli_fetch_assoc($result_trending);
        $id=$row['id'];

        $sql="SELECT * FROM `t_news` WHERE `id`!='$id' ORDER BY `view` DESC LIMIT 2";
        $result=$connection->query($sql);
        while($row=mysqli_fetch_assoc($result)){
            echo '
                <div class="col-12">
                    <figure>
                        <a href="news-detail.php?id='.$row['id'].'">
                            <div class="thumbnail">
                                <img src="../admin/assets/image/'.$row['thumnail'].'" alt="">
                            <div class="title">
                                '.$row['title'].'
                            </div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';
        }
    }
    function get_category_news($category,$news_type){
        global $connection;
        $sql="SELECT * FROM `t_news` WHERE (`category`='$category' AND `new_type`='$news_type') ORDER BY `id` DESC ";
        $result=$connection->query($sql);
        while($row=mysqli_fetch_assoc($result)){
            echo '
                <div class="col-4">
                    <figure>
                        <a href="news-detail.php?id='.$row['id'].'">
                            <div class="thumbnail">
                                <img src="../admin/assets/image/'.$row['thumnail'].'" alt="">
                            </div>
                            <div class="detail">
                                <h3 class="title">'.$row['title'].'</h3>
                                <div class="date">'.$row['created_at'].'</div>
                                <div class="description">
                                    '.$row['decription'].'
                                </div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';           
        }
    }
    function get_relate_news($post_id){
        global $connection;
        $sql_news_type="SELECT * FROM `t_news` WHERE `id`='$post_id' ORDER BY `id` DESC LIMIT 1 ";
        $result_news_type=$connection->query($sql_news_type);
        $row_news_type=mysqli_fetch_assoc($result_news_type);
        $news_type=$row_news_type['new_type'];

        $sql="SELECT * FROM `t_news` WHERE `new_type`='$news_type' AND `id` NOT IN ('$post_id') ORDER BY `id` DESC LIMIT 2";
        $result=$connection->query($sql);
        while($row=mysqli_fetch_assoc($result)){
            echo '
                <figure>
                    <a href="news-detail.php?id='.$row['id'].'">
                        <div class="thumbnail">
                            <img src="../admin/assets/image/'.$row['thumnail'].'" alt="">
                        </div>
                        <div class="detail">
                            <h3 class="title">'.$row['title'].'</h3>
                            <div class="date">'.$row['created_at'].'</div>
                            <div class="description">
                                '.$row['decription'].'
                            </div>
                        </div>
                    </a>
                </figure>
            ';
        }
        
    }
    function search_news(){
        global $connection;
        $query = $_GET['query'];
        $sql="SELECT * FROM `t_news` WHERE `decription` LIKE '%$query%' OR `title` LIKE  '%$query%'
        OR `new_type` LIKE '%$query%' OR `category` LIKE '%$query%' OR `created_at` LIKE '%$query%'";
        $result=$connection->query($sql);
        while($row=mysqli_fetch_assoc($result)){
            echo '
                <div class="col-4">
                    <figure>
                        <a href="news-detail.php?id='.$row['id'].'">
                            <div class="thumbnail">
                                <img src="../admin/assets/image/'.$row['thumnail'].'" alt="">
                            </div>
                            <div class="detail">
                                <h3 class="title">'.$row['title'].'</h3>
                                <div class="date">'.$row['created_at'].'</div>
                                <div class="description">
                                    '.$row['decription'].'
                                </div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';           
        }  
    }
   
?>