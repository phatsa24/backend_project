<?php 
    include('sidebar.php');
    global $connection;
    $up_id=$_GET['id'];
    $sql="SELECT * FROM `t_news` WHERE `id`='$up_id' ";
    $result=$connection->query($sql);
    $row=mysqli_fetch_assoc($result);
    $sport="";
    $socail="";
    $intertament="";
    $international="";
    $national="";
    $status=$row['new_type'];
    $category=$row['category'];
    if($status== "sport"){
        $sport="selected";
    } 
    else if($status=="socail"){
        $socail="selected";
    }else {
        $intertament="selected";
    }
    if($category=="national"){
        $national="selected";
    }
    else{
        $international="selected";
    }

?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>UPDATE News</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" name="id" value="<?php echo $_GET['id'] ?>">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" value="<?php echo $row['title'] ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label>News Type</label>
                                        <select class="form-select" name="news_type">
                                            <option value="sport"       <?php echo $sport ?> >sport</option>
                                            <option value="socail"      <?php echo $socail ?> >socail</option>
                                            <option value="intertainment"<?php echo $intertament ?> >intertainment</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>banner</label>
                                        <input type="file" class="form-control" name="banner">
                                        <img class="my-2" width="100px" src="assets/image/<?php echo $row['banner'] ?>" alt="">
                                        <input type="text" name="old_banner" value="<?php echo $row['banner'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>thumbnail</label>
                                        <input type="file" class="form-control" name="thumnail">
                                        <img class="my-2" width="100px" src="assets/image/<?php echo $row['thumnail'] ?>" alt="">
                                        <input type="text" name="old_thumnail" value="<?php echo $row['thumnail'] ?>">

                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-select" name="category">
                                            <option value="national"     <?php echo $national ?> >national</option>
                                            <option value="international"<?php echo $international ?> >international</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description"><?php echo $row['decription'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="accept_update_news" >OK,update</button>
                                        <a href="index.php" class="btn btn-danger">Danger</a>
                                    </div>
                                </form>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>