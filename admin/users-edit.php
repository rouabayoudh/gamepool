<?php include('includes/header.php'); ?>

<div class="row" style="max-width: 1000px; margin-left: auto; margin-right: auto;">
    <div class="col-md-12">
        <div class="card" style="width: 80%; height: 80%;">
            <div class="card-header">
                <h4>
                    <h4 style="font-family: Comic Sans MS;">Update Users</h4>
                    <a href="users.php" class="btn btn-danger" style="margin-left: auto;">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="code.php" method="POST">

                    <?php
                        $paramResult = Functions::checkParamId('id');
                        if (!is_numeric($paramResult)) {
                            echo '<h5>' . $paramResult . '</h5>';
                            return false;
                        }
                        $user = Functions::getById('users', Functions::checkParamId('id'));
                        if ($user['status'] == 200) {
                    ?>
                    <input type="hidden" name="userId" value="<?= $user['data']['id']; ?>" required>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Name</label>
                                <br/><br/><br/><br/>
                                <input type="text" name="name" value="<?= $user['data']['name']; ?>" required class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Phone No.</label>
                                <br/><br/><br/><br/>
                                <input type="text" name="phone" value="<?= $user['data']['phone']; ?>" required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Email</label>
                                <br/><br/><br/><br/>
                                <input type="email" name="email" value="<?= $user['data']['email']; ?>" required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Password</label>
                                <br/><br/><br/>
                                <input type="password" name="password" value="<?= $user['data']['password']; ?>" required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Select a Role</label>
                                <br/><br/><br/><br/>
                                <select name="role" required class="form-select">
                                    <option value="">Select a Role</option>
                                    <option value="admin" <?= $user['data']['role'] == 'Admin' ? 'selected' : ''; ?>> Admin</option>
                                    <option value="user" <?= $user['data']['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3 ">
                                <label>Is Ban</label>
                                <br/><br/><br/><br/><br/>
                                <input type="checkbox" name="is_ban" <?= $user['data']['is_ban'] == true ? 'checked' : ''; ?> style="width:30px ;height:30px" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3 text-end" style="margin-left: auto;">
                            <br/><br/><br/><br/><br/>
                            <button type="submit" name="updateUser" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    <?php
                        } else {
                            echo '<h5>'. $user['message'] . '</h5>';
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
