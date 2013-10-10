jQuery(document).ready(function() {
	jQuery('.ecwid-pb-view-size, .ecwid-pb-view-size *').click(function() {
		jQuery('.ecwid-pb-view-size').removeClass('active');
		jQuery(this).closest('.ecwid-pb-view-size').addClass('active');
	});
});


