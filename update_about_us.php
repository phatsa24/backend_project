<?php 
    global $connection;
    include('sidebar.php');
    $id=$_GET['id'];
    $sql="SELECT * FROM `t_about_us` WHERE `id`='$id'";
    $result=$connection->query($sql);
    $row=mysqli_fetch_assoc($result);

?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update About Us </h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">                                 
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="<?php  echo $_GET['id']?>">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description"><?php echo $row['description'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="accept_update_about_us">ok,update</button>
                                        <a href="index.php" class="btn btn-danger">Cancel</a>
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