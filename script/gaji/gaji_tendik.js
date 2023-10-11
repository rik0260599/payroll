$(document).ready(function () {
	var homedir = $("#homedir").val();
	$("#icMessage").on("click", function () {
		$("#modalMessage").modal("toggle");
	});

	$(".dtTendik").on("click", "a", function () {
		//let data = $("#dtApproveTendik").row(e.target.closest("tr")).data();
		// if (this.name == "approve") {
		// 	$("#modalMessage").modal("toggle");
		// 	$("#btnReject").hide();
		// 	$("#btnApprove").show();
		// }
		if (this.name == "icMessage") {
			$("#modalMessage").modal("toggle");
			let tempId = this.id;
			$.ajax({
				url: homedir + "tendik/getmessage",
				dataType: "json",
				type: "post",
				data: {
					id: tempId,
				},
				success: function (d) {
					console.log(d.response);
					$("#lblMessage").html(
						d.response + "<br><br> Pengirim : " + d.updateby
					);
				},
			});
		}
	});
});
