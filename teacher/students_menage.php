<?php
require('top.inc.php');
if(isset($_GET['id']) && isset($_GET['action'])){
    $id=get_safe_value($con,$_GET['id']);
    $action=get_safe_value($con,$_GET['action']);
    if($action=='accept'){
        mysqli_query($con,"UPDATE `enroll` SET `action`=1 where id='$id'");
    }else if($action=='notaccept'){
        mysqli_query($con,"UPDATE `enroll` SET `action`=0 where id='$id'");
    }
    
}
?>

            <!-- ================ Order Details List ================= -->
            <style>
                a{
                    text-decoration:none;
                }
            .details{
                display: grid;
                grid-template-columns: 1fr;
            }
            </style>
            
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Students List</h2>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Image</td>
                                <td>Name</td>
                                <td>Age</td>
                                <td>Enrolled Date</td>
                                <th>Course</th>
                                <th>Duration</th>
                                <th>Feed</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                             if(isset($_SESSION['TEACHER_LOGIN'])){
                                
     
                                $email=$_SESSION['TEACHER_EMAIL'];
                                $courseres=mysqli_query($con,"select * from course where email='$email'");
                                while($courserow=mysqli_fetch_assoc($courseres)){
                                $courseid=$courserow['id'];
                                    $res=mysqli_query($con,"select * from enroll where course_id='$courseid'");
                                    while($row=mysqli_fetch_assoc($res)){
                                    $student_id=$row['student_id'];
                                    $course_id=$row['course_id'];
                                ?>
                            <tr>
                                <?php
                                $student_res=mysqli_query($con,"select * from student where id='$student_id'");
                                $student_row=mysqli_fetch_assoc($student_res);
                                $course_res=mysqli_query($con,"select * from course where id='$course_id'");
                                $course_row=mysqli_fetch_assoc($course_res);
                                $birthdate=$student_row['birth'];
                                $today=date('Y-m-d');
                                $diff = date_diff(date_create($birthdate), date_create($today));
                                $age = $diff->format('%y');
                                ?>
                                <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$student_row['image'] ?>" alt="" style="width: 75px;border-radius: 1rem;"></td>
                                <td><?php echo $student_row['name'] ?></td>
                                <td><?php echo $age ?></td>
                                <td><?php echo $row['added_on'] ?></td>
                                <td><?php echo $course_row['name'] ?></td>
                                <td><?php echo $course_row['duration'] ?></td>
                                <td><?php echo $course_row['feed'] ?></td>
                                <?php
                                if($row['action']==0){
                                    ?>
                                <td ><a href="?id=<?php echo $row['id'] ?>&action=accept" style="background-color:red;padding:1rem;border-radius:10px;">Not Accept</a></td>
                                <?php } else{
                                    ?>
                                    <td ><a href="?id=<?php echo $row['id'] ?>&action=notaccept" style="background-color:green;padding:1rem;border-radius:10px;">Accept</a></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php } } }
                                ?>
                        </tbody>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->

            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>