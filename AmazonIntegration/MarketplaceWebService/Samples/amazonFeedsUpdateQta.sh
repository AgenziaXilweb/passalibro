#!/bin/sh
###########################################
# Lancia la procedura che controlla       #
# se ci prodotti da eliminare da amazon   #
# quindi con giacenza 0                   #
###########################################

# BEGIN

#########################
#                       #
#  SEDE 1 NUOVO E USATO #
#                       #
#########################
#
# mysql -h 'localhost' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(1,"n")'
# mysql -h 'localhost' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(1,"u")'
# php ../SubmitFeedSample.php 1
#
#########################



#########################
#                       #
#  SEDE 2 NUOVO E USATO #
#                       #
#########################
#
  mysql -h 'localhost' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(2,"n")'
  mysql -h 'localhost' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(2,"u")'
  php ../SubmitFeedSample.php 2
#
#########################



#########################
#                       #
#  SEDE 3 NUOVO E USATO #
#                       #
#########################
#
# mysql -h 'localhost' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(3,"n")'
# mysql -h 'localhost' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(3,"u")'
# php ../SubmitFeedSample.php 3
#
#########################


#########################
#                       #
#  SEDE 4 NUOVO E USATO #
#                       #
#########################
#
# mysql -h 'localhost' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(4,"n")'
# mysql -h 'localhost' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(4,"u")'
# php ../SubmitFeedSample.php 4
#
#########################


#  END
