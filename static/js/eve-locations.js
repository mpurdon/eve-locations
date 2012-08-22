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

$(document).ready(function() {
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

	setTimeout("refreshList()", 300000);

	$('#add_sighting').click(function(event) {
		var location = '';
		
		if (typeof CCPEVE !== 'undefined') {
			// Find the pilot's current system
			
		}
	});
	
	$('span.set_system a').click(function(event) {
		if (typeof CCPEVE == 'undefined') {
			return false;
		}
		
		var system_id = $(this).attr('id');
		
		CCPEVE.setDestination(system_id);
		
		show_destination_set($(this).text());
		
		return false;
	});
});
