<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ sprintf(trans('user_auth.create_user_activate_label') , $name) }}</h2>

		<div>
			{{ trans('user_auth.create_user_activate_subheading').' '.link_to_route('user.activate', 'Activate Account', array('id' => $id , 'activation_code' => $activation))}}
		</div>
	</body>
</html>