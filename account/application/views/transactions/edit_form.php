<?php
$options = '<option value=""> -- Category -- </option>';
foreach ($categories as $cat) {
	$options .= '<option value="' . $cat -> category_id. '">' . $cat -> category_name . '</option>';
}
?>

<div class="edit-option" id="edit-option">

	<form id="form_edit_transaction" method="post" class="edit-option-body">
		<div class="edit-header">
			<table class="table">
				<tr>
					<td>
					<input type="checkbox" />
					<input type="hidden" readonly="readonly" name="edit_id" id="edit_id" value=""/>
					</td>
					<td>
					<input type="text" readonly="readonly" name="edit_date" id="edit_date" class="" value="">
					</td>
					<td>
					<input type="text" name="edit_description" id="edit_description" class="edit_desc " value="" />
					</td>
					<td>
					<select class="" name="edit_category" id="edit_category">
						<?php echo $options; ?>
					</select></td>
					<td>
					<input class="" type="text" id="edit_amount" disabled="disabled"/>
					</td>
				</tr>
			</table>
		</div>
		<ul class="edit-options-list">
			<li>
				<span>Details</span>
				<div class="edit-elements">
					<p id="t_date">
						You entered this cash expense on <strong>March 22</strong>
					</p>
				</div>
			</li>
			<li>
				<span>Tags</span>
				<div class="edit-elements">
					<label>
						<input type="checkbox" name="t_tags[]" value="reimbursable" />
						Reimbursable </label>
					<label>
						<input type="checkbox" name="t_tags[]" value="tax related" />
						Tax Related </label>
					<label>
						<input type="checkbox" name="t_tags[]" value="vacation" />
						Vacation </label>
					<button type="button" class="btn btn-outline btn-info">
						Edit Tags
					</button>
				</div>
			</li>
			<li>
				<span>Notes</span>
				<div class="edit-elements">
					<textarea class="form-control" name="t_notes" id="t_notes" maxlength="2000" placeholder="2000 characters max"></textarea>
				</div>
			</li>
			<li>
				<div class="edit-elements">
					<button id="cancel" type="button" class="btn btn-outline btn-info">
						Cancel
					</button>
					<button id="done" type="button" class="btn btn-outline btn-info">
						I'm Done
					</button>
				</div>
			</li>
		</ul>
	</form>

	<a href="javascript:;" class="edit-btn" >Edit Details</a>
</div>

<div class="edit-option add-transaction" id="add-transaction" style="display: none;">
	<form id="form_add_transaction" method="post" class="edit-option-body">
		<div class="edit-header">
			<table class="table">
				<tr>
					<td>
					<input type="checkbox" />
					</td>
					<td>
					<input type="text" readonly="readonly" name="t_date" id="t_date" class="" value="<?php echo date('d/M/Y'); ?>">
					</td>
					<td>
					<input type="text" name="t_description" id="t_description" class="t_desc " placeholder="Enter Description" value="" />
					</td>
					<td>
					<select class="" name="t_category" id="t_category">
						<?php echo $options; ?>
					</select></td>
					<td>
					<input type="text" name="t_amount" id="t_amount" placeholder="Amount" value=""/>
					</td>
				</tr>
			</table>
		</div>

		<ul>
			<li>
				<span>Type</span>
				<div class="edit-elements">
					<select name="t_entry_type" id="t_entry_type" class="form-control">
						<option value="cash">Cash</option>
						<option value="cheque">Cheque</option>
						<option value="pending">Pending</option>
					</select>
					<label>
						<input type="radio" checked="checked" name="t_cat_type" id="expense" value="debit"/>
						Expense</label>
					<label>
						<input type="radio" name="t_cat_type" id="income" value="credit"/>
						Income</label>
					<label>
						<input type="checkbox" checked="checked" name="t_auto_atm" id="auto_atm" value="1"/>
						Automatically deducted this from my last ATM withdrawal.</label>

				</div>
			</li>
			<li id="t_account_row" style="display: none;">
				<span>Account</span>
				<div class="edit-elements">
					<select name="" id="" class="form-control">
						<option value="cash">TD EMERALD</option>
						<option value="cheque">TD UNLIMITED CHEQUING ACCOUNT</option>
						<option value="pending">US $ DAILY INTEREST CHEQUING ACCOUNT</option>
					</select>
					<label id="t_cheque_no">Check #
						<input type="text" name="t_chk_no" if="t_chk_no" value=""/>
					</label>
				</div>
			</li>
			<li>
				<span>Tags</span>
				<div class="edit-elements">
					<label>
						<input type="checkbox" name="t_tags[]" value="reimbursable" />
						Reimbursable </label>
					<label>
						<input type="checkbox" name="t_tags[]" value="tax related" />
						Tax Related </label>
					<label>
						<input type="checkbox" name="t_tags[]" value="vacation" />
						Vacation </label>
					<button type="button" class="btn btn-outline btn-info" data-dismiss="modal"  data-toggle="modal" data-target="#manageTags">
						Edit Tags
					</button>
				</div>
			</li>
			<li>
				<span>Notes</span>
				<div class="edit-elements">
					<textarea class="form-control" name="t_notes" maxlength="2000" placeholder="2000 characters max"></textarea>
				</div>
			</li>
			<li>
				<div class="edit-elements">
					<button id="cancel" type="button" class="btn btn-outline btn-info">
						Cancel
					</button>
					<button id="done" type="button" class="btn btn-outline btn-info">
						I'm Done
					</button>
				</div>
			</li>
		</ul>
	</form>
</div>
<!-- model for enter Other Value information-->
<div class="modal inmodal" id="manageTags" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Manage your tags </h4>
			</div>
			<div class="modal-body credentials_info">
				<form class="form-horizontal">
					<div class="central-form">
						<div class="row form-group">
							<div class="col-sm-12">
								<input type="text" placeholder="Reimbursable" class="form-control">
								<a href="#"><i aria-hidden="true" class="glyphicon glyphicon-remove text-danger"></i></a>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-12">
								<button class="btn btn-lg btn-primary" type="submit">
									+ Add a tag
								</button>
							</div>
						</div>
					</div>
					<div class="form-group text-center">
						<button class="btn btn-lg btn-primary" type="submit">
							I'm Done
						</button>
					</div>
				</form>
			</div>
			<div class="modal-footer">			
				<button type="button" class="btn btn-white" data-dismiss="modal">
					Close
				</button>
			</div>
		</div>
	</div>
</div>

<style>
	.edit-option .error {
		border-color: red;
	}
</style>