<?php 
    include('sidebar.php');
    global $connection;
    $up_id=$_GET['id'];
    $sql="SELECT * FROM `t_follow_us` WHERE `id`='$up_id'";
    $result=$connection->query($sql);
    $row=mysqli_fetch_assoc($result); 
    $status=$row['status'];
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>UPDATE FOLLOW US</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="<?php echo $up_id ?>">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $row['label'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>thumnail</label>
                                        <input type="file" name="thumnail" class="form-control">
                                        <img class="my-2" width="80px"  src="assets/image/<?php echo $row['thumnail'] ?>" alt="">
                                        <input type="text" name="old_thumnail" value="<?php echo $row['thumnail'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>URL</label>
                                        <input type="url" name="url" class="form-control" value="<?php  echo $row['url']?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-select" name="show_on">
                                            <option value="facebook"    <?php if($status=="facebook"){ echo "selected";} ?>>Facebook </option>
                                            <option value="youtube"     <?php if($status=="youtube"){ echo "selected";}  ?>>Youtube  </option>
                                            <option value="instagram"   <?php if($status=="instagram"){ echo "selected";}?>>Instagram</option>
                                            <option value="telegram"    <?php if($status=="telegram"){ echo "selected";} ?>>Telegram </option>
                                             <option value="email"      <?php if($status=="email"){ echo "selected";}    ?>> Email   </option>
                                            <option value="tik tok"     <?php if($status=="tik tok"){ echo "selected";}  ?>> Tik Tok </option>
                                            <option value="phone"       <?php if($status=="phonek"){ echo "selected";}   ?>>phone    </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="accept_update_follow_us" class="btn btn-success">OK,Update</button>
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