function frontendBlockFormbuilderClass()
{
	var self = this;
	
	this.init = function(block)
	{
		var block = $('.block[data-id="' + block.attr('data-id') + '"]');
		var form = block.find('form');
		var btnSubmit = form.find('button').get(0);
		var options = $.datepicker.regional[_APP.frontend.language];
		var validator = null;
		
		// Datepicker
		if(options)
			options.dateFormat = 'dd/mm/yy';
		block.find('[data-date="true"]').datepicker(options);
		
		// Validation
		validator = block.find('form').validate({
			errorPlacement: function (error, element) {
			    if (element.attr("type") == "checkbox") {
			        error.insertAfter($(element).parents('.form-group').find('.error-container'));
			    } else {
			        error.insertAfter($(element));
			    }
			}
		});
		
		// Time
		block.find('[data-time-hh="true"], [data-time-mm="true"]').off('change');
		
		block.find('[data-time-hh="true"], [data-time-mm="true"]').change(function() {
			self.updateTime(block);
		});
		
		self.updateTime(block);
		
		// Range
		block.find('[data-range]').each(function(index, element) {
			
			element = $(element);
			element.addClass('ui-slider-custom-handle').html('<div class="ui-slider-handle"></div>');
			
			var handle = element.find('.ui-slider-handle');
			var options = {
				min: parseInt(element.attr('data-min')),
				max: parseInt(element.attr('data-max')),
			};
			
			if($.isNumeric(element.attr('data-value')))
				options.value = parseFloat(element.attr('data-value'));
			
			if($.isNumeric(element.attr('data-step')))
				options.step = parseFloat(element.attr('data-step'));
			
			options._moveHandler = function(value)
			{
				if(value == undefined)
					return;
				
				handle.html('<span>' + value + '</span>');

				handle.find('span').css('left', (handle.outerWidth() - handle.find('span').outerWidth()) / 2);
			}
			
			options.create = function(event, ui)
			{
				options._moveHandler(ui.value);
			};
			
			options.slide = function(event, ui)
			{
				options._moveHandler(ui.value);
			};
			
			options.change = function(event, ui)
			{
				options._moveHandler(ui.value);
			}
			
			element.slider(options);
			
			element.slider('value', element.slider('value')); 
		});
		
		// File
		block.find('.btn-upload-file').click(function(e) {
			e.preventDefault();
			
			var id = $(this).attr('data-input-file');
			
			block.find('input[type="file"][data-id="' + id + '"]').click();
		});
		
		block.find('input[type="file"]').on('change', function(e) {
			
			var id = $(this).attr('data-id');
			var text = '';
			var totalArchivosSeleccionados = this.files.length;
			
			if(totalArchivosSeleccionados == 0)
			{
				text = _APP.t('block_formbuilder archivo boton info ningun_archivo');
			}
			else if(totalArchivosSeleccionados == 1)
			{
				text = _APP.t('block_formbuilder archivo boton info un_archivo');
			}
			else
			{
				text = _APP.t('block_formbuilder archivo boton info varios_archivos', {N: totalArchivosSeleccionados});
			}
			
			block.find('.input-file-info[data-id="' + id + '"]').html(text);
		});
		
		// Form
		form.submit(function(e) {
			
			e.preventDefault();
			
			if(form.attr('action') == '' || form.attr('action') == '#')
				return false;
			
			// Comprobación para saber si ha alcanzado el número máximo de archivos seleccionados
			var errorLimiteArchivosAdjuntos = false;
			
			form.find('input[type="file"]').each(function(index, element) {
				if(element.files.length >= parseInt(form.attr('data-file-limit')))
				{
					errorLimiteArchivosAdjuntos = true;
					
					alert(_APP.t('block_formbuilder error limite_adjuntos texto'));
					
					return false;
				}
			});
			
			if(errorLimiteArchivosAdjuntos)
				return false;
			
			// Comprobación para saber si el formulario se está enviado o si no es válido
			if(form.attr('data-submitting') == 1 || !form.valid())
				return false;

			if(form.find('input[name="_val1"]').length > 0)
			{
				if(parseInt(block.find('input[name="_val2"]').attr('class')) - 1985 != form.find('input[name="_val1"]').val())
				{
					validator.showErrors({
						_val1: _APP.t('formulario error codigo'),
					});
					block.find('input[name="_val1"]').removeClass('valid').addClass('error').focus();
					return false;
				}
				else
				{
					block.find('input[name="_val1"]').removeClass('error');
				}
			}
			
			// Preparamos el formulario para el envío
			form.attr('data-submitting', 1);
			btnSubmit.setSecondStatus();
			self.showSuccessMessage(block, false);
			
			var formData = new FormData(form.get(0));

			formData.append('_valtk', $('#_valtk').attr('data-value'));
			
			form.find("[name]").each(function(index, element) {
				
				element = $(element);
				
				if(element.attr('type') == 'file')
				{
					formData.delete(element.attr('name'));
					
					for(var x = 0; x < element.get(0).files.length; x++)
	                    formData.append("_files[]", element.get(0).files[x]);
				}
			});
			
			$.ajax({
                url: form.attr('action'),
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
		    	processData: false,
		    	success: function(response) {

	    			form.attr('data-submitting', 0);
					btnSubmit.setDefaultStatus();
				
					try
					{
						if(response == '')
							return;
							
						response = $.parseJSON(response);
						
						if(response.success == 1)
						{
							self.showSuccessMessage(block);
						}
						else
						{
							alert(_APP.t('formulario error general') + '. ' + response.details);
						}
					}
					catch(err)
					{
						alert(err);
					}
					
					_onBlockFormSubmitted(block);
		    	} 
            });
		});
	}
	
	this.updateTime = function(block)
	{
		var id = block.find('[data-time]').attr('data-time');
		var input = $('#' + id);
		
		input.val(block.find('[data-time-hh="true"]').val()  + ':' + block.find('[data-time-mm="true"]').val());
	}
	
	this.showSuccessMessage = function(block, show)
	{
		if(show || show == undefined)
		{
			block.find('.success-message').removeClass('hidden');
			$(window).scrollTop(block.offset().top);
			block.find('form').hide();
			block.find('.block-title').hide();
		}
		else
		{
			block.find('.success-message').addClass('hidden');
			block.find('form').show();
		}
	}
}

$(document).ready(function() {
	
	$('.block-formbuilder').each(function(index, element) {
		var frontendBlockFormbuilder = new frontendBlockFormbuilderClass();
		frontendBlockFormbuilder.init($(element));
	});
});