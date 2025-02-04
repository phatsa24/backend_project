<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php
$connection = new mysqli("localhost", "root", "", "db");

function register()
{
    global $connection;
    if (isset($_POST["btn_register"])) {

       echo $name = $_POST["user"];
       echo $email = $_POST["email"];
       echo $password = $_POST["password"];
       echo $profile = $_FILES["profile"]["name"];
        
        if (!empty($name) && !empty($email) && !empty($password) && !empty($profile)) {
            $password = md5($password);
            $thumnail = date("YmdHis") . "-" . $profile;
            $path = "assets/image/" . $thumnail;
            move_uploaded_file($_FILES["profile"]["tmp_name"], $path);

            $sql = "INSERT INTO `t_user`(`id`, `name`, `email`, `password`, `profile`) VALUES (null,'$name','$email','$password','$thumnail')";
            $result = $connection->query($sql);
            if ($result) {
                echo '
                        <script>
                             $(document).ready(function(){
                                swal({
                                    title: "SUCCESS",
                                    text: "Data Inserted",
                                    icon: "success",
                                });
                             })
                        </script>
                    ';
            } else {
                echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "ERROR",
                                    text: "Insert Failed",
                                    icon: "error",
                                  });
                            })
                        </script>
                    ';
            }
        } else {
            echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "ERROR",
                            text: "Field Must Not Be Empty",
                            icon: "error",
                        });
                    })
                 </script>
                ';
        }
    }
}
register();
function login()
{
    session_start();
    global $connection;
    if (isset($_POST["btn_login"])) {
        $name_email = $_POST['name_email'];
        $password   = $_POST['password'];
        if (!empty($name_email) && !empty($password)) {
            $password = md5($password);
            $sql = "SELECT * FROM `t_user` WHERE (`name`='$name_email' OR `email`='$name_email') AND `password`='$password'";
            $result = $connection->query($sql);
            $row = mysqli_fetch_assoc($result);
            if (!empty($row)) {
                $_SESSION['user'] = $row['id'];
                header('location:index.php');
            } else {
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Somethings went wrong",
                                icon: "error",
                            });
                        })
                    </script>
                    ';
            }
        } else {
            echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Field Must Not Be Empty",
                                icon: "error",
                            });
                        })
                    </script>
                    ';
        }
    }
}
login();

function logout()
{
    global $connection;
    if (isset($_POST["btn_logout"])) {
        session_start();
        unset($_SESSION['user']);
        header("location: login.php");
    }
}
logout();
function logo_add_post()
{
    global $connection;
    if (isset($_POST['accept_add_logo'])) {
        $show_on    = $_POST['show_on'];
        $thumnail   = $_FILES['thumnail']['name'];
        if (!empty($show_on) && !empty($thumnail)) {
            $image=date('YmdHis')."-".$thumnail;
            $path='assets/icon/'.$image;
            move_uploaded_file($_FILES['thumnail']['tmp_name'],$path);
            $sql = "INSERT INTO `t_logo`(`id`, `status`, `thumnail`) VALUES (null,'$show_on','$image')";
            $result = $connection->query($sql);
            if ($result) {
                echo '
                        <script>
                             $(document).ready(function(){
                                swal({
                                    title: "SUCCESS",
                                    text: "Data Inserted",
                                    icon: "success",
                                });
                             })
                        </script>
                    ';
            } else {
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "ERROR",
                            text: "Insert Failed",
                            icon: "error",
                          });
                    })
                </script>
            ';
            }
        } else {
            echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "ERROR",
                        text: "Field Must Not Be Empty",
                        icon: "error",
                    });
                })
             </script>
            ';
        }
    }
}
logo_add_post();
function logo_view_post(){
    global $connection;
    $sql="SELECT * FROM `t_logo` WHERE 1 ORDER BY `id` DESC LIMIT 5";
    $result=$connection->query($sql);
    while($row=mysqli_fetch_assoc($result)){
        echo '
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['status'].'</td>
                <td><img width="80px" src="assets/icon/'.$row['thumnail'].'"></td>
                <td>'.$row['created_at'].'</td>
                <td width="150px">
                    <a href="logo_update_post.php?id='.$row['id'].'" class="btn btn-primary">Update</a>
                    <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Remove
                    </button>
                </td>
            </tr> 
        ';
    }
    
}
function logo_update_post(){
    global $connection;
    if(isset($_POST['accept_update_logo'])){
        $update_id  =$_POST['post_id'];
        $show_on    =$_POST['show_on'];
        $thumnail   =$_FILES['thumnail']['name'];
        $od_thumnail=$_POST['old_thumnail'];
        if(!empty($thumnail)){
            $image=date('YmdHis').'-'.$thumnail;
            $path='assets/icon/'.$image;
            move_uploaded_file($_FILES['thumnail']['tmp_name'],$path);
        }
        else{
            $image=$od_thumnail;
        }
        $sql="UPDATE `t_logo` SET `status`='$show_on',`thumnail`='$image' WHERE `id`='$update_id'";
        $result=$connection->query($sql);
        if($result){
            echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "SUCCESS",
                        text: "Data Inserted",
                        icon: "success",
                    });
                })
            </script>
        ';
        }
        else{
            echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Somethings went wrong",
                                icon: "error",
                            });
                        })
                    </script>
                    ';
        }

    }

}
logo_update_post();
function logo_delete_post(){
    global $connection;
    if(isset($_POST['accept_delete_logo'])){
        $delete_logo=$_POST['remove_id'];
        $sql="DELETE FROM `t_logo` WHERE `id`='$delete_logo'";
        $result=$connection->query($sql);
        if($result){
            echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "SUCCESS",
                            text: "Data Deleted",
                            icon: "success",
                        });
                    })
                </script>
            ';
        }
        else{
            echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "ERROR",
                        text: "Somethings went wrong",
                        icon: "error",
                    });
                })
            </script>
            ';  
        }
    }
}
logo_delete_post();
function up_image_news($img){
    $image=date("YmdHis").'-'.$_FILES[$img]['name'];
    $path="assets/image/".$image;
    move_uploaded_file($_FILES[$img]['tmp_name'],$path);
    return $image;
}
function add_news(){
    global $connection;
   // session_start();
    if(isset($_POST['accept_add_news'])){
        $title=$_POST['title'];
        $type=$_POST['news_type'];
        $banner=up_image_news('banner');
        $thumnail=up_image_news('thumnail');
        $category=$_POST['category'];
        $description=$_POST['description'];
        $author_id=$_SESSION['user'];
        if(!empty($title) && !empty($type) && !empty($banner) && !empty($thumnail) && !empty($category) && !empty($description) && !empty($author_id)){
            $sql ="INSERT INTO `t_news`(`id`,`author_id`, `thumnail`, `banner`, `title`, `decription`, `new_type`, `category`) VALUES (null,'$author_id','$thumnail','$banner','$title','$description','$type','$category')";
            $result=$connection->query($sql);
            if($result){
                echo '
                        <script>
                             $(document).ready(function(){
                                swal({
                                    title: "SUCCESS",
                                    text: "Data Inserted",
                                    icon: "success",
                                });
                             })
                        </script>
                    ';
            }else{
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "ERROR",
                            text: "Insert Failed",
                            icon: "error",
                          });
                    })
                </script>
            ';
            }
        }else{
            echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "ERROR",
                        text: "Field Must Not Be Empty",
                        icon: "error",
                    });
                })
             </script>
            ';
        }
    }
}
add_news();
function view_news(){
    global $connection;
    $sql="SELECT t_user.name,t_news.* FROM t_news INNER JOIN t_user ON t_user.id=t_news.author_id";
    $result=$connection->query($sql);
    while($row=mysqli_fetch_assoc($result)){
        echo '
        <tr>
            </script>
            <td>'.$row['title'].'</td>
            <td>'.$row['new_type'].'</td>
            <td>'.$row['category'].'</td>
            <th>'.$row['name'].'</th>
            <td><img width="80px" src="assets/image/'.$row['banner'].'"/></td>
            <td><img width="80px" src="assets/image/'.$row['thumnail'].'"/></td>
            <td>'.$row['decription'].'</td>
            <td>'.$row['created_at'].'</td>
            <td width="150px">
                <a href="update_news.php?id='.$row['id'].'"class="btn btn-primary">Update</a>
                <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Remove
                </button>
            </td>
        </tr>
      ';
    }
}
function update_news(){
    global $connection;
    if(isset($_POST['accept_update_news'])){
        $id=$_POST['id'];
        $title=$_POST['title'];
        $type=$_POST['news_type'];
        $description=$_POST['description'];
        $category=$_POST['category'];
        $old_banner=$_POST['old_banner'];
        $old_thumnail=$_POST['old_thumnail'];
        if(!empty($_FILES['thumnail']['name'])){
            $thumnail=up_image_news('thumnail');
        }
        else{
            $thumnail=$old_thumnail;
        }
        if(!empty($_FILES['banner']['name'])){
            $banner=up_image_news('banner');
        }
        else{
            $banner=$old_banner;
        }
        $sql="UPDATE `t_news` SET `thumnail`='$thumnail',`banner`='$banner',`title`='$title',`decription`='$description',`new_type`='$type',`category`='$category' WHERE `id`='$id'";
        $result=$connection->query($sql);
        if($result){
            echo '
                <script>
                     $(document).ready(function(){
                        swal({
                            title: "SUCCESS",
                            text: "Data Updated",
                            icon: "success",
                        });
                     })
                </script>
            ';
        }else{
            echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "ERROR",
                        text: "Update Failed",
                        icon: "error",
                      });
                })
            </script>
        ';
        }
    }
}  
update_news();
function add_follow_us(){
    global $connection;
    if(isset($_POST['accept_add_follow_us'])){
        $name       =$_POST['name'];
        $url        =$_POST['url'];
        $show_on    =$_POST['show_on'];
        $image      =up_image_news('thumnail');
        if(!empty($name) && !empty($url) && !empty($show_on) && !empty($image)){
            $sql="INSERT INTO `t_follow_us`(`id`, `thumnail`, `label`, `url`, `status`) VALUES (null,'$image','$name','$url','$show_on')";
            $result=$connection->query($sql);
            if($result){
                echo '
                <script>
                     $(document).ready(function(){
                        swal({
                            title: "SUCCESS",
                            text: "Data Inserted",
                            icon: "success",
                        });
                     })
                </script>
            ';
            }else{
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "ERROR",
                            text: "Insert Failed",
                            icon: "error",
                          });
                    })
                </script>
            ';
            }
        }
        else{
            echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "ERROR",
                        text: "Field Must Not Be Empty",
                        icon: "error",
                    });
                })
             </script>
            ';
        }
    }
}
function delete_news(){
    global $connection;
    if(isset($_POST['accept_delete'])){
        $id=$_POST['remove_id'];
        $sql="DELETE FROM `t_news` WHERE `id`='$id'";
        $result=$connection->query($sql);
        if($result){
            echo '
                <script>
                     $(document).ready(function(){
                        swal({
                            title: "SUCCESS",
                            text: "Data Inserted",
                            icon: "success",
                        });
                     })
                </script>
            ';
        }
        else{
            echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "ERROR",
                            text: "Insert Failed",
                            icon: "error",
                          });
                    })
                </script>
            ';
        }
    }
}
delete_news();
add_follow_us();
function view_follow_us(){
    global $connection;
    $sql="SELECT * FROM `t_follow_us` WHERE 1 ORDER BY `id` DESC LIMIT 7";
    $result=$connection->query($sql);
    while($row=mysqli_fetch_assoc($result)){
        echo '
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['label'].'</td>
                <td><img width="80px" src="assets/image/'.$row['thumnail'].'"/></td>
                <td>'.$row['url'].'</td>
                <td>'.$row['status'].'</td>
                <td>'.$row['created_at'].'</td>
                <td width="150px">
                    <a href="update_follow_us.php?id='.$row['id'].'"class="btn btn-primary">Update</a>
                    <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Remove
                    </button>
                </td>
            </tr>
        ';
    }
}
function update_follow_us(){
    global $connection;
    if(isset($_POST['accept_update_follow_us'])){
        $id=$_POST['id'];
        $name=$_POST['name'];
        $old_thumnail=$_POST['old_thumnail'];
        $status=$_POST['show_on'];
        $url=$_POST['url'];
        if(!empty($_FILES['thumnail']['name'])){
            $image=up_image_news('thumnail');
        }
        else{
            $image=$old_thumnail;
        }
        $sql="UPDATE `t_follow_us`SET `label`='$name',`thumnail`='$image' ,`status`='$status' ,`url`='$url' WHERE `id`='$id' ";
        $res=$connection->query($sql);
        if($res){
            echo '
                <script>
                     $(document).ready(function(){
                        swal({
                            title: "SUCCESS",
                            text: "Data Updated",
                            icon: "success",
                        });
                     })
                </script>
            ';
        }
        else{
            echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "ERROR",
                        text: "Update Failed",
                        icon: "error",
                      });
                })
            </script>
        ';
        }
    }
}
update_follow_us();
function delete_follow_us(){
    global $connection;
    if(isset($_POST['accept_delete'])){
        $delete_id=$_POST['remove_id'];
        $sql="DELETE FROM `t_follow_us` WHERE `id`='$delete_id'";
        $result=$connection->query($sql);
        if($result){
            echo '
                <script>
                     $(document).ready(function(){
                        swal({
                            title: "SUCCESS",
                            text: "Data Delete",
                            icon: "success",
                        });
                     })
                </script>
            ';
        }
        else{
            echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "ERROR",
                        text: "delete Failed",
                        icon: "error",
                      });
                })
            </script>
        ';
        }
    }
}
delete_follow_us();
function add_about_us(){
    global $connection;
    if(isset($_POST['accept_about_us'])){
       $description=$_POST['description'];
       if(!empty($description)){
        $sql="INSERT INTO `t_about_us` (`id`,`description`) VALUES(null,'$description')";
        $result=$connection->query($sql);
        if($result){
            echo '
                <script>
                     $(document).ready(function(){
                        swal({
                            title: "SUCCESS",
                            text: "Data Inserted",
                            icon: "success",
                        });
                     })
                </script>
            ';
        }else{
            echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "ERROR",
                            text: "Insert Failed",
                            icon: "error",
                          });
                    })
                </script>
            ';
        }
       }else{
        echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "ERROR",
                        text: "Field Must Not Be Empty",
                        icon: "error",
                    });
                })
             </script>
            ';
       }
    }
}
add_about_us();
function view_about_us(){
    global $connection;
    $sql="SELECT * FROM `t_about_us` WHERE 1 ORDER BY `id` DESC";
    $result=$connection->query($sql);
   while( $row=mysqli_fetch_assoc($result)){
     echo '
         <tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['description'].'</td>
            <td>'.$row['created'].'</td>
            <td width="150px">
                <a href="update_about_us.php?id='.$row['id'].'"class="btn btn-primary"  >Update</a>
                <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Remove
                </button>
            </td>
        </tr>     
     ';
   }
}
function update_about_us(){
    global $connection;
    if(isset($_POST['accept_update_about_us'])){
        $id=$_POST['id'];
        $description=$_POST['description'];
        $sql="UPDATE `t_about_us` SET `description`='$description' WHERE `id`='$id'";
        $result=$connection->query($sql);
        if($result){
            echo '
            <script>
                 $(document).ready(function(){
                    swal({
                        title: "SUCCESS",
                        text: "Data Updated",
                        icon: "success",
                    });
                 })
            </script>
        '; 
        }else{
            echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "ERROR",
                        text: "Update Failed",
                        icon: "error",
                      });
                })
            </script>
        ';  
        }  
    }
}
update_about_us();
function delete_about_us(){
    global $connection;
    if(isset($_POST['accept_delete_about_us']))
    {
        $delete_id=$_POST['remove_id'];
        $sql="DELETE FROM `t_about_us` WHERE `id`='$delete_id'";
        $result=$connection->query($sql);
        if($result){
            echo '
                <script>
                     $(document).ready(function(){
                        swal({
                            title: "SUCCESS",
                            text: "Data delete",
                            icon: "success",
                        });
                     })
                </script>
            ';
        }else{
            echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "ERROR",
                        text: "delete Not success",
                        icon: "error",
                      });
                })
            </script>
        ';
        }
    }
}
delete_about_us();


?>