
var mySettings = {
	onShiftEnter:  	{keepDefault:false, replaceWith:'<br />\n'},
	onCtrlEnter:  	{keepDefault:false, openWith:'\n', closeWith:''},
	onTab:    		{keepDefault:false, replaceWith:'    '},

	markupSet:  [ 
		{name:'Bold', key:'B', openWith:'[tbold]', closeWith:'[/tbold]' },
		{name:'Italic', key:'I', openWith:'[titalic]', closeWith:'[/titalic]'  },
		{name:'Stroke through', key:'U', openWith:'[tunderline]', closeWith:'[/tunderline]' },
		{separator:'---------------' },
		{name:'Bulleted List', openWith:' [tli]', closeWith:'[/tli]', multiline:true, openBlockWith:'[tlist]\n', closeBlockWith:'\n[/tlist]'},
		{name:'Numeric List', openWith:' [tli]', closeWith:'[/tli]', multiline:true, openBlockWith:'[tnumeric]\n', closeBlockWith:'\n[/tnumeric]'},
		{separator:'---------------' },
		{name:'Link', key:'L', openWith:'[thyperlink] [![Link:!:http://]!] [/thyperlink]' },
		{separator:'---------------' },
		{name:'H2', className:'h2',  openWith:'[th2]', closeWith:'[/th2]' },
		{name:'H3', className:'h3',  openWith:'[th3]', closeWith:'[/th3]' },
		{name:'H4', className:'h4',   openWith:'[th4]', closeWith:'[/th4]' },
		{name:'H5', className:'h5',   openWith:'[th5]', closeWith:'[/th5]' },
		{name:'H6', className:'h6',   openWith:'[th6]', closeWith:'[/th6]' },
		{name:'Quote', key:'Q',   openWith:'[tquote]', closeWith:'[/tquote]' },
		{name:'Code', key:'K',   openWith:'[tcode]', closeWith:'[/tcode]' },
		{separator:'---------------' },
		{name:'Align Left', key:'L',   openWith:'[talignleft]', closeWith:'[/talignleft]' },
		{name:'Align Center', key:'T',   openWith:'[taligncenter]', closeWith:'[/taligncenter]' },
		{name:'Align Right', key:'R',   openWith:'[talignright]', closeWith:'[/talignright]' },
	]
}


jQuery(document).ready(function($){

	$('.tj_media_upload').click(function(e) {
		var attribute = $(this).attr('rel');
	    e.preventDefault();

	    var custom_uploader = wp.media({
	        title: 'Upload Image',
	        button: {
	            text: 'Add image'
	        },
	        library : {
                        type : 'image'
                       },
	        type : 'image',

	        multiple: false  // Set this to true to allow multiple files to be selected
	    })
	    .on('select', function() {
	        var attachment = custom_uploader.state().get('selection').first().toJSON();
			var cursorPos 	= $('#markItUp'+attribute).prop('selectionStart'),
			v 				= $('#markItUp'+attribute).val(),
			textBefore 		= v.substring(0,  cursorPos ),
			textAfter  		= v.substring( cursorPos, v.length );
			$('#markItUp'+attribute).val( textBefore + '[timage title="' + attachment.title +'" alt="' + attachment.alt +'" description="' + attachment.description +'" caption="' + attachment.caption +'"]' + attachment.url + '[/timage]' + textAfter );
	    })
	    .open();
	});

});