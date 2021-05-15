function getTodayMonthDate(separator) {
    var today = new Date();
    var month = today.getMonth() + 1;
    var date = today.getDate();

    if (month < 10) {
        month = "0" + month;
    }
    if (date < 10) {
        date = "0" + date;
    }
    return month + separator + date;
}

function getTodayYearMonthDate(separator) {
    var today = new Date();
    var year = today.getFullYear();
    return year + separator + getTodayMonthDate(separator);
}


function dateStringToTime(dateString) {
    if (dateString == null || dateString.length < 3) {
        return "";
    } else {
		
        var hours = extractHours(dateString);
		
        var minutes = extractMinutes(dateString);
		
        if (hours < -1 || minutes == -1) {
            return "";
        }
        //var date = new Date(null, null, null, hours, minutes);
        //var hours = date.getHours();
        //var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        // minutes = minutes < 10 ? '0' + minutes : minutes;
	//	alert(hours + ':' + minutes + ' ' + ampm);
        return hours + ':' + minutes + ' ' + ampm;
    }
}

function extractHours(dateString) {
	//alert(convertTimeStringToNumber(dateString.substr(0, 2)));
    if (dateString != null && dateString.length > 0) {
        return convertTimeStringToNumber(dateString.substr(0, 2));
    } else {
        return -1;
    }
}

function extractMinutes(dateString) {
    if (dateString != null && dateString.length > 3) {
        return convertTimeStringToNumber(dateString.substr(3, 2));
    } else {
        return -1;
    }
}

function convertTimeStringToNumber(numberString) {
    if (isNaN(numberString)) {
        return -1;
    } else {
        return numberString;
    }
}

function dateStringToDate(dateString) {
    if (dateString == null || dateString.length < 10) {
        return;
    }
    var today = new Date();
    var month = dateString.substr(5, 2);
    var date = dateString.substr(8, 2);
    if (isNaN(month) || isNaN(date)) {
        return;
    }
    return new Date(today.getFullYear(), month - 1, date);
}

function formatNextChange(dateString, timeString) {
    if (dateString == null || dateString.length < 10 || timeString == null || timeString.length < 3) {
        return;
    }
    var date = dateStringToDate(dateString);
    var formattedTime = dateStringToTime(timeString);

    var result = "";
    if(date != null) {
        var month = (date.getMonth() + 1);
        var d = date.getDate();
        month = month < 10 ? "0" + month : month;
        d = d < 10 ? "0" + d : d;
        result += month + "/" + d;
    }
    if (result.length > 0) {
        result += "<br/>"
    }
    if (formattedTime != null && formattedTime.length > 0) {
        result += formattedTime;
    }
    return result;
}



