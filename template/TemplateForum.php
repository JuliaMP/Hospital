<?php

if (!isset($_SESSION['PATH_SYS'])) {
    session_start();
}

$path = $_SESSION['PATH_SYS'];
include_once($path['controller'] . 'ForumQuestaoController.php');
include_once($path['controller'] . 'ForumRespostaController.php');
include_once($path['controller'] . 'ForumTopicoController.php');
include_once($path['controller'] . 'ForumViewController.php');
include_once($path['controller'] . 'ForumQuestaoParticipanteController.php');
include_once($path['controller'] . 'UsuarioController.php');
include_once($path['funcao'] . 'DatasFuncao.php');

/**
 * Description of Template
 *
 * @author MuranoDesign
 */
class TemplateForum {

    public static $path;

    function __construct() {
        self::$path = $_SESSION['URL_SYS'];
    }

    public function listaAlunos() {
        $forumController = new ForumQuestaoController();
        $viewController = new ForumViewController();
        $respController = new ForumRespostaController();
        $frqParticipante = new ForumQuestaoParticipanteController();
        $dataFuncao = new DatasFuncao();
        $idusr = (unserialize($_SESSION["USR"])["id"]);

        $questoes = $forumController->selectAprovadas();
        $cont = 0;

        function verificarAlteracaoQuestao($fqp, $frr) {
            $fqp_d = strtotime($fqp->getFqp_ultima_visualizacao());
            $frr_d = strtotime($frr->getFrr_data());
            
            if ($fqp_d - $frr_d < 0)
                return true;
            else
                return false;
        }

        foreach ($questoes as $key => $value) {
            $resp = $respController->totalByQuestao($value->getFrq_id());
            $labelNovo = "";

            if ($frqParticipante->verificarParticipante($value->getFrq_id(), $idusr)) {
                $fqp = $frqParticipante->getUltimaVisualizacao($value->getFrq_id(), $idusr);
                $frr = $respController->getMaisRecenteByQuestao($value->getFrq_id());

                if ($frr && verificarAlteracaoQuestao($fqp, $frr))
                    $labelNovo = "<span class=\"badge\">Novo</span>";
            }


            if ($cont % 2 == 0) {
                $caixaGrande = "cx_rosa";
                $caixaPequena = "cx_brancaP";
            } else {
                $caixaGrande = "cx_branca";
                $caixaPequena = "cx_rosaP";
            }

            if (file_exists("imgp/".$value->getFrq_usuario()->getUsr_imagem()))
                $foto = $value->getFrq_usuario()->getUsr_imagem();
            else
                $foto = 'default.png';

            $idfrq  = $value->getFrq_id();
            $frq    = utf8_encode($value->getFrq_questao());
            $usr    = utf8_encode($value->getFrq_usuario()->getUsr_nome());
            $frt    = utf8_encode($value->getFrq_topico()->getFrt_topico());
            $data   = $dataFuncao->dataTimeBRExibicao($value->getFrq_data());
            $views  = $value->getFrq_visualizacoes();

            echo '<a onclick="incrementarVisualizacoes('.$idfrq.')" href="forumResposta.php?resp='.$idfrq.'" id="caixaQuestao'.$idfrq.'">';
            echo     '<div id="perg_box'.$idfrq.'" class="perg_box '.$caixaGrande.' row">';
            echo         '<div class="perg_box_1 col-xs-12 col-md-7 col-lg-7">';
            echo             '<p class="foto_aluno"><img src="imgp/'.$foto.'"></p>';
            echo             '<p class="perg_aluno questaoTexto" id="'.$idfrq.'">'.$frq.' '.$labelNovo.'</p>';
            echo             '<p class="nome_aluno">'.$usr.'</p>';
            echo             '<p class="post_data">Tópico: '.$frt.' | Postado dia '.$data.'</p>';
            echo         '</div>';
            echo         '<div class="perg_box_2 col-xs-12 col-md-5 col-lg-5">';
            echo             '<p id="qtd_visu'.$idfrq.'" class="qtd_visu '.$caixaPequena.'"><span>'.$views.'</span> visualizações</p>';
            echo             '<p id="qtd_resp'.$idfrq.'" class="qtd_resp '.$caixaPequena.'"><span>'.$resp.'</span> respostas</p>';
            echo         '</div>';
            echo     '</div>';
            echo '</a>';

            $cont++;
        }
    }

    public function listarTopicosPendentes() {
        $usuario = unserialize($_SESSION['USR']);
        $perfilLogado = $usuario["perfil_id"];
        $dataFuncao = new DatasFuncao();

        if (intval($perfilLogado) === 2 || intval($perfilLogado) === 4) {
            $forumQuestaoController = new ForumQuestaoController();
            $questoesPendentes = $forumQuestaoController->selectPendentes();
            
            function verificarImagem($arquivo) {
                if (file_exists("imgp/" . $arquivo))
                    return $arquivo;
                else
                    return "default.png";
            }

            echo "<div id=\"box_questoes_pendentes_container\">";
            echo    "<div id=\"box_questoes_pendentes\">";

            if (count($questoesPendentes) > 0) {
                foreach ($questoesPendentes as $questao) {
                    echo "<div id=\"box_questao" . $questao->getFrq_id() . "\">";
                    echo    "<div class=\"row perg_box\">";
                    echo        "<div class=\"perg_box_1 col-xs-12 col-md-9\">";
                    echo            "<p class=\"foto_aluno\"><img src=\"imgp/" . verificarImagem($questao->getFrq_usuario()->getUsr_imagem()) . "\"></p>";
                    echo            "<p id=\"" . $questao->getFrq_id() . "\" class=\"perg_aluno questaoTexto\">" . utf8_encode($questao->getFrq_topico()->getFrt_topico()) . "</p>";
                    echo            "<p class=\"nome_aluno\">Questão: " . utf8_encode($questao->getFrq_questao()) . "</p>";
                    echo            "<p class=\"post_data\">Solicitante: " . $questao->getFrq_usuario()->getUsr_nome() . " | Solicitado dia " . $dataFuncao->dataTimeBRExibicao($questao->getFrq_data()) . "</p>";
                    echo        "</div>";
                    echo        "<div class=\"btns_container col-xs-12 col-md-3\">";
                    echo            "<button type=\"button\" data-action=\"aceitar\" data-topico=\"" . $questao->getFrq_topico()->getFrt_id() . "\" id=\"btn_aceitar" . $questao->getFrq_id() . "\" class=\"btn btn-primary\">Aceitar Tópico</p>";
                    echo            "<button type=\"button\" data-action=\"rejeitar\" data-topico=\"" . $questao->getFrq_topico()->getFrt_id() . "\" id=\"btn_rejeitar" . $questao->getFrq_id() . "\" class=\"btn\">Rejeitar tópico</p>";
                    echo        "</div>";
                    echo    "</div>";
                    echo "</div>";
                }
            } else {
                echo "<div class=\"alert_container\">";
                echo    "<div class=\"alert alert-warning\">Nenhum tópico ou questão pendente de aprovação.</div>";
                echo "</div>";
            }

            echo    "</div>";
            echo "</div>";
        }
    }
    
    public function countTopicosPendentes() {
        $forumTopicoController = new ForumTopicoController();
        $countTopicosPendentes = intval($forumTopicoController->countTopicosPendentes());
        
        if ($countTopicosPendentes > 0)
            return $countTopicosPendentes;
        else
            return false;
    }
    
    public function mostrarAbasForum() {
        $usuario = unserialize($_SESSION['USR']);
        $perfilLogado = $usuario["perfil_id"];
        
        if (intval($perfilLogado) === 2 || intval($perfilLogado) === 4){
            echo "<p class=\"titulo_box_forum ativo\" id=\"txt_postagens\">POSTAGENS RECENTES</p>";
            echo "<p class=\"titulo_box_forum\" id=\"txt_topicos_pendentes\">";
            echo    "TÓPICOS PENDENTES ";
            
            if ($this->countTopicosPendentes()) {
                echo "<span class=\"badge\">Novo</span>";
            }
            
            echo "</p>";
        } else {
            echo "<p class=\"titulo_box_forum ativo\" id=\"txt_postagens\">POSTAGENS RECENTES</p>";
        }
        
    }

}

?>
