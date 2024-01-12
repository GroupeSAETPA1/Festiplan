<?php

// Informations de connexion MySQL
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'root';
$dbName = 'festiplan';

// Informations de connexion FTP
$ftpHost = 'node178-eu.n0c.com';
$ftpUser = 'ftp@festiplan.go.yo.fr';
$ftpPass = '*bN.t*IbNN*f**.6a.';
$ftpDir = '/home/vhjxwkvz/backupDB';

// Chemin de sauvegarde local
$backupDir = '/backupBD';

// Nom du fichier de sauvegarde
$backupFile = 'backup_' . date('Ymd') . '.sql';

// Commande mysqldump
$command = "mysqldump -u $dbUser -p$dbPass -h $dbHost $dbName > $backupDir/$backupFile";
exec($command);

// Connexion FTP et transfert du fichier
$ftpCommand = "lftp -u $ftpUser,$ftpPass $ftpHost -e 'set ftp:ssl-allow no; cd $ftpDir; put $backupDir/$backupFile; bye'";
exec($ftpCommand);

echo "Sauvegarde terminée avec succès.\n";

?>