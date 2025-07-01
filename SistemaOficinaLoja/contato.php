<?php include('includes/header.php'); ?>

<h1 class="titulo-center">Fale Conosco</h1>

<section class="form-contato">
    <form method="POST" action="contato.php">
        <input type="text" name="nome" placeholder="Seu nome" required>
        <input type="email" name="email" placeholder="Seu e-mail" required>
        <textarea name="mensagem" placeholder="Digite sua mensagem" rows="5" required></textarea>
        <input type="submit" value="Enviar">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<p><strong>Obrigado por entrar em contato! Responderemos em breve.</strong></p>";
        }
    ?>
</section>

<section class="info-contato">
    <p><strong>Endereço:</strong> Rua das Motos, 123 - Praia, Recife - PE</p>
    <p><strong>Telefone:</strong> (81) 99999-0000</p>
    <p><strong>Email:</strong> contato@motosemotores.com</p>

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.3907910394028!2d-34.874434887018815!3d-8.061594420927571!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7ab18a48f03c145%3A0xef4ac38fd080a24!2sPra%C3%A7a%20do%20Marco%20Zero!5e0!3m2!1spt-BR!2sbr!4v1750394107632!5m2!1spt-BR!2sbr" 
        width="100%" height="300" style="border:0;" allowfullscreen>
    </iframe>
</section>

<?php include('includes/footer.php'); ?>
