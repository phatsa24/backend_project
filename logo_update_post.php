
<?php 
    include('sidebar.php');
    $post_id= $_GET['id'];
    $sql="SELECT * FROM `t_logo` WHERE `id`='$post_id'";
    $result=$connection->query($sql);
    $row=mysqli_fetch_assoc($result);
    $select_1="";
    $select_2="";
    $status=$row['status'];
    if($status=="header"){
        $select_1="selected";
    }
    else{
        $select_2="selected";
    }
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update Website Logo</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Show on</label>
                                        <select class="form-select" name="show_on">
                                            <option value="header"<?php echo $select_1 ?> >header</option>
                                            <option value="footer"<?php echo $select_2 ?> >footer</option>
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <label>Thumbnail</label>
                                        <input type="file" name="thumnail" class="form-control">
                                    </div>
                                    <input type="hidden" name="old_thumnail" value="<?php echo $row['thumnail'] ?>">
                                    <input name="post_id" type="hidden" value="<?php echo $post_id ?>">
                                    <img width="80px" src="assets/icon/<?php echo $row['thumnail'] ?>" alt="">
                                    <div class="form-group mt-2">
                                        <button name="accept_update_logo" type="submit" class="btn btn-primary">Update logo</button>
                                        <a  href="index.php" class="btn btn-danger">Cancel</a>
                                       
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
