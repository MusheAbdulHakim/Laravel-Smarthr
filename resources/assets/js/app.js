/*
Author       : Dreamguys
Template Name: SmartHR - Bootstrap Admin Template
Version      : 3.6
*/

$(document).ready(function() {
	
	// Variables declarations
	
	var $wrapper = $('.main-wrapper');
	var $pageWrapper = $('.page-wrapper');
	var $slimScrolls = $('.slimscroll');

	// Loader
	
	setTimeout(function () {
		$('#loader-wrapper');
		setTimeout(function () {
			$("#loader-wrapper").hide();
		}, 100);
	}, 500);
	
	// Sidebar
	
	var Sidemenu = function() {
		this.$menuItem = $('#sidebar-menu a');
	};
	function init() {
		var $this = Sidemenu;
		$('#sidebar-menu a').on('click', function(e) {
			if($(this).parent().hasClass('submenu')) {
				e.preventDefault();
			}
			if(!$(this).hasClass('subdrop')) {
				$('ul', $(this).parents('ul:first')).hide(350);
				$('a', $(this).parents('ul:first')).removeClass('subdrop');
				$(this).next('ul').show(350);
				$(this).addClass('subdrop');
			} else if($(this).hasClass('subdrop')) {
				$(this).removeClass('subdrop');
				$(this).next('ul').hide(350);
			}
		});
		$('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');

		
	}
	
	// Sidebar Initiate
	init();

	// Password toggle

	
	
	$("#toggle-password").click(function () {
		$( this ).toggleClass("fa-eye fa-eye-slash");
        if ($("#password").attr("type") == "password")
        {
            $("#password").attr("type", "text");
        } else
        {
            $("#password").attr("type", "password");
        }
    });

	// Mobile menu sidebar overlay
	
	$('body').append('<div class="sidebar-overlay"></div>');
	$(document).on('click', '#mobile_btn', function() {
		$wrapper.toggleClass('slide-nav');
		$('.sidebar-overlay').toggleClass('opened');
		$('html').addClass('menu-opened');
		$('#task_window').removeClass('opened');
		return false;
	});
	
	$(".sidebar-overlay").on("click", function () {
			$('html').removeClass('menu-opened');
			$(this).removeClass('opened');
			$wrapper.removeClass('slide-nav');
			$('.sidebar-overlay').removeClass('opened');
			$('#task_window').removeClass('opened');
	});
	
	// Chat sidebar overlay
	
	$(document).on('click', '#task_chat', function() {
		$('.sidebar-overlay').toggleClass('opened');
		$('#task_window').addClass('opened');
		return false;
	});
	
	// Select 2
	
	if($('.select').length > 0) {
		$('.select').select2({
			minimumResultsForSearch: -1,
			width: '100%'
		});
	}
	
	// Modal Popup hide show

	if($('.modal').length > 0 ){
		var modalUniqueClass = ".modal";
		$('.modal').on('show.bs.modal', function(e) {
		  var $element = $(this);
		  var $uniques = $(modalUniqueClass + ':visible').not($(this));
		  if ($uniques.length) {
			$uniques.modal('hide');
			$uniques.one('hidden.bs.modal', function(e) {
			  $element.modal('show');
			});
			return false;
		  }
		});
	}
	
	// Floating Label

	if($('.floating').length > 0 ){
		$('.floating').on('focus blur', function (e) {
		$(this).parents('.form-focus').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
		}).trigger('blur');
	}

	// Date Range Picker
	if($('.bookingrange').length > 0) {
		var start = moment().subtract(6, 'days');
		var end = moment();

		function booking_range(start, end) {
			$('.bookingrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		}

		$('.bookingrange').daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, booking_range);

		booking_range(start, end);
	}
	
	// Sidebar Slimscroll

	if($slimScrolls.length > 0) {
		$slimScrolls.slimScroll({
			height: 'auto',
			width: '100%',
			position: 'right',
			size: '7px',
			color: '#ccc',
			wheelStep: 10,
			touchScrollStep: 100
		});
		var wHeight = $(window).height() - 60;
		$slimScrolls.height(wHeight);
		$('.sidebar .slimScrollDiv').height(wHeight);
		$(window).resize(function() {
			var rHeight = $(window).height() - 60;
			$slimScrolls.height(rHeight);
			$('.sidebar .slimScrollDiv').height(rHeight);
		});
	}
	
	// Page Content Height

	var pHeight = $(window).height();
	$pageWrapper.css('min-height', pHeight);
	$(window).resize(function() {
		var prHeight = $(window).height();
		$pageWrapper.css('min-height', prHeight);
	});
	
	// Date Time Picker
	
	if($('.datetimepicker').length > 0) {
		$('.datetimepicker').datetimepicker({
			//format: 'DD/MM/YYYY',
			format: 'DD-MM-YYYY',
			icons: {
				up: "fa fa-angle-up",
				down: "fa-solid fa-angle-down",
				next: 'fa-solid fa-angle-right',
				previous: 'fa-solid fa-angle-left'
			}
		});
	}

	if($('.timepicker').length > 0) {
		$('.timepicker').datetimepicker({
			format: "hh:mm:ss",
			icons: {
				up: "fa fa-angle-up",
				down: "fa-solid fa-angle-down",
				next: 'fa-solid fa-angle-right',
				previous: 'fa-solid fa-angle-left'
			}
		});
	}
	
	// Datatable

	if($('.datatable').length > 0) {
		$('.datatable').DataTable({
			"bFilter": false,
		});
	}
	
	// Tooltip

	if($('[data-bs-toggle="tooltip"]').length > 0) {
		$('[data-bs-toggle="tooltip"]').tooltip();
	}
	
	// Email Inbox

	if($('.clickable-row').length > 0 ){
		$(".clickable-row").click(function() {
			window.location = $(this).data("href");
		});
	}

	// Check all email
	
	$(document).on('click', '#check_all', function() {
		$('.checkmail').click();
		return false;
	});
	if($('.checkmail').length > 0) {
		$('.checkmail').each(function() {
			$(this).on('click', function() {
				if($(this).closest('tr').hasClass('checked')) {
					$(this).closest('tr').removeClass('checked');
				} else {
					$(this).closest('tr').addClass('checked');
				}
			});
		});
	}
	
	// Mail important
	
	$(document).on('click', '.mail-important', function() {
		$(this).find('i.fa').toggleClass('fa-star').toggleClass('fa-star-o');
	});
	
	// CK Editor

	if ($('#editor').length > 0) {
		ClassicEditor
		.create( document.querySelector( '#editor' ), {
			 toolbar: {
			    items: [
			        'heading', '|',
			        'fontfamily', 'fontsize', '|',
			        'alignment', '|',
			        'fontColor', 'fontBackgroundColor', '|',
			        'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
			        'link', '|',
			        'outdent', 'indent', '|',
			        'bulletedList', 'numberedList', 'todoList', '|',
			        'code', 'codeBlock', '|',
			        'insertTable', '|',
			        'uploadImage', 'blockQuote', '|',
			        'undo', 'redo'
			    ],
			    shouldNotGroupWhenFull: true
			}
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
	}
	
	// Task Complete
	
	$(document).on('click', '#task_complete', function() {
		$(this).toggleClass('task-completed');
		return false;
	});
	
	// Multiselect

	if($('#customleave_select').length > 0) {
		$('#customleave_select').multiselect();
	}
	if($('#edit_customleave_select').length > 0) {
		$('#edit_customleave_select').multiselect();
	}

	// Leave Settings button show
	
	$(document).on('click', '.leave-edit-btn', function() {
		$(this).removeClass('leave-edit-btn').addClass('btn btn-white leave-cancel-btn').text('Cancel');
		$(this).closest("div.leave-right").append('<button class="btn btn-primary leave-save-btn" type="submit">Save</button>');
		$(this).parent().parent().find("input").prop('disabled', false);
		return false;
	});
	$(document).on('click', '.leave-cancel-btn', function() {
		$(this).removeClass('btn btn-white leave-cancel-btn').addClass('leave-edit-btn').text('Edit');
		$(this).closest("div.leave-right").find(".leave-save-btn").remove();
		$(this).parent().parent().find("input").prop('disabled', true);
		return false;
	});
	
	$(document).on('change', '.leave-box .onoffswitch-checkbox', function() {
		var id = $(this).attr('id').split('_')[1];
		if ($(this).prop("checked") == true) {
			$("#leave_"+id+" .leave-edit-btn").prop('disabled', false);
			$("#leave_"+id+" .leave-action .btn").prop('disabled', false);
		}
	    else {
			$("#leave_"+id+" .leave-action .btn").prop('disabled', true);	
			$("#leave_"+id+" .leave-cancel-btn").parent().parent().find("input").prop('disabled', true);
			$("#leave_"+id+" .leave-cancel-btn").closest("div.leave-right").find(".leave-save-btn").remove();
			$("#leave_"+id+" .leave-cancel-btn").removeClass('btn btn-white leave-cancel-btn').addClass('leave-edit-btn').text('Edit');
			$("#leave_"+id+" .leave-edit-btn").prop('disabled', true);
		}
	});
	
	$('.leave-box .onoffswitch-checkbox').each(function() {
		var id = $(this).attr('id').split('_')[1];
		if ($(this).prop("checked") == true) {
			$("#leave_"+id+" .leave-edit-btn").prop('disabled', false);
			$("#leave_"+id+" .leave-action .btn").prop('disabled', false);
		}
	    else {
			$("#leave_"+id+" .leave-action .btn").prop('disabled', true);	
			$("#leave_"+id+" .leave-cancel-btn").parent().parent().find("input").prop('disabled', true);
			$("#leave_"+id+" .leave-cancel-btn").closest("div.leave-right").find(".leave-save-btn").remove();
			$("#leave_"+id+" .leave-cancel-btn").removeClass('btn btn-white leave-cancel-btn').addClass('leave-edit-btn').text('Edit');
			$("#leave_"+id+" .leave-edit-btn").prop('disabled', true);
		}
	});
	
	// Placeholder Hide

	if ($('.otp-input, .zipcode-input input, .noborder-input input').length > 0) {
		$('.otp-input, .zipcode-input input, .noborder-input input').focus(function () {
			$(this).data('placeholder', $(this).attr('placeholder'))
				   .attr('placeholder', '');
		}).blur(function () {
			$(this).attr('placeholder', $(this).data('placeholder'));
		});
	}
	

	
	// OTP Input
	
	if ($('.otp-input').length > 0) {
		$(".otp-input").keyup(function(e) {
			if ((e.which >= 48 && e.which <= 57) || (e.which >= 96 && e.which <= 105)) {
				$(e.target).next('.otp-input').focus();
			} else if (e.which == 8) {
				$(e.target).prev('.otp-input').focus();
			}
		});
	}
	
	// Small Sidebar

	$(document).on('click', '#toggle_btn', function() {
		if($('body').hasClass('mini-sidebar')) {
			$('body').removeClass('mini-sidebar');
			$('.subdrop + ul').show();
		} else {
			$('body').addClass('mini-sidebar');
			$('.subdrop + ul').hide();
		}
		return false;
	});
	$(document).on('mouseover', function(e) {
		e.stopPropagation();
		if($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
			var targ = $(e.target).closest('.sidebar').length;
			if(targ) {
				$('body').addClass('expand-menu');
				$('.subdrop + ul').show();
			} else {
				$('body').removeClass('expand-menu');
				$('.subdrop + ul').hide();
			}
			return false;
		}
	});
	
	$(document).on('click', '.top-nav-search .responsive-search', function() {
		$('.top-nav-search').toggleClass('active');
	});
	
	$(document).on('click', '#file_sidebar_toggle', function() {
		$('.file-wrap').toggleClass('file-sidebar-toggle');
	});
	$(document).on('click', '#file_sidebar_toggle', function() {
		$('.file-wrap').toggleClass('file-sidebar-toggle');
	});
	$(document).on('click', '.list-inline-item .submenu a', function() {
		$('.hidden-links').addClass('hidden');
	});
	$(document).on('click', '.two-col-bar .sub-menu a', function() {
		$('.two-col-bar .sub-menu ul').toggle(500);
	});
	$(document).on('click', '.sidebar-horizantal .viewmoremenu', function() {
		$('.sidebar-horizantal .list-inline-item .submenu ul').hide(500);
		$('.sidebar-horizantal .list-inline-item .submenu a').removeClass("subdrop");
	});
	if($('.kanban-wrap').length > 0) {
		$(".kanban-wrap").sortable({
			connectWith: ".kanban-wrap",
			handle: ".kanban-box",
			placeholder: "drag-placeholder"
		});
	}
	

	
	if ($(window).width() < 991) {
		$("html").each(function() {
			var attributes = $.map(this.attributes, function(item) {
			return item.name;
			});
		
			var img = $(this);
			$.each(attributes, function(i, item) {
			img.removeAttr(item);
			});
		});
	}	
	
	// $(document).on('click', '#customizer-layout02', function() {
	// 	location.reload();
	// });
	
	$(document).ready(function(){
		$("#sidebar-size-compact").click(function(){            
			$('html').attr("data-layout", "vertical");
		});
	});
	$(document).ready(function(){
		$("#sidebar-size-small-hover").click(function(){            
			$('html').attr("data-layout", "vertical");
		});
	});
	$(document).ready(function(){
		$("[data-layout=horizontal] #sidebar-size-compact").click(function(){            
			$('html').attr("data-layout", "vertical");
		});
	});
	$(document).ready(function(){
		$("[data-layout=horizontal] #sidebar-size-small-hover").click(function(){            
			$('html').attr("data-layout", "vertical");
		});
	});
	$(document).ready(function(){
		$(".colorscheme-cardradio input[type=radio]").click(function(){
			$("html").removeAttr("data-topbar");
		});
		
		$(".viewmoremenu").click(function() {
			$(".hidden-links").toggleClass("hidden");
		});
		
	});


	$("[data-sidebar-size=sm-hover] #customizer-layout03").click(function(){
		$("html").removeAttr("data-layout-mode");
	});
	$(".greedy .list-inline-item .submenu a").click(function(){
		$(".hidden-links").addClass("hidden");
	});
	
	// Add Product
	$("#addProduct").on('click',function(e){
		const tableBody = $('#addTable tbody');
        const rowCount = tableBody.find('tr').length + 1;
	var addTable = `<tr><td>${rowCount}</td><td><input class="form-control" type="text" style="min-width:150px"></td>
	  	<td><input class="form-control" type="text" style="min-width:150px"></td>
		<td><input class="form-control" style="width:100px" type="text"></td>
		<td><input class="form-control" style="width:80px" type="text"></td>
		<td><input class="form-control" readonly style="width:120px" type="text"></td>
		<td><a href="javascript:void(0)" class="text-danger font-18 remove" title="Remove"><i class="fa-regular fa-trash-can"></i></a></td></tr>`; 
		$('tbody.tbodyone').append(addTable);
		e.preventDefault();
  	});

	// Add Edit Product 
	
	$("#addEditProduct").on('click',function(e){
		const tableBody = $('#editTable tbody');
        const rowCount = tableBody.find('tr').length + 1;
		var editAddTable = `<tr><td>${rowCount}</td>
	<td>
		<input class="form-control" type="text" value="Vehicle Module" style="min-width:150px">
	</td>
	<td>
		<input class="form-control" type="text" value="Create, edit delete functionlity" style="min-width:150px">
	</td>
	<td>
		<input class="form-control" style="width:100px" type="text" value="112">
	</td>
	<td>
		<input class="form-control" style="width:80px" type="text" value="1">
	</td>
	<td>
		<input class="form-control" readonly style="width:120px" type="text" value="112">
	</td>
	<td>
		<a href="javascript:void(0)" class="text-danger font-18 remove" title="Remove"><i class="fa-regular fa-trash-can"></i></a>
	</td></tr>`;
		$('tbody.tbodyone').append(editAddTable);
		e.preventDefault();
  	});
  
  $(document).on('click','.remove',function(){
	  $(this).parents('tr').remove();
	  const tableBody = $('#addTable tbody');
    const rowCount = tableBody.find('tr').length - 1;
	var editAddTable = `<tr><td>${rowCount}</td></tr>`
  	});

});


