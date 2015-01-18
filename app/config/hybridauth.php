<?php

return array(
     'base_url'  => URL::route('hybridauth', array('process' => true)),
    "providers" => array(
        "Google" => array(
            "enabled" => true,
            "keys" => array("id" => "482953531374-qofnf1emssg85o604rvf83vblspov252.apps.googleusercontent.com", "secret" => "ySpmIX9GYirof4G7Tu3LotDP"),
            "scope" => "https://www.googleapis.com/auth/userinfo.profile " . "https://www.googleapis.com/auth/userinfo.email"
        ),
        "Facebook" => array(
            "enabled" => true,
            "keys" => array("id" => "406838482800578", "secret" => "09057cb8fc9ac531146540cd5b79ea6b"),
            'scope' => ['publish_actions', 'email', 'user_location']
        ),
        "Twitter" => array(
            "enabled" => true,
            "keys" => array("key" => "ID", "secret" => "SECRET")
        )
    ),
);
