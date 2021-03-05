
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Joshua Script</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="chatbot-wrapper">
        <div class="title">
            <p>Jaxx Chat Test</p>
        </div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-user-astronaut"></i>
                </div>
                <div class="msg-header">
                    <p>Hi there! May I help you?</p>
                </div>
            </div>
            <br>
        </div>
        <div class="ticontainer">
            <div class="tiblock">
                <p class="prompt">Typing</p>
                <div class="tidot"></div>
                <div class="tidot"></div>
                <div class="tidot"></div>
            </div>
        </div>
        <div class="chat-options">
            <button id="show-emoji">🙂<span style="font-size:10px;">+</span></button>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Start typing..." required>
                <button id="send-btn">Send</button>
            </div> 
        </div>
    </div>
    <script>
        $(document).ready(function (){
            //Some little sheight
            $(".ticontainer").hide();
            $( "#data" ).focus(function() {
                $(".ticontainer").show();
            });
            $( "#data" ).focusout(function() {
                $(".ticontainer").hide();
            });
            //On click
            $("#send-btn").on("click", function(){
                    $value = $("#data").val();
                    $msg = 
                        "<div class='user-inbox inbox'><div class='msg-header'><p>" 
                        + $value 
                        + "</p></div>" 
                        + "<div class='icon'><i class='fas fa-user'></i></div></div>";
                    $(".form").append($msg);
                    $("#data").val('');
                    /*
                    for testing = so far so good
                    alert($value);
                    */
                    $("#data").val('');
                    // Ajax starts here
                    $.ajax({
                        url: 'message.php',
                        type: 'POST',
                        data: 'text='+$value,
                        success: function($result){
                            $reply = 
                                "<div class='bot-inbox inbox'><div class='icon'><i class='fas fa-user-astronaut'></i></div><div class='msg-header'><p>" 
                                + $result + "</p></div></div>";
                            $(".form").append($reply);
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                        }
                    })
                    $("#data").val('');
        });
        //On press (13 == 'Return / Enter key')
        $("#data").on('keypress',function(e) {
                if(e.which == 13) {
                    $value = $("#data").val();
                    $msg = 
                        "<div class='user-inbox inbox'><div class='msg-header'><p>" 
                        + $value 
                        + "</p></div>" 
                        + "<div class='icon'><i class='fas fa-user'></i></div></div>";
                    $(".form").append($msg);
                    $("#data").val('');
                    /*
                    for testing = so far so good
                    alert($value);
                    console.log(); 
                    */
                    // Ajax starts here
                    $.ajax({
                        url: 'message.php',
                        type: 'POST',
                        data: 'text='+$value,
                        success: function($result){ 
                            $reply = 
                                "<div class='bot-inbox inbox'><div class='icon'><i class='fas fa-user-astronaut'></i></div><div class='msg-header'><p>" 
                                + $result + "</p></div></div>";
                            //console.log("Back from message",$reply);
                            //Add some delays
                            //sleep(2);
                            $(".form").append($reply);
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                        }
                    })
                    
                }
        });
    });
    </script>
</body>    
</html>