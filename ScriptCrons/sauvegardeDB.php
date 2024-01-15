<?php

/* Configuration de la base de données sur le serveur
$dbHost    = '127.0.0.1'
$dbPort    = '3306';
$dbName    = 'ucvjwjeq_festiplan';
$dbCharset = 'utf8mb4';
$dbUser    = 'root';
$dbPass    = 'root';
*/

// Informations de connexion MySQL locales
$dbHost    = 'localhost';
$dbPort    = '3306';
$dbName    = 'festiplan';
$dbCharset = 'utf8mb4';
$dbUser    = 'root';
$dbPass    = 'root';
$options   = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

// Informations de connexion FTP
$ftpHost = '185.221.182.121';
$ftpUserName = 'ftp@festiplan-sauvegarde.go.yj.fr';
$ftpPassword = '::kk/)CT(11mG9DkIm';

// Générer le nom du fichier de sauvegarde
$generatedFileName = 'backup_' . date('Ymd_hi') . '.sql';

// Chemins des fichiers locaux et distants
$localBackupDirectory = $_SERVER["DOCUMENT_ROOT"] . "Festiplan/FestiplanWeb/backupBD/";
$localFilePath = $localBackupDirectory . $generatedFileName;

$remoteFilePath = "backupBD/$generatedFileName";

try {
    $pdo = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=$dbCharset",
        $dbUser, $dbPass, $options);

    // Ouvrir le fichier en mode écriture
    $file = fopen($localFilePath, 'w');

    // Obtenir la requête de création de la base de données SQL
    $databaseCreateQuery = $pdo->query("SHOW CREATE DATABASE $dbName");
    $databaseCreateResult = $databaseCreateQuery->fetch(PDO::FETCH_NUM);
    $databaseCreate = $databaseCreateResult[1];

    // Écrire la requête de création de la base de données dans le fichier
    fwrite($file, "-- Création de la base de données\n");
    fwrite($file, "$databaseCreate;\n\n");

    // Tables dans l'ordre de création
    $tables = [
        'categorie',
        'utilisateurs',
        'taille_scene',
        'festival',
        'liste_organisateur',
        'scene',
        'spectacle',
        'spectacle_festival_scene',
        'liste_spectacle_temporaire',
        'liste_scene_temporaire',
        'liste_inter_hors_scene',
        'liste_inter_scene',
        'liste_scene',
    ];

    // Utiliser la base de données
    fwrite($file, "USE $dbName;\n\n");

    // Créer les tables et insérer les données
    foreach ($tables as $table) {
        // Structure
        $structureQuery = $pdo->query("SHOW CREATE TABLE $table");
        $structureResult = $structureQuery->fetch(PDO::FETCH_NUM);

        if ($structureResult) {
            $structure = $structureResult[1];
            fwrite($file, "-- Structure de la table `$table`\n");
            fwrite($file, "$structure;\n\n");

            // Requête de récupération des données
            $dataQuery = $pdo->query("SELECT * FROM $table");
            $rows = $dataQuery->fetchAll(PDO::FETCH_ASSOC);

            if ($rows) {
                fwrite($file, "-- Insertion des données dans la table `$table`\n");
                foreach ($rows as $row) {
                    $columns = implode(', ', array_keys($row));
                    $values = implode(', ', array_map(function ($value) use ($pdo) {
                        return ($value === null) ? 'NULL' : $pdo->quote($value);
                    }, $row));

                    fwrite($file, "INSERT INTO $table ($columns) VALUES ($values);\n");
                }
                fwrite($file, "\n");
            }
        } else {
            // Ajouter des informations de débogage
            echo "Échec de l'obtention de la structure de la table : $table\n";
            print_r($pdo->errorInfo());
        }
    }

    // Fermer le fichier
    fclose($file);

    echo "Sauvegarde de la base de données créée avec succès à l'emplacement : $localFilePath<br><br>";

    // Configuration de la connexion FTP
    $ftp = ftp_connect($ftpHost);
    if (!$ftp) {
        throw new Exception("La connexion FTP a échoué");
    }

    // Connexion avec le nom d'utilisateur et le mot de passe
    $login_result = ftp_login($ftp, $ftpUserName, $ftpPassword);
    if (!$login_result) {
        throw new Exception("La connexion FTP a échoué");
    }

    // Basculer en mode passif
    if (!ftp_pasv($ftp, true)) {
        throw new Exception("Impossible d'activer le mode passif");
    }

    // Vérifier la connexion
    echo "Connecté à $ftpHost, en tant qu'utilisateur $ftpUserName<br><br>";

    // echo des chemins
    echo "localFilePath : $localFilePath<br><br>";
    echo "remoteFilePath : $remoteFilePath<br><br>";

    // vérifier si le fichier existe
    if (!file_exists($localFilePath)) {
        throw new Exception("The backup file does not exist: $localFilePath");
    }

    //verifier si le fichier est lisible
    if (!is_readable($localFilePath)) {
        throw new Exception("The backup file is not readable: $localFilePath");
    }

    // Télécharger un fichier
    $upload_result = ftp_put($ftp, $remoteFilePath, $localFilePath, FTP_BINARY);
    if ($upload_result) {
        echo "Téléchargement réussi de $generatedFileName\n";
    } else {
        $error_message = error_get_last()['message'] ?? "Erreur inconnue";
        throw new Exception("Un problème est survenu lors du téléchargement de $localFilePath. Erreur : $error_message");
    }

    // Fermer la connexion
    ftp_close($ftp);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
