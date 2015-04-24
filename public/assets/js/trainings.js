$.fn.reload = function() {
    return $(this.selector);
};

$(document).ready(function(){

	$('div').on('mouseover', '.photo-thumbnail', function(){
		var container = $(this);
		container.find('.remove-photo').show();
		container.find('.select-remove-photo').show();
	}).on('mouseout', '.photo-thumbnail', function(){
		var container = $(this);
		container.find('.remove-photo').hide();
		container.find('.select-remove-photo').each(function(){
			if ($(this).find('input[type=checkbox]:checked').length) $(this).show();
			else $(this).hide();
		});
	});

	var ul_photos = $('ul#training-photos-slider'),
		form_delete_photo = $('form#delete-photos-form');

	if (ul_photos.length && form_delete_photo.length)
	{
		var index = 1;
		ul_photos.find('li.photo-thumbnail').each(function(){

				var proto_div_input = form_delete_photo.find('div.input-group').last().clone();

				proto_div_input.attr('id', 'photo-'+$(this).attr('data-id'));
				input_id = proto_div_input.find('input[type=hidden].prototype-input-id');
				input_id.attr('name', input_id.attr('data-parent')+'['+input_id.attr('data-relation')+']['+input_id.attr('data-index')+']['+input_id.attr('data-name')+']');
				input_id.attr('value', $(this).attr('data-id'));
				input_id.attr('data-index', parseInt(input_id.attr('data-index')) + index );

				input_delete = proto_div_input.find('input[type=hidden].prototype-input-delete');
				input_delete.attr('name', input_delete.attr('data-parent')+'['+input_delete.attr('data-relation')+']['+input_delete.attr('data-index')+']['+input_delete.attr('data-name')+']');
				input_delete.attr('value', 1);
				input_delete.attr('data-index', parseInt(input_delete.attr('data-index')) + index );

				form_delete_photo.append(proto_div_input);
		});
		form_delete_photo.find('div#input-prototype').remove();
	}



	$(document).on('change', 'input[type=checkbox].select-photo-to-remove', function(){
		var removeDiv = $('.remove-image-buttons'),
			removeSelected = removeDiv.find('.remove-selected-image-button').show();
		if ($(this).checked) {

			removeSelected.show();
		}
		else
		{
			if ($('input.select-photo-to-remove:checked').length) removeSelected.show();
			else removeSelected.hide();
		}
	});

	$('#training-photos-slider').bxSlider({
        hideControlOnEnd: true,
        minSlides: 5,
        maxSlides: 5,
        slideWidth: 360,
        slideMargin: 10,
        pager: true,
        adavtiveHeight: true,
        nextSelector: '#training-photos-next',
        prevSelector: '#training-photos-prev',
        nextText: '>',
        prevText: '<',
    });

   $(document).on('click', '.remove-a-photo', function(e){
   		var form = form_delete_photo.clone(),
   			id = $(this).parents('li').attr('data-id');
   		form.attr('id', 'fuck-you-browser');
   		form.find('div.input-group').each(function(){
   			console.log(id);
   			if ($(this).attr('id')  != 'photo-'+id)
   			{
   				$(this).remove();
   			}
   		});

   		$(this).parents('li').append(form);
   		console.log(form);
   		form.submit();
   		e.preventDefault();
   });

   $(document).on('click', '.remove-selected-image-button', function(e){
   		var form = form_delete_photo.clone(),
   			photo_ids = [];
   		$('#training-photos-slider').find('li').each(function(){
   			if ($(this).find('input[type=checkbox]:checked').length)
   			{
   				photo_ids.push($(this).attr('data-id'));
   			}
   		});
   		photo_ids = photo_ids.filter(function(elem, index, self) {
		    return index == self.indexOf(elem);
		});

		form.find('div.input-group').each(function(){
			var id = $(this).attr('id').split('-')[$(this).attr('id').split('-').length - 1];
			if (photo_ids.indexOf(id) == -1)
			{
				$(this).remove();
			}
		});
		form.attr('id', 'fuck-you-and-everyone-around-you');
		$(this).parents('div').append(form);
		form.submit();
   		e.preventDefault();
   });

   $(document).on('click', '.remove-all-image-button' ,function(e){
	   	form_delete_photo.submit();
	   	e.preventDefault();
   });


   $(document).on('click', '.scroll', function(event){
   		$('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top
            }, 1000);
   });

   //comments

   var new_comment_form = $('#form-create-training-comment');

   if (new_comment_form.length)
   {
   		if (new_comment_form.find('div.form-group').hasClass('has-error'))
   		{
   			var ahref = "<a class='scroll hidden' href='#"+new_comment_form.attr('id')+"'></a>";
   			new_comment_form.append(ahref);
   			new_comment_form.find('a.scroll').trigger('click');
   			new_comment_form.find('a.scroll').remove();
   		}
   }

});



