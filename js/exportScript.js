$(document).ready(function () {
    function downloadPDFWithBrowserPrint() {
        window.print();
    }

    $("#btnExport").click(function(){
        downloadPDFWithBrowserPrint();
    });

    function exportTableToExcel() {
        today = new Date();

        let year = today.getFullYear();
        let month = today.getMonth() + 1;
        let day = today.getDate();
        let hour = today.getHours();
        let min = today.getMinutes();
        let sec = today.getSeconds();

        // Add zero if is single digit
        month = month < 10 ? '0' + month : month;
        day = day < 10 ? '0' + day : day;
        sec = sec < 10 ? '0' + sec : sec;
        min = min < 10 ? '0' + min : min;
        hour = hour < 10 ? '0' + hour : hour;

        // Format datetime
        let formattedDate = `${year}${month}${day}${hour}${min}${sec}`;

        $("#bookingRequest").table2excel({
            name: "Backup file for HTML content",
            filename: "Booking_" + formattedDate + ".xls",
            preserveColors: false
        });
    }

    // Attach click event to the export button
    $("#excelBtn").click(function() {
        exportTableToExcel();
    });

});