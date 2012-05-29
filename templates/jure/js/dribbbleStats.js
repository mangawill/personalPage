$(function(){ // Twitter API call
$.ajax({
   url: 'http://api.twitter.com/1/users/show.json',
   data: {screen_name: 'JureStern'},
   dataType: 'jsonp',
   success: function(data) {
       $('#followers').html(data.followers_count);
       $('#tweets').html(data.statuses_count);
       $('#following').html(data.friends_count);
   }
});
});


$.jribbble.getShotsByPlayerId('JureStern', function (playerShots) { // Dribbble API call latest shot
    var html = [];

    $.each(playerShots.shots, function (i, shot) {
        html.push('<a href="' + shot.url + '" target="_blank">');
        html.push('<img src="' + shot.image_url + '" ');
        html.push('alt="' + shot.title + '"></a>');
				html.push('<h3>' + shot.title + '</h3>');
				html.push('<ul class="clearfix"><li class="commentDribbble">' + shot.comments_count + ' comments</li>');
        html.push('<li class="viewsDribbble"><i class="icon-eye-open"></i> ' + shot.views_count + '</li>');
        html.push('<li class="loveDribbble"><i class="icon-heart"></i> ' + shot.likes_count + '</li></ul>');
    });

    $('#shotsByPlayerId').html(html.join(''));
}, {page: 1, per_page: 1});


$.jribbble.getPlayerById('JureStern', function (player) { // Dribbble API call player stats
    var html = [];
    
    html.push('<ul class="achivementList clearfix"><li><div class="number">' + player.shots_count  + '</div>' + '<div class="icon"><i class="icon-camera"></i></div>' + 'shots</li>');
    html.push('<li><div class="number">' + player.following_count + '</div>' + '<div class="icon"><i class="icon-heart-empty"></i></div>' + 'following</li>');
    html.push('<li><div class="number">' + player.followers_count + '</div>' + '<div class="icon"><i class="icon-heart"></i></div>' + 'followers</li>');

    $('#playerProfile').html(html.join(''));
});