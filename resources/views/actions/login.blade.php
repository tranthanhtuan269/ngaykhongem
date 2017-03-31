<?php
require_once __DIR__ . '/Facebook/autoload.php';

session_start();
$fb = new Facebook\Facebook([
  'app_id' => '317838401932364', // Replace {app-id} with your app id
  'app_secret' => '2301dd0b517e64b0d340298b5ef300a1',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://chodatso.com/fb-callback', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';