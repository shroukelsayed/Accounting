   //StartDate And EndDate

$(document).ready(function(){ 
    $("#startdate").datepicker({
        dateFormat: 'yy/mm/dd',
        minDate: 0,
        maxDate: "+365D",
        numberOfMonths: 1,
        onSelect: function(selected) {
          $("#enddate").datepicker("option","minDate", selected)
    }

    });

    $("#startdate").keydown(function(event){
          event.preventDefault();          
    }); 

    $("#enddate").datepicker({ 
        dateFormat: 'yy/mm/dd',
        minDate: 0,
        maxDate:"+365D",
        numberOfMonths: 1,
        onSelect: function(selected) {
           $("#startdate").datepicker("option","maxDate", selected)
        }
    }); 

    $("#enddate").keydown(function(event){
          event.preventDefault();          
    });  

 });      