<style>
    
</style>
<section class="bank-info  animated fadeInRight" style="height:100%;">
    <form action="https://node.developer.yodlee.com/authenticate/restserver/" method="post" target="an_iframe" id="rsessionPost">
        <input type="hidden" name="rsession" placeholder="rsession" value="<?php echo $rsession_token; ?>"/>
        <input type="hidden" name="app" placeholder="FinappId" value="<?php echo $finapp_id; ?>"/>
        <input type="hidden" name="redirectReq" placeholder="true/false" value="true"/>
        <input type="hidden" name="token" placeholder="token" value="<?php echo $fastlink2_token; ?>"/>
        <input type="hidden" name="extraParams" placeholer="Extra Params" value="<?php echo $extra_params; ?>"/>
    </form>

    <iFrame width="100%" height="100%" src="https://node.developer.yodlee.com/authenticate/restserver/" name="an_iframe"></iFrame>

    <script type="text/javascript">

        $(document).ready(function(){
            launch();
        });

        function launch() {
            document.getElementById('rsessionPost').submit();
        }

    </script>
</section>

<script src="<?php echo base_url('assets/js/dashboard.js'); ?>"></script>

