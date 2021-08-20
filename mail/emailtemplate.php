<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?= $title ?></title>
            <style type="text/css">
                body {font-family:Arial, Helvetica, sans-serif;color:#000;}
                h1 {font-size:18px}
                h2 {font-size:16px}
                p {font-size:14px, letter-spacing: 2px;}
                a {font-size:14px, letter-spacing: 2px;}
                small {font-size:12px}
                small a {font-size:12px}
            </style>

    </head>
    <body>
        <div>
            <?= $emailbody ?>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>Kind regards,</p>
            <p><i><b>The Guild of Mercers' Scholars</b></i></p>
            <p><img src="http://theguildofmercersscholars.com/images/logo.jpg" width="175"></p>
            <p>Web: <a href="<?= _URL ?>"><?= _URL ?></a></p>
            <p><small>If you no longer wish to receive any of these emails please do not reply by email - you can change your preferences by <a href="<?= _URL ?>signin">signing in</a> and using the option within your account.</small></p>

            <small>This e-mail and any files transmitted with it are confidential to the intended recipient and may be privileged. If you are not the intended recipient, please immediately notify clerk@theguildofmercersscholars.com. While we have used Anti-Virus software to alert us to the presence of computer viruses, we cannot guarantee that this email and any files transmitted with it are free from them.
            </small></p>

        </div>
    </body>
</html>

