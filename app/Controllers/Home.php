<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session("magicLogin")) {

            return redirect()->to("set-password")
                             ->with("message", "Please update your password");
        }

        return view("Home/index");
        
    }

    private function sendTestEmail()
    {
        $email = \config\services::email();

        $email->setTo("rajuchanl1@miumg.edu.gt");

        $email->setSubject("Test Email");
        $email->setMessage("Hello from <i>Codeigniter</i> ");

        if ($email->send()) {
             
            echo "Email sent";

        } else {

             echo "Email not sent";

        }
    }
}
