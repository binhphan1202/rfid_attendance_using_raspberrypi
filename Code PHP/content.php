<div class="page-content">
                        <div class="container-fluid">
                            <h3 style="font-family: Ebrima; font-size: 35px; text-align:center;">REGISTRATION</h3>
                            <div class="row">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title" style="font-family: Gadugi; text-align: center; font-size: 32px;"><b>STUDENT LIST&nbsp;</b></h4>
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                    <tr class="table-primary">
                                                        <th scope="col">Student RFID</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">MSSV</th>
                                                        <th scope="col">Time Modified</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($row = $q->fetch()): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($row['rfid']) ?></td>
                                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['mssv']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['time_create']); ?></td>
                                                            <td>
                                                                <a href="edit.php?rfid=<?php echo $row['rfid']; ?>" class="btn btn-success" id="edit">Edit</a> 
                                                                <a onclick="return confirm('This row will be deleted. Are you sure?');" href="delete.php?rfid=<?php echo $row['rfid'];?>" class="btn btn-danger">Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>