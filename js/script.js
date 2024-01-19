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

    return day + '-' + month + '-' + year + ' ' + hour + ':' + minute + ':' + second;
}


function getExpiredDate(nowDT, isExp, bookFor) {
    var currentDate = new Date(nowDT);

    // Check if the date is valid
    if (isNaN(currentDate.getTime())) {
        throw new Error('Invalid input: Must be a valid Date string');
    }

    var day = currentDate.getDate().toString().padStart(2, '0');
    var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
    var year = currentDate.getFullYear();
    var hour = currentDate.getHours().toString().padStart(2, '0');
    var minute = currentDate.getMinutes().toString().padStart(2, '0');
    var second = currentDate.getSeconds().toString().padStart(2, '0');

    if (isExp) {
        bookFor = parseInt(bookFor);
        year += bookFor;
    }
    return year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second;

}

function scrollToMessage() {
    $('html, body').animate({
        scrollTop: $(".message").offset().top
    }, 'slow');
}
