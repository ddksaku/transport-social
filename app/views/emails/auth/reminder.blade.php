<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ sprintf(trans('user_auth.reset_password_label') , $email) }}</h2>

		<div>
			{{ trans('user_auth.reset_password_subgeading').' '.link_to_route('user.activate_reset_password', 'Reset Password', array('email' => $email , 'password' => $password , 'reset_code' => $reset_code))}}
		</div>
	</body>
</html>