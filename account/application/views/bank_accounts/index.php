<?php $currency = currency_symbol(); ?>
<section class="account-details banklist">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="bank-lists table-responsive">
                    <h2>Bank Accounts - <?php echo $currency.number_format($banks->total_balance, 2); ?></h2>
                    <span>Saving/Current Accounts ( <?php echo $currency.number_format($banks->total_saving_balance, 2); ?> )</span>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Account Name</th>
                                <th>Account Type</th>
                                <th>Account No.</th>
                                <th>Balance</th>
                                <th>Last Updated</th>
                                <th>Account Status</th>
                                <th>Refresh</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $banks->account_list; ?>
                        </tbody>
                    </table>							
                </div>
                <div class="btn-wrp"><a href="#" onClick="javascript:launch();" class="btn btn-primary">Link Bank Account</a></div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url('assets/js/bank_accounts.js'); ?>"></script>


