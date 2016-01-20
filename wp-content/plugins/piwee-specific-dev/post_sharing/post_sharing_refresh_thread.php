<?php

/**
 * Created by PhpStorm.
 * User: alexandrenguyen
 * Date: 12/01/16
 * Time: 22:00
 */

/**
 * Class Post_sharing_refresh_thread
 * DEPRECATED
 */
class Post_sharing_refresh_thread extends Thread
{

    private $post_id;

    public function run()
    {
        $count = 0;
        $networks = array("facebook", "linkedin", "google", "pinterest");
        $permalink = get_permalink($this->post_id);
        $month = date('m.Y');

        foreach ($networks as $network) {
            $count += social_share_shares($network, $permalink);
        }

        //Update in DB
        add_post_meta($this->post_id, 'total_share_count', $count, true)
        || update_post_meta($this->post_id, 'total_share_count', $count);

        //Store in DB by month
        add_post_meta($this->post_id, 'total_share_count_month_' . $month, $count, true)
        || update_post_meta($this->post_id, 'total_share_count_month_' . $month, $count);

        //A "month diff" for the current month share diff
        $oneMonthAgo = date("m.Y", strtotime("-1 months"));

        $countOneMonthAgo = get_post_meta($this->post_id, 'total_share_count_month_' . $oneMonthAgo, true);

        if ($countOneMonthAgo != null) {

            $diff = $count - $countOneMonthAgo;

            add_post_meta($this->post_id, 'share_count_month_diff_' . $month, $diff, true)
            || update_post_meta($this->post_id, 'share_count_month_diff_' . $month, $diff);
        }
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @param mixed $post_id
     */
    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }
}