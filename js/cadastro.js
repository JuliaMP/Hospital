"use strict";

var tabs = $('.tab_cadastro');
var containers = $('.conteudo_tab');
var btns = $('.btns_tabs');

var perfisAlunos = [
    {id: 34, nome: 'Laura Cristina dos Santos', escola: 'E.E. Prof. Vital Fogaça de Almeida', professor: 'Adilson Ferreira Batista', sala: '3º ano B', periodo: 'Manhã', nascimento: '10/10/1999', rg: '11.234.567-8', cpf: '111.222.333-44', rua: 'Rua Crubixás', numero: '13', complemento: 'casa 02', cep: '03737-037', bairro: 'Vila Araguaia', estado: 'SP', cidade: 'São Paulo', telResidencial: '+55 (11) 2345-6789', telCelular: '', telComercial: '', email: 'lauracris1@gmail.com', usuario: 'laura_cris1'},
    {id: 35, nome: 'Laura Cristina dos Santos', escola: 'E.E. Prof. Vital Fogaça de Almeida', professor: 'Adilson Ferreira Batista', sala: '3º ano B', periodo: 'Manhã', nascimento: '10/10/1999', rg: '11.234.567-8', cpf: '111.222.333-44', rua: 'Rua Crubixás', numero: '13', complemento: 'casa 02', cep: '03737-037', bairro: 'Vila Araguaia', estado: 'SP', cidade: 'São Paulo', telResidencial: '+55 (11) 2345-6789', telCelular: '', telComercial: '', email: 'lauracris1@gmail.com', usuario: 'laura_cris1'},
    {id: 36, nome: 'Laura Cristina dos Santos', escola: 'E.E. Prof. Vital Fogaça de Almeida', professor: 'Adilson Ferreira Batista', sala: '3º ano B', periodo: 'Manhã', nascimento: '10/10/1999', rg: '11.234.567-8', cpf: '111.222.333-44', rua: 'Rua Crubixás', numero: '13', complemento: 'casa 02', cep: '03737-037', bairro: 'Vila Araguaia', estado: 'SP', cidade: 'São Paulo', telResidencial: '+55 (11) 2345-6789', telCelular: '', telComercial: '', email: 'lauracris1@gmail.com', usuario: 'laura_cris1'},
    {id: 37, nome: 'Laura Cristina dos Santos', escola: 'E.E. Prof. Vital Fogaça de Almeida', professor: 'Adilson Ferreira Batista', sala: '3º ano B', periodo: 'Manhã', nascimento: '10/10/1999', rg: '11.234.567-8', cpf: '111.222.333-44', rua: 'Rua Crubixás', numero: '13', complemento: 'casa 02', cep: '03737-037', bairro: 'Vila Araguaia', estado: 'SP', cidade: 'São Paulo', telResidencial: '+55 (11) 2345-6789', telCelular: '', telComercial: '', email: 'lauracris1@gmail.com', usuario: 'laura_cris1'}
];

var perfisProf = [
    {id: 10, nome: 'Andressa de Cardoso Dias', nascimento: '02/04/1984', rg: '23.887.654-9', cpf: '567.800.766-42', rua: 'Rua Embirussú', numero: '56', complemento: '', cep: '03817-090', bairro: 'Vila Beatriz', estado: 'São Paulo', cidade: 'SP', telResidencial: '+55 (11) 96543-9876', telComercial: '', telCelular: '', email: 'nanda_hr@outlook.com', escola: 'E.M.E.F. Deputado Januário Mantelli Neto', sala: '3º série A', periodo: 'Manhã', usuario: 'andressa_cd'},
    {id: 11, nome: 'Andressa de Cardoso Dias', nascimento: '02/04/1984', rg: '23.887.654-9', cpf: '567.800.766-42', rua: 'Rua Embirussú', numero: '56', complemento: '', cep: '03817-090', bairro: 'Vila Beatriz', estado: 'São Paulo', cidade: 'SP', telResidencial: '+55 (11) 96543-9876', telComercial: '', telCelular: '', email: 'nanda_hr@outlook.com', escola: 'E.M.E.F. Deputado Januário Mantelli Neto', sala: '3º série A', periodo: 'Manhã', usuario: 'andressa_cd'},
    {id: 12, nome: 'Andressa de Cardoso Dias', nascimento: '02/04/1984', rg: '23.887.654-9', cpf: '567.800.766-42', rua: 'Rua Embirussú', numero: '56', complemento: '', cep: '03817-090', bairro: 'Vila Beatriz', estado: 'São Paulo', cidade: 'SP', telResidencial: '+55 (11) 96543-9876', telComercial: '', telCelular: '', email: 'nanda_hr@outlook.com', escola: 'E.M.E.F. Deputado Januário Mantelli Neto', sala: '3º série A', periodo: 'Manhã', usuario: 'andressa_cd'},
    {id: 13, nome: 'Andressa de Cardoso Dias', nascimento: '02/04/1984', rg: '23.887.654-9', cpf: '567.800.766-42', rua: 'Rua Embirussú', numero: '56', complemento: '', cep: '03817-090', bairro: 'Vila Beatriz', estado: 'São Paulo', cidade: 'SP', telResidencial: '+55 (11) 96543-9876', telComercial: '', telCelular: '', email: 'nanda_hr@outlook.com', escola: 'E.M.E.F. Deputado Januário Mantelli Neto', sala: '3º série A', periodo: 'Manhã', usuario: 'andressa_cd'}
];

var perfisAlunosGerados = new Array();
var perfisProfsGerados = new Array();

var delPerfilId = '0';
var blah;

$(document).ready(function() {
	
	$('.conteudo_tab').mCustomScrollbar({
		axis:"y",
		scrollButtons:{
			enable:true
		}
	});
    
    $(tabs).click(function() {
        tabNavigation(this);
    });

    
    tabNavigation(tabs[0]);
    
    $('.data').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        language: "pt-BR",
        toggleActive: true
    });
    
    //Criar objetos da classe Perfil Aluno e colocar no acordeon
    for ( var a in perfisAlunos ) { 
        perfisAlunosGerados[a] =
            new PerfilAluno(perfisAlunos[a].id, perfisAlunos[a].nome, perfisAlunos[a].escola, perfisAlunos[a].professor, perfisAlunos[a].sala, perfisAlunos[a].periodo, perfisAlunos[a].nascimento, perfisAlunos[a].rg, perfisAlunos[a].cpf,
                            perfisAlunos[a].rua, perfisAlunos[a].numero, perfisAlunos[a].complemento, perfisAlunos[a].cep, perfisAlunos[a].bairro, perfisAlunos[a].estado, perfisAlunos[a].cidade, perfisAlunos[a].telResidencial,
                            perfisAlunos[a].telCelular, perfisAlunos[a].telComercial, perfisAlunos[a].email, perfisAlunos[a].usuario);

        var outerHTML = perfisAlunosGerados[a].gerarHTML();
        $('.update_aluno_accordion').append(outerHTML);
    }

    //Criar objetos da classe Perfil Professor e colocar no acordeon
    for ( var a in perfisProf ) { 
        perfisProfsGerados[a] =
            new PerfilProfessor(perfisProf[a].id, perfisProf[a].nome, perfisProf[a].nascimento, perfisProf[a].rg, perfisProf[a].cpf, perfisProf[a].rua, perfisProf[a].numero, perfisProf[a].complemento, perfisProf[a].cep, perfisProf[a].bairro,
                            perfisProf[a].estado, perfisProf[a].cidade, perfisProf[a].telResidencial, perfisProf[a].telComercial, perfisProf[a].telCelular, perfisProf[a].email, perfisProf[a].escola, perfisProf[a].sala,
                            perfisProf[a].periodo, perfisProf[a].usuario);
                                          
        var outerHTML = perfisProfsGerados[a].gerarHTML();
        $('.update_prof_accordion').append(outerHTML);
    }
    
    $('.btn_tab').click(function() {
        $(this).siblings().removeClass('btn_tab_ativo');
        $(this).addClass('btn_tab_ativo');
        
        if ( $(this).hasClass('btn_aluno') ) {
            if ( $(this).hasClass('btn_add_cadastro') ) {
                $('.conteudo_aluno').find('.form_cadastro').show();
                $('.conteudo_aluno').find('.update_cadastro').hide()
            } else if ( $(this).hasClass('btn_update_cadastro') ) {
                $('.conteudo_aluno').find('.form_cadastro').hide();
                $('.conteudo_aluno').find('.update_cadastro').show()
            }
        } else if ( $(this).hasClass('btn_professor') ) {
            if ( $(this).hasClass('btn_add_cadastro') ) {
                $('.conteudo_professor').find('.form_cadastro').show();
                $('.conteudo_professor').find('.update_cadastro').hide()
            } else if ( $(this).hasClass('btn_update_cadastro') ) {
                $('.conteudo_professor').find('.form_cadastro').hide();
                $('.conteudo_professor').find('.update_cadastro').show()
            }
        } else if ( $(this).hasClass('btn_escola') ) {
            if ( $(this).hasClass('btn_add_cadastro') ) {
                $('.conteudo_escola').find('.form_cadastro').show();
                $('.conteudo_escola').find('.update_cadastro').hide()
            } else if ( $(this).hasClass('btn_update_cadastro') ) {
                $('.conteudo_escola').find('.form_cadastro').hide();
                $('.conteudo_escola').find('.update_cadastro').show()
            }
        }
    });
    
    //chama a função q carrega os estados no select
    listarEstadoCidade('inputEstadoAluno');
    $('#inputEstadoAluno').change(function(){
    	selectCidade('inputEstadoAluno','inputCidadeAluno')
    })
    listarEstadoCidade('inputEstadoProf');
    $('#inputEstadoProf').change(function(){
    	selectCidade('inputEstadoProf','inputCidadeProf')
    })
    listarEstadoCidade('inputEstadoEscola');
    $('#inputEstadoEscola').change(function(){
    	selectCidade('inputEstadoEscola','inputCidadeEscola')
    })
    
    $('.btn_del_cad').click(function() {
        var AlunoId = this.id.substring(11);
        delPerfilId = AlunoId;
        
        $('#modalDelMsg').modal({keyboard: false, backdrop: "static"});
    });
    
    $('.btnUpdateCadAluno').click(function() {
        var AlunoId = this.id.substring(14);
        
        for ( var a in perfisAlunosGerados ) {
            if ( perfisAlunosGerados[a].id == AlunoId ) {
                perfisAlunosGerados[a].gerarForm();
                break;
            }
        }
        
        $('.btn_add_cadastro:visible').trigger('click');
        
        console.info('Os campos do formulário estão sendo preenchidos com os dados dos objetos pré-criados da classe PerfilAluno.');
    });
    
    $('.accordion_info').click(function() {
        $(this).toggleClass('accordion_expanded');
    });

    $("#cadastroAluno").click(function(){
    	
    	$('.obrigatorioAluno').each(function(){
    		if ($(this).val() == '' || $(this).val() == null ){
    			if ($(this).attr('id') == 'inputTelResAluno'){	//Verifica se existe ao menos um telefone cadastrado!
    				if ($('#inputTelCelAluno').val() == '' && $('#inputTelComAluno').val() == ''){
    					$("#textoMensagemVazio").text('Pelo menos um número de telefone deve ser cadastrado');
    	        		$("#mensagemCampoVazio").show();
    	        		$(this).focus();
    					return false;
    				}
    			}else{
	    			$("#textoMensagemVazio").text($(this).attr('msgVazio'));
	        		$("#mensagemCampoVazio").show();
	        		$(this).focus();
	        		return false;
    			}
    		} 
    	})
    	
    	//Se a div de erro está visivel para aqui.
    	if ($("#mensagemCampoVazio").is(':visible')) return false;
    	
    	if (validarCPF($("#inputCpfAluno").val()) == false){
    		$("#textoMensagemVazio").text('CPF inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputCpfAluno").focus();
    		return false;
    	}
    	
    	if ($("#inputCepAluno").val().length < 10){
    		$("#textoMensagemVazio").text('CEP inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputCepAluno").focus();
    		return false;
    	}
    	
    	if(validaEmail($("#inputEmailAluno").val()) == false){
    		$("#textoMensagemVazio").text('Email inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputEmailAluno").focus();
    		return false;    		
    	}
    	
    	if ($('#inputSenhaAluno').val() != $('#inputSenhaConfirmAluno').val()){
			$("#textoMensagemVazio").text('Os campos senha e confirmação da senha devem ser iguais');
    		$("#mensagemCampoVazio").show();
    		$('#inputSenhaAluno').focus();
			return false;    		
    	}
    	
    	//dados da tabela usuário
    	var nome = $("#inputNomeAluno").val();
    	var escolaGrupo = $("#selectProfessorAluno").val().split('_');
    	var escola = escolaGrupo[0];
    	var grupo = escolaGrupo[1];
    	
    	var professor = $("#selectProfessorAluno").val();
        var periodo = $("#selectPeriodoAluno").val();
        var serie = $("#selectSerieAluno").val();
        var nascimento = $("#inputNascimentoAluno").val();
        var rg = $("#inputRgAluno").val();
        var cpf = $("#inputCpfAluno").val();
        var ano = $("#selectAnoAluno").val();
        
        //Dados da tabela endereço do aluno!
        var rua = $("#inputRuaAluno").val();
        var bairro = $("#inputBairroAluno").val();
        var cidade = $("#inputCidadeAluno").val();
        var numCasa = $("#inputNumCasaAluno").val();
        
        var compCasa = $('#inputCompCasaAluno').val();
        
        var estado = $("#inputEstadoAluno").val();
        var cep = $("#inputCepAluno").val(); 
        var celular = $("#inputTelCelAluno").val();
        var telResidencial = $("#inputTelResAluno").val();
        var telComercial = $("#inputTelComAluno").val();
        var email = $("#inputEmailAluno").val();
        var login = $("#inputUsuarioAluno").val();
        var senha = $("#inputSenhaAluno").val();

        $.ajax({
            url:'ajax/cadastroAjax.php',
            type:'post',
            dataType:'json',
            data: {
                'acao': 'novoUsuario',
                'perfil': '1',
                'nome': nome,
                'professor': professor,
                'periodo': periodo,
                'escola': escola,
                'serie': serie,
                'ano': ano,
                'grupo': grupo,
        		'grauInstrucao':'null',
        		'categoria':'null',
                'nascimento': nascimento,
                'rg': rg,
                'cpf': cpf,
                'rua': rua,
                'bairro': bairro,
                'cidade':cidade,
                'numCasa': numCasa,
                'complemento': compCasa,
                'estado': estado,
                'cep': cep,
                'celular': celular,
                'telResidencial': telResidencial,
                'telComercial': telComercial,
                'email': email,
                'nse':'',
                'login':login,
                'senha':senha
            },
            success:function(retorno){
        		if (retorno.erro == false) $("#mensagemSucessoCadastro").show();
	           		else {
	           			$("#textoMensagemVazio").text(retorno.msg);
	           			$("#mensagemCampoVazio").show();
	           		}
            	return false;
            },
            error:function(data){
            	$("#mensagemErroCadastro").show();
            	return false;
            }
        });
        return false;
    });

    $("#cadastroProfessor").click(function(){

    	$('.obrigatorioProf').each(function(){
    		if ($(this).val() == '' || $(this).val() == null ){
    			if ($(this).attr('id') == 'inputTelResProf'){	//Verifica se existe ao menos um telefone cadastrado!
    				if ($('#inputTelCelProf').val() == '' && $('#inputTelComProf').val() == ''){
    					$("#textoMensagemVazio").text($(this).attr('msgVazio'));
    	        		$("#mensagemCampoVazio").show();
    	        		$(this).focus();
    					return false;
    				}
    			}else{
	    			$("#textoMensagemVazio").text($(this).attr('msgVazio'));
	        		$("#mensagemCampoVazio").show();
	        		$(this).focus();
	        		return false;
    			}
    		} 
    	})
    	
    	//Se a div de erro está visivel para aqui.
    	if ($("#mensagemCampoVazio").is(':visible')) return false;
    	
    	if (validarCPF($("#inputCpfProf").val()) == false){
    		$("#textoMensagemVazio").text('CPF inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputCpfAluno").focus();
    		return false;
    	}
    	
    	if ($("#inputCepProf").val().length < 10){
    		$("#textoMensagemVazio").text('CEP inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputCepAluno").focus();
    		return false;
    	}
    	
    	if(validaEmail($("#inputEmailProf").val()) == false){
    		$("#textoMensagemVazio").text('Email inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputEmailAluno").focus();
    		return false;    		
    	}
    	
    	if ($('#inputSenhaProf').val() != $('#inputSenhaConfirmProf').val()){
			$("#textoMensagemVazio").text('Os campos senha e confirmação da senha devem ser iguais');
    		$("#mensagemCampoVazio").show();
    		$('#inputSenhaAluno').focus();
			return false;    		
    	}

    	var nomeProfessor = $("#inputNomeProf").val();
    	var dataNascimentoProfessor = $("#inputNascimentoProf").val();
    	var rgProfessor = $("#inputRgProf").val();
    	var cpfProfessor = $("#inputCpfProf").val();
    	var loginProfessor = $("#inputUsuarioProf").val();
    	var senhaProfessor = $("#inputSenhaProf").val();
    	
    	var ruaProfessor = $("#inputRuaProf").val();
    	var bairroProfessor = $("#inputBairroProf").val();
    	var numeroCasa = $("#inputNumCasaProf").val();
    	var compCasa = $("#inputCompCasaProf").val();
    	var cidadeProfessor = $("#inputCidadeProf").val();
    	var ufProfessor = $("#inputEstadoProf").val();
    	var cepProfessor = $("#inputCepProf").val();
    	var telResidencial = $("#inputTelResProf").val();
    	var celular = $("#inputTelCelProf").val();
    	var telComercial = $("#inputTelComProf").val();
    	var emailProfessor = $("#inputEmailProf").val();
    	var emailProfessor = $("#inputEmailProf").val();
    	
    	var grauInstrucao = $("#selectGrauProf").val();
    	var categoria = $("#selectCategoriaProf").val();
    	var serie = $("#selectSerieProf").val();
    	
    	$.ajax({
        	url:'ajax/cadastroAjax.php',
        	type:'post',
        	dataType:'json',
        	data:{'acao':'novoUsuario',
    			'perfil':'2',
        		'nome':nomeProfessor,
        		'nascimento':dataNascimentoProfessor,
        		'rg':rgProfessor,
        		'cpf':cpfProfessor,
        		'ano':'null',
        		'turma':'null',
        		'grupo':'null',
        		'serie':serie,
        		'grauInstrucao': grauInstrucao,
        		'categoria':categoria,
        		'rua':ruaProfessor,
        		'bairro':bairroProfessor,
        		'numCasa':numeroCasa,
        		'cidade':cidadeProfessor,
        		'estado':ufProfessor,
        		'cep':cepProfessor,
        		'telResidencial':telResidencial,
        		'complemento':compCasa,
        		'telComercial':telComercial,
        		'celular':celular,
        		'nse':'',
        		'email':emailProfessor,
        		'login':loginProfessor,
        		'escola':'',
        		'senha':senhaProfessor},
        	success:function(retorno){
        		if (retorno.erro == false) {
        			$("#mensagemSucessoCadastro").show();
        			listaProfessores(); //Lista os professores novamente para aparecer o professor recem-cadsatrado (se precisar)
        		}else {
               			$("#textoMensagemVazio").text(retorno.msg);
               			$("#mensagemCampoVazio").show();
               		}

               	return false;
            },
                error:function(data){
               	$("#mensagemErroCadastro").show();
                	return false;
        	}
        });	
    	return false;
   	});
   
    //Cadastro daescola.
    $("#cadastroEscola").click(function(){

    	$('.obrigatorioEscola').each(function(){
    		if ($(this).val() == '' || $(this).val() == null ){
    			$("#textoMensagemVazio").text($(this).attr('msgVazio'));
	        	$("#mensagemCampoVazio").show();
	        	$(this).focus();
	        	return false;
    		} 
    	})
    	
    	//Se a div de erro está visivel para aqui.
    	if ($("#mensagemCampoVazio").is(':visible')) return false;
    	
    	if (validaCNPJ($("#inputCnpjEscola").val()) == false){
    		$("#textoMensagemVazio").text('CNPJ inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputCpfAluno").focus();
    		return false;
    	}
    	
    	if ($("#inputCepEscola").val().length < 10){
    		$("#textoMensagemVazio").text('CEP inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputCepAluno").focus();
    		return false;
    	}
    	
    	if(validaEmail($("#inputEmailEscola").val()) == false){
    		$("#textoMensagemVazio").text('Email inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputEmailAluno").focus();
    		return false;    		
    	}
    	
    	if ($('#inputSenhaEscola').val() != $('#inputSenhaConfirmEscola').val()){
			$("#textoMensagemVazio").text('Os campos senha e confirmação da senha devem ser iguais');
    		$("#mensagemCampoVazio").show();
    		$('#inputSenhaAluno').focus();
			return false;    		
    	}

    	var nomeEscola = $("#inputNomeEscola").val();
    	var razao = $("#inputRazaoEscola").val();
    	var codigoEscola = $("#inputCodigoEscola").val();
    	var nse = $("#inputNseEscola").val();
    	var cnpj = $("#inputCnpjEscola").val();
    	var adm = $("#inputAdmEscola").val();
    	var tipo = $("#inputTipoEscola").val();
    	var enderecoEscola = $("#inputRuaEscola").val();
    	var bairroEscola = $("#inputBairroEscola").val();
    	var numeroEnderecoEscola = $("#inputNumCasaEscola").val();
    	var complemento = $("#inputCompCasaEscola").val();
    	var cidadeEscola = $("#inputCidadeEscola").val();
    	var ufEscola = $("#inputEstadoEscola").val();
    	var cepEscola = $("#inputCepEscola").val();
    	var telefoneEscola = $("#inputTelefoneEscola").val();
    	var emailEscola = $("#inputEmailEscola").val();
    	var loginEscola = $("#inputUsuarioEscola").val();
    	var senhaEscola = $("#inputSenhaEscola").val();
    	
    	$.ajax({
    		url:'ajax/cadastroAjax.php',
    		type:'post',
    		dataType:'json',
    		data:{
    			'acao':'cadastraEscola',
    			'perfil': '4',
    			'nomeEscola':nomeEscola,
    			'razao':razao,
    			'cnpj':cnpj,
    			'nse':nse,
    			'codigoEscola':codigoEscola,
    			'tipoEscola':tipo,
    			'adm':adm,
    			'enderecoEscola':enderecoEscola,
    			'bairroEscola':bairroEscola,
    			'complemento':complemento,
    			'numeroEnderecoEscola':numeroEnderecoEscola,
    			'cidadeEscola':cidadeEscola,
    			'ufEscola':ufEscola,
    			'cepEscola':cepEscola,
    			'telefoneEscola':telefoneEscola,
    			'emailEscola':emailEscola,
    			'loginEscola':loginEscola,
    			'senhaEscola':senhaEscola
    		},
    		success:function(retorno){
    			if (retorno.erro == false) {
    				$("#mensagemSucessoCadastro").show();
    	        	listarEscolas();	//Lista es escolas novamente colocando a recem cria e zera a lista dos professores.
    	        	$('#selectProfessorAluno').html('<option value="" disabled selected>Selecione primeiro a escola e a série</option>');
    			}else {
               			$("#textoMensagemVazio").text(retorno.msg);
        	        	$("#mensagemCampoVazio").show();
               		}
               	return false;
    		},
    		error:function(data){
            	$("#mensagemErroCadastro").show();
            	return false;
            }
    	});    		
    	
    	return false;
    });
    
    
}); //Fim

//Classe Perfil Aluno
function PerfilAluno(id, nome, escola, professor, sala, periodo, nascimento, rg, cpf, rua, num, complemento, cep, bairro, estado, cidade, telResidencial, telCelular, telComercial, email, usuario) {
    self = this;
    
    this.id = id;
    this.nome = nome;
    this.escola = escola;
    this.professor = professor;
    this.sala = sala;
    this.periodo = periodo
    this.nascimento = nascimento;
    this.rg = rg;
    this.cpf = cpf;
    this.rua = rua;
    this.num = num;
    this.complemento = complemento;
    this.cep = cep;
    this.bairro = bairro;
    this.estado = estado;
    this.pais = 'Brasil';
    this.cidade = cidade;
    this.telResidencial = telResidencial;
    this.telCelular = telCelular;
    this.telComercial = telComercial;
    this.email = email;
    this.usuario = usuario;
    
    this.gerarHTML = function () {
        var html = '';
        
        html +=
        '<a href="#updateAlunoCont'+this.id+'" class="accordion_info_toggler updateAlunoToggler" data-toggle="collapse">'+
            '<div class="accordion_info" id="updateAlunoInfo'+this.id+'">'+this.nome+'</div>'+
        '</a>'+
        '<div class="accordion_content collapse" id="updateAlunoCont'+this.id+'">'+
            '<div class="content_col_info">';
        
        html += 
                '<table>'+
                    '<tr class="content_info_row">'+
                         '<td colspan="3"><span class="content_info_label">Escola:</span> <span class="content_info_txt">'+this.escola+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="2"><span class="content_info_label">Professor:</span> <span class="content_info_txt">'+this.professor+'</span></td>'+
                        '<td><span class="content_info_label">Sala:</span> <span class="content_info_txt">'+this.sala+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td><span class="content_info_label">Nascimento:</span> <span class="content_info_txt">'+this.nascimento+'</span></td>'+
                        '<td><span class="content_info_label">RG:</span> <span class="content_info_txt">'+this.rg+'</span></td>'+
                        '<td><span class="content_info_label">CPF:</span> <span class="content_info_txt">'+this.cpf+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="2">'+
                            '<span class="content_info_label">Endereço:</span> '+
                            '<span class="content_info_txt">'+
                                this.rua+', '+this.num+(this.complemento != '' && this.complemento != undefined ? ', '+this.complemento : '')+' - '+this.bairro+' - '+this.cidade+' - '+this.estado+
                            '</span>'+
                        '</td>'+
                        '<td><span class="content_info_label">CEP:</span> <span class="content_info_txt">'+this.cep+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td><span class="content_info_label">Tel.:</span> <span class="content_info_txt">'+this.telResidencial+'</span></td>'+
                        '<td colspan="2"><span class="content_info_label">E-mail:</span> <span class="content_info_txt">'+this.email+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="3"><span class="content_info_label">Usuário:</span> <span class="content_info_txt">'+this.usuario+'</span></td>'+
                    '</tr>'+
                '</table>';
        
        html +=
            '</div>'+
            '<div class="content_col_btns">'+
                '<button id="btnDelAluno'+this.id+'" class="section_btn btn_del_cad btnDelCadAluno">Excluir cadastro</button>'+
                '<button id="btnUpdateAluno'+this.id+'" class="section_btn btn_update_cad btnUpdateCadAluno">Alterar Dados</button>'+
            '</div>'+
        '</div>';
        
        return html;
    }
    this.gerarForm = function () {
        $('#inputTurmaAluno').val(this.sala);
        $('#inputNomeAluno').val(this.nome);
        $('#inputNascimentoAluno').val(this.nascimento);
        $('#inputRgAluno').val(this.rg);
        $('#inputCpfAluno').val(this.cpf);
        $('#inputRuaAluno').val(this.rua);
        $('#inputNumCasaAluno').val(this.num);
        $('#inputCompCasaAluno').val(this.complemento);
        $('#inputCepAluno').val(this.cep);
        $('#inputBairroAluno').val(this.bairro);
        $('#inputTelResAluno').val(this.telResidencial);
        $('#inputTelCelAluno').val(this.telCelular);
        $('#inputTelComAluno').val(this.telComercial);
        $('#inputEmailAluno').val(this.email);
        $('#inputUsuarioAluno').val(this.usuario);
    }
    this.deletar = function() {
        $('#updateAlunoInfo'+this.id).parent('a').remove();
        $('#updateAlunoCont'+this.id).remove();
    }
}

//Classe Perfil Professor
function PerfilProfessor(id, nome, nascimento, rg, cpf, rua, numero, complemento, cep, bairro, estado, cidade, telResidencial, telCelular, telComercial, email, escola, sala, periodo, usuario) {
    self = this;
    
    this.id = id;
    this.nome = nome;
    this.nascimento = nascimento;
    this.rg = rg;
    this.cpf = cpf;
    this.rua = rua;
    this.numero = numero;
    this.complemento = complemento;
    this.cep = cep;
    this.bairro = bairro;
    this.estado = estado;
    this.cidade = cidade;
    this.telResidencial = telResidencial;
    this.telComercial = telComercial;
    this.telCelular = telCelular;
    this.email = email;
    this.escola = escola;
    this.sala = sala;
    this.periodo = periodo;
    this.usuario = usuario;
    
    this.gerarHTML = function () {
        var html = '';
        
        html +=
        '<a href="#updateProfCont'+this.id+'" class="accordion_info_toggler updateProfToggler" data-toggle="collapse">'+
            '<div class="accordion_info" id="updateProfInfo'+this.id+'">Andressa de Cardoso Dias</div>'+
        '</a>'+
        '<div class="accordion_content collapse" id="updateProfCont'+this.id+'">'+
            '<div class="content_col_info">';
            
        html +=    
                '<table>'+
                    '<tr class="content_info_row">'+
                        '<td><span class="content_info_label">Nascimento:</span> <span class="content_info_txt">'+this.nascimento+'</span></td>'+
                        '<td><span class="content_info_label">RG:</span> <span class="content_info_txt">'+this.rg+'</span></td>'+
                        '<td><span class="content_info_label">CPF:</span> <span class="content_info_txt">'+this.cpf+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="2"><span class="content_info_label">Endereço:</span> <span class="content_info_txt">'+
                            this.rua + ', ' + this.numero + (this.complemento != '' ? ', '+this.complemento : '') + ' - ' + this.bairro + ' - ' + this.cidade + ' - ' + this.estado +'</span></td>'+
                        '<td><span class="content_info_label">CEP:</span> <span class="content_info_txt">'+this.cep+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td><span class="content_info_label">Tel.:</span> <span class="content_info_txt">+'+this.telResidencial+'</span></td>'+
                        '<td colspan="2"><span class="content_info_label">E-mail:</span> <span class="content_info_txt">'+this.email+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="3"><span class="content_info_txt">'+ this.escola + ' - ' + this.sala + ' - ' + this.periodo +'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="3"><span class="content_info_label">Usuário</span> <span class="content_info_txt">'+this.usuario+'</span></td>'+
                    '</tr>'+
                '</table>';
                
        html +=
            '</div>'+
            '<div class="content_col_btns">'+
                '<button id="btnDelProf'+this.id+'" class="section_btn btn_del_cad btnDelCadProf">Excluir cadastro</button>'+
                '<button id="btnUpdateProf'+this.id+'" class="section_btn btn_update_cad btnUpdateCadProf">Alterar Dados</button>'+
            '</div>'+
        '</div>';
    
        return html;
    }
    this.gerarForm = function () {
        $('#inputNomeProf').val(this.nome);
        $('#inputNascimentoProf').val(this.nascimento);
        $('#inputRgProf').val(this.rg);
        $('#inputCpfProf').val(this.cpf);
        $('#inputRuaProf').val(this.rua);
        $('#inputNumCasaProf').val(this.numero);
        $('#inputCompCasaProf').val(this.complemento);
        $('#inputCepProf').val(this.cep);
        $('#inputBairroProf').val(this.bairro);
        $('#inputTelResProf').val(this.telResidencial);
        $('#inputTelCelProf').val(this.telCelular);
        $('#inputTelComProf').val(this.telComercial);
        $('#inputEmailProf').val(this.email);
        $('#inputUsuarioProf').val(this.usuario);
    }
    this.deletar = function() {
        $('#updateProfInfo'+this.id).parent('a').remove();
        $('#updateProfCont'+this.id).remove();
    }
}

//Classe Perfil Escola
function PerfilEscola() {
    self = this;

    this.id = id;
    this.codigo = codigo; 
    this.rua = rua;
    this.numero = numero;
    this.complemento = complemento;
    this.cep = cep;
    this.bairro = bairro;
    this.pais = 'Brasil';
    this.estado = estado;
    this.cidade = cidade;
    this.telefone = telefone;
    this.email = email;
    this.usuario = usuario;
}

function tabNavigation(tabToShow) {
	for ( var i = 0; i < tabs.length; i++ ) {
		if ( tabs[i] == tabToShow ) {
			$($(containers).get(i)).show();
			$($(btns).get(i)).show();

			$($(tabs).get(i)).addClass('tab_cadastro_ativo');
		} else {
			$($(containers).get(i)).hide();
			$($(btns).get(i)).hide();

			$($(tabs).get(i)).removeClass('tab_cadastro_ativo');
		}
	}
}

function cancelDelPerfil() {
    delPerfilId = '0';
}

function confirmDelPerfil() {
    for ( var a in perfisAlunosGerados ) {
        if ( perfisAlunosGerados[a].id == delPerfilId ) {
            perfisAlunosGerados[a].deletar();
            break;
        }
    }
}


function formatar(mascara, documento){
    var i = documento.value.length;
    var saida = mascara.substring(0,1);
    var texto = mascara.substring(i)
    
    if (texto.substring(0,1) != saida){
       documento.value += texto.substring(0,1);
    }
  	  
  }

function listaProfessores(){
	
	if ($('#selectEscolaAluno').val() == null || $('#selectSerieAluno').val() == null){
		$('#selectProfessorAluno').html('<option value="" disabled selected>Selecione primeiro a escola e a série</option>');
		return false;
	}
	$.ajax({
        url:'ajax/cadastroAjax.php',
        type:'post',
        dataType:'html',
        data: {
            'acao': 'listaProfessoresByEscolaAndSerie',
            'serie': $('#selectSerieAluno').val(),
            'escola': $('#selectEscolaAluno').val()
        },
        success:function(retorno){
        	$('#selectProfessorAluno').html(retorno);
        }
    });
	return false;
}

function listarEscolas(){
	$.ajax({
        url:'ajax/cadastroAjax.php',
        type:'post',
        dataType:'html',
        data: {
            'acao': 'listaEscolas'
        },
        success:function(retorno){
        	$('#selectEscolaAluno').html(retorno);
        }
    });
	return false;
}
