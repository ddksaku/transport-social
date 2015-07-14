{{ Form::open(array('route' => 'messages.add_contact' , 'id' => 'add_contact_form')); }}
	<div id="add_contact_dialog" class="modal fade"  role="dialog" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <a class="close" data-dismiss="modal">x</a>
	                <h4>Add a Contact</h4>
	            </div>
	            <div class="modal-body">
	            	<fieldset  id="user_photo_info">
	            		<div class="row">
	            			{{ Form::label('username' , trans('messages.message_user_name')); }}
                            {{ Form::text('user_name' , null , array('class' => 'form-control' , 'id' => 'user_name')); }}
	                    </div>	
	            		<div class="row">
	            			{{ Form::label('contactname' , trans('messages.message_contact_name')); }}
                            {{ Form::text('contact_name' , null , array('class' => 'form-control' , 'id' => 'contact_name')); }}
	                    </div>	
	                    <div class="row">
	                    	{{ Form::label('username' , trans('messages.message_contact_status')); }}
	                  		{{Form::select('status', array('1' => 'allow' , '2' => 'pending' , '3' => 'decline') , '1' , array('class' => 'form-control')) }}  	
	                    </div>		                    
	            	</fieldset>
	            </div>
	            <div class="modal-footer">
	            	{{ Form::button('Close', array('class' => 'btn' , 'data-dismiss' => 'modal' , 'aria-hidden' => 'true')) }}
	            	{{ Form::submit('Submit' , array('class' => 'btn btn-primary')); }}
	            </div>
	        </div>
	    </div>
	</div>         
{{ Form::close(); }}