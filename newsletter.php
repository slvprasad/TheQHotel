<?php
            //===============================================================================================================
            //						Code For Sending Newslatter Mail to Web Administrator
            //===============================================================================================================
            $date = date("j F, Y, g:i a");
            
            $ipaddress = $_SERVER["REMOTE_ADDR"];
            
            //$addr_details = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=".$ipaddress));
            //$city2 = stripslashes(ucfirst($addr_details[geoplugin_city]));
            //$countrycode2 = stripslashes(ucfirst($addr_details[geoplugin_countryCode]));
            //$country2 = stripslashes(ucfirst($addr_details[geoplugin_countryName]));
            
            
            $subject = " ";
            $to = " ";
            $body = " ";
            $headers = " ";
            
            $name = $_POST["name"];
            $email = $_POST["email"];
            
            $subject = "Newsletter Subscription -". $name;
            
            $Propertyname = "The Q Hotel";
            
            //Set Params
            $mailfrom = "";
            
            $to = "";
        
            $fromcolor = "";
            
            $body .= "<html>";
            $body .="<p>Dear Team,</p> </br> <p>We have received Newsletter Subscription Request.</p>";
            
            $body .= "<table border=0 cellspacing=0 cellpadding=0 style=\"border: 2px solid " . $fromcolor . "; font-family:Arial; font-size:12px;\" width=80%>";
            
            $body .= "<tr>";
            
            $body .= "<td width=40% colspan=3 align=center style=\"background:" . $fromcolor . "; padding-top:10px; padding-bottom: 0px; border-bottom: 1px solid " . $fromcolor . "; color:#fff;\">
            
            <h1> " . $Propertyname . "</h1></td>";
            
            $body .= "</tr>";
            
            $body .= "<tr>";
            
            $body .= "<td width=40% style=\"padding-top:2px; padding-bottom: 2px; padding-left: 12px; border-bottom: 1px solid " . $fromcolor . "; border-right: 1px solid #689e4a\">Name </td>";
            
            $body .= "<td colspan=2 align=bottom width=60%  style=\"padding-top:2px; padding-bottom: 2px; padding-left: 12px; border-bottom: 1px solid " . $fromcolor . ";\">" . $name . "&nbsp;</td>";
            
            $body .= "</tr>";
            
            $body .= "<tr>";
            
            $body .= "<td  style=\"padding-top:2px; padding-bottom: 2px; padding-left: 12px; border-bottom: 1px solid " . $fromcolor . "; border-right: 1px solid " . $fromcolor . "\">Email </td>";
            
            $body .= "<td colspan=2 align=bottom  style=\"padding-top:2px; padding-bottom: 2px; padding-left: 12px; border-bottom: 1px solid " . $fromcolor . ";\">" . $email . "&nbsp;</td>";
            
            $body .= "</tr>";
            
            
            $body .= "<tr>";
            
            $body .= "<td bgcolor=#f5f5f5 style=\"border-right:1px solid #ccc;\"> &nbsp;&nbsp;&nbsp; Client IP Address :</td>";
            
            $body .= "<td bgcolor=#f5f5f5>&nbsp;&nbsp;&nbsp;" . $ipaddress . "</td>";
            
            $body .= "</tr>";
            
            //echo $body;
            // die();
            
            
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["recaptcha_response2"]))
            {
            
                // Build POST request:
				$recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
            
				$recaptcha_secret = "";
            
				$recaptcha_response = $_POST["recaptcha_response2"];
            
                // Make and decode POST request:
				$recaptcha = file_get_contents($recaptcha_url . "?secret=" . $recaptcha_secret . "&response=" . $recaptcha_response);
            
				$recaptcha = json_decode($recaptcha);
            
                // Take action based on the score returned:
				if ($recaptcha->score >= 0.5)
                {
            
                    // Verified - send email
                    // To send HTML mail, the Content-type header must be set
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
                    // Additional headers
                    $headers .= "From: " . $name . "<" . $email . ">" . "\r\n";
            
                    mail($to, $subject, $body, $headers);
                    header("location:thank-you.html");
            
                }
                else
                {
                    // Not verified - show form error
                    echo "Robot verification failed, please try again.";
            
				}
            
            }
            ?>