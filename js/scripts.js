function getPace() {
	var time = $('#time').val();
	var distance = $('#distance').val();
	var segments = time.split(":");
	var length = segments.length;
	var pace = "--";
	var seconds = 0;
				
	if (length == 3) {
		seconds = Number(segments[0]) * 3600 + Number(segments[1]) * 60 + Number(segments[2]);
	} else if (length == 2) {
		seconds = Number(segments[0]) * 60 + Number(segments[1]);
	}
				
	if (seconds != 0) {
		minutes = Math.floor(seconds / distance / 60);
		seconds = pad(Math.round((seconds / distance / 60 - minutes) * 60),2);
		pace = minutes+":"+seconds;
	}
				
	$('#pace').val(pace);
}

function pad(num, size) {
	var s = num+"";
	while (s.length < size) s = "0" + s;
	return s;
}

$('.datepicker').datepicker({
	format: 'yyyy-mm-dd'
})

function getPercentage() {
	var percentage = "";
	var total = $('#field').val();
	var placement = $('#placement').val();
	if ((total != "") && (placement != "")) {
		percentage = Number(placement) / Number(total) * 100;
		percentage = Math.round(percentage) + "%";
	}
	$('#percentage').val(percentage);
}