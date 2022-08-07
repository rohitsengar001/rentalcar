<?php

namespace rentalcar\modules\common;
interface utilty
{

    /**
     * @param $data
     * @return void
     */
    public function alert_message($data): void;


    /**
     * @param $msg
     * @return void
     */
    public function msg_console($msg): void;

    /**
     * ## url:'http://localhost/rentalcar/modules/agency/agency-component.php';
     * @param $url
     * @return void
     */
    public function redirect_url($url):void;

}

class common_utility implements utilty
{
    /**
     * @param $data
     * @return void
     */
    public function alert_message($data): void
    {
        if (!$data->success) {
            echo '
        <script>
            let alertDiv = document.getElementById("alert-div");
            let child_alert_div=`<strong>"' . $data->message . '"</strong> You should check in on some of those fields below.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeAlertDiv()">
                                        <span aria-hidden="true">&times;</span>
                                         </button>`;
                    alertDiv.innerHTML=child_alert_div;
                    alertDiv.style.display = "block";
           
        </script>
        ';

        }
        echo "<script>
            setTimeout(()=>{
                window.location = 'http://localhost/rentalcar/modules/agency/agency-component.php';
             },5000)
            </script>";
    }

    /**
     * @param $msg
     * @return void
     */
    public function msg_console($msg): void
    {
        echo "<script>console.log('.$msg.')</script>";
    }

    public function redirect_url($url):void
    {
        echo "<script>
            setTimeout(()=>{
                window.location = '{$url}';
             },1000)
            </script>";
    }
}