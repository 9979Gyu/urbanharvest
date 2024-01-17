$(document).ready(function () {
    function downloadPDFWithBrowserPrint() {
        window.print();
    }

    $("#btnExport").click(function(){
        downloadPDFWithBrowserPrint();
    });

});