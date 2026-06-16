<?php

    function prx($arr)
    {
        echo "<pre>";print_r($arr);die();
    }

    function createAgoraProject($name)
    {
        // Customer ID
        $customerKey = env('customerKey');
        
        // Customer secret
        $customerSecret = env('customerSecret');
        
        // Concatenate customer key and customer secret
        $credentials = $customerKey . ":" . $customerSecret;

        // Encode with base64
        $base64Credentials = base64_encode($credentials);
        
        // Create authorization header
        $arr_header = "Authorization: Basic " . $base64Credentials;

        $curl = curl_init();


        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.agora.io/dev/v1/project',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"name": "' . $name . '",
        "enable_sign_key": true
        }',
        CURLOPT_HTTPHEADER => array(
            $arr_header,
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // prx($response);
        $result = json_decode($response);
        // prx($result);
        return $result;
    }

    function createToken($appId, $appCertificate, $channelName)
    {
        $curl = curl_init();

        $base_url = URL::to('/');

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mehandrucompany.com/agoraToken/sample/RtcTokenBuilderSample.php',
            /* CURLOPT_URL => $base_url.'/agoraToken/sample/RtcTokenBuilderSample.php', */
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('appId' => $appId, 'appCertificate' => $appCertificate, 'channelName' => $channelName),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    function generateRandomString($length = 7)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for($i = 0; $i < $length; $i++) 
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    function calculate_cart_total_amount()
    {
        $total_amount = 0;

        foreach (session('cart', []) as $product_id => $cartItem) 
        {
            $fetch_product_details 	= DB::table('products')
                                    ->where('id','=',$product_id)
                                    ->first();

            $total_amount += $cartItem['quantity'] * $fetch_product_details->amount;
        }

        $gst = $total_amount * 0.18;

        $final_amount = $total_amount + $gst;

        return $final_amount;
    }

    function calculate_total_amount_for_checkout()
    {
        $total_amount = 0;

        foreach (session('cart', []) as $product_id => $cartItem) 
        {
            $fetch_product_details 	= DB::table('products')
                                    ->where('id','=',$product_id)
                                    ->first();

            $total_amount += $cartItem['quantity'] * $fetch_product_details->amount;
        }

        return $total_amount;
    }
    
    function curl_get_file_contents($URL)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);
    
        if ($contents) return $contents;
        else return FALSE;
    }