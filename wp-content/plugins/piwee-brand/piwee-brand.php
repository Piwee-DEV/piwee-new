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
add_action("category_add_form_fields", "category_add_brand");
add_action('category_edit_form_fields', 'category_add_brand');
add_action('edit_category', 'save_extra_taxonomy_fields');

function register_brand_page()
{
    add_menu_page('PIWEE Brand', 'PIWEE Brand', 'manage_options', 'brand_page', 'brand_page', plugins_url('images/logo-piwee.jpg', __FILE__), null);
}

function category_add_brand($tag)
{

    $piwee_brand = get_brand_for_category($tag->term_id);
    $piwee_brand_list = get_piwee_brands();

    ?>

    <div class="form-field">
        <label for="term_meta[cat_icon]">Marque</label>
        <select id="piwee_brand" name="brandSlug">
            <option value="-1">Aucune marque</option>
            <?php foreach ($piwee_brand_list as $brand): ?>
                <option
                    value="<?php echo $brand['brandSlug'] ?>" <?php if ($piwee_brand['brandSlug'] == $brand['brandSlug']) {
                    echo 'selected';
                } ?>><?php echo $brand['brandName'] ?></option>
            <?php endforeach; ?>
        </select>
        <p class="description">Marque sponsorisant la catégorie</p>
    </div>

    <?php
}

function encode_brand_wp_option_to_json($brandName, $brandDescription, $brandUrl, $brandLogo, $brandSlug, $brandHeaderImage, $brandSidebar)
{
    $brandArray = array('brandName' => $brandName,
        'brandDescription' => $brandDescription,
        'brandUrl' => $brandUrl,
        'brandLogo' => $brandLogo,
        'brandSlug' => $brandSlug,
        'brandHeaderImage' => $brandHeaderImage,
        'brandSidebar' => $brandSidebar);
    return json_encode($brandArray);
}

function get_piwee_brands()
{
    global $wpdb;
    $options = $wpdb->get_results("SELECT * FROM {$wpdb->options} WHERE option_name LIKE '" . WPOPTION_NAME_BRAND . "_%'");

    $brands = array();

    foreach ($options as $option) {
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

function delete_brand($brandSlug)
{
    delete_brand_slug_for_post($brandSlug);
    delete_brand_slug_for_category($brandSlug);
    delete_option(WPOPTION_NAME_BRAND . '_' . $brandSlug);
}

function get_brand_for_post($postId)
{
    $brandSlug = get_post_meta($postId, WPPOSTMETA_SLUG_BRAND, true);

    if (!$brandSlug) {
        return null;
    }

    return get_piwee_brand_by_slug($brandSlug);
}


function get_brand_for_category($tagId)
{
    $brandSlug = get_term_meta($tagId, WPPOSTMETA_SLUG_BRAND, true);

    if (!$brandSlug) {
        return null;
    }

    return get_piwee_brand_by_slug($brandSlug);
}

function delete_brand_slug_for_post($brandSlug, $postId = null)
{
    delete_metadata('post', $postId, WPPOSTMETA_SLUG_BRAND, $brandSlug, true);
}

function delete_brand_slug_for_category($brandSlug, $categoryId = null)
{
    delete_metadata('term', $categoryId, WPPOSTMETA_SLUG_BRAND, $brandSlug, true);
}

function brand_page()
{

    if (isset($_GET)) {

        if (isset($_GET['brandSlug'])) {

            $editBrand = get_piwee_brand_by_slug($_GET['brandSlug']);
        }
    }

    if (isset($_POST)) {

        if ($_POST['action'] == 'add_or_update_brand') {

            $brandName = $_POST['brandName'];
            $brandDescription = $_POST['brandDescription'];
            $brandUrl = $_POST['brandUrl'];
            $brandLogo = $_POST['brandLogo'];
            $brandHeaderImage = $_POST['brandHeaderImage'];
            $brandSidebar = $_POST['brandSidebar'];
            $brandSlug = sanitize_title($brandName);

            $wp_option_value = encode_brand_wp_option_to_json($brandName, $brandDescription, $brandUrl, $brandLogo, $brandSlug, $brandHeaderImage, $brandSidebar);

            if (!get_option(WPOPTION_NAME_BRAND . '_' . $brandSlug)) {
                add_option(WPOPTION_NAME_BRAND . '_' . $brandSlug, $wp_option_value);
            } else {
                update_option(WPOPTION_NAME_BRAND . '_' . $brandSlug, $wp_option_value);
            }

            $editBrand = get_piwee_brand_by_slug($_GET['brandSlug']);

        } else if ($_POST['action'] == 'delete_brand') {
            delete_brand($_POST['brandSlug']);
        }

    }

    $allBrands = get_piwee_brands();

    ?>

    <div>
        <?php if (!isset($editBrand)): ?>
            <h1>Ajouter une marque</h1>
        <?php endif; ?>

        <?php if (isset($editBrand)): ?>
            <h1>Editer la marque <?php echo stripslashes($editBrand['brandName']) ?></h1>
        <?php endif; ?>

        <form action="#" method="POST">
            <input type="text" name="brandName" placeholder="Nom de la marque" <?php if (isset($editBrand)) {
                echo 'value="' . stripslashes($editBrand['brandName']) . '"';
            } ?> required>
            <br>
            <input type="text" name="brandUrl" placeholder="URL de la marque" <?php if (isset($editBrand)) {
                echo 'value="' . stripslashes($editBrand['brandUrl']) . '"';
            } ?> required>
            <br>
            <textarea name="brandDescription" placeholder="Description de la marque" rows="10" cols="50"
                      required><?php if (isset($editBrand)) {
                    echo stripslashes($editBrand['brandDescription']);
                } ?></textarea>
            <br>
            <div class="uploader">
                <input class="button" name="_wpse_82857_button" id="_wpse_82857_button" value="Logo de la marque"/>
                <input type="text" name="brandLogo" id="_wpse_82857" <?php if (isset($editBrand)) {
                    echo 'value="' . $editBrand['brandLogo'] . '"';
                } ?> required/>
            </div>
            <div class="uploader">
                <input class="button" name="_wpse_82858_button" id="_wpse_82858_button" value="Image sous header"/>
                <input type="text" name="brandHeaderImage" id="_wpse_82858" <?php if (isset($editBrand)) {
                    echo 'value="' . $editBrand['brandHeaderImage'] . '"';
                } ?>/>
            </div>
            <br>
            <?php if (class_exists('CustomSidebars')): ?>
                <label>Sidebar</label>
                <div>
                    <select name="brandSidebar">
                        <option value="-1">Aucune</option>
                        <?php foreach (CustomSidebars::get_custom_sidebars() as $sidebar): ?>
                            <option
                                value="<?php echo $sidebar['id'] ?>" <?php if ($editBrand['brandSidebar'] == $sidebar['id']) {
                                echo 'selected';
                            } ?>><?php echo $sidebar['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
            <input type="hidden" name="action" value="add_or_update_brand">
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

            <?php foreach ($allBrands as $brand): ?>
                <tr>
                    <td><?php echo $brand['brandName'] ?></td>
                    <td><?php echo $brand['brandDescription'] ?></td>
                    <td><?php echo $brand['brandSlug'] ?></td>
                    <td><img src="<?php echo $brand['brandLogo'] ?>" style="max-width: 100px;"></td>
                    <td>
                        <a href="?brandSlug=<?php echo $brand['brandSlug'] ?>&page=brand_page" class="button">EDIT</a>
                        <form action="#" method="POST">
                            <input type="hidden" name="brandSlug" value="<?php echo $brand['brandSlug'] ?>">
                            <input type="hidden" name="action" value="delete_brand">
                            <input type="submit"
                                   class="button"
                                   onclick="return confirm('ATTENTION : TOUS VOS ARTICLES SERONT DESASSIGNES DE CETTE MARQUE ! CONTINUER ?')"
                                   value="DELETE">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>

    <?php
}

function get_brand_for_post_or_category($post_id)
{
    $brand = get_brand_for_post($post_id);

    if (!$brand) {

        $category = get_the_category($post_id);

        $parent_categories = get_category_parents_ids($category[0]->term_id);

        foreach ($parent_categories as $parent_category) {

            $brand = get_brand_for_category($parent_category->term_id);

            if (isset($brand)) {
                break;
            }
        }
    }

    return $brand;
}

function get_category_parents_ids($id, $visited = array())
{
    $parents = array();
    $parent = get_term($id, 'category');

    if (is_wp_error($parent))
        return $parent;

    $parents[] = $parent;

    if ($parent->parent && ($parent->parent != $parent->term_id) && !in_array($parent->parent, $visited)) {
        $visited[] = $parent->parent;
        $parents = array_merge($parents, get_category_parents_ids($parent->parent));
    }

    return $parents;
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
            <?php foreach ($piwee_brand_list as $brand): ?>
                <option
                    value="<?php echo $brand['brandSlug'] ?>" <?php if ($piwee_brand['brandSlug'] == $brand['brandSlug']) {
                    echo 'selected';
                } ?>><?php echo $brand['brandName'] ?></option>
            <?php endforeach; ?>
        </select>
    </p>

    <?php
}

function add_piwee_brand_metabox()
{
    add_meta_box("piwee-brand-meta-box", "PIWEE Brand", "add_piwee_brand_metabox_markup", "post", "side", "high", null);
}

function validate_form_piwee_brand()
{
    $brandSlug = $_POST['brandSlug'];

    if ($brandSlug == -1) {
        delete_brand_slug_for_post(WPPOSTMETA_SLUG_BRAND, get_the_ID());
    } else {
        add_post_meta(get_the_ID(), WPPOSTMETA_SLUG_BRAND, $brandSlug, true)
        || update_post_meta(get_the_ID(), WPPOSTMETA_SLUG_BRAND, $brandSlug);
    }
}

function save_extra_taxonomy_fields($term_id)
{

    $brandSlug = $_POST['brandSlug'];

    if ($brandSlug == -1) {
        delete_brand_slug_for_category(WPPOSTMETA_SLUG_BRAND, $term_id);
    } else {
        add_term_meta($term_id, WPPOSTMETA_SLUG_BRAND, $brandSlug, true)
        || update_term_meta($term_id, WPPOSTMETA_SLUG_BRAND, $brandSlug);
    }
}