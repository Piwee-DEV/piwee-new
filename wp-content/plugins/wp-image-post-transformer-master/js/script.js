
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
				parent.attr("href", get_site_url() + "?p=" + media_ID);
			}
		}
		
	}
