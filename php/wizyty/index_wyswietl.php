<!DOCTYPE html>
<html lang="pl">
    <head>
        <title>Przychodnia "Zdrowie"</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../logo/logo.png" type="image/x-icon" />
        <meta name="description" content="Najlepsi w branży projektowej!" />
        <meta name="keywords" content="projekt" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="author" content="Wiktor Patajewicz" />
        <meta name="reply-to" content="wg833@zs1.lublin.eu" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <style>
            table, td
            {
                font-size: 15px;
                border: 1px solid #000;
                border-collapse: collapse;
                padding: 4px;
                text-align: left;
                margin: auto;
            }
        </style>
    </head>
    <body>
        
        <div id="container">
            <span class="bigtitle">Wyświetlanie zapisanych wizyt</span>
            <div style="height: 15px;"></div>

            <form method="POST">
                <input type="submit" name="Wyswietl_all" value="Wyświetl wszystkich wizyt">
            </form>
            <br><br>
            <?php
                if (isset($_POST['Wyswietl_all'])){
                    $db = mysqli_connect("localhost", "root", "", "przychodnia");
                    
                    if($db){

                        $zapytanie = "SELECT * FROM wizyty";
                        $query = mysqli_query($db, $zapytanie);

                        echo"<table>";
                            echo "<tr>";
                                echo "<td>" . '<b>ID Wizyty</b>'. "</td>";
                                echo "<td>" . '<b>ID Pacjenta</b>' . "</td>";
                                echo "<td>" . '<b>ID Lekarza</b>' . "</td>";
                                echo "<td>" . '<b>Data</b>' . "</td>";
                                echo "<td>" . '<b>Godzina</b>' . "</td>";
                                echo "<td>" . '<b>ID Gabinetu</b>' . "</td>";
                            echo "</tr>";

                        while($row = mysqli_fetch_array($query)){
                            echo "<tr>";
                                echo "<td>" . $row['id_wizyty'] . "</td>";
                                echo "<td>" . $row['id_pacjent'] . "</td>";
                                echo "<td>" . $row['id_lekarz'] . "</td>";
                                echo "<td>" . $row['daty'] . "</td>";
                                echo "<td>" . $row['godzina'] . "</td>";
                                echo "<td>" . $row['id_gabinet'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }else{
                        echo "<b>Błąd połączenia z bazą danych<b>";
                    }
                    mysqli_close($db);
                }
            ?>
            <br><br>
            <div id="form2">
                <span class="bigtitle">Wyszukiwanie wizyt danego dnia</span>
                <h3><b>Wybierz datę wizyty, którą chcesz wyszukać:</b></h3>
                <form method="POST">
                    <input type="date" name="szukajInput">
                    <input type="submit" name="szukaj" value="Szukaj"><br><br>
                </form>
            </div>
            <?php
                if(isset($_POST['szukaj'])){

                    $db = mysqli_connect("localhost", "root", "", "przychodnia");
                    $sql_all = "SELECT * FROM wizyty";
                    $query_all = mysqli_query($db, $sql_all);
                    $searchInput = $_POST['szukajInput'];
                        
                    if($db){
                        $sql_search =  "SELECT * FROM wizyty WHERE daty = '$searchInput'";
                        $query_search = mysqli_query($db, $sql_search);

                        if(empty($searchInput)){
                            echo "<br>";
                            echo "<b>Podaj datę wizyty.</b>";
                        }else if (mysqli_num_rows($query_search) == 0){
                            echo "<b>Tego dnia nie ma żadnej wizyty.</b>";
                        }else {
                            echo "<br>";
                            echo"<table>";
                                echo "<tr>";
                                    echo "<td>" . '<b>ID Wizyty</b>'. "</td>";
                                    echo "<td>" . '<b>ID Pacjenta</b>' . "</td>";
                                    echo "<td>" . '<b>ID Lekarza</b>' . "</td>";
                                    echo "<td>" . '<b>Data</b>' . "</td>";
                                    echo "<td>" . '<b>Godzina</b>' . "</td>";
                                    echo "<td>" . '<b>ID Gabinetu</b>' . "</td>";
                                echo "</tr>";

                        while($row = mysqli_fetch_array($query_search)){
                            echo "<tr>";
                                echo "<td>" . $row['id_wizyty'] . "</td>";
                                echo "<td>" . $row['id_pacjent'] . "</td>";
                                echo "<td>" . $row['id_lekarz'] . "</td>";
                                echo "<td>" . $row['daty'] . "</td>";
                                echo "<td>" . $row['godzina'] . "</td>";
                                echo "<td>" . $row['id_gabinet'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        }
                    }else{
                        echo "<b>Błąd połączenia z bazą danych</b>";
                    }
                    mysqli_close($db);
                }
            ?>
        </div>
    </body>
</html>