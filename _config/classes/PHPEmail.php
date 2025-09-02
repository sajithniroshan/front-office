<?php

require 'PHPMailer/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PHPEmail {

    public static function sendEmail($to,$nameto,$subject,$message,$altmess)  {

          $template = '<div style="style="font-family: Arial, sans-serif""><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center" style="padding: 20px;">
                    <table class="content" width="600" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse; border: 1px solid #cccccc;">

                        <!-- Body -->
                        <tr>
                            <td class="body" style="padding: 20px; text-align: left; font-size: 16px; line-height: 1.6;">
                              <center>
                                <img src="https://www.sinlix.lk/assets/img/logo.png" style="width:100%; max-width: 300px;" />
                              <center>
                              <hr style="border: 1px solid #cccccc; margin-bottom: 20px;">

                              '.$message.'
                                          
                            </td>
                        </tr>
                        <!-- Footer -->
                        <tr>
                            <td class="footer" style="background-color: #cccccc;padding: 20px; text-align: center; color: #000000; font-size: 14px; border: 1px solid #cccccc; letter-spacing: 0.5px;">
                            Copyright &copy; 2025 | Tripupdater.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table></div>';


          $from  = "noreply@sinlix.lk"; 
          $namefrom = "Sinlix";
          $mail = new PHPMailer();
          $mail->SMTPDebug = 0;
          $mail->CharSet = 'UTF-8';
          $mail->isSMTP();
          $mail->SMTPAuth   = true;
          
          $mail->Host   = "server293.web-hosting.com";
          $mail->Port       = 465;
          
          $mail->Username   = $from;
          $mail->Password   = "dWSX%!#!!tM3";
          $mail->SMTPSecure = "ssl";
          $mail->setFrom($from,$namefrom);
          $mail->Subject  = $subject;
          $mail->isHTML();
          $mail->Body = $template;
          $mail->AltBody  = $altmess;
          $mail->addAddress($to, $nameto);
          return $mail->send();
        } // sendEmail()

}