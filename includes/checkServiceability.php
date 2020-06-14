<?php
require("../includes/connect.php");
require('../includes/delhivery_config.php');

if(isset($_POST['checkPincode']))
{
    if($_POST['pincode']==NULL)
    {
        echo "Enter a Pin-Code.";
    }
    else
    {
        $url= 'https://track.delhivery.com/c/api/pin-codes/json/?token='.$api_key_token.'&filter_codes='.$_POST['pincode'];
        $output = json_decode(file_get_contents($url),true);
        if($output['delivery_codes']==NULL)
        {
            echo "Sorry! We do not provide service in this area.";
        }
        else
        {
            if($output['delivery_codes'][0]['postal_code']!=NULL && $output['delivery_codes'][0]['postal_code']['pre_paid']=="Y")
            {
                echo "Service Available!";
            }
            else
            {
                echo "Sorry! We do not provide service in this area.";
            }
        }
    }
}


if(isset($_POST['checkPincodeforReturn']))
{
    if($_POST['pincode']==NULL)
    {
        echo "Enter a Pin-Code.";
    }
    else
    {
        $url= 'https://track.delhivery.com/c/api/pin-codes/json/?token='.$api_key_token.'&filter_codes='.$_POST['pincode'];
        $output = json_decode(file_get_contents($url),true);
        if($output['delivery_codes']==NULL)
        {
            echo "Sorry! We do not provide pickup service in this area.";
        }
        else
        {
            if($output['delivery_codes'][0]['postal_code']!=NULL && $output['delivery_codes'][0]['postal_code']['pickup']=="Y")
            {
                echo "Return pickup service available!";
            }
            else
            {
                echo "Sorry! We do not provide pickup service in this area.";
            }
        }
    }
}
?>