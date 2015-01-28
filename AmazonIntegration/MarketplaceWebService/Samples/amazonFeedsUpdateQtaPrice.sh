#!/bin/sh
#####################################################
# Lancia le procedure che controllano la variazione #
# di quantita e prezzo dei prodotti presenti        #
# su amazon.                                        #
#####################################################

# BEGIN

#########################
#                       #
#  SEDE 1 NUOVO E USATO #
#                       #
#########################
#
# Verifica delle quantita
#
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(1,"n")'
 sleep 15 
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(1,"u")'
#
# Verifica variazione del prezzo (triggerato da catalogo_sedi)
#
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsPrice(1,"n")'
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsPrice(1,"u")'
#
#########################



#########################
#                       #
#  SEDE 2 NUOVO E USATO #
#                       #
#########################
#
# Verifica delle quantita
#
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(2,"n")'
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(2,"u")'
#
# Verifica variazione del prezzo (triggerato da catalogo_sedi)
#
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsPrice(2,"n")'
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsPrice(2,"u")'
#
#########################


#########################
#                       #
#  SEDE 3 NUOVO E USATO #
#                       #
#########################
#
# Verifica delle quantita
#
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(3,"n")'
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(3,"u")'
#
# Verifica variazione del prezzo (triggerato da catalogo_sedi)
#
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsPrice(3,"n")'
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsPrice(3,"u")'
#
#########################


#########################
#                       #
#  SEDE 4 NUOVO E USATO #
#                       #
#########################
#
# Verifica delle quantita
#
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(4,"n")'
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsQuantity(4,"u")'
#
# Verifica variazione del prezzo (triggerato da catalogo_sedi)
#
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsPrice(4,"n")'
 sleep 15
 mysql -h '172.19.0.30' -u passalibroweb -p'passa20libro12' passalibroweb -e 'CALL amazonUpdateProductsPrice(4,"u")'
#
#########################


#  END
