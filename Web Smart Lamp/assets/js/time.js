function updateClock() {
    // Get waktu dan tanggal sekarang
    var now = new Date();

    // Extract jam, menit, detik
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();

    // nambahin 0 depan angka satuan
    hours = (hours < 10) ? "0" + hours : hours;
    minutes = (minutes < 10) ? "0" + minutes : minutes;
    seconds = (seconds < 10) ? "0" + seconds : seconds;

    // Concat jam, menit, detik
    var time = hours + ":" + minutes + ":" + seconds;

    // Insert time into HTML
    document.getElementById("time").innerHTML = time;
}

// Update tiap detik
setInterval(updateClock, 1000);

function updateDate() {
    // Get current date
    var now = new Date();

    // Extract year, month, and day
    var year = now.getFullYear();
    var month = now.getMonth() + 1; // Months are zero-based
    var day = now.getDate();

    // Add leading zero if needed
    month = (month < 10) ? "0" + month : month;
    day = (day < 10) ? "0" + day : day;

    // Concatenate year, month, and day
    var date = year + "-" + month + "-" + day;

    // Insert date into HTML
    document.getElementById("date").innerHTML = date;
}

// Update the date every second (1000 milliseconds)
setInterval(updateDate, 1000);

