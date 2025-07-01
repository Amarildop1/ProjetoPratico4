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
    <h2>Agende seu atendimento</h2>
    <form method="POST" action="servicos.php">
        <input type="text" name="nome" placeholder="Seu nome" required>
        <input type="text" name="telefone" placeholder="Telefone" required>
        <textarea name="mensagem" placeholder="Serviço desejado" rows="5" required></textarea>
        <input type="submit" value="Enviar Solicitação">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<p><strong>Solicitação recebida. Entraremos em contato!</strong></p>";
    }
    ?>
</section>

<?php include('includes/footer.php'); ?>
