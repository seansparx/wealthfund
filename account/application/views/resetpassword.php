<section class="sign-up-form-wrap">
	<div class="middle-box text-center loginscreen signup-screen  animated fadeInDown">
		<div>
			<h3> Wealth Fund User Reset Password</h3>
			
			<?php
			$url = "resetPassword/resetpassword?e=".$email."";
			echo form_open($url, array('method' => 'post', 'name' => 'user_resetpassword', 'id' => 'user_resetpassword'));
			?>
			
			<div class="form-group">
				<?php
				$data = array(
					'name' => 'password',
					'id' => 'password',
					'placeholder' => 'Password',
					'class' => 'form-control',
					'value' => set_value('password')
				);

				echo form_password($data);
				echo form_error('password');
				?>
			</div>
			<div class="form-group">
				<?php
				$data = array(
					'name' => 'passconf',
					'id' => 'passconf',
					'placeholder' => 'Confirm Password',
					'class' => 'form-control',
					'value' => set_value('passconf')
				);

				echo form_password($data);
				echo form_error('passconf');
				?>
			</div>
			<input type="hidden" name="user_email" value="<?php echo $email; ?>" id="user_email">
			<button type="submit" name="submit_resetpassword" id="submit_resetpassword" class="btn btn-primary block full-width m-b">
				Submit
			</button>
			
			<?php
			echo form_close();
			?>

		</div>
	</div>
</section>

