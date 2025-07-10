<?php
    session_start();


    include('db/conexao.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_usuario = mysqli_real_escape_string($conexao, $_SESSION['cliente_id']);
        $nome = mysqli_real_escape_string($conexao, $_SESSION['cliente_nome']);
        $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
        $mensagem = mysqli_real_escape_string($conexao, $_POST['mensagem']);
        $servico = mysqli_real_escape_string($conexao, $_POST['servico']);


        $query = "INSERT INTO agendamentos (id_usuario, nome, telefone, mensagem, servico) VALUES ('$id_usuario', '$nome', '$telefone', '$mensagem', '$servico')";
        if (mysqli_query($conexao, $query)) {
        /*  echo "<p><strong>Solicitação recebida. Entraremos em contato!</strong></p>"; */
        header('Location: pedidos.php');
            exit;
        } else {
            echo "<p><strong>Erro ao enviar solicitação.</strong></p>";
        }
    }


    // Se usuário NÃO está logado, salva a página atual para redirecionar depois
    if (!isset($_SESSION['cliente_id'])) {
        // Salva a URL atual (servicos.php)
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    }

?>


<?php include('includes/header.php'); ?>

    <h1 class="titulo-center">Serviços de Manutenção</h1>

    <section class="servicos-cards">
        <div class="card-servico">
            <img src="imagens/mecanica.png" alt="Mecânica em Geral">
            <h3>Mecânica em Geral</h3>
            <p>Solucionamos seus problemas e fazemos reparos duradouros.</p>
        </div>
        <div class="card-servico">
            <img src="imagens/restauracao.jpg" alt="Restauração">
            <h3>Restauração</h3>
            <p>Reconstruímos peças originais com acabamento fiel ao modelo de fábrica.</p>
        </div>
        <div class="card-servico">
            <img src="imagens/eletrica2.jpg" alt="Elétrica">
            <h3>Elétrica</h3>
            <p>Diagnóstico e reparo completo da parte elétrica e iluminação clássica.</p>
        </div>
        <div class="card-servico">
            <img src="imagens/oleo.png" alt="Troca de Óleo">
            <h3>Troca de Óleo</h3>
            <p>Utilizamos óleo recomendado para motores clássicos com troca de filtro incluso.</p>
        </div>
        <div class="card-servico">
            <img src="imagens/carburador.jpg" alt="Limpeza de Carburador">
            <h3> Limpeza de Carburador </h3>
            <p>Reparo e limpeza completa de Carburadores.</p>
        </div>
        <div class="card-servico">
            <img src="imagens/manutencao.jpg" alt="Troca de Peças">
            <h3> Troca de Peças </h3>
            <p>Troca de peças danificadas e irrecuperáveis.</p>
        </div>
        <div class="card-servico">
            <img src="imagens/bateria.jpg" alt="Substituição de Bateria">
            <h3> Substituição de Bateria </h3>
            <p>Substituição da bateria e os conectores relacionados.</p>
        </div>
        <div class="card-servico">
            <img src="imagens/manutencao.jpg" alt="Manutenção preventiva">
            <h3> Manutenção preventiva </h3>
            <p>Vistoria e manutenção preventiva para aumentar a vida útil das suas peças.</p>
        </div>
    </section>

    <section class="form-agendamento">
        <h2 class="titulo-center">Agende seu atendimento</h2>

        <?php if (isset($_SESSION['cliente_id'])): ?>
            <form method="POST" action="servicos.php" class="form-servicos-atendimento">
                <input type="text" value="<?= htmlspecialchars($_SESSION['cliente_nome']) ?>" readonly>

                <input type="text" name="telefone" placeholder="Telefone" required>

                <label for="servico">Escolha o serviço:</label>
                <select name="servico" required>
                    <option value="Troca de óleo">Troca de óleo</option>
                    <option value="Revisão completa">Revisão completa</option>
                    <option value="Limpeza de Carburador">Limpeza de Carburador</option>
                    <option value="Revisão Elétrica">Revisão Elétrica</option>
                    <option value="Revisão Mecânica">Revisão Mecânica</option>
                    <option value="Restauração">Restauração</option>
                    <option value="Substituição de Bateria">Substituição de Bateria</option>
                    <option value="Troca de Peça">Troca de Peça</option>
                </select>

                <textarea name="mensagem" placeholder="Descreva sua mensagem aqui..." rows="5" required></textarea>
                <input type="submit" value="Solicitar Serviço">
            </form>
        <?php else: ?>
            <p style="color: red; text-align: center; font-weight: 700;">
                Para solicitar um serviço, por favor <a href="login.php">faça login</a> ou <a href="cadastro.php">cadastre-se</a>.
            </p>
        <?php endif; ?>
    </section>


<?php include('includes/footer.php'); ?>

