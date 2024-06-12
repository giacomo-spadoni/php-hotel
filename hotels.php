<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

if (isset($_GET['parcheggio'])) {
    $filtroParcheggio = $_GET['parcheggio'];
    $filtrovoto = $_GET['voto'];

    $hotels = array_filter($hotels, function ($hotel) use ($filtrovoto) {
        return $hotel["vote"] >= $filtrovoto;
    });

    if ($filtroParcheggio == "si") {
        $hotels = array_filter($hotels, function ($hotel) {
            return $hotel['parking'] === true;
        });
    } elseif ($filtroParcheggio == "no") {
        $hotels = array_filter($hotels, function ($hotel) {
            return $hotel['parking'] === false;
        });
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>$hotels</title>
</head>

<body>
    <div id="app">
        <form action="hotels.php">
            <select name="parcheggio" id="parcheggio" required>
                <option value="" selected>seleziona un opzione</option>
                <option value="si">con parcheggio</option>
                <option value="no">senza parcheggio</option>
                <option value="entrambi">con e senza parcheggio</option>
            </select>
            <select name="voto" id="voto" required>
                <option value="" selected>seleziona un opzione</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button>cerca</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Hotel</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Voto</th>
                    <th>Distanza dal centro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hotels as $hotel) : ?>
                    <tr>
                        <td><?= $hotel["name"] ?></td>
                        <td><?= $hotel["description"] ?></td>
                        <td><?= $hotel["parking"] ? "si" : "no" ?></td>
                        <td><?= $hotel["vote"] ?></td>
                        <td><?= $hotel["distance_to_center"] ?> Km</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- <div><?= var_dump($hotels[0]); ?></div> -->
    </div>
    <script src="script.js"></script>
</body>

</html>