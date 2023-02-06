<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
<script src="script/script.js"></script>
<script defer >
    <?php
        //here I wanted to get the inputs loaded with the last data that user entered to search, so he can review the search result with the request that he made
    if (isset($_GET["check"])) {
        echo "
            document.querySelector('#range_min').value = " . $_GET["min"] . ";
            ";
        if ($_GET["max"]!=''){
            echo " document.querySelector('#range_max').value = " . $_GET["max"] . ";
            document.querySelector('option[value=\"" . $_GET["type"] . "\"]').setAttribute('selected','');
            ";
        }

    }
    ?>
</script>