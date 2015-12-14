    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <h2 class="section-heading">To Pay</h2>
                    <form>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="text" class="form-control" id="exampleInputAmount" placeholder="Amount">
                                <div class="input-group-addon">.00</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Currency</label>
                            <select class="form-group" name="from"><?php
                                foreach($currencyDict as $curr => $pf){
                                    echo '<option value="'.$curr.'" '.($curr === '' ? 'selected' : '').'>'.$curr.(empty($pf['name']) ? '' : ' - '.$pf['name']).'</option>';
                                }
                            ?></select>
                        </div>
                        <button type="button" class="btn btn-default">Suggest</button>
                    </form>

                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->
