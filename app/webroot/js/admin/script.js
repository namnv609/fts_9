$(function(){
	var answerNum = $("#list-answer .form-group").length;
	
	$("#addNewAnswer").on("click", function(){
		var $formTemplate = $("#form-template .form-group").clone();
		answerNum++;
		
		$formTemplate.find("input[type=hidden]:first").prop({
			"name" : "data[Answer][" + answerNum + "][id]"
		});
		$formTemplate.find("input[type=text]").prop({
			"name" : "data[Answer][" + answerNum + "][answer]"
		});
		$formTemplate.find("input[type=hidden]:last").prop({
			"name" : "data[Answer][" + answerNum + "][correct]"
		});
		$formTemplate.find("input[type=checkbox]").prop({
			"name" : "data[Answer][" + answerNum + "][correct]"
		});
		
		$formTemplate.appendTo($("#list-answer"));
		
	});
	
	$("#list-answer").on("click", "button.remove-answer", function(){
		var confirmMessage = $("#list-answer").data("confirm-message");
		
		if (confirm(confirmMessage)) {
			$(this).closest(".form-group").fadeOut("fast", function(){
				$(this).remove();
			});
		}
	});
});