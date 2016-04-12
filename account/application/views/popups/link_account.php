<!-- model for enter credentials information of your netbanking  -->
<div class="modal inmodal" id="myModal_link_account" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Link your Bank of America account</h4>
                <small class="font-bold">Providing your account credentials allow us to import your account details </small>
            </div>
            <div class="modal-body credentials_info text-center">
                <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'form_link_account')); ?>
                    <input type="hidden" name="site_id" id="site_id" value=""/>
                    <div class="form-group text-center">
                        <input type="text" name="login" placeholder="Online ID" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <input type="password" name="passwd" placeholder="IPIN(Password)" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" type="button">Submit</button>
                    </div>                    
                <?php echo form_close(); ?>

                <a href="#" class="redirect-bank"> Don't remember your credentials?</a>

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