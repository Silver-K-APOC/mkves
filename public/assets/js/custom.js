document.addEventListener('DOMContentLoaded', function() {

    $('.date-pick').datepicker();
    $(".staff").hide();

    $(".image-box").on('click', function(event) {

        var previewImg = $(this).children("img");

        $(this)
            .siblings()
            .children("input")
            .trigger("click");

        $(this)
            .siblings()
            .children("input")
            .change(function() {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var urll = e.target.result;
                    $(previewImg).attr("src", urll);
                    previewImg.parent().css("background", "transparent");
                    previewImg.show();
                    previewImg.siblings("p").hide();
                };
                reader.readAsDataURL(this.files[0]);
            });
    });

    var teacher = $("[name='user_type']").val();
    $("[name='user_type']").on('change', function(event){

        var user_type = $(this).val();
        // console.log("teacher", teacher);
        // console.log(user_type);
        
        if(user_type == teacher){
            $(".teacher").find("[type='text']").val('');
            $(".staff").find("[type='text']").val("(NULL)");
            $(".teacher").show();
            $(".staff").hide();
        }else{
            $(".staff").find("[type='text']").val('');
            $(".teacher").find("[type='text']").val("(NULL)");
            $(".teacher").hide();
            $(".staff").show();
        }

    });

    console.log(medical_entitlement);
    if(medical_entitlement == 'off'){
        $(".medical").find('select').attr('disabled', 'disabled');
        $(".medical").find('input').attr('disabled', 'disabled');
        $(".medical").find('textarea').attr('disabled', 'disabled');
    }

    $("[name='medical_entitlement']").on('change', function(){

        var choosed = $(this)[0].checked;
        if(!choosed){
            $(".medical").find('select').attr('disabled', 'disabled');
            $(".medical").find('input').attr('disabled', 'disabled');
            $(".medical").find('textarea').attr('disabled', 'disabled');

            $(".medical").find('select').prop('selectedIndex',-1).trigger( "change" );
            $(".medical").find('input').val('');
            $(".medical").find('textarea').val('');

        }else{
            $(".medical").find('select').removeAttr('disabled');
            $(".medical").find('input').removeAttr('disabled');
            $(".medical").find('textarea').removeAttr('disabled');
        }
    });

    //////////////////////////////////////////////////
    $("[name='allowances']").on('change',function(){

        var type = $(this).val();
        $(".allowance_modal").find('tbody').empty();
        $("[name='amount_allowances']").val(''); 
        $("[name = 'new_allowance_year']").val('');
        $("[name = 'new_allowance_type']").val('');
        $("[name = 'new_allowance_amount']").val('');

        $("[name = 'new_allowance_type']").val(type);

        $.get(getAllowances,{type:type}, function(res){
            for(i in res){
                $(".allowance_modal").find('tbody').append(
                    " <tr> <td>"+res[i]['start']+"/"+res[i]['end']+"</td>"+
                    " <td>"+res[i]['type']+"</td>"+
                    " <td>"+res[i]['amount']+" DHS </td>"+
                    " <td><i class='icon-trash' onclick='delAllowance("+res[i]['id']+", this);' style='cursor:pointer;' id='"+res[i]['id']+"'></tr>"
                   );
                
                $("[name='allowances_amount']").val(res[i]['amount']);                
            }
        });
        
        

    });

    $("[name='setAllowance']").on("click", function(){

        var year = $("[name = 'new_allowance_year']").val();
        var type = $("[name = 'new_allowance_type']").val();
        var amount = $("[name = 'new_allowance_amount']").val();

        $.get(setAllowances,{year:year, type:type, amount:amount}, function(res){
            
                $(".allowance_modal").find('tbody').append(
                    " <tr> <td>"+year+"</td>"+
                    " <td>"+type+"</td>"+
                    " <td>"+amount+" DHS </td>"+
                    " <td><i class='icon-trash' onclick='delAllowance("+res+",this);' style='cursor:pointer;' id='"+res+"'></tr>"
                   );
                   $("[name = 'new_allowance_year']").val('');
                   $("[name = 'new_allowance_type']").val('');
                   $("[name = 'new_allowance_amount']").val('');            
        });

    });

    /////////////////////////////////////////////////////////////////
    $("[name='responsibility_allowances']").on('change',function(){

        
        var type = $(this).val();
        $(".responsibility_allowance_modal").find('tbody').empty();
        $("[name='amount_responsibility_allowances']").val(''); 
        $("[name = 'new_responsibility_allowance_year']").val('');
        $("[name = 'new_responsibility_allowance_type']").val('');
        $("[name = 'new_responsibility_allowance_amount']").val('');

        $("[name = 'new_responsibility_allowance_type']").val(type);

        $.get(getResponsibilityAllowances,{type:type}, function(res){
            for(i in res){
                $(".responsibility_allowance_modal").find('tbody').append(
                    " <tr> <td>"+res[i]['start']+"/"+res[i]['end']+"</td>"+
                    " <td>"+res[i]['type']+"</td>"+
                    " <td>"+res[i]['amount']+" DHS </td>"+
                    " <td><i class='icon-trash' onclick='delResponsibilityAllowance("+res[i]['id']+", this);' style='cursor:pointer;' id='"+res[i]['id']+"'></tr>"
                   );
                
                $("[name='responsibility_allowances_amount']").val(res[i]['amount']);                
            }
        });
        
        

    });

    $("[name='setResponsibilityAllowance']").on("click", function(){

        var year = $("[name = 'new_responsibility_allowance_year']").val();
        var type = $("[name = 'new_responsibility_allowance_type']").val();
        var amount = $("[name = 'new_responsibility_allowance_amount']").val();

        $.get(setResponsibilityAllowances,{year:year, type:type, amount:amount}, function(res){
            
                $(".responsibility_allowance_modal").find('tbody').append(
                    " <tr> <td>"+year+"</td>"+
                    " <td>"+type+"</td>"+
                    " <td>"+amount+" DHS </td>"+
                    " <td><i class='icon-trash' onclick='delResponsibilityAllowance("+res+",this);' style='cursor:pointer;' id='"+res+"'></tr>"
                   );            

                    $("[name = 'new_responsibility_allowance_year']").val('');
                    $("[name = 'new_responsibility_allowance_type']").val('');
                    $("[name = 'new_responsibility_allowance_amount']").val('');
        });

    });

    /////////////////////////////////////////////////////
    if(medical_life != 'Life') {$(".medical_life").hide();}

    $("[name='medical_category']").on('change',function(){
        
        var type = $(this).val();
        console.log(type);
        if(type != 'Life'){
            $(".medical_life").hide();
        }else{
            $(".medical_life").show();
        }
    });

    if(emergency_leave != 'Emergency leave') {$(".emergency_leave").hide();}

    $("[name='type_of_leaving']").on('change',function(){

        var type = $(this).val();
        if(type != 'Emergency leave'){
            $(".emergency_leave").hide();
        }else{
            $(".emergency_leave").show();
        }
    });

    if(teacher_list == 'on'){
        $("[trigger-toggle='teacher']").trigger('click');
    }

    if(admin_list == 'on'){
        $("[trigger-toggle='admin']").trigger('click');
    }

    ////////////// PDF Maker /////////////

    $(".pdf_maker").on('click',function(){

        const quality = 2; // Higher the better but larger file

        html2canvas(document.querySelector('#PDFTarget'),
            { scale: quality }
        ).then(canvas => {
            const pdf = new jsPDF('p', 'mm', 'a4');
            pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 7, 7, 194, 290);
            pdf.save(filename+".pdf");
        });        

    });

    $(".pdf_printer").on('click',function(){

        window.print();
        return true;

    });

    ///////////////// full calender ////////////////////////

    $.get("dashboard/getEvents",function(res){

        for(i in res){

            eventData = {
                title: res[i]['title'],
                start: res[i]['start'],
                end: res[i]['end'],
                db: res[i]['id']
              };
              
            $(".fullcalendar-basic").fullCalendar("renderEvent", eventData, true);
        }
    });

    $('.fullcalendar-basic').fullCalendar({
        
              header: {
                left: "prev,next today",
                center: "title",
                right: "month,agendaWeek,agendaDay"
              },
              defaultView: "month",
              navLinks: true, // can click day/week names to navigate views
              selectable: true,
              selectHelper: false,
              editable: true,
              eventLimit: true, // allow "more" link when too many events
          
              select: function(start, end) {
                var title = prompt("Please insert Event Content (ex: 2:30pm Meeting):");
                var eventData;
                if (title) {
                  
                  //add
                  console.log("addEvent");
                  $.get("dashboard/addEvents",{start:start.format('YYYY-MM-DD'), end:end.format('YYYY-MM-DD'), title:title}, function(res){
                    
                    eventData = {
                        title: title,
                        start: start,
                        end: end,
                        db: res
                      };
                    $(".fullcalendar-basic").fullCalendar("renderEvent", eventData, true); // stick? = true
                    
                  });                  
                }
                $(".fullcalendar-basic").fullCalendar("unselect");
              },
          
              eventRender: function(event, element) {
                element
                  .find(".fc-content")
                  .prepend("<i class='closeon icon-close2' id='"+event.db+"'></i>");
                element.find(".closeon").on("click", function() {                  
                  //delete
                  console.log("delete");
                  $.get("dashboard/delEvents",{id:$(this).attr('id')}, function(res){
                    $(".fullcalendar-basic").fullCalendar("removeEvents", event._id);
                  });
                });
              },
          
              eventClick: function(calEvent) {
                // var title = prompt("Edit Event Content:", calEvent.title);
                // calEvent.title = title;
                // $(".fullcalendar-basic").fullCalendar("updateEvent", calEvent);
              }
            });
          



});


function delAllowance(id,ele){

    if(!confirm("Are you sure you want to delete the selected row?")) return;

    $.get(delAllowances,{id:id}, function(res){
        
        $(ele).parents('tr').remove();
        
    });
}

function delResponsibilityAllowance(id,ele){

    if(!confirm("Are you sure you want to delete the selected row?")) return;

    $.get(delResponsibilityAllowances,{id:id}, function(res){
        
        $(ele).parents('tr').remove();
        
    });
}