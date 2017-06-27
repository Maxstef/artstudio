var calendarObject = {};
calendarObject.date = new Date();
calendarObject.year = calendarObject.date.getFullYear();
calendarObject.month = calendarObject.date.getMonth();
calendarObject.months = ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'];
document.getElementById('left').onclick = function () { drawMonth(calendarObject.year, calendarObject.month - 1); };
document.getElementById('right').onclick = function () { drawMonth(calendarObject.year, calendarObject.month + 1); };
window.onload = function () { drawMonth(calendarObject.year, calendarObject.month); }



function drawMonth(year, month){
    document.querySelector('#calendar tbody').innerHTML = '';
    document.querySelector('#calendar thead td:first-child').innerHTML = '';
    document.querySelector('#calendar thead td:nth-child(2)').innerHTML = '';
    var content = '<tr>';
    if(month < 0){
        month = 11;
        year = year - 1;
    }
    if(month > 11){
        month = 0;
        year = year + 1;
    }
    var date = new Date(year, month),
        d1Last = new Date(year, month + 1, 0).getDate(),
        dLast = new Date(year, month, d1Last).getDay(),
        dFirst = new Date(year, month, 1).getDay();
            if (dFirst != 0) {
                for (i = 1; i < dFirst; i++) {
                    content += '<td>';
                }
            } else {
                for (i = 0; i < 6; i++) {
                    content += '<td>';
                }
            }
            var today = new Date();
            for (i = 1; i <= d1Last; i++) {
                if(today.getDate() == i && today.getFullYear() == year && today.getMonth() == month){
                    content += '<td id="today">' + i;
                } else {
                    content += '<td>' + i;  
                }
                
                                
                if (new Date(date.getFullYear(), date.getMonth(), i).getDay() == 0) {
                    content += '<tr>';
                }
            }
            if (dLast != 0) {
                for (i = dLast; i < 7; i++) {
                    content += '<td>';
                }
            }
            document.querySelector('#calendar tbody').innerHTML = content;
            document.querySelector('#calendar thead td:first-child').innerHTML = year;
            document.querySelector('#calendar thead td:nth-child(2)').innerHTML = calendarObject.months[month];
            calendarObject.year = year;
            calendarObject.month = month;
}