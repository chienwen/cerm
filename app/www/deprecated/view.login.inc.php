    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <h2 class="section-heading">Login</h2>
                    <form method="post">
                        <?php if(!empty($_GET['e'])){ ?>
                        <div class="alert alert-danger">
                            Login failed.
                        </div>
                        <?php } ?>
                        <input type="hidden" name="action" value="login">
                        <input type="hidden" name="done" value="<?php
                            if(empty($_GET['d'])) echo 'dashboard';
                            else echo $_GET['d'];
                        ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="passwd" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Submit</button>
                            new to <?php echo PRODUCT_NAME;?>? <a href="?v=signup">sign up</a> now
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->
