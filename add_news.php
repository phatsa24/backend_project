<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add Sport News</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label>News Type</label>
                                        <select class="form-select" name="news_type">
                                            <option value="sport">sport</option>
                                            <option value="socail">socail</option>
                                            <option value="intertainment">intertainment</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>banner</label>
                                        <input type="file" class="form-control" name="banner">
                                    </div>
                                    <div class="form-group">
                                        <label>thumbnail</label>
                                        <input type="file" class="form-control" name="thumnail">
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-select" name="category">
                                            <option value="national">national</option>
                                            <option value="international">international</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="accept_add_news" >Add</button>
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