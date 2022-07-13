function ins () {
	$('#myTable').submit(function () {
		var th = $(this);
			$.ajax({
				type: 'POST',
				url: 'php/ins.php',
				data: $(this).serialize()
			}).done(function () {
				setTimeout(function() {
				th.trigger("reset");
			}, 1000);
			});
		return false;
	});
}