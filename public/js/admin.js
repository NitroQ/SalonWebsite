/**
 * Warns the user that they're leaving without saving their changes.
 * @param urlTo String value. The page they'r attempting to open.
 */
function confirmLeave(urlTo) {
	Swal.fire({
		icon: 'warning',
		html: '<h4>Are you sure?</h4><p>You have unsave changes.</p>',
		showDenyButton: true,
		confirmButtonText: 'Yes',
		denyButtonText: 'No'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = urlTo;
		}
	});
}

$(document).ready(() => {
	// SIDEBAR COLLAPSE
	$('#sidebar-trigger').on('click', (e) => {
		let obj = $(e.currentTarget);
		let target = $(obj.attr('data-target'));

		if (obj.parent().parent().hasClass('col-10')) {
			obj.parent().parent().addClass('col-12');
			obj.parent().parent().removeClass('col-10');
			target.removeClass('col-2');
			target.addClass('active');
			$('.js-only').addClass('w-100');
		}
		else {
			obj.parent().parent().removeClass('col-12');
			obj.parent().parent().addClass('col-10');
			target.addClass('col-2');
			target.removeClass('active');
			$('.js-only').removeClass('w-100');
		}
	});

	// Change submit to either "Updating" or "Submitting" after click
	$('[type=submit], [data-action]').click(function(e) {
		let action = $(e.currentTarget).attr('data-action');

		if ($(e.currentTarget).attr('data-clicked') == 'true') {
			e.preventDefault()
		}
		else {
			if (action == 'submit')
				$(e.currentTarget).html(`<div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only"></span></div> Submitting...`);
			else if (action == 'update')
				$(e.currentTarget).html(`<div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only"></span></div> Updating...`);
			else if (action == 'none') {
				return true;
			}
		}

		$(e.currentTarget).addClass(`disabled cursor-default`);
	});

	// Activate masking
	$(document).on('ready load click focus', "[data-mask]", (e) => {
		let obj = $(e.currentTarget);
		console.log(e.currentTarget);
		if (!obj.attr('data-masked')) {
			obj.inputmask('mask', {
				'mask' : obj.attr('data-mask-format'),
				'removeMaskOnSubmit' : true,
				'autoUnmask':true
			});

			obj.attr('data-masked', 'true');
		}
	});

	// TRIGGER STEP PROGRESS FUNCTION
	stepProgressInit();
});

// STEP PROGRESS
function stepProgressInit() {
	let obj = $('.step-progress');
	let bars = obj.find('.bar').children();
	let steps = obj.find('.steps').children();
	let labels = obj.find('.labels').children();
	let stepCount = steps.length-1;
	// In percentage
	let progress = (obj.attr('data-progress')*100)/stepCount;
	let remaining = 100-progress;

	// Set length and height of steps
	obj.find('.steps').css('width', obj.find('.bar').width());
	obj.find('.steps').css('height', obj.find('.bar').height());

	// Attaching a resize event listener to .steps
	$(window).resize((e) => {
		obj.find('.steps').css('width', obj.find('.bar').width());
		obj.find('.steps').css('height', obj.find('.bar').height());
	});

	// Placing the step milestone
	steps.css('width', (100/stepCount) + "%");
	$(steps[stepCount]).css('width', '');

	// Setting the color for step milestone
	for (let i = 0; i <= obj.attr('data-progress'); i++)
		$(steps[i]).addClass('active');

	// Setting the length of the bar
	$(bars[0]).css('width', progress + "%");
	$(bars[1]).css('width', remaining + "%");

	// Setting the labels
	labels.css('width', (100/stepCount) + "%");
};