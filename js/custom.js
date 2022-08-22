var start_signal = null;
    
    var sequence = [];
    
    var max_sequence = 0;
    
    var current_sequence = 1;
    
    var timer = 0;
    
    var green_light = 0;
    var yellow_light = 0; 
    
    $(document).ready(function()
    {
        $("#error").html("");
        resetLight();         
        $("#stop").hide();
        $.ajax({
            type: "GET",
            url: base_url + "?type=getdata",
            
            data: [],
            success: function (data) {
                var data = JSON.parse(data);
                if(data.status == "ok")
                {
                    sequence = data.data.signalordor; 
                    
                    green_light = data.data.signalgreenlight; 
                    yellow_light = data.data.signalyellowlight; 
                    max_sequence = data.data.max_sequence;
                    
                    $("#greenlight").val(green_light);
                    $("#yellowlight").val(yellow_light);
                    
                    //console.log(data.data.signalorder);                    
                    for (var i = 0; i < data.data.signalvalue.length; i++) {
                        $("#singalinput"+(i+1)).val(data.data.signalvalue[i]);                        
                    }
                    
                }
                else
                {
                    $("#error").html(data.message);
                }
            },
            error: function (data) {
                $("#error").html('An error occurred.');
                return false;
            },
        });
        
    });
    
    $("#start").click(function() {
        stopSignal();
        startSignal();
        $("#start").hide();
        $("#stop").show();
        return false;
    }); 
    
    $("#stop").click(function(){
        $("#start").show();
        $("#stop").hide();
        stopSignal();
        return false;
    }); 
    
    function resetLight()
    {
        $(".signal").addClass('red_signal');
        $(".signal").removeClass("green_signal");
        $(".signal").removeClass("yellow_signal");
        $("#current_timer").html("Timer: 0"); 
        
    }
    
    
    function startSignal()
    {
        $.ajax({
            type: "GET",
            url: base_url + "?type=getdata",
            data: [],
            success: function (data) {
                var data = JSON.parse(data);
                if(data.status == "ok")
                {
                    current_sequence = 1;
                    timer = 0;
                    
                    sequence = data.data.signalordor; 
                    
                    green_light = data.data.signalgreenlight; 
                    yellow_light = data.data.signalyellowlight; 
                    max_sequence = data.data.max_sequence;
                    
                    $("#greenlight").val(green_light);
                    $("#yellowlight").val(yellow_light);
                    
                    //console.log(data.data.signalorder);                    
                    for (var i = 0; i < data.data.signalvalue.length; i++) {
                        $("#singalinput"+(i+1)).val(data.data.signalvalue[i]);                        
                    }
                    
                    
                    start_signal = setInterval(function()
                    {
                        setLight();
                    }, 1000); 
                }
                else
                {
                    $("#error").html(data.message);
                }
            },
            error: function (data) {
                $("#error").html('An error occurred.');
                return false;
            },
        });
    }
    
    function stopSignal()
    {
        resetLight();
        if (start_signal != null){
            clearInterval(start_signal);
        }        
    }
    
    function setLight()
    {
        resetLight();
        if(timer > (green_light + yellow_light))
        {
            timer = 0;
            current_sequence = current_sequence + 1;            
        }
        
        if(current_sequence > max_sequence)
        {
            current_sequence = 1;
        }
        
        timer = timer + 1;
        
        var position = "#signal" + sequence[current_sequence - 1];
        $("#current_timer").html("Timer: 0"); 
        
        if(timer <= green_light)
        {
            $(position).addClass("green_signal");
            $("#current_timer").html("Timer: " + timer).css("color", "green"); 
        }
        
        if(timer > green_light && timer <= (green_light + yellow_light))
        {
            $(position).addClass("yellow_signal"); 
            $("#current_timer").html("Timer: " + timer).css("color", "yellow"); 
        }
    }    
    
    $(document).on('change keyup', 'input', function() 
    {
        $("#error").html("");
        $.ajax({
            type: "POST",
            url: base_url + "?type=setdata",
            data: $('#singalform').serialize(),
            success: function (data) {
                var data = JSON.parse(data);
                if(data.status == "error")
                {
                    $("#error").html(data.message);
                    return false;
                }
            },
            error: function (data) {                        
                $("#error").html('An error occurred.');
            },
        });
    });
