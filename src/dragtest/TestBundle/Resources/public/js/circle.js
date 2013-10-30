/*global $ */

$(function () {
	$.fn.circle = function (params) {
		
		var circle = 
		{
			id: params.id,
			name: params.name,
			friendNumber: params.friendNumber
		};
		
		circle.render = function (divName) {
			var me = this;
			var divHtml = '<div class=\'circle\' id=\'circle_' + me.id + '\'>';
			
			divHtml = divHtml + '<div class =\'label\'>' + me.name + '</div>';
			divHtml = divHtml + '<div class =\'number\'>' + me.friendNumber + '</div>';
			divHtml = divHtml + '</div>';
			$(divName).append(divHtml);
		};
		
		return circle;
	};
});