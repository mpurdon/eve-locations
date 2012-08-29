function setCookie(c_name, value, exdays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
    document.cookie = c_name + "=" + c_value;
}

function getCookie(c_name) {
    var i, x, y, allCookies = document.cookie.split(";");
    for (i = 0; i < allCookies.length; i++) {
        x = allCookies[i].substr(0, allCookies[i].indexOf("="));
        y = allCookies[i].substr(allCookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == c_name) {
            return unescape(y);
        }
    }
}

function deleteCookie(name) {
    document.cookie = name + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
}

function refreshList() {
	if($('#do_refresh').attr('checked')) {
		location.reload();	
	}
}

function show_destination_set(destination) {
	
	var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
	
    var opts = {
        title: "Destination set",
        text: "Destination has been set to " + destination,
        addclass: "stack-bar-top",
        cornerclass: "",
        width: "100%",
        stack: stack_bar_top,
        type: "success,"
    };
    
    $.pnotify(opts);
}

function notifyUpdates() {
	
	var updateMessages = '';
	var releaseNotes = new Array();
	
	releaseNotes[20120828] = '<h4>Release 2012-08-28 Added the ability to record a wt sighting.</h4><ul><li>Using the IGB the form is filled in with the  the current system information</li><li>You can specify wormhole as the location</li><li>Adding the ship type will have it show up on the locations list</li><ul>';

	var lastNotificationCookie = getCookie("updateNotified");

	if (lastNotificationCookie == null || lastNotificationCookie == '') {
		lastNotificationCookie = 0;
	}

	var mostRecentUpdate = lastNotificationCookie;
	for (var releaseDate in releaseNotes) {
		if (releaseDate > lastNotificationCookie) {
			updateMessages += releaseNotes[releaseDate];
			mostRecentUpdate = releaseDate;
		}
	}

	if (lastNotificationCookie != mostRecentUpdate) {
		setCookie('updateNotified', mostRecentUpdate, 365);
	}

	if (updateMessages.length > 0) {
		updateMessages = '<h3>Updates since your last visit</h3>' + updateMessages;
		apprise(updateMessages);
	}
}

function displayTerms() {
	apprise('EVE Online and the EVE logo are the registered trademarks of CCP hf. All rights are reserved worldwide. All other trademarks are the property of their respective owners. EVE Online, the EVE logo, EVE and all associated logos and designs are the intellectual property of CCP hf. All artwork, screenshots, characters, vehicles, storylines, world facts or other recognizable features of the intellectual property relating to these trademarks are likewise the intellectual property of CCP hf. CCP hf. has granted permission to evewho.com to use EVE Online and all associated logos and designs for promotional and information purposes on its website but does not endorse, and is not in any way affiliated with, evewho.com. CCP is in no way responsible for the content on or functioning of this website, nor can it be liable for any damage arising from the use of this website.');
}

$(document).ready(function() {
	
	// Handle browser trust
	if (typeof CCPEVE != 'undefined') {
		var current_url = document.location.href;
        var base_url = current_url.substring(0, current_url.indexOf('/', 7));
		CCPEVE.requestTrust(base_url);
	}
	
	// Set up jQuery UI as the Pines notify styling handler
	$.pnotify.defaults.styling = "jqueryui";
	
	// Don't do a history
	$.pnotify.defaults.history = false;
	
	// Show for 3 seconds
	$.pnotify.defaults.delay = 3000;
	
	$('#do_refresh').change(function(event) {
		deleteCookie('doRefresh');
		if($('#do_refresh').attr('checked')) {
			setCookie('doRefresh', 'true', 14);
		} else {
			setCookie('doRefresh', 'false', 14);
		}
	});
	
	//if IsRefresh cookie exists
	 var refreshCookie = getCookie("doRefresh");
	 
	 if (refreshCookie != null && refreshCookie != "") {
		 if (refreshCookie === 'true') {
			 $('#do_refresh').attr('checked', 'checked');
		 }
	 }
	 
	 // Tell the user about new features
	 notifyUpdates();

	setTimeout("refreshList()", 300000);

	$('span.set_system a').click(function(event) {
		if (typeof CCPEVE == 'undefined') {
			return false;
		}
		
		var system_id = $(this).attr('id');
		
		CCPEVE.setDestination(system_id);
		
		show_destination_set($(this).text());
		
		return false;
	});
	
	$('#submit-sighting').click(function(event) {
		// We have to update the date so that it's current before we submit the sighting form
		
		var current_url = document.location.href;
        var base_url = current_url.substring(0, current_url.indexOf('/', 7));
        var timezone_url = base_url + '/time-by-zone/GMT';
		
        $.getJSON('/time-by-zone/GMT', function(serverDate){
			var GMTDateTime = new Date(serverDate.datetime);
			var datePart = GMTDateTime.toISOString().match( /([0-9]{4}-[0-9]{2}-[0-9]{2})/ )[0];
			var timePart = GMTDateTime.toISOString().match( /([0-9]{2}:[0-9]{2}:[0-9]{2})/ )[0];
			var eveDateTime = datePart + ' ' + timePart;
			
			$('<input>').attr({
			    type: 'hidden',
			    id: 'eve-date',
			    name: 'eve-date',
			    value: eveDateTime  
			}).appendTo('#form-location-sighting');
		    
		    $('#form-location-sighting').submit();
		});
	});
	
	$('#in-wormhole').click(function(event){
		event.preventDefault();
		$('#station').val('(in space)');
		$('#system').val('wormhole');
		$('#constellation').val('');
		$('#region').val('');
	});
	
	$('#show-terms').click(function(event) {
		displayTerms();
	});
});
