/* -- Important Signatures & Notes --
*
*	.on( events [, selector] [, data], handler(eventObject) )
*	.trigger( eventType [, extraParameters] )
*
*/
var contxt = {};
	contxt.current = "#organization",
	contxt.appIteration = 0;


function getOption($this){
	
		contxt.choices		= ['organization', 'country', 'branch']; //Return this option list from the server
		contxt.realm		= $this;
		contxt.target 		= contxt.realm.text();
		contxt.selected 	= contxt.target;
		contxt.type 		= $(contxt.realm.parent().parent().parent().parent()).data('type'); //organization, coutnry, branch, ect..
		contxt.current 		= $('#' + $('.jqTransformSelectWrapper ul li a.selected', '#' + contxt.type).parent().parent().parent().parent().attr('id'));
		contxt.nextI 		= contxt.choices.indexOf(contxt.type) + 1;
		contxt.nextSel		= $($('#' + contxt.choices[contxt.nextI]));
		contxt.prevI 		= contxt.choices[(contxt.choices.indexOf(contxt.type) - 1)];

		contxt.header		= 'Select a ' + contxt.choices[(contxt.choices.indexOf(contxt.type) + 1)];
		$('#nameTag').html(contxt.header);
}
function advance(){
	$selN = contxt.nextSel;
	
	contxt.current.animate({
		left: '-225px'
	}, 'fast', function(){
		contxt.current.hide().addClass('inactive').removeAttr('style');
		//bring the next one in
		$selN.animate({
			left: '0px'
		}, 'fast', function(){
			$selN.hide().removeClass('inactive').fadeIn('medium');
		});
	});
	updateContxt();
	contxt.appIteration++;
}
function updateContxt(){
  	getOption(contxt.realm);
  	$('#nameTag').html(contxt.header);
}
function getPrevious(contxt){

}
function fireEvt(event, data){
	event.preventDefault();
	getOption( $(data) );
	//getOption($(this));
	advance();
}
$('document').ready(function(){
	$('#filter form').jqTransform();

	$('#go').on('click', function(event, data){
		//$(selector).trigger('event', dataToPass = ["selection evt"]);
		var $this = $($('li:not(".inactive") a.selected', contxt.current));
		$this.trigger('selection', $this);
	});
	$('.jqTransformSelectWrapper ul li a', '#filter').on("selection", fireEvt);

});



