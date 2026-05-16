<?php

                if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["recaptcha_response"])) {

                    $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
                    $recaptcha_secret = ""; // secret key
                    $recaptcha_response = $_POST["recaptcha_response"];
                    $recaptcha = file_get_contents($recaptcha_url . "?secret=" . $recaptcha_secret . "&response=" . $recaptcha_response);
                    $recaptcha = json_decode($recaptcha);

                    if ($recaptcha->score > 0.7) {
                        try {
                            
                            $subject = " ";
                            $to = " ";
                            $body = " ";

                    //TODO: apply below validations on HTML page also
                            $name				= substr(filter_var($_POST["name"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH), 0, 20);
                            $email				= filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
                            $phone				= substr(filter_var($_POST["phone"], FILTER_SANITIZE_NUMBER_INT),0,20);
                            $message			= substr( filter_var($_POST["message"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) ,0 , 200);    // only 80 characters allowd change as per need
                    // REFER : https://www.php.net/manual/en/filter.filters.sanitize.php  for more filtering parameters		
                    
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)  || !filter_var($phone, FILTER_VALIDATE_INT)) {
                                exit;
                            }

                            $to = "theqhotel.vizag@gmail.com";  // cleint email1

                            $subject = "Inquiry - Q " . $name; // hotel name
                            $Propertyname = "Q"; // hotel name

                            $fromcolor = "#818181"; // primery color

                            $body .= "<html>";

                            $body .= "<table  border=0 cellspacing=0 cellpadding=0 style='border: 2px solid " . $fromcolor . "; font-family:Arial; font-size:12px;' width=80%>";

                    $body .= "<tr>";

                            $body .= "<td width=40% colspan=3 align=center style='background:" . $fromcolor . "; padding-top:10px; padding-bottom: 0px; border-bottom: 1px solid " . $fromcolor . "; color:#fff;'>

                                <h1> " . $Propertyname . "</h1></td>";

                            $body .= "</tr>";

                            $body .= "<tr>";

                            $body .= "<td width=40% style='padding-top:2px; padding-bottom: 2px; padding-left: 12px; border-bottom: 1px solid " . $fromcolor . "; border-right: 1px solid #689e4a'>Name </td>";

                            $body .= "<td colspan=2 align=bottom width=60%  style='padding-top:2px; padding-bottom: 2px; padding-left: 12px; border-bottom: 1px solid " . $fromcolor . ";'>" . $name . "&nbsp;</td>";

                            $body .= "</tr>";

                            $body .= "<tr>";

                            $body .= "<td  style='padding-top:2px; padding-bottom: 2px; padding-left: 12px; border-bottom: 1px solid " . $fromcolor . "; border-right: 1px solid " . $fromcolor . "'>Email </td>";

                            $body .= "<td colspan=2 align=bottom  style='padding-top:2px; padding-bottom: 2px; padding-left: 12px; border-bottom: 1px solid " . $fromcolor . ";'>" . $email . "&nbsp;</td>";

                            $body .= "</tr>";

                    $body .= "<tr>";

                            $body .= "<td style='padding-top:2px; padding-bottom: 2px; padding-left: 12px; border-bottom: 1px solid " . $fromcolor . "; border-right: 1px solid " . $fromcolor . "'>Telephone </td>";

                            $body .= "<td colspan=2 align=bottom style='padding-top:2px; padding-bottom: 2px; padding-left: 12px; border-bottom: 1px solid " . $fromcolor . ";'>" . $phone . "&nbsp;</td>";

                            $body .= "<tr>";

                            $body .= "<td  style='padding-top:2px; padding-bottom: 2px; padding-left: 12px; border-bottom: 1px solid " . $fromcolor . "; border-right: 1px solid " . $fromcolor . "'>Message </td>";

                            $body .= "<td colspan=2 align=bottom style='padding-top:2px; padding-bottom: 2px; padding-left: 12px; border-bottom: 1px solid " . $fromcolor . ";'>" . $message . "&nbsp;</td>";

                            $body .= "</tr>";

                    $body .= "</tr>";

                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
                            // Additional headers
                            $headers .= "From: " . $name . "<" . $to . ">" . "\r\n";

                            mail($to, $subject, $body, $headers);
                            header("location:thank-you.html");

                        } catch (Exception $e) {
                            error_log($e->getMessage());
                        }
                    }
                }

                ?>