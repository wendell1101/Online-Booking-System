<?php
    function sanitize($data){
        // protect from unwanted scripts
        return htmlspecialchars($data);
    }
?>