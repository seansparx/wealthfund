<!-- =============Markup of Model for Fastlink  ==================== -->
<div class="modal inmodal" id="myModal-fastlink" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog login-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-body">
				<iFrame width="100%" height="100%" src="https://node.developer.yodlee.com/authenticate/restserver/" name="an_iframe"></iFrame>
			</div>
		</div>
		<i class="glyphicon glyphicon-remove text-danger btn-close"></i>
	</div>

</div>

<form action="https://node.developer.yodlee.com/authenticate/restserver/" method="post" target="an_iframe" id="rsessionPost">
	<input type="hidden" name="rsession" placeholder="rsession" value="<?php echo $rsession_token; ?>"/>
	<input type="hidden" name="app" placeholder="FinappId" value="<?php echo $finapp_id; ?>"/>
	<input type="hidden" name="redirectReq" placeholder="true/false" value="true"/>
	<input type="hidden" name="token" placeholder="token" value="<?php echo $fastlink2_token; ?>"/>
	<input type="hidden" name="extraParams" placeholer="Extra Params" value="<?php echo $extra_params; ?>"/>
</form>
<script type="text/javascript">
	function launch() {
		$("#myModal-fastlink").modal();
		document.getElementById('rsessionPost').submit();
		
	}


	$("#myModal-fastlink .btn-close").click(function() {
		$("#myModal-fastlink").modal('toggle');
	});
	

</script>