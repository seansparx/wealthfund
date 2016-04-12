<section class="bank-info  animated fadeInRight">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 main-bank-wrap">
                <div class="search-form">
                    <h1>See all your accounts in one place</h1>
                    <span>Search for your bank, credit cards or investments:</span>
                    <form action="" id="form_site_search" method="post">
                        <div class="input-group">
                            <input type="text" placeholder="Search Accounts/Wallets" name="search" id="search_keyword" class="form-control input-lg">
                            <div class="input-group-btn">
                                <button class="btn btn-lg btn-primary" id="btn-searchSite" type="button">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="banking-list ">
                    <h2 class="text-center">List of Accounts to Configure </h2>

                    <div id="banks_container" class="row m-t-lg">
                        <div id="pop_banks" class="col-xs-12 col-sm-6 col-md-8">
                            <h3 class="text-center text-capitalize"> bank accounts </h3>
                            <ul class="bank-listing-wrap list-unstyled clearfix">
                                <li>
                                    <a href="#"> <img src="../assets/img/Chase.png" alt="chase" /></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="../assets/img/Bank_Of_America.png" alt="Bank_Of_America" /></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="../assets/img/Wells_Fargo.png" alt="chase" /></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="../assets/img/Am_Ex.png" alt="chase" /></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="../assets/img/Capital_One.png" alt="chase" /></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="../assets/img/Citi.png" alt="chase" /></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="../assets/img/US_Bank.png" alt="chase" /></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="../assets/img/Paypal.png" alt="chase" /></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="../assets/img/Chase.png" alt="chase" /></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="../assets/img/Bank_Of_America.png" alt="Bank_Of_America" /></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="../assets/img/Wells_Fargo.png" alt="chase" /></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="../assets/img/Am_Ex.png" alt="chase" /></a>
                                </li>
                            </ul>

                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-2">
                            <h3 class="text-center text-capitalize"> Provident Fund </h3>
                            <ul class="wallet-list list-unstyled clearfix text-align cash-other">
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#myModal3"> epf</a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#myModal3"> ppf</a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#myModal4"> cash </a>
                                </li>
                            </ul>

                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-2">
                            <h3 class="text-center text-capitalize"> wallets </h3>
                            <ul class="wallet-list list-unstyled clearfix text-align">
                                <li>
                                    <a href="#"> <img src="../assets/img/paytm.png" alt="chase" /></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="../assets/img/Pay-U.jpg" alt="Bank_Of_America" /></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="../assets/img/logoairtel.png" alt="chase" /></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="../assets/img/google-logo.png" alt="chase" /></a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php
    $this->load->view('popups/link_account');
?>

<!-- model for enter credentials information of Provident Fund -->
<div class="modal inmodal" id="myModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Link your Provident Fund account</h4>
                <small class="font-bold">Providing your account credentials allow us to import your account details </small>
            </div>
            <div class="modal-body credentials_info text-center">
                <form class="form-horizontal ">
                    <div class="form-group text-center">
                        <input type="text" placeholder="UAN" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <input type="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="form-group text-center">

                        <button class="btn btn-lg btn-primary" type="submit" data-dismiss="modal" data-toggle="modal" data-target="#myModal3">
                            Submit
                        </button>

                    </div>
                </form>

                <a href="#" class="redirect-bank"> Don't remember your credentials?</a>

            </div>
            <div class="modal-footer">
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>

                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>
<!-- model for enter Cash Fund -->
<div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Cash Balance</h4>
                <!-- <small class="font-bold">Invest your amount in terms of Cash </small> -->
            </div>
            <div class="modal-body credentials_info text-center">
                <form class="form-horizontal ">
                    <div class="form-group text-center">
                        <input type="text" placeholder="Enter Amount" class="form-control">
                    </div>							
                    <div class="form-group text-center">

                        <button class="btn btn-lg btn-primary" type="submit" data-dismiss="modal" data-toggle="modal" data-target="#myModal4">
                            Submit
                        </button>

                    </div>
                </form>						

            </div>
            <div class="modal-footer">
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>

                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>
<!-- model for display message of sucess after login 		 -->
<div class="modal inmodal" id="myModal_account_linked" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Success !</h4>
                <small class="font-bold">Your HDFC bank account has been added successfully </small>
            </div>
            <div class="modal-body credentials_info text-center">

                <div class="circle-success text-center">
                    <i class="fa fa-check-circle-o"></i>
                </div>
                <div class="basic-button text-center ">
                    <button type="button" class="btn btn-info text-uppercase" data-dismiss="modal">
                        add another account
                    </button>
                    <button type="button" class="btn btn-info text-uppercase overview-btn" data-dismiss="modal">
                        go to overview
                    </button>
                </div>

            </div>
            <div class="modal-footer">
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/dashboard.js'); ?>"></script>

