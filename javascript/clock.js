function getTime() {

    var currTime = new Date();
    var hour = currTime.getHours();
    var minute = currTime.getMinutes();
    var second = currTime.getSeconds();
    var ampm = (hour >= 12) ? "PM" : "AM";

    //Change hours from 0-23 to 1-12:
    hour = (hour % 12 == 0) ? 12 : hour % 12;

    //If hour, minute, or second are less than 10, add a leading zero
    if (hour < 10) {
        hour = "0" + hour;
    }
    if (minute < 10) {
        minute = "0" + minute;
    }
    if (second < 10) {
        second = "0" + second;
    }

    //Make the time string:
    var timeString = hour + ":" + minute + ":" + second + " " + ampm;

    //Return the time string:
    document.getElementById("clock").innerHTML = timeString;
}