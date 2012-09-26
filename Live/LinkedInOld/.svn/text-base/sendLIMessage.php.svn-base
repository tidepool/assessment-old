<html>
<head>
    <title>Message Sending App Example</title>

    <script type="text/javascript" src="https://platform.linkedin.com/in.js">
        api_key: bwgphvx02ln2
        authorize: true
    </script>
    <meta https-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link media="all" type="text/css" href="../css/jqueryui/jqueryui.css" rel="stylesheet"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.5b1.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js"></script>

    <script type="text/javascript">
        var userInfo = []
        $(function() {
            $( "#dialog-form" ).dialog({
                autoOpen: false,
                height: 250,
                width: 350,
                modal: true,
                buttons: {
                    "Send a Message": function() {
                        SendMessage();
                        $( this ).dialog( "close" );
                    },
                    Cancel: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        });

        function loadData() {
            IN.API.Connections("me")
                .fields(["pictureUrl","publicProfileUrl","id", "firstName","lastName"])
                .params({"count":50})
                .result(function(result) {
                    profHTML = "";
                    for (var index in result.values) {
                        profile = result.values[index]
                        if (profile.pictureUrl) {
                            id = profile.id + ":" + profile.firstName + " " + profile.lastName
                            profHTML += "<img id=\"" + id + "\" class=img border height=30 align=\"left\" src=\"" + profile.pictureUrl + "\">";
                        }
                    }
                    $("#connections").html(profHTML);
                    $("img").click(function() {
                        userInfo = this.id.split(":")
                        $("#userName").html(userInfo[1]);
                        $( "#dialog-form" ).dialog( "open" );
                    } );
                });

        }

        function SendMessage() {
            var message = document.getElementById('message').value;

            var BODY = {
                "recipients": {
                    "values": [{
                        "person": {
                            "_path": "/people/IhzrdxF8cp",
                        }
                    }]
                },
                "subject": "Message from Message Sender",
                "body": message
            }
            IN.API.Raw("/people/~/mailbox")
                .method("POST")
                .body(JSON.stringify(BODY))
                .result(function(result) {alert ("Message sent") })
                .error(function error(e) { alert ("No dice") });
        }
    </script>
</head>
<body class="yui3-skin-sam	yui-skin-sam">
<div id="dialog-form" title="Send message">

    <form>
        <fieldset>
            <label for="name">Send a message to <span id=userName></span><br /></label>

            <input type="text" name="message" id="message" value="Howdy partner" class="text ui-widget-content ui-corner-all" />
            <button onclick="javascript:SendMessage();">Send</button>
        </fieldset>
    </form>
</div>

<div id="connections">
</div>
<script type="IN/Login" data-onAuth="loadData"></script>
</body>
</html>