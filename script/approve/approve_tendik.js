$(document).ready(function () {
	var homedir = $("#homedir").val();
	$("#alertNotes").hide();
	$(".dtApproveTendik").on("click", "a", function () {
		//let data = $("#dtApproveTendik").row(e.target.closest("tr")).data();
		// if (this.name == "approve") {
		// 	$("#modalMessage").modal("toggle");
		// 	$("#btnReject").hide();
		// 	$("#btnApprove").show();
		// }
		if (this.name == "reject") {
			$("#modalMessage").modal("toggle");
			$("#btnReject").show();
			$("#btnApprove").hide();
			$("#alertNotes").hide(200);
			$("#idGaji").val(this.id);
			$("#txtMessage").val("");
		}
	});

	$("#btnReject").on("click", function () {
		if (!$.trim($("#txtMessage").val())) {
			$("#alertNotes").show(200);
		} else {
			$("#alertNotes").hide(200);
			$.ajax({
				url: homedir + "approve/rejectgajitendik",
				type: "post",
				data: {
					id: $("#idGaji").val(),
					note: $("#txtMessage").val(),
				},
				success: function () {
					document.location.href = homedir + "approve";
				},
			});
		}
	});
});
