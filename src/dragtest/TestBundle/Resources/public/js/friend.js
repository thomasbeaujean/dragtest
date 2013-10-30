/*global $ */

$(function () {
	$.fn.friend = function (params) {
		var friend = 
		{
			id: params.id,
			name: params.name,
			circleName: params.circleName
		};
		
		friend.render = function (divName) {
			var me = this;
			
			var divHtml = '<div class=\'friend\' id=\'friend_' + me.id + '\'>';
			divHtml = divHtml + me.name;
			if (me.circleName.length !== 0) {
				divHtml = divHtml + ' (' + me.circleName + ')';
			}
			divHtml = divHtml + '</div>';
			
			$(divName).append(divHtml);
		};
		
		return friend;
	};
});