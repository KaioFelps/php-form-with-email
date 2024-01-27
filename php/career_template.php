<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
$img_path = $protocol.$_SERVER["HTTP_HOST"]."/img/logo.png";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Career proposal from <?php echo $name; ?></title>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=1">
        <style>
            * {
                box-sizing: border-box;
            }

            .content-div p {
                margin: 4px 0 4px 0;
                padding: 12px 16px;
                border-radius: 24px;
                background: #eeeeee;
                color: #2a2a2a;
                font-weight: normal;
            }

            .content-div p span {
                font-weight: bold;
                color: black;
            }

            td { word-break: break-word; }
        </style>
    </head>
    <body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" background="#F9F9F9" style="margin:0;padding:0;font-family:'Helvetica Neue',Helvetica,Helvetica,Arial,sans-serif;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;height:100%;width:100%!important;background-color:#f9f9f9">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
            <td>
                <table align="center" border="0" width="100%" style="max-width:600px;" cellspacing="0" cellpadding="0">
                    <!-- HEADER -->
                    <tr>
                        <td bgcolor="#1e1e1e" align="center" style="padding: 40px;">
                            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                <tr><td align="center"><img src="<?php echo $img_path; ?>" alt="Trust Corp Logo"></td></tr>
                                <tr><td style="padding:24px 0;"><hr style="border:none;background-color:#cccccc;height:1px;"></td></tr>
                                <tr><td align="center" style="color: white; font-size: 1.5rem;">New career proposal email from <?php echo $name; ?></td></tr>
                            </table>
                        </td>
                    </tr>
                    <!-- BODY -->
                    <tr>
                        <td>
                           <table border="1" bgcolor="#fefefe" width="100%" style="padding:24px;border-color:#1e1e1e;" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="border: none;">
                                    <div class="content-div">
                                        <p><span>Name: </span><?php echo $name; ?></p>
                                        <p><span>Email: </span><?php echo $email; ?></p>
                                        <p><span>Content: </span><?php echo $content; ?></p>
                                    </div>
                                </td>
                            </tr>
                           </table>
                        </td>
                    </tr>
                </table>
            </td>
            </tr>
        </table>
    </body>
</html>