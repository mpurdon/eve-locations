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

$(document).ready(function() {
	if (typeof CCPEVE != 'undefined') {
		
		var current_url = document.location.href;
        var base_url = current_url.substring(0, current_url.indexOf('/', 7));
		CCPEVE.requestTrust(base_url);
	}
	
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
		
		apprise
		
	});
	
	$('span.set_system a').click(function(event) {
		if (typeof CCPEVE == 'undefined') {
			return false;
		}
		
		var system_id = $(this).attr('id');
		
		CCPEVE.setDestination(system_id);
		
		var noty = noty({
			timeout: 3000,
			text: 'Destination set to ' + $(this).text()
		});
		
		return false;
	});
});
