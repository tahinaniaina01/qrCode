<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>
    <form action="<?php echo base_url('index.php/SendMail/sendMail')?>" method="post">
    <label for="mail"> Receiver Email</label>
    <input type="text" name="mailTo">
    <label for="">Your subject</label>
    <input type="text" name="subject">
    <label for="">Message</label>
    <textarea name="message" cols="30" rows="10"></textarea>
    <label for="">piece joint</label>
    <input type="file" name="salu">
    <button type="submit" >Submit</button>
    </form>
</body>
</html>