"use strict";
$(document).ready(function() {
	$("#tipo_grafico_picker").click(function() {
		$(this).toggleClass("picker_expanded");
	});
	$(".listagem_perfis_graficos").mCustomScrollbar({
		axis: "y",
		scrollButtons:{
			enable:true
		}
	});
	$(".tipo_grafico_picker_opcoes").children("div").click(function() {
		toggleGrafico(this);
	});
	$("body").click(function() {
		$("#tipo_grafico_picker").removeClass("picker_expanded");
	});
	$(".tipo_grafico_picker_opcoes").click(function(event) {
		event.stopPropagation();
	});
	$("#tipo_grafico_picker").click(function(event) {
		event.stopPropagation();
	});
	$("#liberarCapitulos").click(function() {
		showLiberarCapitulos();
	});
	$("#cancelarLiberarCapitulos").click(function() {
		cancelLiberarCapitulos();
	});
	$("#salvarLiberarCapitulos").click(function() {
		saveLiberarCapitulos();
	});
	$("#liberarCapitulosTable").find("span").click(function() {
		if ($(this).is(".cap_nao_liberado")) {
			$(this).addClass("cap_liberado");
			$(this).removeClass("cap_nao_liberado");
		} else if ($(this).is(".cap_liberado")) {
			$(this).removeClass("cap_liberado");
			$(this).addClass("cap_nao_liberado");
		}
	});
});

function toggleGrafico(item) {
	var idNum = $(item).attr("id").substring(11);
	var texto = $(item).html();

	$("#tipo_grafico_picker").removeClass("picker_expanded");
	$(".tipo_grafico_picker_opcoes").children("div").not(item).removeClass("option_selected");
	$(".grafico").not("#grafico"+idNum).hide();
	$(".legenda_grafico").children("div").not("#legendaGrafico"+idNum).hide()
	$("#legendaGrafico"+idNum).show();
	$(item).addClass("option_selected");
	$("#grafico"+idNum).show();
	$("#tipo_grafico_picker").html(texto);
}
function showLiberarCapitulos() {
	$("#liberarCapitulos").hide();
	$("#conteudoPrincipal").hide();
	$("#liberarCapituloContainer").show();
}
function cancelLiberarCapitulos() {
	$("#liberarCapitulos").show();
	$("#conteudoPrincipal").show();
	$("#liberarCapituloContainer").hide();
}
function saveLiberarCapitulos() {
	$("#liberarCapitulos").show();
	$("#conteudoPrincipal").show();
	$("#liberarCapituloContainer").hide();
}