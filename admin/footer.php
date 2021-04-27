    <footer class="footer mt-auto py-3" style="background:rgba(102,102,102,0.5); padding:0px;color:white;">

        <p style="text-align: center; margin:0;padding:0;">
            <small>
                Project by:-
                Aditya Bodhankar |
                Komal Dhake |
                Kalpak Nemade |
                Vishal Chaudhari
            </small>
        </p>

    </footer>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    </body>

    </html>
    <script>
        $('.carousel').carousel({
            interval: 3000
        })
        $(".dropdown-menu a").click(function() {
            $(this).closest(".dropdown-menu").prev().dropdown("toggle");
        });
    </script>
    <script>
        document.body.onresize = resizeWindow();

        function resizeWindow() {
            document.body.style.height = window.innerHeight + 'px'
        }
    </script>