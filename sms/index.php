<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send SMS</title>
    <script>
        // JavaScript function to handle button click
        function sendMessage() {
            fetch("send_sms.php", {
                method: "POST",
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
            })
            .catch(error => {
                console.error("Error:", error);
            });
        }
    </script>
</head>
<body>
    <button onclick="sendMessage()">Send SMS</button>
</body>
</html>
