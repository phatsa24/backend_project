<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>FOLLOW US</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>thumnail</label>
                                        <input type="file" name="thumnail" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>URL</label>
                                        <input type="url" name="url" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-select" name="show_on">
                                            <option value="facebook" >Facebook</option>
                                            <option value="youtube" >Youtube</option>
                                            <option value="instagram" >Instagram</option>
                                            <option value="telegram" >Telegram</option>
                                            <option value="email" > Email</option>
                                            <option value="tik tok" > Tik Tok</option>
                                            <option value="phone" >phone</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="accept_add_follow_us" class="btn btn-success">Add</button>
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