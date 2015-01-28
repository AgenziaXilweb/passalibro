php ApiCall.php CreateBackShip 1 1
chown sdausers:ftp /home/sdausers/busto/*.*
php ApiCall.php CreateBackShip 2 1
chown sdausers:ftp /home/sdausers/sesto/*.*
php ApiCall.php CreateBackShip 3 1
chown sdausers:ftp /home/sdausers/milano/*.*
mv /home/sdausers/busto/*.elab /home/sdausers/busto/.elab
mv /home/sdausers/sesto/*.elab /home/sdausers/sesto/.elab
mv /home/sdausers/milano/*.elab /home/sdausers/milano/.elab