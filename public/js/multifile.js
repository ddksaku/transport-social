$("document").ready(function(){
	$('#multifile_input').change(function(evt)
	{
		var files = evt.target.files;
        for(var i = 0; i < files.length; i++) {
            var file = files[i];
            var id = this;
            if(!file.type.match('image/gif') && !file.type.match('image/jpg') && !file.type.match('image/png') && !file.type.match('image/jpeg'))
            {
                return;
            }
            var reader = new FileReader();

            $('#multifile_list').html('');
            reader.onload = (function(theFile)
            {
                return function(e) {
                    var img = document.createElement('img');
                    var container = document.createElement('div');
                    img.src = e.target.result;
                    img.classList.add('thumb');
                    img.classList.add('img-thumbnail');
                    container.classList.add('img-container');
                    container.classList.add('col-md-6');

                    $(container).append(img);

                    $('#multifile_list').append(container);
                }
            })(file);

            reader.readAsDataURL(file);
        }

	});
});