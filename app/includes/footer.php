<footer>
    <a href="index.php" class="logo"><img src="assets/img/logo2_dark.png" alt="logo"></a>
    <div class="footer-icons">
        <a href="#"><i class="icon fab fa-instagram text-dark"></i></a>
        <a href="#"><i class="icon fab fa-facebook-square text-dark"></i></a>
        <a href="#"><i class="icon fab fa-twitter-square text-dark"></i></a>
    </div>
</footer>

<!-- <script src="node_modules/flatpickr/dist/flatpickr.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="assets/js/flatpickr.min.js"></script>
<script src="assets/js/main.js"></script>

<script>
    const dateTime = document.getElementById('date_time');
    flatpickr("#date_time", {
        // minDate: "today",
        minTime: "16:00",
        maxTime: "22:00",
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
</script>
</body>

</html>