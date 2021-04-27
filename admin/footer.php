    <footer class="footer mt-auto py-3" style="background:rgba(102,102,102,0.5); padding:0px;color:white;">
            
            <p style="text-align: center; margin:0;padding:0;" >
                <small>
                    Project by:- 
                    <a href="http://www.aditya.team/" style="color:white;" class="btn btn-a btn-sm"><img src="../images/logoaditya.png" width="30">&nbsp;Aditya Bodhankar</a>
                    <a href="#" style="color:white;" class="btn btn-a btn-sm"><img src="#"  width="30">Vishal Chaudhari</a>
                    <a href="#" style="color:white;" class="btn btn-a btn-sm"><img src="#"  width="30">Komal Dhake</a>
                </small>
            </p>

    </footer>
    <style>
        html{
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