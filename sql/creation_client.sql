CREATE USER IF NOT EXISTS 'lectureSpectacle'@'localhost' IDENTIFIED WITH mysql_native_password AS 'spectacle';
GRANT SELECT ON festiplan.spectacle TO 'lectureSpectacle'@'localhost';

CREATE USER IF NOT EXISTS 'lectureSpectacleFestival'@'localhost' IDENTIFIED WITH mysql_native_password AS 'spectacleFestival';
GRANT SELECT ON festiplan.spectacle TO 'lectureSpectacleFestival'@'localhost';
GRANT SELECT ON festiplan.festival TO 'lectureSpectacleFestival'@'localhost';
