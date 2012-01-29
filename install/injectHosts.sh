#!/bin/bash

USERNAME='username';
PASSWORD='password';
DEASY_URL='http://DEASY_URL';

HOSTS="/etc/hosts";

# GET THE NEW CONFIG FROM THE SERVER
VHOSTS=`curl -f $DEASY_URL/rest/$USERNAME/$PASSWORD/vhosts 2>/dev/null`;

# CLEAR OLD RECORDS
sed -e '/### DEASY HOST CONFIG$/d' $HOSTS > $HOSTS.tmp;
mv $HOSTS.tmp $HOSTS;
# ADD A NEW CONFIG
echo "$VHOSTS" >> $HOSTS;
