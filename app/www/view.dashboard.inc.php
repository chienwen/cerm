    <div class="content-section-a">

        <div class="container">
            <!--
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <h2 class="section-heading">Real-time Exchange Rates</h2>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <?php /* <p><pre><?php print_r($_SESSION['login']);?></pre></p> */ ?>
                    <form>
                        <select class="form-group" name="from"><?php
                            foreach($currencyDict as $curr => $pf){
                                echo '<option value="'.$curr.'" '.($curr === '' ? 'selected' : '').'>'.$curr.(empty($pf['name']) ? '' : ' - '.$pf['name']).'</option>';
                            }
                        ?></select>
                    </form>
                </div>
            </div>
            -->
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <h2 class="section-heading">Trending</h2>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <iframe src="http://people.cs.nctu.edu.tw/~chienwen/cerm/?from=JPY&to=TWD&days=14&w=300&h=300" width="360" height="420" frameborder="0" scrolling="no"></iframe>
                </div>
                <?php /* ?>
                <div class="col-lg-5 col-sm-6">
                    <h2 class="section-heading">Welcome to Card Master!</h2>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/cmlogo.png" alt="">
                </div>
                <?php */ ?>
            </div>
        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->
