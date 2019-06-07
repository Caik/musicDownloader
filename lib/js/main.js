function getData(form) {
	var termoBusca = form.busca_input.value;
	var radio = form.radio.value;
	if(!termoBusca){
		$("#erro_busca strong").html("Digite o nome da música.");
		$("#erro_busca").show();
		return false;
	}
	$("#erro_busca").hide();
	
	$.ajax({
        url: 'getData.php',
        type: "POST",
        data: { busca: termoBusca, info: radio },
        beforeSend: function() {
        	$("#resultado_div").html('');
        	$("#loading_div").show();
        },
        success: function(data) {
            $("#resultado_div").html(data);
            $("#erro_busca").hide();
        },
    	error: function(msg) {
    		$("#erro_busca").html("<strong class=''>Erro:</strong> " + msg.statusText);
    		$("#erro_busca").show();
    	}
    })
    .done(function(){
    	$("#loading_div").hide();
    });
}

function getDetalhes(id) {
	$.ajax({
        url: 'http://mp3clan.com/bitrate.php?tid=' + id,
        type: "GET",
        success: function(data) {
            $("span[name=bitrate_" + id + "]").html(data.replace(/^(\d+ kbps).+$/m, '$1'));
            $("span[name=size_" + id + "]").html(data.replace(/^.+(\d*\.\d+ mb).+$/m, '$1'));
            $("#get_" + id).hide();
        },
    	error: function(msg) {
    		$("span[name=bitrate_" + id + "]").html('');
            $("span[name=size_" + id + "]").html('');
    	}
    });
}