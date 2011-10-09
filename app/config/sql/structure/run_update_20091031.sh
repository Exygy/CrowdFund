#!/bin/sh

scriptname=$0
username=$1
password=$2
database=$3

if [ "$username" = "" ] | [ "$password" = '' ] | [ "$database" = '' ]
then
    echo "usage: $0 <username> <password> <database>"
    exit 1;
fi

for i in $(find . -type f -mmin -120 | grep -v svn | grep -v "~" | grep sql | xargs ls );
do
    echo "running $i"
    mysql -u $username --password=$password $database < $i
done
