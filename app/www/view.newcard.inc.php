    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <h3 class="section-heading">Add a New Card</h3>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <form>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="ctype" id="visa" value="visa" checked>
                                    <span class="cardLogo card_visa"></span>
                                </label>
                                <label>
                                    <input type="radio" name="ctype" id="mc" value="mc">
                                    <span class="cardLogo card_mc"></span>
                                </label>
                                <label>
                                    <input type="radio" name="ctype" id="jcb" value="jcb">
                                    <span class="cardLogo card_jcb"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Foreign Transaction Fee</label>
                            <input type="text" class="form-control" name="ftfee" placeholder="0.015">
                        </div>
                        <div class="form-group">
                            <label>Reward Rate</label>
                            <input type="text" class="form-control" name="rr" placeholder="0.01">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->
