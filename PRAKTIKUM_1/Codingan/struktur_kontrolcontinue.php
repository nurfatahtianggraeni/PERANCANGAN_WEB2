<?php
for ($i = 1; $i <= 10; $i++) {
    if (!($i % 2)) {
        continue; // skip jika $i genap
    }
    echo "\$i = $i <br>";
}
?>