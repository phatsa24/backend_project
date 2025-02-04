
<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add Website Logo</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Show on</label>
                                        <select class="form-select" name="show_on">
                                            <option value="header">header</option>
                                            <option value="footer">footer</option>
                                        </select>
                                    </div>
                                   
                                    <div class="form-group" >
                                        <label>File</label>
                                        <input type="file" name="thumnail" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <button name="accept_add_logo" type="submit" class="btn btn-primary">Add  logo</button>
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