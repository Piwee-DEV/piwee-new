
jQuery(document).ready(function() {

	if (is_single()) {

		var images = getAllImagesFromPost();

		images.forEach(function(image) {
			assignLink(image);
		});

	}

});


function getAllImagesFromPost() {

	var images = [];

	jQuery(".post").find("img").each(function(i) {
		images.push(jQuery(this));
	});

	return images;
}

function assignLink(image) {

	var classes = image.attr("class");

	if(classes) {
		//getting media ID
		var imageClasses = image.attr("class").split(' ');
		var media_ID;
		imageClasses.forEach(function(iClass) {
			if(iClass.indexOf("wp-image-") > -1) {
				var pieces = iClass.split('-');
				media_ID = pieces[pieces.length - 1];
			}
		});

		if (media_ID) {
			var parent = image.parent();

			var previousUrl = parent.attr("href");

			if(!previousUrl || previousUrl.indexOf("piwee.net") > -1) {

				var url = get_site_url() + "?p=" + media_ID;

				var imageSrc = image.attr('src');

				var imageHtml = '<div style="position:relative;margin:0;padding:0;">';
				imageHtml += '<a href="' + url + '">' + image[0].outerHTML + '</a>';
				imageHtml += '<div id="media-share-' + media_ID + '" class="media-share-image" style="margin:0;padding:0;position:absolute;bottom:10px;right:10px;display:none;"><div class="fb-like" data-href="' + url + '" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> <a href="//fr.pinterest.com/pin/create/button/?url=' + encodeURIComponent(url) + '&media=' + encodeURIComponent(imageSrc) + '" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" style="margin-top:-4px;" /></a></div>';
				imageHtml += '</div>';
				parent.append(imageHtml);

				jQuery('#media-share-' + media_ID).mouseover(function() {
					jQuery('#media-share-' + media_ID).show();
				});

				jQuery('.wp-image-' + media_ID).mouseover(function() {
					jQuery('#media-share-' + media_ID).show();
				});

				jQuery('.wp-image-' + media_ID).mouseout(function() {
					jQuery('#media-share-' + media_ID).hide();
				});

				var cnt = parent.contents();
				parent.replaceWith(cnt);

				image.remove();

			}
		}
	}

}
