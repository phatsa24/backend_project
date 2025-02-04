<?php
    include("sidebar.php");
    //include("function.php");

?>
<div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Are you sure ?</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <a href="index.php" type="submit" class="btn btn-danger">Cancel</a>
                                        <button name="btn_logout" type="submit" class="btn btn-success">Yes,Logout</button>
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
