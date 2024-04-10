<?php include('includes/header.php'); ?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card" style="width: 900px; height: 600px;">
            <div class="card-header">
                <h4>
                    Users Lists
                    <a href="users-create.php" class="btn btn-primary float-end">Add Users</a>
                </h4>
            </div>
            <div class="card-body">
               <?= Functions::alertMessage(); ?> 

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="font-size: 12px;"> <!-- Adjusted font size -->
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Is_Ban</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $users = Functions::getall('users'); // Retrieve user data using getall() function

                            if (!empty($users)) { // Check if there are users returned
                                foreach ($users as $userItem) {
                            ?>
                                    <tr>
                                        <td><?= $userItem['id']; ?></td>
                                        <td><?= $userItem['name']; ?></td>
                                        <td><?= $userItem['email']; ?></td>
                                        <td><?= $userItem['phone']; ?></td>
                                        <td><?= $userItem['role']; ?></td>
                                        <td><?= $userItem['is_ban'] ==1 ?'Banned':'Active' ; ?></td>
                                        <td>
                                            <a href="users-edit.php?id=<?= $userItem['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="users-delete.php?id=<?= $userItem['id']; ?>" class="btn btn-danger btn-sm mx-2"
                                            onclick="return confirm('Are you sure you want to delete this data ?')"
                                            >
                                             
                                            Delete
                                            
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="7">No Record Found</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
