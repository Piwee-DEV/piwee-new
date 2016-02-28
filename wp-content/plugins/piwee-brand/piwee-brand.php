<?php
/*
Plugin Name: PIWEE Brand
Plugin URI: http://alexandrenguyen.fr
Description: Brand module for PIWEE
Version: 1.0
Author: Alexandre Nguyen
Author URI: http://alexandrenguyen.fr
License: Copyright 2016  Alexandre Nguyen  (email : alex.nr@hotmail.co.jp)

        This program is free software; you can redistribute it and/or modify
        it under the terms of the GNU General Public License, version 2, as
        published by the Free Software Foundation.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with this program; if not, write to the Free Software
        Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('admin_menu', 'register_brand_page');

define("WPOPTION_NAME_BRAND", "piwee_brand");
define("WPPOSTMETA_SLUG_BRAND", "piwee_brand_slug");

add_action("add_meta_boxes", "add_piwee_brand_metabox");
add_action("save_post", "validate_form_piwee_brand");

function register_brand_page()
{
    add_menu_page('PIWEE Brand', 'PIWEE Brand', 'manage_options', 'brand_page', 'brand_page', plugins_url('images/logo-piwee.jpg', __FILE__), null);
}

function encode_brand_wp_option_to_json($brandName, $brandDescription, $brandUrl, $brandLogo, $brandSlug)
{
    $brandArray = array('brandName' => $brandName,
        'brandDescription' => $brandDescription,
        'brandUrl' => $brandUrl,
        'brandLogo' => $brandLogo,
        'brandSlug' => $brandSlug);
    return json_encode($brandArray);
}

function get_piwee_brands()
{
    global $wpdb;
    $options = $wpdb->get_results("SELECT * FROM {$wpdb->options} WHERE option_name LIKE '" . WPOPTION_NAME_BRAND . "_%'");

    $brands = array();

    foreach($options as $option) {
        $brands[] = json_decode($option->option_value, true);
    }

    return $brands;
}

function get_piwee_brand_by_slug($slug)
{
    $brand = get_option(WPOPTION_NAME_BRAND . '_' . $slug);

    return json_decode($brand, true);
}

function add_brand_postmeta($postId, $brandSlug)
{
    $brand = get_piwee_brand_by_slug($brandSlug);

    add_post_meta($postId, WPPOSTMETA_SLUG_BRAND, $brand['brandSlug'], true)
    || update_post_meta($postId, WPPOSTMETA_SLUG_BRAND, $brand['brandSlug']);
}

function delete_brand($brandSlug) {

    delete_brand_slug_for_post($brandSlug);
    delete_option(WPOPTION_NAME_BRAND . '_' . $brandSlug);
}

function get_brand_for_post($postId) {

    $brandSlug = get_post_meta($postId, WPPOSTMETA_SLUG_BRAND, true);

    if(!$brandSlug) {
        return null;
    }

    return get_piwee_brand_by_slug($brandSlug);
}

function delete_brand_slug_for_post($brandSlug, $postId = null) {

    delete_metadata('post', $postId, WPPOSTMETA_SLUG_BRAND, $brandSlug, true);
}

function brand_page()
{

    if ($_POST) {

        if ($_POST['action'] == 'add_brand') {

            $brandName = $_POST['brandName'];
            $brandDescription = $_POST['brandDescription'];
            $brandUrl = $_POST['brandUrl'];
            $brandLogo = $_POST['brandLogo'];
            $brandSlug = sanitize_title($brandName);

            $wp_option_value = encode_brand_wp_option_to_json($brandName, $brandDescription, $brandUrl, $brandLogo, $brandSlug);

            add_option(WPOPTION_NAME_BRAND . '_' . $brandSlug, $wp_option_value) || update_option(WPOPTION_NAME_BRAND . '_' . $brandSlug, $wp_option_value);
        }

        else if($_POST['action'] == 'delete_brand') {

            delete_brand($_POST['brandSlug']);
        }

    }

    $allBrands = get_piwee_brands();

    ?>

    <div>
        <h1>Ajouter une marque</h1>

        <form action="#" method="POST">
            <input type="text" name="brandName" placeholder="Nom de la marque" required>
            <br>
            <input type="text" name="brandUrl" placeholder="URL de la marque" required>
            <br>
            <textarea name="brandDescription" placeholder="Description de la marque" rows="10" cols="50" required></textarea>
            <br>
            <div class="uploader">
                <input class="button" name="_wpse_82857_button" id="_wpse_82857_button" value="Logo de la marque"/>
                <input type="text" name="brandLogo" id="_wpse_82857" required/>
            </div>
            <input type="hidden" name="action" value="add_brand">
            <br><br>
            <input type="submit" class="button-primary">
        </form>
    </div>

    <script>
        jQuery(document).ready(function ($) {
            var _custom_media = true,
                _orig_send_attachment = wp.media.editor.send.attachment;

            // ADJUST THIS to match the correct button
            $('.uploader .button').click(function (e) {
                var send_attachment_bkp = wp.media.editor.send.attachment;
                var button = $(this);
                var id = button.attr('id').replace('_button', '');
                _custom_media = true;
                wp.media.editor.send.attachment = function (props, attachment) {
                    if (_custom_media) {
                        $("#" + id).val(attachment.url);
                    } else {
                        return _orig_send_attachment.apply(this, [props, attachment]);
                    }
                    ;
                }

                wp.media.editor.open(button);
                return false;
            });

            $('.add_media').on('click', function () {
                _custom_media = false;
            });
        });
    </script>


    <div class="table" style="margin-top: 50px;">

        <table>
            <tr>
                <td>NAME</td>
                <td>DESCRIPTION</td>
                <td>SLUG</td>
                <td>LOGO</td>
                <td>X</td>
            </tr>

            <?php foreach($allBrands as $brand): ?>
            <tr>
                <td><?php echo $brand['brandName'] ?></td>
                <td><?php echo $brand['brandDescription'] ?></td>
                <td><?php echo $brand['brandSlug'] ?></td>
                <td><img src="<?php echo $brand['brandLogo'] ?>" style="max-width: 100px;"></td>
                <td>
                    <form action="#" method="POST">
                        <input type="hidden" name="brandSlug" value="<?php echo $brand['brandSlug'] ?>">
                        <input type="hidden" name="action" value="delete_brand">
                        <input type="submit" onclick="return confirm('ATTENTION : TOUS VOS ARTICLES SERONT DESASSIGNES DE CETTE MARQUE ! CONTINUER ?')" value="DELETE">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

    </div>

    <?php
}

function add_piwee_brand_metabox_markup()
{
    $piwee_brand = get_brand_for_post(get_the_ID());
    $piwee_brand_list = get_piwee_brands();

    ?>

    <p>
        <label for="piwee_brand">Choisir une marque</label>
        <select id="piwee_brand" name="brandSlug">
            <option value="-1">Aucune marque</option>
            <?php foreach($piwee_brand_list as $brand): ?>
                <option value="<?php echo $brand['brandSlug'] ?>" <?php if($piwee_brand['brandSlug'] == $brand['brandSlug']) {echo 'selected';} ?>><?php echo $brand['brandName'] ?></option>
            <?php endforeach; ?>
        </select>
    </p>

    <?php
}

function add_piwee_brand_metabox()
{
    add_meta_box("piwee-adsense-meta-box", "PIWEE Brand", "add_piwee_brand_metabox_markup", "post", "side", "high", null);
}

function validate_form_piwee_brand()
{
    $brandSlug = $_POST['brandSlug'];

    if($brandSlug == -1) {
        delete_brand_slug_for_post(WPPOSTMETA_SLUG_BRAND, get_the_ID());
    }
    else {
        add_post_meta(get_the_ID(), WPPOSTMETA_SLUG_BRAND, $brandSlug, true)
        || update_post_meta(get_the_ID(), WPPOSTMETA_SLUG_BRAND, $brandSlug);
    }
}