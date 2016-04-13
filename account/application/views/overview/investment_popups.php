<!-- model for ensurance information -->
<div class="modal inmodal" id="model-insurance" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Edit the details of your Insurance </h4>
                <small class="font-bold">Please answer the following questions</small>
            </div>
            <div class="modal-body credentials_info">
                    <?php echo form_open('', array('id' => 'form_add_insurance', 'class' => 'form-horizontal')); ?>
                    <div class="central-form">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>Name of policy </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="policy_name" id="policy_name" placeholder="Eg. LIC Jeevan Beema" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label> Monthly Premium </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="monthly_amt" id="monthly_amt" placeholder="<?php echo currency_symbol(); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label> Coverage Amount </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="coverage_amt" id="coverage_amt" placeholder="<?php echo currency_symbol(); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label> Term </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="no_of_yrs" id="no_of_yrs" placeholder="Number of years" class="form-control">
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
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- model for FD information -->
<div class="modal inmodal" id="model-fd" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Edit the details of your FD </h4>
                <small class="font-bold">Please answer the following questions</small>
            </div>
            <div class="modal-body credentials_info">
                <?php echo form_open('', array('id' => 'form_add_fd', 'class' => 'form-horizontal')); ?>
                    <div class="central-form">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>Name of Bank ?</label>
                            </div>
                            <div class="col-sm-7">
                                <select name="bank_name" id="bank_name" class="form-control m-b">
                                    <option value=""> -- Select Bank -- </option>
                                    <option value="State Bank of India">State Bank of India</option>
                                    <option value="ICICI Bank Limited">ICICI Bank Limited</option>
                                    <option value="Punjab National Bank">Punjab National Bank</option>
                                    <option value="Canara Bank">Canara Bank</option>
                                    <option value="Bank of Baroda">Bank of Baroda</option>
                                    <option value="Bank of India">Bank of India</option>
                                    <option value="IDBI Limited">IDBI Limited</option>
                                    <option value="Union Bank of India">Union Bank of India</option>
                                    <option value="Central Bank of India">Central Bank of India</option>
                                    <option value="HDFC Bank Limited">HDFC Bank Limited</option>
                                    <option value="Indian Overseas Bank">Indian Overseas Bank</option>
                                    <option value="UCO Bank">UCO Bank</option>
                                    <option value="Oriental Bank of Commerce">Oriental Bank of Commerce</option>
                                    <option value="Syndicate Bank">Syndicate Bank</option>
                                    <option value="Allahabad Bank">Allahabad Bank</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label> Amount ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="fd_amount" id="fd_amount" placeholder="Rs. 10000" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label> Maturity Period ?</label>
                            </div>
                            <div class="col-sm-7">
                                <select name="mt_period" id="mt_period" class="form-control m-b">
                                    <option value=""> -- No. of years -- </option>
                                    <option value="1">1 year</option>
                                    <?php
                                    for($y=2; $y<=100; $y++){
                                        echo '<option value="'.$y.'">'.$y.' Years</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>                         
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" type="button" id="btn_add">
                            Add It
                        </button>
                    </div>
                <?php echo form_close(); ?>
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

<!-- model for enter Other Value information-->
<div class="modal inmodal" id="myModal-gold" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Edit the details of your Gold </h4>
                <small class="font-bold">Please answer the following questions</small>
            </div>
            <div class="modal-body credentials_info">
                <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'form_add_gold')); ?>
                    <div class="central-form">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>How would you like to see it ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="gold_name" id="gold_name" placeholder="Eg. Artwork" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>What is its estimated value ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="gold_amt" id="gold_amt" placeholder="<?php echo currency_symbol(); ?>" class="form-control">
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