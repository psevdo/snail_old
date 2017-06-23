(function($){
	
	$.fn.translite = function(options) {
		
		var settings = $.extend({
			'dstFieldId' : '',	// куда будет выводиться результат транслитерации
			'space' : '-',	// Символ, на который будут заменяться все спецсимволы
			'eventType' : 'keyup blur copy paste cut start',
			'caseType' : 'lower',	// lower(default), upper, inherit - регистр выходных данных
		}, options);

		var srcFieldId = this.attr('id');
			
		$(document).on(settings['eventType'], '#'+srcFieldId, function(){
			translit(srcFieldId, settings['dstFieldId'], settings['space'], settings['caseType']);
		});
			
		return this;
	}
	
})(jQuery)


function translit(srcFieldId, dstFieldId, space, caseType) {
	
	// Символ, на который будут заменяться все спецсимволы
	// var space = '-'; 
	
	if(caseType == 'lower') { var text = $('#'+srcFieldId).val().toLowerCase(); }
	if(caseType == 'upper') { var text = $('#'+srcFieldId).val().toUpperCase(); }
	if(caseType == 'inherit') { var text = $('#'+srcFieldId).val(); }
	
	// Массив для транслитерации
	var transl = { 
					'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh', 'з': 'z', 'и': 'i',
					'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't',
					'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': space, 'ы': 'y',
					'ь': space, 'э': 'e', 'ю': 'yu', 'я': 'ya',
					'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'E', 'Ж': 'ZH', 'З': 'Z', 'И': 'I',
					'Й': 'J', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O', 'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T',
					'У': 'U', 'Ф': 'F', 'Х': 'H', 'Ц': 'C', 'Ч': 'CH', 'Ш': 'SH', 'Щ': 'SH', 'Ъ': space, 'Ы': 'Y',
					'Ь': space, 'Э': 'E', 'Ю': 'YU', 'Я': 'YA',
					
					' ': space, '_': space, '`': space, '~': space, '!': space, '@': space, '#': space, '$': space,
					'%': space, '^': space, '&': space, '*': space, '(': space, ')': space, '-': space, '\=': space,
					'+': space, '[': space, ']': space, '\\': space, '|': space, '/': space, '.': space, ',': space,
					'{': space, '}': space, '\'': space, '"': space, ';': space, ':': space, '?': space, '<': space,
					'>': space, '№': space					
				 }
	
    var result = '';
	
	var curent_sim = '';
	
    for(i=0; i < text.length; i++) {
        // Если символ найден в массиве то меняем его
		if(transl[text[i]] != undefined) {			
			if(curent_sim != transl[text[i]] || curent_sim != space){
				result += transl[text[i]];
				curent_sim = transl[text[i]];				
			}					
		}
		// Если нет, то оставляем так как есть
        else {
			result += text[i];
			curent_sim = text[i];
		}		
    }	
	
	result = TrimStr(result);	
	
	// Выводим результат
	$('#'+dstFieldId).val(result);
}
function TrimStr(s) {
	s = s.replace(/^-/, '');
	return s.replace(/-$/, '');
}