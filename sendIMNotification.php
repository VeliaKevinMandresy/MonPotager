<?php

function login($username, $password)
{
    //login form action url
    $url = "https://demo.rocket.chat/home";
    $postinfo = "email=".$username."&password=".$password;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_NOBODY, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    //curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    //set the cookie the site has for certain features, this is optional
    curl_setopt($ch, CURLOPT_COOKIE, "cookiename=0");
    curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URL']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
    curl_exec($ch);
    
    // gestion error
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //var_dump(curl_setopt($ch, CURLOPT_URL, $url));

    //page with the content I want to grab
    curl_setopt($ch, CURLOPT_URL, $url);
    
    $html = curl_exec($ch);
    curl_close($ch);

    if ($http_status == 200)
        echo '[ '. $http_status .' ]' . " Vous avez reussi a vous connecter au site Rocket Chat\n";
    else
        echo $http_status . " Vous avez un probleme\n";
}

login("kevin.mandresy.velia", "Mandresy9");
?>