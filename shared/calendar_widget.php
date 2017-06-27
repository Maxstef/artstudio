<style>
    #calendar {
        margin:  auto;
        height: 265px;
    }
    #calendar td{
        color: #808080;
        font-size: 16px;
        padding: 2px 4px;
        text-align: center;
    }
    #calendar tbody td:nth-child(n+6){
        color: #ef8e8e;
    }

    #today {
        color: white !important;
        background-color: #ef8e8e;  
        border-radius: 3px;
    }
    #calendar thead tr:nth-child(2) td:nth-child(1), #calendar thead tr:nth-child(2) td:nth-child(3){
        cursor: pointer;
        color: black !important;
        font-size: 25px !important;
        font-weight: 900 !important;
    }
</style>
<div style="width:  100%; text-align: center">
    <table id="calendar">
        <thead>
            <tr>
                <td colspan="7"></td>
            </tr>
            <tr>
                <td id="left"><</td>
                <td colspan="5"></td>
                <td id="right">></td>
            </tr>
            <tr><td>Пн</td><td>Вт</td><td>Ср</td><td>Чт</td><td>Пт</td><td>Сб</td><td>Нд</td></tr>
        </thead>
        <tbody>
                
        </tbody>
    </table>
</div>
<script src="../js/calendar.widget.js"></script>