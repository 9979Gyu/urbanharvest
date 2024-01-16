function getDate(isExpired, bookYear){
    var currentDT = new Date();
    var day = currentDT.getDate().toString().padStart(2, '0');
    var month = (currentDT.getMonth() + 1).toString().padStart(2, '0'); 
    var year = currentDT.getFullYear();
    var hour = currentDT.getHours().toString().padStart(2, '0');
    var minute = currentDT.getMinutes().toString().padStart(2, '0');
    var second = currentDT.getSeconds().toString().padStart(2, '0');

    if(isExpired){
        bookYear = parseInt(bookYear);
        year += bookYear;
    }

    return day + '/' + month + '/' + year + ' ' + hour + ':' + minute + ':' + second;
}

function scrollToMessage() {
    $('html, body').animate({
        scrollTop: $(".message").offset().top
    }, 'slow');
}


function getBookingList(){
    var bookingList;
    var isExtend = false;

    if(localStorage.getItem("extendYear")){
        isExtend = true;
        bookingList = [
            [localStorage.getItem("gardenName"), localStorage.getItem("plotNo"), localStorage.getItem("gardenAddress"), 'yuqin1161@gmail.com', localStorage.getItem("extendDT"), localStorage.getItem("extendYear"), localStorage.getItem("extendApproval"), localStorage.getItem("extendPaymentStatus"), true],
            [localStorage.getItem("gardenName"), localStorage.getItem("plotNo"), localStorage.getItem("gardenAddress"), 'yuqin1161@gmail.com', localStorage.getItem("bookDT"), localStorage.getItem("bookYear"), localStorage.getItem("bookApproval"), localStorage.getItem("paymentStatus"), false],
            ['Taman Desa Idaman', '2', 'Taman Desa Idaman, 76100, Durian Tunggal, Melaka', 'yuqin1161@gmail.com', '16/10/2023 07:46', '2', "Approved", "Paid", false],
            ['Taman Nuri Sentosa', '21', 'Kampung Tengah, 76100 Durian Tunggal, Melaka', 'micheal@gmail.com', '16/9/2023 07:46', '1', "Approved", "Cancelled", false],
            ['Taman Daya', '2', 'Taman Daya, 81100 Johor Bahru, Johor', 'yuan@gmail.com', '15/9/2023 17:46', '2', "Declined", "Pending", false],
        ];
    }
    else if(localStorage.getItem("bookYear")){
        bookingList = [
            [localStorage.getItem("gardenName"), localStorage.getItem("plotNo"), localStorage.getItem("gardenAddress"), 'yuqin1161@gmail.com', localStorage.getItem("bookDT"), localStorage.getItem("bookYear"), localStorage.getItem("bookApproval"), localStorage.getItem("paymentStatus")],
            ['Taman Desa Idaman', '2', 'Taman Desa Idaman, 76100, Durian Tunggal, Melaka', 'yuqin1161@gmail.com', '16/10/2023 07:46', '2', "Approved", "Paid"],
            ['Taman Nuri Sentosa', '21', 'Kampung Tengah, 76100 Durian Tunggal, Melaka', 'micheal@gmail.com', '16/9/2023 07:46', '1', "Approved", "Cancelled"],
            ['Taman Daya', '2', 'Taman Daya, 81100 Johor Bahru, Johor', 'yuan@gmail.com', '15/9/2023 17:46', '2', "Declined", "Pending"],
        ];
    }
    else{
        bookingList = [
            ['Taman Desa Idaman', '2', 'Taman Desa Idaman, 76100, Durian Tunggal, Melaka', 'yuqin1161@gmail.com', '16/10/2023 07:46', '2', "Approved", "Paid"],
            ['Taman Nuri Sentosa', '21', 'Kampung Tengah, 76100 Durian Tunggal, Melaka', 'micheal@gmail.com', '16/9/2023 07:46', '1', "Approved", "Cancelled"],
            ['Taman Daya', '2', 'Taman Daya, 81100 Johor Bahru, Johor', 'yuan@gmail.com', '15/9/2023 17:46', '2', "Declined", "Pending"],
        ];
    }

    return [isExtend, bookingList];

}

function getHistory(){
    var bookingList;

    if(localStorage.getItem("extendYear")){
        bookingList = [
            [localStorage.getItem("gardenName"), localStorage.getItem("plotNo"), localStorage.getItem("gardenAddress"), localStorage.getItem("extendDT"), localStorage.getItem("extendApproval"), localStorage.getItem("extendBalance"), localStorage.getItem("extendPayAmount"), localStorage.getItem("extendPaymentStatus")],
            [localStorage.getItem("gardenName"), localStorage.getItem("plotNo"), localStorage.getItem("gardenAddress"), localStorage.getItem("bookDT"), localStorage.getItem("bookApproval"), localStorage.getItem("balance"), localStorage.getItem("payAmount"), localStorage.getItem("paymentStatus")],
            ['Taman Desa Idaman', '2', 'Taman Desa Idaman, 76100, Durian Tunggal, Melaka', '16/10/2023 07:46', "Approved", "0", "100", "Paid"],
        ];
    }
    else if(localStorage.getItem("bookYear")){
        bookingList = [
            [localStorage.getItem("gardenName"), localStorage.getItem("plotNo"), localStorage.getItem("gardenAddress"), localStorage.getItem("bookDT"), localStorage.getItem("bookApproval"), localStorage.getItem("balance"), localStorage.getItem("payAmount"), localStorage.getItem("paymentStatus")],
            ['Taman Desa Idaman', '2', 'Taman Desa Idaman, 76100, Durian Tunggal, Melaka', '16/10/2023 07:46', "Approved", "0", "100", "Paid"],
        ];
    }   
    else{
        bookingList = [
            ['Taman Desa Idaman', '2', 'Taman Desa Idaman, 76100, Durian Tunggal, Melaka', '16/10/2023 07:46', "Approved", "0", "100", "Paid"],
        ];
    }

    return bookingList;
}