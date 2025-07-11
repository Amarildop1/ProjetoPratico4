
    </main>

    <footer>
        &copy; <?= date('Y') ?> Motos e Motores - Todos os direitos reservados.
    </footer>
    
    <script>
        const btnMenu = document.getElementById('btn-menu');
        const menuLista = document.getElementById('menu-lista');

        btnMenu.addEventListener('click', () => {
            menuLista.classList.toggle('aberto');
        });
    </script>

    </body>
</html>
