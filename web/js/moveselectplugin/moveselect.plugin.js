(function($){
	
	var methods = {
		init : function(settings){
			initHtml(this);
			updateButtons(this);
			
			$('.moveselect-left', this).bind('click.moveSelect', methods.moveLeft);
			$('.moveselect-right', this).bind('click.moveSelect', methods.moveRight);
			$('.moveselect-allleft', this).bind('click.moveSelect', methods.moveAllLeft);
			$('.moveselect-allright', this).bind('click.moveSelect', methods.moveAllRight);
			$('ul li', this).bind('click.moveSelect', methods.setSelected);
			
			return this;
		},
		moveLeft : function(){
			var wrap = $(this).parents('.moveselect').attr('id');
			var elements = $('#' + wrap + ' .awarded li.selected').removeClass('selected');
			elements.each(function(i, el){
				$(el).children('input[type=hidden]').attr('name', '');
			});
			$('#' + wrap + ' .avialable ul').append(elements);
			
			updateButtons(this);
		},
		moveAllLeft : function(){
			var wrap = $(this).parents('.moveselect').attr('id');
			var elements = $('#' + wrap + ' .awarded li').removeClass('selected');
			elements.each(function(i, el){
				$(el).children('input[type=hidden]').attr('name', '');
			});
			$('#' + wrap + ' .avialable ul').append(elements);
			
			updateButtons(this);
		},
		moveRight : function(){
			var wrap = $(this).parents('.moveselect').attr('id');
			var elements = $('#' + wrap + ' .avialable li.selected').removeClass('selected');
			elements.each(function(i, el){
				$(el).children('input[type=hidden]').attr('name', 'permission[]');
			});
			$('#' + wrap + ' .awarded ul').append(elements);
			
			updateButtons(this);
		},
		moveAllRight : function(){
			var wrap = $(this).parents('.moveselect').attr('id');
			var elements = $('#' + wrap + ' .avialable li').removeClass('selected');
			elements.each(function(i, el){
				$(el).children('input[type=hidden]').attr('name', 'permission[]');
			});
			$('#' + wrap + ' .awarded ul').append(elements);
			
			updateButtons(this);
		},
		setSelected : function(){
			$(this).toggleClass('selected');
		}
	};
	
	$.fn.moveSelect = function(settings){
		return methods.init.apply(this, arguments);
	};
	
	function initHtml(obj){
		var elementId = obj.attr('id');
		var html = '<div class="buttons">';
		html += '<button type="button" class="moveselect-right">></button>';
		html += '<button type="button" class="moveselect-left"><</button>';
		html += '<button type="button" class="moveselect-allright">>></button>';
		html += '<button type="button" class="moveselect-allleft"><<</button>';
		html += '</div>';
		
		obj.wrap('<div class="moveselect" id="moveselect-'+ elementId +'">');
		obj.find('.avialable').after(html);
	}
	
	function updateButtons(obj){
		var wrap = $(obj).parents('.moveselect').attr('id');
		var btnLeft = $('#' + wrap + ' .buttons .moveselect-left');
		var btnRight = $('#' + wrap + ' .buttons .moveselect-right');
		var btnAllLeft = $('#' + wrap + ' .buttons .moveselect-allleft');
		var btnAllRight = $('#' + wrap + ' .buttons .moveselect-allright');
		
		if($('#' + wrap + ' .awarded li').length == 0){
			btnLeft.addClass('disabled').attr('disabled', 'disabled');
			btnAllLeft.addClass('disabled').attr('disabled', 'disabled');
		} else {
			btnLeft.removeClass('disabled').removeAttr('disabled');
			btnAllLeft.removeClass('disabled').removeAttr('disabled');
		}
		
		if($('#' + wrap + ' .avialable li').length == 0){
			btnRight.addClass('disabled').attr('disabled', 'disabled');
			btnAllRight.addClass('disabled').attr('disabled', 'disabled');
		} else {
			btnRight.removeClass('disabled').removeAttr('disabled');
			btnAllRight.removeClass('disabled').removeAttr('disabled');
		}
	}
	
	
})(jQuery)


/*
$(document).ready(function(){
	$('#moveselect1').moveSelect(); 
});

<div id="moveselect1">
	<div class="avialable">
		<ul>
			<li>item1</li>
			<li>item2</li>
			<li>item3</li>
			<li>item4</li>
			<li>item5</li>
		</ul>
	</div>
	<div class="awarded">
		<ul>
		</ul>
	</div>
</div>
*/