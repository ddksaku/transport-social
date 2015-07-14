<div class="col-md-3">
	<ul class="nav nav-pills nav-stacked">
		<li class="label label-default">
			<h5><span>{{ trans('user_auth.sidebar_caption_user_profile_photo'); }}</span></h5>	
		</li>
		<li>	
			<div class="thumbnail">
				<div class="thumb">
					{{ HTML::image($profile_pic, null , array('class' => 'thumb')) }}
				</div>	
				<div class="caption">
					<p>
						{{ link_to_route('user.edit_profile', 'Edit Profile Picture', null, array('class' => 'btn btn-primary' , 'data-toggle' => 'modal' , 'data-target' => '#profile_pic_form' , 'data-remote' => 'false')) }}
					</p>	
				</div>	
			</div>	
			
		</li>	
		{{ HTML::clever_profile_link('user.profile', trans('user_auth.sidebar_link_profile'), array(Sentry::getUser()->id)) }}
		{{ HTML::clever_profile_link('user.change_password', trans('user_auth.sidebar_link_change_password')) }}

	</ul>
</div>