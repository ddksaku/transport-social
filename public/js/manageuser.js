/**
 * Enable dialog of create&edit user
 * @param signup_url
 */


$("document").ready(function(){
  $('.profile-pic').change(function(evt) {
		var files = evt.target.files;
		var id = evt.target.id;
		var file = this;
		for(var i = 0 , f; f = files[i]; i ++)
		{
			if(!f.type.match('image/gif') &&
					!f.type.match('image/jpg') &&
					!f.type.match('image/png') &&
					!f.type.match('image/jpeg'))
				continue;

			if(i > 1) break;

			var reader = new FileReader();

			reader.onload = ( function(theFile) {
				return function(e) {
					var thumb = $(file).closest('.file-wrapper').next('.thumb').attr('src', e.target.result);
				};
			})(f);

			reader.readAsDataURL(f);
		}
	});
});
