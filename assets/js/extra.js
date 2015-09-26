//function popup() {
//	var mString = {};
//	mString.action = 'getContactForm';
//	$.get('', mString, function( data ){
//		$('#display').append( data );
//	});
//}

function contactUs(){
	$('#contactUs').modal();
}

function contactUsSpecific( year, vehicle ) {
	$('#subject').val('I am interested in the ' + year + ' ' + vehicle + ' please contact me.');
//	$('#contactUs').modal();
}

function showImage(image) {
	// 		alert('Test');
	// 		$('#modal_image').removeAttr('src');
	$('#modal_image').attr('src', image);
}

function getDisplay() {
	var mString = {};
	mString.action = 'display';
	// 		mString.pageID = id;
	$.get('', mString, function(data) {
		$('#display').html(data);
	});
}

function getPageById(id) {
	var mString = {};
	mString.action = 'viewpage';
	mString.pageID = id;
	$.get('', mString, function(data) {
		$('#display').html(data);
	});
}
