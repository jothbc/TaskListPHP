<?php
    $path = "../../app_lista_tarefas/";
    require $path . "tarefa.model.php";
    require $path . "tarefa.service.php";
    require $path . "conexao.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if ($acao == 'inserir') {
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);
        $conexao = new Conexao();
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();
        header('Location: nova_tarefa.php?inclusao=1');
    } else if ($acao == 'recuperar') {
        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar();
    } else if ($acao == 'atualizar' || $acao == 'atualizar2') {
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_POST['id']);
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();
        $tarefaService = new TarefaService($conexao, $tarefa);
        if ($tarefaService->atualizar()) {
            if($acao == "atualizar"){
                header('Location: todas_tarefas.php');
            }
            else if($acao == "atualizar2"){
                header('Location: index.php');
            }
        }
    } else if ($acao == 'remover' || $acao == 'remover2') {
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);

        $conexao = new Conexao();
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->remover();
        if($acao=='remover'){
            header('Location: todas_tarefas.php');
        }
        else if($acao=='remover2'){
            header('Location: index.php');
        }
    }
    else if($acao == 'marcarRealizada' || $acao == 'marcarRealizada2'){
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id'])
            ->__set('id_status', 2);

        $conexao = new Conexao();
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->marcarRealizada();
        if($acao == 'marcarRealizada'){
            header('Location: todas_tarefas.php');
        }else if($acao == 'marcarRealizada2'){
            header('Location: index.php');
        }
    }
?>
