/*global $ */

$(function () {
    
    
    var loadFriends = function () {
        $.ajax(
        {
            url: "loadfriends"
        }).done(function (data) {
            var friendsData = data.data.friends;
            var friends = [];
            
            //clear the list
            $('#friends').html('');
            
            $.each(friendsData, function (index, fr) {
                var friend = new $.fn.friend({
                    id: fr.id,
                    name: fr.name,
                    circleName: fr.circleName
                });
                friend.render('#friends');
                friends.push(friend);
            });
            
            $(".friend").draggable({
                revert: 'invalid'
            });
          
        });
    };
    
    var loadCircles = function () {
        $.ajax(
        {
            url: "loadcircles"
        }).done(function (data) {
            var circlesData = data.data.circles;
            var circles = [];
            
            //clear the list
            $('#circles').html('');
            
            $.each(circlesData, function (index, fr) {
                var circle = new $.fn.circle({
                    id: fr.id,
                    name: fr.name,
                    friendNumber: fr.friendNumber
                });
                circle.render('#circles');
                circles.push(circle);
            });
            
            $(".circle").droppable({
                drop: function (event, ui) {                    
                    var friendDivId = ui.draggable.context.id;
                    //7 => friend_
                    var friendId = friendDivId.substring(7, friendDivId.length);
                    
                    var circleDivId = this.id;
                    //7 => circle_
                    var circleId = circleDivId.substring(7, circleDivId.length);
                    
                    $.ajax(
                    {
                        url: 'addfriendtogroup',
                        type: 'POST',
                        data:
                        {
                            friend: friendId,
                            circle: circleId
                        }
                    }).done(function (data) {
                        loadFriends();                    
                        loadCircles();
                    });
                }
            });
        });
    };
    
    loadFriends();
    loadCircles();
});