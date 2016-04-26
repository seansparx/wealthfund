<!-- model for Create Budget-->
<div class="modal inmodal" id="edit-budget" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Create a Budget</h4>
            </div>
            <div class="modal-body credentials_info">
                <form id="form_edit_budget" class="form-horizontal edit-budget-form">
                    <div class="central-form">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>Choose a Category</label>
                            </div>
                            <div class="col-sm-7">
                                <select name="b_category" id="b_category" class="form-control">
                                    <option value=""> -- Select -- </option>
                                    <?php
                                    foreach ($budget_category as $cat) {
                                        echo '<option value="' . $cat->category_id . '">' . $cat->category_name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>What is its estimated value ?</label>
                            </div>
                            <div class="col-sm-7">
                                <label>
                                    <input type="radio" checked="checked" name="term" />
                                    Every Month</label>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>Amount</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="b_amount" id="b_amount" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-lg btn-primary" type="button" data-dismiss="modal">
                                Cancel
                            </button>
                            <button id="btn_save" class="btn btn-lg btn-primary" type="button" >
                                Save
                            </button>
                        </div>
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



<!-- model for enter Success Value information-->
<div class="modal inmodal" id="budget-success" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Success ! We got your budget</h4>
                <small class="font-bold">This will now be counted in your net worth on your financial overview. </small>
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