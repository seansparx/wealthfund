<!-- model for enter vahicle information-->
<div class="modal inmodal" id="myModal-vahicle" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Lets find the value of your Vehicle</h4>
                <small class="font-bold">Please select what you'do like to add.</small>
            </div>
            <div class="modal-body credentials_info text-center">
                <form class="form-horizontal" id="form_vehicle_step1">
                    <div class="form-group text-center">
                        <select id="vehicle_type" class="form-control m-b">
                            <option value="automobile">Automobile</option>
                            <option value="boat">Boat</option>
                            <option value="motorcycle">Motorcycle</option>
                            <option value="snowmobile">Snowmobile</option>
                            <option value="bicycle">Bicycle</option>
                            <option value="commercial vehicle">Commercial Vehicle</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group text-center">
                        <input type="text" name="model_name" id="model_name" placeholder="Vehicle Model" class="form-control">
                    </div>

                    <div class="form-group text-center">
                        <button id="btn_next" class="btn btn-lg btn-primary" type="button">
                            Next
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-back" data-toggle="modal" data-target="#myModal-properties"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>



<!-- model for enter credentials information of your netbanking  -->
<div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Make Your Choice</h4>

            </div>
            <div class="modal-body credentials_info text-center">
                <a href="javascript:void(0);" onclick="javascript:launch();" class="btn btn-primary"><i class="fa fa-briefcase"></i> Add Your Account</a><span class="separator">or</span>
                <a href="#" data-toggle="modal" data-target="#myModal-properties" data-dismiss="modal" class="btn btn-primary"><i class="fa fa-home"></i> Add Your Property </a>
            </div>
            <div class="modal-footer">
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- model for enter Properies information-->
<div class="modal inmodal" id="myModal-properties" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Add Your Properties</h4>
                <small class="font-bold">Select the kind of propertiy you'do like to add </small>
            </div>
            <div class="modal-body credentials_info text-center">
                <div class="circle-success property-types text-center">
                    <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-realState" href="#"><span>Real Estate</span><i class="fa fa-home"></i></a>
                    <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-cash" href="#"><span>Cash or Debt</span><i class="fa fa-briefcase"></i></a>
                    <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-vahicle" href="#"><span>Vehicle</span><i class="fa fa-automobile"></i></a>
                    <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-otherinfo" href="#"><span>Other</span><i class="fa fa-database"></i></a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-back" data-toggle="modal" data-target="#myModal2" data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>

                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>
<!-- model for enter Real Estate information-->
<div class="modal inmodal" id="myModal-realState" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Lets find the value of your home</h4>
                <small class="font-bold">Please enter your address</small>
            </div>
            <div class="modal-body credentials_info text-center">
                <form class="form-horizontal " id="form_realestate_step1">
                    <div class="form-group text-center">
                        <input type="text" name="street_addr" id="street_addr" placeholder="Street Address" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="apartment" id="apartment" placeholder="Apartment" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="zipcode" id="zipcode" placeholder="Zip" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" type="button" id="btn_next">
                            Next
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-back" data-toggle="modal" data-target="#myModal-properties"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- model for enter Real Estate Value information-->
<div class="modal inmodal" id="myModal-realStatevalue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Edit your real estate's details </h4>
                <small class="font-bold">Please answer the following questions</small>
            </div>
            <div class="modal-body credentials_info">
                <form class="form-horizontal" id="form_realestate_step2">
                    <div class="central-form">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>What kind of residence is this ?</label>
                            </div>
                            <div class="col-sm-7">
                                <select name="residence_type" id="residence_type" class="form-control m-b">
                                    <option value="primary">Primary Residence</option>
                                    <option value="secondary">Secondary Residence</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>What is its estimated value ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="property_amt" id="property_amt" placeholder="<?php echo currency_symbol(); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>How would you like to see it ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="property_name" id="property_name" placeholder=" " class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" id="btn_add" type="button">
                            Add It
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-back" data-toggle="modal" data-target="#myModal-realState"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- model for enter Success Value information-->
<div class="modal inmodal" id="myModal-success" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Success ! We got your property</h4>
                <small class="font-bold">This will now be counted in your net worth on your financial overview. </small>
            </div>
            <div class="modal-body credentials_info text-center">
                <a href="<?php echo site_url('overview'); ?>" class="btn btn-primary"><i class="fa fa-briefcase"></i> Go to Overview</a><span class="separator">or</span>
                <a href="#" data-toggle="modal" data-target="#myModal-properties" data-dismiss="modal" class="btn btn-primary"><i class="fa fa-home"></i> Add another Property </a>
            </div>
            <div class="modal-footer">
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- model for enter cash or debt information-->
<div class="modal inmodal" id="myModal-cash" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Lets find the value of your Cash or Debt</h4>
                <small class="font-bold">Please select what you'do like to add.</small>
            </div>
            <div class="modal-body credentials_info text-center">
                <form class="form-horizontal" id="form_cashdebt_step1">
                    <div class="form-group text-center">
                        <select name="property_type" id="property_type" class="form-control m-b">
                            <option value="Debt">Debt</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" type="button" id="btn_next">
                            Next
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-back" data-toggle="modal"  data-dismiss="modal" data-target="#myModal-properties" >
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>
<!-- model for enter Cash Value information-->
<div class="modal inmodal" id="myModal-cashvalue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Edit the details of your cash </h4>
                <small class="font-bold">Please answer the following questions</small>
            </div>
            <div class="modal-body credentials_info">
                <form class="form-horizontal" id="form_cashdebt_step2">
                    <div class="central-form">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>How would you like to see it ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="property_name" id="property_name" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>What is its estimated value ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="property_amt" id="property_amt" placeholder="<?php echo currency_symbol(); ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" id="btn_add" type="button">
                            Add It
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-back" data-toggle="modal" data-target="#myModal-vahicle"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- model for enter Car Value information-->
<div class="modal inmodal" id="myModal-carvalue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Let's find the value of your car </h4>
                <small class="font-bold">Please answer the following questions</small>
            </div>
            <div class="modal-body credentials_info">
                <form class="form-horizontal" id="form_vehicle_step2">
                    <div class="central-form">
                        <div class="row form-group">
                            <div class="col-sm-4">
                                <select name="year" class="form-control m-b">
                                    <option value="">Year</option>
                                    <option value="2016">2016</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select name="make" class="form-control m-b">
                                    <option value="">Make</option>
                                    <option value="2016">2016</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select name="model" class="form-control m-b">
                                    <option value="">Model</option>
                                    <option value="2016">2016</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-7">
                                <select name="term" class="form-control m-b">
                                    <option value="">Trim</option>
                                    <option value="2016">2016</option>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <select name="miles" class="form-control m-b">
                                    <option value="">Miles</option>
                                    <option value="2016">2016</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button id="btn_showme" class="btn btn-lg btn-primary" type="button">
                            Show me
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-back" data-toggle="modal" data-target="#myModal-vahicle"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- model for Edit detail of Car information-->
<div class="modal inmodal" id="myModal-edit-carvalue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Edit the details of your Acura ILX </h4>
                <small class="font-bold">Please answer the following questions</small>
            </div>
            <div class="modal-body credentials_info">
                <form class="form-horizontal" id="form_vehicle_step3">
                    <div class="central-form">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>How would you like to see it ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="property_name" id="property_name" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>What is its estimated value ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="property_amt" id="property_amt" placeholder="<?php echo currency_symbol(); ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" type="button" id="btn_add" >
                            Add It
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-back" data-toggle="modal" data-target="#myModal-vahicle"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- model for enter Other information-->
<div class="modal inmodal" id="myModal-otherinfo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">What would you like to add ?</h4>
                <small class="font-bold">Please select below</small>
            </div>
            <div class="modal-body credentials_info text-center">
                <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'form_other_property_step-1')); ?>
                    <div class="form-group text-center">
                        <select class="form-control m-b" name="property_type" id='property_type'>
                            <?php
                                $items = array('Artwork','Appliance','Bedding/Drapes/Linen','Books/CDs/DVDs/Tapes','Camera','Clothing','Collectible','Computer','Cooking','Cutlery/Silverware','Decorations','Dishes/Fine China','Electronics','Furniture','Gardening','Glass/Crystal','Gold','Jewelry','Miscellaneous Items','Musical Instrument','Rug','Sporting Goods','Tools','Toys');
                                foreach ($items as $item) {
                                    echo '<option value="'.$item.'">'.$item.'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" id='btn_next' type="button">
                            Next
                        </button>
                    </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-back" data-toggle="modal" data-target="#myModal-properties"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>
<!-- model for enter Other Value information-->
<div class="modal inmodal" id="myModal-othervalue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Edit the details of your Artwork </h4>
                <small class="font-bold">Please answer the following questions</small>
            </div>
            <div class="modal-body credentials_info">
                <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'form_other_property_step-2')); ?>
                    <div class="central-form">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>How would you like to see it ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="property_name" id="property_name" placeholder="Eg. Artwork" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>What is its estimated value ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="property_amt" id="property_amt" placeholder="<?php echo currency_symbol(); ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" id="btn_add" type="button">
                            Add It
                        </button>
                    </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-back" data-toggle="modal" data-target="#myModal-otherinfo"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>