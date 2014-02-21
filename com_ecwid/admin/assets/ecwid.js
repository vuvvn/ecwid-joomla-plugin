/**
 * @version   $Id: ecwid.js 6867 2013-01-28 23:08:31Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
window.addEvent('domready', function(){
	var rockettheme = $$('#rockettheme a');
	if (rockettheme.length && rockettheme[0]){
		rockettheme.addEvents({
			'mousedown': function() { this.removeClass('normal').removeClass('mouseup').addClass('mousedown'); },
			'mouseup': function() { this.removeClass('normal').removeClass('mousedown').addClass('mouseup'); },
			'mouseenter': function() { this.removeClass('normal').removeClass('mousedown').addClass('mouseup'); },
			'mouseleave': function() { this.removeClass('mousedown').removeClass('mouseup').addClass('normal'); }
		});
	}
});