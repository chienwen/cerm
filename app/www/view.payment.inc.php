    <div class="content-section-a payment">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <h2 class="section-heading">To Pay</h2>
                    <form>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="text" class="form-control" id="inputAmount" placeholder="Amount">
                                <div class="input-group-addon">.00</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Currency</label>
                            <select class="form-group" name="from"><?php
                                foreach($currencyDict as $curr => $pf){
                                    echo '<option value="'.$curr.'" '.($curr === 'JPY' ? 'selected' : '').'>'.$curr.(empty($pf['name']) ? '' : ' - '.$pf['name']).'</option>';
                                }
                            ?></select>
                        </div>
                        <button type="button" class="btn btn-default" id="suggest">Suggest</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 col-sm-6 loading hidden">
                    <img src="img/loading.gif">
                </div>
                <div class="col-lg-5 col-sm-6 suggestion hidden">
                    <ol class="cardlist">
                        <li>
                            <div class="ccard">
                                <h4>citibank golden card</h4>
                                <span class="cardLogo card_visa"></span>
                                <div class="row">
                                    <div class="col-md-1 d-ib"><i class="fa fa-money"></i> 1,490 TWD</div>
                                    <div class="col-md-1 d-ib"><a href="javascript:$('#sug1').removeClass('hidden');" class="detailClk"><i class="fa fa-info"></i> details</a></div>
                                </div>
                                <div class="row hidden details" id="sug1" style="margin-left: 20px;">
                                    <table>
                                        <tr>
                                            <td>JPY</td>
                                            <td>5,700</td>
                                        </tr>
                                        <tr>
                                            <td>JCB Ex-rate Today</td>
                                            <td>0.2648</td>
                                        </tr>
                                        <tr>
                                            <td>JCB Ex-rate Est.</td>
                                            <td>0.2652</td>
                                        </tr>
                                        <tr>
                                            <td>TWD</td>
                                            <td>1490</td>
                                        </tr>
                                        <tr>
                                            <td>Trans. fee</td>
                                            <td>+30</td>
                                        </tr>
                                        <tr>
                                            <td>Cash back</td>
                                            <td>-18</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="ccard">
                                <h4>hsbc world card</h4>
                                <span class="cardLogo card_mc"></span>
                                <div class="row">
                                    <div class="col-md-1 d-ib"><i class="fa fa-money"></i> 1,500 TWD</div>
                                    <div class="col-md-1 d-ib"><a href="javascript:$('#sug2').removeClass('hidden');" class="detailClk"><i class="fa fa-info"></i> details</a></div>
                                </div>
                                <div class="row hidden details" id="sug2" style="margin-left: 20px;">
                                    <table>
                                        <tr>
                                            <td>JPY</td>
                                            <td>5,700</td>
                                        </tr>
                                        <tr>
                                            <td>MasterCard Ex-rate Today</td>
                                            <td>0.2648</td>
                                        </tr>
                                        <tr>
                                            <td>MasterCard Ex-rate Est.</td>
                                            <td>0.2652</td>
                                        </tr>
                                        <tr>
                                            <td>TWD</td>
                                            <td>1500</td>
                                        </tr>
                                        <tr>
                                            <td>Trans. fee</td>
                                            <td>+41</td>
                                        </tr>
                                        <tr>
                                            <td>Cash back</td>
                                            <td>-28</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="ccard">
                                <h4>yahoo business card</h4>
                                <span class="cardLogo card_mc"></span>
                                <div class="row">
                                    <div class="col-md-1 d-ib"><i class="fa fa-money"></i> 1,520 TWD</div>
                                    <div class="col-md-1 d-ib"><a href="javascript:$('#sug3').removeClass('hidden');" class="detailClk"><i class="fa fa-info"></i> details</a></div>
                                </div>
                                <div class="row hidden details" id="sug3" style="margin-left: 20px;">
                                    <table>
                                        <tr>
                                            <td>JPY</td>
                                            <td>5,700</td>
                                        </tr>
                                        <tr>
                                            <td>MasterCard Ex-rate Today</td>
                                            <td>0.2648</td>
                                        </tr>
                                        <tr>
                                            <td>MasterCard Ex-rate Est.</td>
                                            <td>0.2652</td>
                                        </tr>
                                        <tr>
                                            <td>TWD</td>
                                            <td>1520</td>
                                        </tr>
                                        <tr>
                                            <td>Trans. fee</td>
                                            <td>+18</td>
                                        </tr>
                                        <tr>
                                            <td>Cash back</td>
                                            <td>-12</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-1 d-ib"><i class="fa fa-money"></i> 1,522 TWD</div>
                                    <div class="col-md-1 d-ib"><a href="javascript:$('#sug4').removeClass('hidden');" class="detailClk"><i class="fa fa-info"></i> details</a></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="ccard">
                                <h4>bank or america diamond card</h4>
                                <span class="cardLogo card_jcb"></span>
                                <div class="row">
                                    <div class="col-md-1 d-ib"><i class="fa fa-money"></i> 1,542 TWD</div>
                                    <div class="col-md-1 d-ib"><a href="javascript:$('#sug5').removeClass('hidden');" class="detailClk"><i class="fa fa-info"></i> details</a></div>
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->
