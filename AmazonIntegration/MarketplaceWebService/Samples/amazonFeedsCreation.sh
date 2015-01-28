#!/bin/sh
###############################
# Controllo nuove giacenze da #
# pubblicare su amazon        #
###############################

# BEGIN

#########################
#                       #
#  SEDE 1 NUOVO E USATO #
#                       #
#########################
#
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonSellProducts(1,"n","books")'
 sleep 5
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonSellProducts(1,"u","books")'
 sleep 5
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonSellProducts(1,"n","toys")'
 sleep 5
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonSellProducts(1,"u","toys")'
 sleep 5
#
#########################



#########################
#                       #
#  SEDE 2 NUOVO E USATO #
#                       #
#########################
#
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonSellProducts(2,"n","books")'
 sleep 5
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonSellProducts(2,"u","books")'
 sleep 5
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonSellProducts(2,"n","toys")'
 sleep 5
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonSellProducts(2,"u","toys")'
 sleep 5
#
#########################



#########################
#                       #
#  SEDE 3 NUOVO E USATO #
#                       #
#########################
#
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonSellProducts(3,"n","books")'
 sleep 5
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonSellProducts(3,"u","books")'
 sleep 5
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonSellProducts(3,"n","toys")'
 sleep 5
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonSellProducts(3,"u","toys")'
 sleep 5
#
#########################



#########################
#                       #
#  SEDE 4 NUOVO E USATO #
#                       #
#########################
#
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonSellProducts(4,"n","books")'
 sleep 5
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonSellProducts(4,"u","books")'
 sleep 5 
#
#########################

# END
