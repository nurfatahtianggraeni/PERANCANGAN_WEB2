<!DOCTYPE html>
<html>
<head>
    <title>Contoh Operasi Variabel PHP</title>
</head>
<body>
    <?php
    $a = 3;
    $b = 7;

    // Operasi pada variabel
    $a += 5;               // sama dengan $a = $a + 5
    $b = ($c = 11) + 3;    // $c diisi 11, lalu $b = 11 + 3

    // Output
    echo "Nilai variabel a adalah = $a <br>";
    echo "Nilai variabel b adalah = $b <br>";
    echo "Nilai variabel c adalah = $c <br>";
    ?>
</body>
</html>