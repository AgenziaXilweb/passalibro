#!/bin/sh
#################################
# Controllo lo status dei feeds #
# lanciati su amazon            #
#################################

# BEGIN

#########################
#                       #
#  SEDE 1 NUOVO E USATO #
#                       #
#########################
#
 php GetFeedSubmissionListSample.php 1
 php GetFeedSubmissionResultSample.php 1
#
#########################



#########################
#                       #
#  SEDE 2 NUOVO E USATO #
#                       #
#########################
#
 php GetFeedSubmissionListSample.php 2
 php GetFeedSubmissionResultSample.php 2
#
#########################



#########################
#                       #
#  SEDE 3 NUOVO E USATO #
#                       #
#########################
#
 php GetFeedSubmissionListSample.php 3
 php GetFeedSubmissionResultSample.php 3
#
#########################



#########################
#                       #
#  SEDE 4 NUOVO E USATO #
#                       #
#########################
#
 php GetFeedSubmissionListSample.php 4
 php GetFeedSubmissionResultSample.php 4
#
#########################



#   END

