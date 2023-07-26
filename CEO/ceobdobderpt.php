<?php include('ceoheader.php'); ?>

<div class="main-content" style="min-height: 530px;">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>BDE Report</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>SN</th>
                                            <th>Username</th>
                                            <th>Employee Code</th>
                                            <th>Password</th>
                                            <th>Staus</th>
                                            <th>PostDate</th>
                                        </tr>
                                        <?php
                                        if (isset($_GET['update'])) {
                                            $id = $_GET['update'];
                                            $status = "active";
                                            if ($status == "active") {
                                                $sql = "UPDATE bde SET status='inactive' WHERE id='$id'";
                                                $result = mysqli_query($conn, $sql);
                                                if ($result) {
                                                    echo "<script>alert('User Inactive!')location.href='ceobdobderpt.php';</script>";
                                                }
                                            }
                                        }
                                        ?>
                                        <?php
                                        $sql = "SELECT * FROM bde";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["id"] . "</td>";
                                                echo "<td>" . $row["username"] . "</td>";
                                                echo "<td>" . $row["employee_code"] . "</td>";
                                                echo "<td>" . $row["password"] . "</td>";
                                                echo "<td><a href='ceobdobderpt.php?update=" . $row['id'] . " '>" . $row['status'] . "</a></td>";
                                                echo "<td>" . $row["postdate"] . "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "No Data Avialable";
                                        }
                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1 <span
                                                class="sr-only">(current)</span></a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div> -->
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
<?php include('ceofooter.php'); ?>