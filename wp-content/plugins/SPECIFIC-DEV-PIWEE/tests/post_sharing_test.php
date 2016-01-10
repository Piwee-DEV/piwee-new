<?php
/**
 * Created by PhpStorm.
 * User: alexandrenguyen
 * Date: 10/01/16
 * Time: 18:09
 */

require_once "../vendor/autoload.php";
require_once "../post_sharing/post_sharing.php";
require_once "../../../../wp-load.php";

const URL_TO_TEST = "http://piwee.net/1flat-d-pet-odeur-patch-slip-discret-deodorant101114/";
const POST_ID_TO_TEST = 14169;

class Post_Sharing_Test extends PHPUnit_Framework_TestCase
{

    public function testSocialShareLinkFacebookSuccess()
    {
        $count = social_share_shares('facebook', URL_TO_TEST);
        $this->assertInternalType("int", $count);
    }

    public function testSocialShareLinkGoogleSuccess()
    {
        $count = social_share_shares('google', URL_TO_TEST);
        $this->assertInternalType("int", $count);
    }

    public function testSocialShareLinkLinkedinSuccess()
    {
        $count = social_share_shares('linkedin', URL_TO_TEST);
        $this->assertInternalType("int", $count);
    }

    public function testSocialShareLinkPinterestSuccess()
    {
        $count = social_share_shares('pinterest', URL_TO_TEST);
        $this->assertInternalType("int", $count);
    }
}