<?php include('header.php'); 
global $connection;
$post_id=$_GET['id'];
$sql="SELECT * FROM `t_news` WHERE `id`='$post_id'";
$result=$connection->query($sql);
$row=mysqli_fetch_assoc($result);
?>
<main class="news-detail">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="main-news">
                        <div class="thumbnail">
                            <img src="../admin/assets/image/<?php echo $row['banner'] ?>">
                        </div>
                        <div class="detail">
                            <h3 class="title"><?php echo $row['title'] ?></h3>
                            <div class="date"><?php echo $row['created_at'] ?></div>
                            <div class="description">
                                    <?php echo $row['decription'] ?>
                            </div>
                        </div>
                    </div>
                   <?php get_view($post_id) ?>
                </div>
                <div class="col-4">
                    <div class="relate-news">
                        <h3 class="main-title">Related News</h3>
                        <!-- <figure>
                            <a href="">
                                <div class="thumbnail">
                                    <img src="https://via.placeholder.com/350x200" alt="">
                                </div>
                                <div class="detail">
                                    <h3 class="title">Kloppថា​ Liverpool ត្រូវ​ធ្វើ​បែប​នេះ​ ក្រោយ​អស់​ពី​ Mane</h3>
                                    <div class="date">17/July/2022</div>
                                    <div class="description">
                                        លោក​ Jorgen Klopp អ្នកចាត់ការ​ក្លឹប​ Liverpool បាន​និយាយ​នៅ​ក្នុង​ថ្ងៃ​នេះ​ថា​ បន្ទាប់​ពី​ខ្សែ​ប្រយុទ្ធ​ Sadio Mane ចាកចេញ​ទៅ​កាន់​ Bayern Munich ក្រុម​របស់​លោក​ត្រូវ​តែ​ខិត​ខំ​សហការ​គ្នា​ជា​ធ្លុង​មួយសារ​ជា​ថ្មី​​នឹង​កីឡាករ​ដែល​កំពុង​មាន​វត្តមាន​ស្រាប់​នៅ​ក្លឹប​លោក​។
                                    </div>
                                </div>
                            </a>
                        </figure>
                        <figure>
                            <a href="">
                                <div class="thumbnail">
                                    <img src="https://via.placeholder.com/350x200" alt="">
                                </div>
                                <div class="detail">
                                    <h3 class="title">Kloppថា​ Liverpool ត្រូវ​ធ្វើ​បែប​នេះ​ ក្រោយ​អស់​ពី​ Mane</h3>
                                    <div class="date">17/July/2022</div>
                                    <div class="description">
                                        លោក​ Jorgen Klopp អ្នកចាត់ការ​ក្លឹប​ Liverpool បាន​និយាយ​នៅ​ក្នុង​ថ្ងៃ​នេះ​ថា​ បន្ទាប់​ពី​ខ្សែ​ប្រយុទ្ធ​ Sadio Mane ចាកចេញ​ទៅ​កាន់​ Bayern Munich ក្រុម​របស់​លោក​ត្រូវ​តែ​ខិត​ខំ​សហការ​គ្នា​ជា​ធ្លុង​មួយសារ​ជា​ថ្មី​​នឹង​កីឡាករ​ដែល​កំពុង​មាន​វត្តមាន​ស្រាប់​នៅ​ក្លឹប​លោក​។
                                    </div>
                                </div>
                            </a>
                        </figure> -->
                        <?php 
                            get_relate_news($post_id);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('footer.php'); ?>